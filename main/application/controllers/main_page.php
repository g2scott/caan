<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('video_model');
		$this->load->model('user_model');

	}

	public function index()
	{
		$this->load->view('main_page.html');   
	}

	public function build_category()
	{
		$return = $this->video_model->find_video_catgories(); 
		// $return = NULL;
		// need echo or print to ajax response
		echo $return;
	}

	// public function stream($user_name)
	// {
	// 	// get following users
	// 	$users = $this->user_model->find_following_users($user_name);
	// 	$user_array = explode(",", $users);
	// 	foreach ($user_array as $key => $value) {
	// 		$return = $this->video_model->find_video_by_user($value);
	// 		$data["user_{$key}"] = $return;
	// 	}
	// 	echo $data;
	// }

	/**
	 * user login their profile page, click 'feed' button, then load single page view, triger
	 * javascript file to run ajax call this controller get the json return then display at 
	 * the main pages
	 */
	public function build_video_stream()
	{
		if (isset($this->session->userdata['user_id'])) {
			$user_id = $this->session->userdata['user_id'];
			$following_string = $this->user_model->find_following_users($user_id);
			$array = explode(",", $following_string);
			$data = array();
			foreach ($array as $key => $value) {
				$result = $this->video_model->find_video_by_user($value);
				if (isset($result)) {
					$data["{$value}"] = $result;
				}
			}
			$json_result = json_encode($data);
			echo $json_result;
		} else {
			$data['result'] = FALSE;
			$json_result = json_encode($data);
			echo $json_result;
		}
		
	}
	
	public function privacy(){
		$this->load->view('privacy_policy.php');
	}
	
	public function nominations(){
		$this->load->view('contest_details.php');
	}

	public function search_video($search_term)
	{
		$result_one = $this->video_model->find_video_by_video_name($search_term);
		$result_two = $this->video_model->find_video_by_user_first($search_term);
		if(!empty($result_one)){
			$data = $result_one;
		}else {
			$data = $result_two;
		}
		echo $data; 
	}

	public function check_login()
	{
		
		if (isset($this->session->userdata['user_id'])) {
			$user_id = $this->session->userdata['user_id'];
			$data['login'] = $user_id;
		}else{
			$data['login'] = FALSE;
		}
		$data = json_encode($data);
		echo $data;
	}

}
?>