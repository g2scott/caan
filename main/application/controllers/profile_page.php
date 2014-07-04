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

	public function prepare_edit_profile()
	{
		$user_id = $this->session->userdata("user_id");
		// 1. get back profile from database
		$user = $this->user_model->find_user_object_by_id($user_id);
		// 2. display in the view and filled into the form
		$data['first'] = $user->first;
		$data['last'] = $user->last;
		$data['email'] = $user->email;
		$data['about_me_text'] = $user->about_me_text;
		$this->load->view('edit_profile', $data);
		// in the profile view sign data back to form's element value. 
	}

	public function edit_profile()
	{
		// 3. receive the form submited by user
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first', 'First', 'required');
		$this->form_validation->set_rules('last', 'Last', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
		$this->form_validation->set_rules('about_me_text', 'About_Me', 'required');
		if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('edit_profile');
			}
			else
			{	
				$user_id = $this->session->userdata('user_id');
				$user = $this->find_user_object_by_id($user_id);
		
				$user->first = $this->input->post('first');
				$user->last = $this->input->post('last');
				$user->email = $this->input->post('email');
				$user->about_me_text = $_POST['about_me_text'];
				 
				$this->load->model('user_model');
		
		// 4. update database
		 		$error = $this->user_model->update_user($user);

				//$data['helper'] = $this->fb_helper; 
				$this->load->view('profile');
			}
		
		// 5. display user updated profile
	}

}
?>