<?php 
session_start();

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_page extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		//session_start();
		$this->load->model('video_model');
		$this->load->model('user_model');
	}
	
	public function _remap($method, $params = array()) {
		// enforce access control to protected functions
	
		$protected = array('upload_profile','profile_upload', 'delete', 'index');
		
		if (in_array($method,$protected) && !$this->session->userdata('logged_in')     )  
			redirect('account/login', 'refresh'); //Then we redirect to the index page again
		 
		return call_user_func_array(array($this, $method), $params);
	}
	
	public function index()
	{
		$this->load->view('profile_page');
	}
	
	public function build_profile()
	{
		$this->load->model('user_model');
		$user_id = $this->session->userdata('user_id');
		$result = $this->user_model->find_user_by_id($user_id);
		$result = json_encode($result);
		echo $result;
	}
	
	public function build_video_list()
	{
		$user_id = $this->session->userdata('user_id');
		$result = $this->video_model->find_video_by_user($user_id);
		$json_result = json_encode($result);
		echo $json_result;
	}

	public function find_user_img_path()
	{
		$this->load->model('user_model');
		$user_id = $this->session->userdata['user_id'];
		$data['file'] = $this->user_model->get_image_path($user_id);
		
		$data['url'] = base_url();
		
		$result = json_encode($data);
		echo $result; 
	}

	/**
	 * Two processes to delete video
	 * 1. delete video from sprout video (need a sprout_video id)
	 * 2. delete video record from videos table
	 * @param String $video_id passed from user click
	 */
	public function delete($video_id)
	{
		$video = $this->video_model->find_video_by_id($video_id);
		$sprout_id = $video->sprout_id;
		try {
			$return = $this->video_model->delete_from_sprout($sprout_id);
			
			//Guzzle exceptions not working
		} catch (Exception $e) {
// 			$req = $e->getRequest();
//             $resp =$e->getResponse();
//             echo $req;
//             echo $resp;
		}
		

		if (isset($return)) {
			// delete record from videos table
			$result = $this->video_model->delete_video_by_id($video_id);
			//$data['url'] = site_url();
			redirect('profile_page');
		}

	}

	public function profile_upload()
	{
		$user_id = $this->session->userdata("user_id");
		// 1. get back profile from database
		$data['user'] = $this->user_model->find_user_object_by_id($user_id);
		// 2. display in the view and filled into the form
		$data['error'] = '';
		$this->load->view('profile_upload_form', $data);
	}
	
	public function upload_profile()
	{
		$user_id = $this->session->userdata("user_id");
		// 1. get back profile from database
		$data['user'] = $this->user_model->find_user_object_by_id($user_id);
		// 2. display in the view and filled into the form
		//$user_id = $this->session->userdata['user_id'];
	
		$config['upload_path'] = './assets/img/profile';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		$config['file_name'] = "{$user_id}" . ".jpg";
		$config['overwrite'] = "true";
	
		$this->load->library('upload', $config);
	
		// Check if a photo has been selected for upload
		$do_photo_upload = false;
		if (!empty($_FILES['userfile']['name'])){
			$do_photo_upload = true;
			if ( ! $this->upload->do_upload())
			{
				$data['error'] = $this->upload->display_errors();
				$this->load->view('profile_upload_form', $data);
				goto abort;
			}
			else{
				$config['image_library'] = 'gd2';
				$config['source_image'] = "assets/img/profile/{$user_id}" . ".jpg";
				$config['quality'] = 100;
				$config['maintain_ratio'] = TRUE;
				$config['width'] =200;
				$config['height'] = 200;
	
				$this->load->library('image_lib', $config);
	
				$this->image_lib->resize();
			}
		}
		$error = array('error' => $this->upload->display_errors());
		$data_array = $this->upload->data();
	
		$this->load->library('form_validation');
	
		$pass = $this->input->post('password');
	
		if ($data['user']->user_name != $this->input->post('username')){
			$this->form_validation->set_rules('username', 'Username', 'required');
		}
		if ($data['user']->email != $this->input->post('email')){
			$this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');
		}
		if (isset($pass) && strlen($pass)){
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[8]|alpha_dash');
		}
	
		//  		Enabled to to failing with not rules present
		$this->form_validation->set_rules('first', 'First', 'required');
		$this->form_validation->set_rules('last', 'Last', 'required');
	
		// 		$this->form_validation->set_rules('about_me_text', 'AboutMe', "required");
	
		if ($this->form_validation->run() == FALSE)
		{
			$data['error'] = validation_errors();
			$this->load->view('profile_upload_form', $data);
		}
		else
		{
			$stored_user = $this->user_model->find_user_object_by_id($user_id);
			$user = User::serialize_object($stored_user);
			$user->user_name = $this->input->post('username');
			$user->email = $this->input->post('email');
			$user->first = $this->input->post('first');
			$user->last = $this->input->post('last');
			$user->height = $this->input->post('height')." Meters";
			$user->weight = $this->input->post('weight')." Kilograms";
			$user->age = "Age ".$this->input->post('age');
				
			if (isset($pass) && strlen($pass)){
	
				$clearPassword = $this->input->post('password');
				$user->encryptPassword($clearPassword);
			}
			$user->about_me_text = $this->input->post('about_me_text');
				
			if ($do_photo_upload){
				// 				Removed base_url() . $config...
				$test = base_url() . $config['source_image'];
				$user->img_path = $test ;
			}
			
			$this->user_model->update_user($user);
			
			$data['url'] = site_url();
				
			//$this->load->view('profile_page', $data);
			redirect('profile_page', 'refresh');
	
		}
	
		abort:
	}
	

}
?>