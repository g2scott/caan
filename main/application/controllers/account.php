<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start(); 		// call session start

	class Account extends CI_Controller {

		public $fb_helper;
		public $fb_session;

		public function __construct()
		{
			parent::__construct();
			$this->load->model('user');
			$this->load->helper('form');
		}
		
		public function _remap($method, $params = array()) {
			// enforce access control to protected functions
		
			$protected = array('recoverPassword','logout_user');
		
			if (in_array($method,$protected) && !$this->session->userdata('logged_in')     )
				redirect('account/login', 'refresh'); //Then we redirect to the index page again
				
			return call_user_func_array(array($this, $method), $params);
		}

		public function load_login(){
			$this->load->view('Account/login_form');
		}
		
		/**
		 * during user login need to check if this user clicked login with facebook link 
		 * and with active facebook session if not using regular login function from login_form form
		 * 
		 */	
		public function login() {

				$this->load->library('form_validation');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('password', 'Password', 'required | alpha_dash');
				
			
				if ($this->form_validation->run() == FALSE)
				{
					echo json_encode(array('status'=>'error','message'=>"Incorrect username or password!"));
				}
				else
				{
					$login = $this->input->post('email');
					$clearPassword = $this->input->post('password');
			
					$this->load->model('user_model');
			
					$user = $this->user_model->getFromEmail($login);
			
					if (isset($user) && $user->comparePassword($clearPassword)) {

						$session_data = array(
		                   'user_id'    => $user->id,
		                   'logged_in' 	=> TRUE,
							'fb_session' => FALSE,
							'fb_token' => "0"
		               );

						$this->session->set_userdata($session_data);
// 						$data['user']=$user;
// 						$data['url'] = site_url();
		
						//$this->load->view('profile_page', $data);

						echo json_encode(array('status'=>'success','message'=>"/profile_page"));

						//redirect('profile_page/index', 'refresh'); //redirect to the main application page
					}
					else {
// 						$data['errorMsg']='Incorrect username or password!';
// 						$data['helper'] = $this->fb_helper;
// 						/$this->load->view('Account/login_form',$data);
						echo json_encode(array('status'=>'error','message'=>"Couldn't find you, check your credentials."));
						
					}
				}			
					
		}
// FACEBOOK LOGIN
		public function login_user()
		{
				
		$this->load->model('user_model');

		$user = $this->user_model->getFromEmail($this->input->post('email'));
	
		if (isset($user)){
			$session_data = array(
					'user_id'    => $user->id,
					'logged_in' 	=> TRUE
			);
			
			$this->session->set_userdata($session_data);

	
			//redirect('profile_page/', 'refresh');
			echo json_encode(array('status'=>'success','message'=>"profile_page"));
			
		}else{
		
			$user = new User(); // this class autoloaded
			
			$user->user_name = $this->input->post('user_name');
// 			$user->first = $this->input->post('first');
// 			$user->last = $this->input->post('last');
			$user->email = $this->input->post('email');
			$user->fb_id = $this->input->post('id');
			$user->img_path = $this->input->post('userPic');
				
			$this->load->model('user_model');
			
			$this->db->trans_start();
			$this->user_model->insert($user);
			$this->db->trans_complete();
			
			$user = $this->user_model->getFromEmail($this->input->post('email'));
			
			if (isset($user)){
			$session_data = array(
					'user_id'    => $user->id,
					'logged_in' 	=> TRUE,
					'fb_session' => TRUE,
					'fb_token' => "0"
			);
			
			$this->session->set_userdata($session_data);
			
			$data['user']=$user;
			$data['url'] = site_url();
			
			//$this->load->view('profile_page', $data);
			
			echo json_encode(array('status'=>'success','message'=>"profile_page"));
			
		}
		}
				
				

			
		}
		
		public function register_user()
		{
			$data['error'] = "";
			$this->load->view('Account/register_form', $data);
		}
	
		/**
		 * This function is used to register new user to insert to user table
		 * create a User object then insert to user table
		 */
		function createNew() {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.user_name]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[8]|alpha_dash');
// 			$this->form_validation->set_rules('first', 'First', "required");
// 			$this->form_validation->set_rules('last', 'last', "required");
			$this->form_validation->set_rules('email', 'Email', "required|is_unique[users.email]");
		
			 
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
				$this->load->view('Account/register_form', $data);
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
		
				$this->load->view('Account/login_form');
			}
		}


		public function logout_user()
		{
			$this->session->sess_destroy();
			redirect('/', 'refresh');
		}
		
		public function recoverPasswordForm() {
			$this->load->view('Account/recoverPasswordForm');
		}
	
		public function recoverPassword() {
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'email', 'required');
		
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('Account/recoverPasswordForm');
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
					$this->load->view('Account/recoverPasswordForm',$data);
				}
			}
		}
	
	}
?>