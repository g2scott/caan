<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('video_model');
		

	}

	function index()
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
			$data = array('upload_data' => $this->upload->data(), 'path' => $data_array['full_path'], 'json' => $json_return);
			
			$this->load->view('upload_success', $data);
		}
	}
}
?>