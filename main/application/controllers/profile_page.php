<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users model will be used in this whole class 
		$this->load->model('video');
		$this->load->model('user');
		// need load helper before use it
		// $this->load->helper('url');
	}
	
	function index() {
		$this->load->view('arcade/mainPage');
	}
	
	public function build_profile()
	{
		$user_id = $_SESSION['user_id'];
		$result = $this->user->find_user_by_id($user_id);
		$result = json_encode($result);
		echo $result;
	}
	
	public function build_video_list()
	{
		$user_id = $_SESSION['user_id'];
		$result = $this->video->find_video_by_user($user_id);
		echo $result;
	}

}	
	
?>	