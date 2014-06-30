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

	public function stream($user_name)
	{
		// get following users
		$users = $this->user_model->find_following_users($user_name);
		$user_array = explode(",", $users);
		foreach ($user_array as $key => $value) {
			$return = $this->video_model->find_video_by_user($value);
			$data["user_{$key}"] = $return;
		}
		echo $data;
	}

	public function search($search_term)
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


}
?>