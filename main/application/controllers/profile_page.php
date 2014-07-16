<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//session_start();
		$this->load->model('video_model');
		$this->load->model('user_model');
	}
	
	
	public function build_profile()
	{
		$this->load->model('user_model');
		$user_id = $this->session->userdata('user_id');
		$result = $this->user_model->find_user_by_id($user_id);
		$result = json_encode($result);
		echo $result;
	}
	
	public function build_video_list()
	{
		$user_id = $this->session->userdata('user_id');
		$result = $this->video_model->find_video_by_user($user_id);
		$json_result = json_encode($result);
		echo $json_result;
	}

	public function find_user_img_path()
	{
		$this->load->helper('directory');
		$dir = './assets/img/profile';
		$map = directory_map($dir);
		$user_id = $this->session->userdata['user_id'];
		foreach ($map as $key => $value) {
			$file = strstr($value, '.' , true);
			if ($user_id == $file) {
				$data['file'] = $value;
			}
		}
		$data['url'] = base_url();
		$result = json_encode($data);
		echo $result; 
	}

	/**
	 * Two processes to delete video
	 * 1. delete video from sprout video (need a sprout_video id)
	 * 2. delete video record from videos table
	 * @param String $video_id passed from user click
	 */
	public function delete($video_id)
	{
		$video = $this->video_model->find_video_by_id($video_id);
		$sprout_id = $video->sprout_id;
		try {
			$return = $this->video_model->delete_from_sprout($sprout_id);
			
		} catch (Exception $e) {
			$req = $e->getRequest();
            $resp =$e->getResponse();
            echo $req;
            echo $resp;
		}
		

		if (isset($return)) {
			// delete record from videos table
			$result = $this->video_model->delete_video_by_id($video_id);
			$data['url'] = site_url();
			$this->load->view('profile_page', $data);
		}

	}



	// /**
	//  * user login their profile page, click 'feed' button, then load single page view, triger
	//  * javascript file to run ajax call this controller get the json return then display at 
	//  * the main pages
	//  */
	// public function build_video_stream()
	// {
	// 	$user_id = $this->session->userdata['user_id'];
	// 	$following_string = $this->user_model->find_following_users($user_id);
	// 	$array = explode(",", $following_string);
	// 	$data = array();
	// 	foreach ($array as $key => $value) {
	// 		$data['$key'] = $this->video_model->find_video_by_user($value);
	// 	}
	// 	$json_result = json_encode($data);
	// 	echo $json_result;
	// }

}
?>