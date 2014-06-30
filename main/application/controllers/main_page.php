<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_page extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

	}

	public function index()
	{
		$this->load->view('main_page.html');   
	}

	public function build_category()
	{
		$this->load->model('video_model');
		$return = $this->video_model->find_video_catgories(); 
		// $return = NULL;
		// need echo or print to ajax response
		echo $return;
	}

}
?>