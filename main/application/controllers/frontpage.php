<?php if (!defined('BASEPATH')) die();
class Frontpage extends Main_Controller {

   public function index()
	{
      $this->load->view('include/header');
      $this->load->view('landing.html');
      $this->load->view('include/footer');
	}
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
