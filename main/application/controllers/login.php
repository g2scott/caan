<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users moede will be used in this whole class 
		$this->load->model('user');
		// need load helper before use it
		// $this->load->helper('url');
	}

	
	public function index()
	{
		if (isset($_POST['login'])) 
		{	
			/**
			 * add user login validation here!!!
			 */
			$user_id = 2; // this hard code to test
			$row = $this->user->find_user_by_id($user_id);
			$data["about_me"] = $row->about_me_text;
			$last_name = $row->last;
			$first_name = $row->first;
			$data["user_name"] = $first_name . " " . $last_name;
			
			$this->load->view('user_page', $data);
		}else {
			$this->load->view('register_form');
		}	
			
	}
	
	public function login_user()
	{
		$this->load->view('login_form');
	}
	
	public function register()
	{
		if (isset($_POST['login'])) 
		{
			//user has tried registering, insert them into database
			$email = $_POST['email'];
			$login = $_POST['login'];
			$first = $_POST['first'];
			$last = $_POST['last'];
			$password = $_POST['password'];
			$about_me_text = $_POST['about_me_text'];
		
			// call user model register function, return boolean
			$this->user->register($email, $login, $first, $last, $password, $about_me_text);
			// $message = "insert successful."
			redirect('login');
		}else{
			// user has not tried registering, bring up registeration information  
			$this->load->view('database_test');
		}
		
		
		
	}


}