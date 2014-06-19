<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		session_start();
	}
	
	public function index()
	{
		$this->load->model('video_model');
		
		// $link_result = $this->video->find_video_links();
		$data['category_name'] = $this->video_model->find_video_catgories();
		$data['url'] = site_url();
		// $data['video_links'] = $link_result->link;
		 $this->load->view('include/header');
	     $this->load->view('main_page.html', $data);
	     $this->load->view('include/footer');
	}
	
	public function build_category()
	{
		$this->load->model('video_model');
		
		echo $this->video_model->find_video_catgories(); // need echo or print to ajax response
		//$data['url'] = site_url();
		//echo $data;
		// return $category_result;
	}
	
	public function built_video_list()
	{
		
	}
	
	

	
}	