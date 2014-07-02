<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users moede will be used in this whole class 
		$this->load->model('user_model');
		$this->load->model('video_model');
		// need load helper before use it
		// $this->load->helper('url');
	}
}
?>