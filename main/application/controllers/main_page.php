<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users moede will be used in this whole class 
		$this->load->model('video');
		// need load helper before use it
		// $this->load->helper('url');
	}
	
	public function index()
	{
		
		// $link_result = $this->video->find_video_links();
		$data['category_name'] = $this->video->find_video_catgories();
		$data['url'] = site_url();
		// $data['video_links'] = $link_result->link;
		 $this->load->view('include/header');
	     $this->load->view('landing.html', $data);
	     $this->load->view('include/footer');
	}
	
	public function build_category()
	{
		$this->load->model('video');
		
		echo $this->video->find_video_catgories(); // need echo or print to ajax response
		//$data['url'] = site_url();
		//echo $data;
		// return $category_result;
	}
	
	public function built_video_list()
	{
		
	}
	
	

	
}	