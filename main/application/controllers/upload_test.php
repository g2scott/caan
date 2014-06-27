<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_test extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		// $this->load->view('upload_test');
		$this->load->view('main_page.html'); 
		
	}
	
}

?>		