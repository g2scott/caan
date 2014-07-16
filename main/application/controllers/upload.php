<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('video_model');
		$this->load->model('user_model');
	}

	public function profile_upload()
	{
		$user_id = $this->session->userdata("user_id");
		// 1. get back profile from database
		$data['user'] = $this->user_model->find_user_object_by_id($user_id);
		// 2. display in the view and filled into the form
		$data['error'] = '';
		$this->load->view('profile_upload_form', $data);
	}

	function video_upload()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}

	public function upload_profile()
	{
		$user_id = $this->session->userdata("user_id");
		// 1. get back profile from database
		$data['user'] = $this->user_model->find_user_object_by_id($user_id);
		// 2. display in the view and filled into the form
		$user_id = $this->session->userdata['user_id'];
	
		$config['upload_path'] = './assets/img/profile';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['file_name'] = "{$user_id}" . ".jpg";
		$config['overwrite'] = "true";

		$this->load->library('upload', $config);

		
		if ( ! $this->upload->do_upload())
		{
			$data['error'] = $this->upload->display_errors();
			
			

			$this->load->view('profile_upload_form', $data);
		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			$data_array = $this->upload->data();


			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.user_name]');
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('about_me_text', 'AboutMe', "required");

			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
				$this->load->view('profile_upload_form', $data);
			}
			else
			{
				$stored_user = $this->user_model->find_user_object_by_id($user_id);
				$user = User::serialize_object($stored_user);
				$user->user_name = $this->input->post('username');
				$user->email = $this->input->post('email');
				$clearPassword = $this->input->post('password');
				$user->encryptPassword($clearPassword);
				$user->about_me_text = $this->input->post('about_me_text');
				$user->img_path = $data_array['full_path'];

				$this->user_model->update_user($user);
				$data['url'] = site_url();
				$this->load->view('profile_page', $data);

			}

		}
		
	}
	
	/**
	 * This function may moved to video_model, rename to video_upload 
	 */
	function do_upload()
	{
		$config['upload_path'] = './assets/temp';
		$config['allowed_types'] = 'flv';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data_array = $this->upload->data();
			$json_return = $this->video_model->upload_to_sprout($data_array);
			//$array_return = json_decode($json_return);
			$link = $json_return['embed_code'];
			$sprout_id = $json_return['id'];
			// $this->load->model('video_model');
			// $this->video_model->createNew($link);

			/**
			 * start form validation here, may move to some other function later
			 */
			$this->load->library('form_validation');
			//$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.user_name]');
			$this->form_validation->set_rules('video_name', 'Video Name', 'required');
			$this->form_validation->set_rules('video_description', 'Video Description', "required");
			// $this->form_validation->set_rules('file', 'Uploaded file', "required");
	
		 
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('Account/add_video');
			}
			else
			{
				// this class autoloaded 
				$video = new Video();
				$user_id = $this->session->userdata('user_id');

				$video->u_id = $user_id;
				$video->link = $link; 	// need input from the sproutvide upload return
				$video->sprout_id = $sprout_id;
				$video->type = $this->input->post('type');
				$video->name = $this->input->post('video_name');
				$video->description = $this->input->post('video_description');

				
				$this->load->model('video_model');

				$error = $this->video_model->insert($video);
				 
				// $this->load->view('profile_page');

			}	


			$data = array('upload_data' => $this->upload->data(), 'path' => $data_array['full_path'], 'json' => $json_return);
			
			// $this->load->view('upload_success', $data);
			$url['url'] = site_url();
			$this->load->view('profile_page', $url);
		}
	}
}

?>