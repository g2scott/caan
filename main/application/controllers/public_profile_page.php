<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_profile_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//session_start();
	}
	
	public function load($user_id)
	{
		$user_id = $user_id;
		$data['url'] = site_url();
		$data['user_id'] = $user_id;
		$this->load->view('public_profile_page', $data);
	}

	public function build_public_profile($user_id)
	{
		$this->load->model('user_model');
		$user_id = $user_id;
		$result = $this->user_model->find_user_by_id($user_id);
		$result = json_encode($result); // moved out json_encode from find_user_by_id function
		echo $result;
		
	}

	public function build_public_video_list($user_id)
	{
		$this->load->model('video_model');
		$user_id = $user_id;
		$result = $this->video_model->find_video_by_user($user_id);
		echo $result;
		
	}

}	
	
?>	