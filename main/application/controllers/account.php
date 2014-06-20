<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users moede will be used in this whole class 
		$this->load->model('user');
		// need load helper before use it
		// $this->load->helper('url');
		//session_start(); 		// call session start
	}

		
	function login() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('account/login_form');
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
				$this->load->view('account/login_form',$data);
				
			}
		}
	}
	
	public function login_user()
	{
		$this->load->view('Account/login_form');
	}
	
	public function register_user()
	{
		$this->load->view('Account/register_form');
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
			 
			$this->load->view('account/login_form');
		}
	}
	
// 	public function register()
// 	{
// 		if (isset($_POST['username'])) 
// 		{
// 			//user has tried registering, insert them into database
// 			$email = $_POST['email'];
// 			$login = $_POST['username'];
// 			$first = $_POST['first'];
// 			$last = $_POST['last'];
// 			$password = $_POST['password'];
// 			$about_me_text = $_POST['about_me_text'];
		
// 			$this->load->model('user_model');
// 			// call user model register function, return boolean
// 			$this->user_model->register($email, $login, $first, $last, $password, $about_me_text);
// 			// $message = "insert successful."
// 			redirect('account/login_user');
// 		}else{
// 			// user has not tried registering, bring up registeration information  
// 			$this->load->view('database_test');
// 		}
		
		
		
// 	}


	public function logout_user()
	{
		session_destroy();
		$this->load->view('landing.html');
	}
	
}