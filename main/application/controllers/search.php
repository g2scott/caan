<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('video_model');

	}

	/**
	 * this controller will be called after user click search buttion, the 
	 */
	public function search_for_video($search_term)
	{
		$result_one = $this->video_model->find_video_by_video_name($search_term);
		$result_two = $this->video_model->find_video_by_user_first($search_term);
		if(!empty($result_one)){
			$data = $result_one;
		}else {
			$data = $result_two;
		}
		echo $data; 
	}

}
?>	