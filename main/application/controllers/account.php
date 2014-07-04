<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start(); 		// call session start
	require_once '../vendor/autoload.php';
	use Facebook\FacebookRequest;
	use Facebook\GraphUser;
	use Facebook\FacebookRequestException;

	class Account extends CI_Controller {

		public $fb_helper;
		public $fb_session;
		// public $session_data;

		private $appId = "481528471979743";
		private $appSecret = "076f8796209ca3aac466108669545f03";

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user');
			$this->load->helper('form');
			/**
			 * construct facebook helper when this controller been called
			 * to prepare the user login with facebook
			 *	
			 * might need deal some expression later 	
			 */
			$this->_facebook_login();
			
			/**
			 *  end of facebook helper prepare
			 */
		}

		/**
		 * function to prepare facebook login with facebook app configuration information
		 * this will be called throught this controller constructor when this controller been invoked
		 */
		public function _facebook_login()
		{
			// $appId = "481528471979743";
			// $appSecret = "076f8796209ca3aac466108669545f03";
			// $redirect_url = "http://www.bellashop.ca/simplenote/public/";
			$redirect_url = "http://localhost/htdocs/caan/main/main/index.php/account/Login";
			// $redirect_url = "http://localhost/~vincent/caan/main/index.php";

			// $appId = "129704493787021";
			// $appSecret = "9f2f02c678fb359804197bc05e3eacd6";
			// $redirect_url = "http://50.87.144.46/~caan/main";

			Facebook\FacebookSession::setDefaultApplication($this->appId, $this->appSecret);
			$this->fb_helper = new Facebook\FacebookRedirectLoginHelper($redirect_url, $this->appId, $this->appSecret);

			try {
			  $session = $this->fb_helper->getSessionFromRedirect();
			} catch(FacebookRequestException $ex) {
			  // When Facebook returns an error
			} catch(\Exception $ex) {
			  // When validation fails or other local issues
			}
			if ($session) {
			    // Logged in
				// create a user in my database, to compare with next login, 
				// simple store user's facebook username as 

				// $session_data = array('user'  => "vincent_test");
				// $this->session->set_userdata($session_data);
				// $this->load->view('profile_page');
				$this->fb_session = $session;
			}
		}

		/**
		 * if login user with active facebook session, will to retrive this user
		 */
		// public function _retrive_facebook_user($user)
		// {
		// 	if (false) {
		// 		// find the user from the database to setup $session_data
		// 		$session_data = array(
	 //                'user'  	=> $user,
	 //                'user_id'   => $user->id,
	 //                'logged_in' => TRUE
	 //            );

		// 		$this->session->set_userdata($session_data);
		// 	} else {
		// 		// add user to our database
		// 		$this->_create_account_for_fb_user();

		// 	}
		// }

		/**
		 * create account for facebook user at the first time logged in throught their facebook account
		 * user_id, user_name, user_profile, and user_infor get from the facebook profile
		 * to insert this into the database. 
		 */
		public function _create_account_for_fb_user()
		{
			$user = new User();
			// $user->id = ''; // came from facebook user account
			// $user->password = ''; // need generate by the system

			$facebook = new Facebook(array(
			  'appId' => $this->appId,
			  'secret' => $this->appSecret,
			));
			if ($user) {
			  try {
			    // Proceed knowing you have a logged in user who's authenticated.
			    $user_profile = $facebook->api('/me');
			  } catch (FacebookApiException $e) {
			    error_log($e);
			    $user = null;
			  }
			}
			$this->load->model('user_model');
			$this->user_model->insert($user);
		}
	
		/**
		 * during user login need to check if this user clicked login with facebook link 
		 * and with active facebook session if not using regular login function from login_form form
		 * 
		 */	
		public function login() {

			if (isset($this->fb_session)) {

				try {
				    // $user_profile = (new FacebookRequest(
				    //   $this->fb_session, 'GET', '/me'
				    // ))->execute()->getGraphObject(GraphUser::className());

				    $user_profile = (new FacebookRequest(
				      $this->fb_session, 'GET', '/me'
				    ))->execute()->getGraphObject();;
			    

				    // echo "Name: " . $user_profile->getName();

			  	} catch(FacebookRequestException $e) {

				    echo "Exception occured, code: " . $e->getCode();
				    echo " with message: " . $e->getMessage();
				}    

				$data['url'] = site_url();
				$this->load->view('profile_page', $data);
			} else {
				$this->load->library('form_validation');
				$this->form_validation->set_rules('username', 'Username', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required');
			
				if ($this->form_validation->run() == FALSE)
				{
					$data['helper'] = $this->fb_helper;
					$this->load->view('account/login_form', $data);
				}
				else
				{
					$login = $this->input->post('username');
					$clearPassword = $this->input->post('password');
			
					$this->load->model('user_model');
			
					$user = $this->user_model->get($login);
			
					if (isset($user) && $user->comparePassword($clearPassword)) {

						$session_data = array(
		                   'user'  		=> $user,
		                   'user_id'    => $user->id,
		                   'logged_in' 	=> TRUE
		               );

						$this->session->set_userdata($session_data);

						// $_SESSION['user'] = $user;
						// $_SESSION['user_id'] = $user->id; // need return a user id from above get function 

						$data['user']=$user;
						$data['url'] = site_url();
			
						$this->load->view('profile_page', $data);
						//redirect('profile_page/index', 'refresh'); //redirect to the main application page
					}
					else {
						$data['errorMsg']='Incorrect username or password!';
						$data['helper'] = $this->fb_helper;
						$this->load->view('account/login_form',$data);
						
					}
				}			
			}		
		}
	
		public function login_user()
		{
			$data['helper'] = $this->fb_helper;
			//$data['test'] = 'test message';
			$this->load->view('Account/login_form', $data);
		}
		
		public function register_user()
		{
			$url['url'] = base_url();
			$this->load->view('Account/register_form', $url);
		}
	
		/**
		 * This function is used to register new user to insert to user table
		 * create a User object then insert to user table
		 */
		function createNew() {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.user_name]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('first', 'First', "required");
			$this->form_validation->set_rules('last', 'last', "required");
			$this->form_validation->set_rules('email', 'Email', "required|is_unique[users.email]");
		
			 
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('account/register_form');
			}
			else
			{
				$user = new User(); // this class autoloaded 
		
				$user->user_name = $this->input->post('username');
				$user->first = $this->input->post('first');
				$user->last = $this->input->post('last');
				$clearPassword = $this->input->post('password');
				$user->encryptPassword($clearPassword);
				$user->email = $this->input->post('email');
				$user->about_me_text = $_POST['about_me_text'];
				 
				$this->load->model('user_model');
		
				 
				$error = $this->user_model->insert($user);

				$data['helper'] = $this->fb_helper; 
				$this->load->view('account/login_form', $data);
			}
		}


		public function logout_user()
		{
			//session_destroy();
			// $this->session->unset_userdata('some_name');
			$this->session->sess_destroy();
			$this->load->view('main_page.html');
		}
		
		public function recoverPasswordForm() {
			$this->load->view('Account/recoverPasswordForm');
		}
	
		public function recoverPassword() {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'email', 'required');
		
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('account/recoverPasswordForm');
			}
			else
			{
				$email = $this->input->post('email');
				$this->load->model('user_model');
				$user = $this->user_model->getFromEmail($email);
		
				if (isset($user)) {
					$newPassword = $user->initPassword();
					$this->user_model->updatePassword($user);
		
					$this->load->library('email');
			   
					$config['protocol']    = 'smtp';
					$config['smtp_host']    = 'ssl://smtp.gmail.com';
					$config['smtp_port']    = '465';
					$config['smtp_timeout'] = '7';
					$config['smtp_user']    = 'your gmail user name';
					$config['smtp_pass']    = 'your gmail password';
					$config['charset']    = 'utf-8';
					$config['newline']    = "\r\n";
					$config['mailtype'] = 'text'; // or html
					$config['validation'] = TRUE; // bool whether to validate email or not
		
					$this->email->initialize($config);
		
					$this->email->from('csc309Login@cs.toronto.edu', 'Login App');
					
					$this->email->to($user->email);
		
					$this->email->subject('Password recovery');
					$this->email->message("Your new password is $newPassword");
		
					$result = $this->email->send();
		
					//$data['errorMsg'] = $this->email->print_debugger();
		
					//$this->load->view('emailPage',$data);
					$this->load->view('Account/login_form');
		
				}else {
					$data['errorMsg']="No record exists for this email!";
					$this->load->view('account/recoverPasswordForm',$data);
				}
			}
		}
	
	}
?>