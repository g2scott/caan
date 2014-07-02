<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//session_start();
		$this->load->model('video_model');

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

	/**
	 * to follow athlete from athlete profile by clicking follow button
	 */
	public function follow($athlete_id)
	{
		// get user_id for the athlete been followed
		// follow button need to send athlete id to this function

		// get the following field from the follower
		$follower_id = $this->session->userdata('user_id');
		$following_field = $this->user_model->find_following_users($follower_id);


		// add the athlete user id to the follower's following field
		$new_following_field = $following_field . "," . $follower_id;
		// update user database
		$return = $this->user_model->update_following_users($follower_id, $new_following_field);

	}

	public function unfollow($athlete_id)
	{
		// get user_id for the athlete been followed
		// follow button need to send athlete id to this function

		// get the following field from the follower
		$follower_id = $this->session->userdata('user_id');
		$following_field = $this->user_model->find_following_users($follower_id);

		// delete the athlete user id to the follower's following field
		$array = explode(",", $following_field);

		// find passed athlete id, then delete it
		foreach ($array as $key => $value) {
			if ($value == $athlete_id) {
				unset($array[$athlete_id]);
			}
		}

		$new_following_field = implode(",", $array);
		$return = $this->user_model->update_following_users($follower_id, $new_following_field);
	}	


}	
	
?>	