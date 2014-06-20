<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		// users moede will be used in this whole class 
		$this->load->model('user');
		$this->load->model('video');
		// need load helper before use it
		// $this->load->helper('url');
	}
	
	// public function index()
	// 	{
	// 		$this->load->view('Account/profile');
	// 	}
	

	// /**
	//  * This function is used to create new video to insert to video table
	//  * create a Video object then insert to video table
	//  */
	// function createNew() {
	// 	$this->load->library('form_validation');
	// 	//$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.user_name]');
	// 	$this->form_validation->set_rules('video_name', 'Video Name', 'required');
	// 	$this->form_validation->set_rules('video_description', 'Video Description', "required");
	// 	$this->form_validation->set_rules('file', 'Uploaded file', "required");
	
		 
	// 	if ($this->form_validation->run() == FALSE)
	// 	{
	// 		$this->load->view('Account/add_video');
	// 	}
	// 	else
	// 	{
	// 		// this class autoloaded 
	// 		$video = new Video();

	// 		$video->u_id = $_SESSION['user_id'];
	// 		$video->link = $link 	// need input from the sproutvide upload return
	// 		$video->type = $this->input->post('type');
	// 		$video->name = $this->input->post('name');
	// 		$video->name = $this->input->post('description');
	// 		$video->name = $this->input->post('likes');

	// 		$this->load->model('video_model');

	// 		$error = $this->video_model->insert($video);
			 
	// 		$this->load->view('profile_page');
	// 	}
	// }


	// public function get_videos_by_id()
	// {
		
	// 	// get user id from submit. 
	// 	$this->load->model('video');
	// 	$videos = $this->video->get_videos_by_id($user_id);
		
	// 	// echo json_encode('status'=>'success';'body'=>$videos);
	// }
	

	// public function create_video()
	// {
	// 	// $id, $link, $thumbnail, $describe, $style
	// 	if (isset($_POST['submit'])) 
	// 	{
	// 		//user create video, insert video into database
	// 		$name = $_POST['video_name'];
	// 		$id = $_POST['id'];
	// 		$link = $_POST['link'];
	// 		$thumbnail = $_POST['thumbnail'];
	// 		$describe = $_POST['describe'];
	// 		$style = $_POST['style'];
		
	// 		$this->video->create_video($name ,$id, $link, $thumbnail, $describe, $style);
	// 		$message = "video add successfully.";
	// 		redirect('profile');
	// 	}else{
	// 		// user has not tried registering, bring up registeration information  
	// 		$this->load->view('add_video.php'); 
	// 	}
	// }
	

	// public function like_video($video_id)
	// {
	// 	$this->load->model('video');
	// 	$this->video->like_video($video_id);
		
	// }
	
	
}	
	