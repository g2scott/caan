<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Public_profile_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// session_start();
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
		$json_result = json_encode($result);
		echo $json_result;
	}

	public function build_follow_button($user_id)
	{
		// check if current user has been followd or not ? 
		// I know the user of this profile's id
		$this->load->model('user_model');
		$data = '';
		$tester = $this->user_model->is_following($user_id);
		if (is_null($tester)) {
			$data = NULL;

		}else {
			if ($tester) {
				$data = TRUE;
			}else {
				$data = FALSE;
			}
		}

		$return['data'] = $data;
		$json_return = json_encode($return);
		echo $json_return; // string follow or not follow
	}

	public function find_user_img_path($user_id)
	{
		$this->load->helper('directory');
		$dir = './assets/img/profile';
		$map = directory_map($dir);
		// $user_id = $this->session->userdata['user_id'];
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
	 * to follow athlete from athlete profile by clicking follow button
	 */
	public function follow($athlete_id)
	{	
		/**
		 * what if this user has been followed already? 
		 * currently 
		 */
		$this->load->model('user_model');
		// get user_id for the athlete been followed
		// follow button need to send athlete id to this function

		// get the following field from the follower
		$follower_id = $this->session->userdata('user_id');
		// $this->fireb->log("follower_id", $follower_id);
		$following_field = $this->user_model->find_following_users($follower_id);
		// $this->fireb->log("following_field", $following_field);

		if (!empty($following_field)) {
			$new_following_field = $following_field . "," . $athlete_id;
		} else {
			// how to add the first follower with the " , " sign
			$new_following_field = $athlete_id; 
		}
		
		// add the athlete user id to the follower's following field
		// $new_following_field = $following_field . "," . $follower_id;
		// $new_following_field = implode(",", $following_array);
		// update user database
		// $this->fireb->log("new_field", $new_following_field);
		$return = $this->user_model->update_following_users($follower_id, $new_following_field);
		// $this->fireb->log("update return", $return);
		$data['url'] = site_url();
		$data['user_id'] = $athlete_id;
		$this->load->view('public_profile_page', $data);

	}

	public function unfollow($athlete_id)
	{
		$this->load->model('user_model');
		$unfollow_id = $this->session->userdata('user_id');
		// $this->fireb->log("unfollower_id", $unfollow_id);
		$following_field = $this->user_model->find_following_users($unfollow_id);
		// $this->fireb->log("following_field", $following_field);

		if (!empty($following_field)) {
			// remove the input athlete_id from current following field
			$following_array = explode(",", $following_field);
			foreach ($following_array as $key => $value) {
				if ($value == $athlete_id) {
					unset($following_array[$key]);
				}
			}
		}

		$new_following_field = implode(",", $following_array);
		// $this->fireb->log("new_field", $new_following_field);
		$return = $this->user_model->update_following_users($unfollow_id, $new_following_field);
		// $this->fireb->log("update return", $return);
		$data['url'] = site_url();
		$data['user_id'] = $athlete_id;
		$this->load->view('public_profile_page', $data);


	}
}	

/* end public_profile_page.php */