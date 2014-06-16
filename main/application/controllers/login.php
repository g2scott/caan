<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users moede will be used in this whole class 
		$this->load->model('user');
		// need load helper before use it
		// $this->load->helper('url');
		session_start(); 		// call session start
	}

	public function index()
	{
		// if(isset(true))
		if (isset($_POST['username'])) 
		{	
			/**
			 *  user login validation here
			 *
			 * need add salt and blowfish later 
			 */
			$user_name = $_POST['username'];
			// $this->fireb->info($user_name, "what login is");
			$user_password = $_POST['password'];
			$password = $this->user->find_user_password($user_name);
			// $this->fireb->info($password, "info");
			// $this->fireb->info($user_password, "info");
			
			
			if($user_password == $password)
			{	
				$user_id = $this->user->find_user_id($user_name);
				$_SESSION['user_id'] = $user_id;
				$_SESSION['user_name'] = $user_name;
				
				// //$user_id = 2; // this hard code to test
				// 			$row = $this->user->find_user_by_id($user_id);
				// 			$data["about_me"] = $row->about_me_text;
				// 			$last_name = $row->last;
				// 			$first_name = $row->first;
				// 			$data["user_name"] = $first_name . " " . $last_name;
				$this->load->view('profile');
				
			}else{
					$data["message"] = "username/password not match.";
					// $this->login->index();
					$this->load->view('login_form', $data);
				}
			
		}elseif(isset($_SESSION['user_name'])) {
			$this->fireb->info("printed profile form here");
			$this->load->view('profile');
		}else{
			$this->load->view('register_form');
		}		
	}
	
	public function login_user()
	{
		$this->load->view('login_form');
	}
	
	public function register()
	{
		if (isset($_POST['username'])) 
		{
			//user has tried registering, insert them into database
			$email = $_POST['email'];
			$login = $_POST['username'];
			$first = $_POST['first'];
			$last = $_POST['last'];
			$password = $_POST['password'];
			$about_me_text = $_POST['about_me_text'];
		
			// call user model register function, return boolean
			$this->user->register($email, $login, $first, $last, $password, $about_me_text);
			// $message = "insert successful."
			redirect('login/login_user');
		}else{
			// user has not tried registering, bring up registeration information  
			$this->load->view('database_test');
		}
		
		
		
	}

	public function logout_user()
	{
		$_SESSION['user_id'] = null;
		$_SESSION['user_name'] = null;
		redirect('login/login_user');
	}
	
}