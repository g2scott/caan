<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('video_model');
	}

	function video_upload()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
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
			//$this->$fireb->log($link);
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