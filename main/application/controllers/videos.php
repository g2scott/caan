<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('video_model');
	}

	public function load($video_id)
	{
		$video = $this->video_model->find_video_by_id($video_id);
		$link = $video->link;
		//Add color to player embed code
		$link = str_replace("type=sd'", "type=sd&amp;regularColorTop=960000&amp;regularColorBottom=d70000'", $link);
		
		$output  = "<div class=\"flex-video widescreen\">";
		$output .= "$link";
		$output .= "</div>";

		$parts = explode ( "/" , $video->thumbnail );
		//Build video source from thumbnail source, not getting this info from sprout.  look into that.
		$source = "https://cdn.sproutvideo.com/" . $parts[3] . "/videos/iphone/" . $parts[5] . ".mp4";
		
		$data['output'] = $output;
		$data['title'] = "<meta property=\"og:title\" content=\""  . $video->name .  "\">";
		$data['type'] = "<meta property=\"og:type\" content=\"video\" >";
		$data['video'] = "<meta property=\"og:video\" content=\"" . $source . "\">";
		$data['thumbnail'] = "<meta property=\"og:image\" content=\"" . $video->poster_frame . "\">";
		$data['description'] = "<meta property=\"og:description\" content=\"" . $video->description . "\">";
		$data['admins'] = "<meta property=\"fb:admins\" content=\"671745245\">";
		$data['app_id'] = "<meta property=\"fb:app_id\" content=\"129704493787021\"/>";
	
		$this->load->view('single_video_page', $data);
	}
	
	
	function video_upload()
	{
		$this->load->view('upload_form', array('error' => ' ' ));
	}
	
	function cancel()
	{
		$this->load->view('profile_page');
	}
	
	
	
	function do_upload()
	{
		$this->load->helper(array('form', 'url'));
		
		$config['upload_path'] = './assets/temp';
		$config['allowed_types'] = 'flv|3g2|3gp|3gp2|3gpp|asf|avi|divx|dv|dvx|flv
			|gvi|m1pg|m1v|m21|m2t|m2ts|m2v|m4e|m4u|m4v|mjp|mod|moov|mov|movie|mp21
			|mp4|mpe|mpeg|mpg|mpv2|mts|qt|qtch|qtz|rm|rmvb|rv|svi|swi|tivo|tod|tp|ts
			|vfw|vid|vob|vp6|vp7|wm|wmv|xvid|yuv';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
		//SANITIZE USERFILE
		$filename = $this->security->sanitize_filename($this->input->post('userfile'));
		$config['file_name'] = $filename;
	
		$this->load->library('upload', $config);
	
		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
	
			$this->load->view('upload_form', $error);
		}
		else
		{
			$data_array = $this->upload->data();
			$json_return = $this->video_model->upload_to_sprout($data_array);
			$link = $json_return['embed_code'];
			$sprout_id = $json_return['id'];

			/**
			 * start form validation here, may move to some other function later
			 */
			$this->load->library('form_validation');

			$assets = $json_return['assets'];
			$thumbnails = $assets['thumbnails'];
			$poster_frames = $assets['poster_frames'];

			$this->form_validation->set_rules('video_name', 'Video Name', 'required');
			$this->form_validation->set_rules('video_description', 'Video Description', "required");
	
			if ($this->form_validation->run() == FALSE)
			{
				$data['error'] = validation_errors();
				$this->load->view('upload_form, $data');
			}
			else
			{
				// this class autoloaded
				$video = new Video();
				$user_id = $this->session->userdata('user_id');
	
				$video->u_id = $user_id;
				$video->link = $link; 	// need input from the sproutvide upload return
				$video->sprout_id = $sprout_id;
				$video->type = $this->input->post('type');
				$video->name = $this->input->post('video_name');
				$video->description = $this->input->post('video_description');
				
				$video->thumbnail = $thumbnails[2];
				$video->poster_frame = $poster_frames[2];
	
				$this->load->model('video_model');
	
				$error = $this->video_model->insert($video);
	
			}
			//$data = array('upload_data' => $this->upload->data(), 'path' => $data_array['full_path'], 'json' => $json_return);
			
			//$url['url'] = site_url();
			redirect('profile_page');
			
		}
	}
	
	
	
}
?>