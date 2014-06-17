<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		session_start();
	}
	
	
	public function build_profile()
	{
		$this->load->model('user');
		$user_id = $_SESSION['user_id'];
		$result = $this->user->find_user_by_id($user_id);
		$result = json_encode($result);
		echo $result;
	}
	
	public function build_video_list()
	{
		$this->load->model('video');
		$user_id = $_SESSION['user_id'];
		$result = $this->video->find_video_by_user($user_id);
		echo $result;
	}

}	
	
?>	