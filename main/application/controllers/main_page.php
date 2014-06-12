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
		$catgory_result = $this->video->find_video_catgories();
		$link_result = $this->video->find_video_links();
		$data['category_name'] = $catgory_result->type;
		$data['video_links'] = $link_result->link;
		$this->load->view('index.html', $data);
	}
	
	
	

	
}	