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
	
	public function get_videos_by_id()
	{
		
		// get user id from submit. 
		$this->load->model('video');
		$videos = $this->video->get_videos_by_id($user_id);
		
		// echo json_encode('status'=>'success';'body'=>$videos);
	}
	
	public function create_video()
	{
		// $id, $link, $thumbnail, $describe, $style
		if (isset($_POST['submit'])) 
		{
			//user create video, insert video into database
			$name = $_POST['video_name'];
			$id = $_POST['id'];
			$link = $_POST['link'];
			$thumbnail = $_POST['thumbnail'];
			$describe = $_POST['describe'];
			$style = $_POST['style'];
		
			$this->video->create_video($name ,$id, $link, $thumbnail, $describe, $style);
			$message = "video add successfully.";
			redirect('profile');
		}else{
			// user has not tried registering, bring up registeration information  
			$this->load->view('add_video.php'); 
		}
	}
	
	
}	
	