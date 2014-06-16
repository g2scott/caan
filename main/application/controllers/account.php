<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users moede will be used in this whole class 
		$this->load->model('user');
		// need load helper before use it
		// $this->load->helper('url');
		session_start(); 		// call session start
	}

// 	public function index()
// 	{
// 		// if(isset(true))
// 		if (isset($_POST['username'])) 
// 		{	
// 			/**
// 			 *  user login validation here
// 			 *
// 			 * need add salt and blowfish later 
// 			 */
// 			$user_name = $_POST['username'];
// 			// $this->fireb->info($user_name, "what login is");
// 			$user_password = $_POST['password'];
// 			$this->load->model('user_model');
// 			$password = $this->user_model->find_user_password($user_name);
// 			// $this->fireb->info($password, "info");
// 			// $this->fireb->info($user_password, "info");
			
			
// 			if($user_password == $password)
// 			{	
// 				$user_id = $this->user_model->find_user_id($user_name);
// 				$_SESSION['user_id'] = $user_id;
// 				$_SESSION['user_name'] = $user_name;
				
// 				// //$user_id = 2; // this hard code to test
// 				// 			$row = $this->user->find_user_by_id($user_id);
// 				// 			$data["about_me"] = $row->about_me_text;
// 				// 			$last_name = $row->last;
// 				// 			$first_name = $row->first;
// 				// 			$data["user_name"] = $first_name . " " . $last_name;
// 				$data['url'] = site_url();
// 				$this->load->view('profile', $data);
				
// 			}else{
// 					$data["message"] = "username/password not match.";
// 					// $this->login->index();
// 					$this->load->view('login_form', $data);
// 				}
			
// 		}elseif(isset($_SESSION['user_name'])) { // this need more specific 
// 			//$this->fireb->info("printed profile form here");
// 			$data['url'] = site_url();
// 			$this->load->view('profile', $data);
// 		}else{
// 			$this->load->view('register_form');
// 		}		
// 	}
	
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
				$_SESSION['user'] = $user;
				$data['user']=$user;
				$data['url'] = site_url();
	
				$this->load->view('profile', $data);
				//redirect('profile', 'refresh'); //redirect to the main application page
			}
			else {
				$data['errorMsg']='Incorrect username or password!';
				$this->load->view('account/login_form',$data);
				
			}
		}
	}
	
	public function login_user()
	{
		$this->load->view('account/login_form');
	}
	
	public function register_user()
	{
		$this->load->view('account/register_form');
	}
	
	function createNew() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.user_name]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('first', 'First', "required");
		$this->form_validation->set_rules('last', 'last', "required");
		$this->form_validation->set_rules('email', 'Email', "required|is_unique[users.email]");
	
		 
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('account/newForm');
		}
		else
		{
			$user = new User();
	
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