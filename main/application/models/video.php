<?php

class Video extends CI_Model {
	
	var $id = '';
	// var $v_id = '';
	var $name = '';
	var $link = '';
	var $description = '';
	var $type = '';
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	/**
	 * crate a new video
	 * if failed update session message 
	 */
	public function create_video($id, $link, $thumbnail, $describe, $style)
	{
		$new_video = array (
			'id' => $id,			// this is user_id
			'link' => $link,
			'thumbnail' => $thumbnail,
			'describe' => $describe,
			'type' => $style
		);
		// active record, database function
		$this->db->insert('videos', $new_video);

		return true;
	}
	
	/**
	 * find video according user id or email
	 * @param string $user_id
	 * @param boolean $public A context variable 
	 * @return array $page
	 * @return null
	 */
	public function find_video_by_user($user_id)
	{
		$query_string = "select * from videos where u_id = '{$user_id}'";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0) {
			$result_array = $query->result_array();
			$result_json = json_encode($result_array);
			return $result_json;
		}
	}
	
	public function find_video_catgories()
	{
		$query_string = "select * from videos order by type";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array();
			// $this->fireb->log($result_array, 'result array');
			$result_json = json_encode($result_array);
		   return $result_json;
		}
		
	}
	
	public function find_video_links()
	{
		$query_string = "select * from videos";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {

		      return $row;
		   }
		}
	}
	
	
	
	/**
	 * edit video according the passed video id / user email
	 * @param string $user_id
	 * or
	 * @param string $email
	 * update session message
	 */
	public function edit_video($video_id)
	{
		
	}
	
	/**
	 * delete video according video id
	 * @param string $video_id 
	 * or
	 * @param string $email
	 * update session message
	 */
	public function delete_video_by_id($video_id)
	{
		
	}
	
	/**
	 * delete all videos belong to single user according to user id or user email
	 */
	public function delete_video_by_user()
	{
		
	}
	
	/**
	 * return all videos from table videos
	 */
	public function find_all_videos()
	{
		
	}
	
	public function find_video_by_id($user_id)
	{
	
		$id = $user_id;
		$query_string = "select * from video where id={$id}";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {

		      return $row;
		   }
		}

	
	}
	

	
	
	
	
	public function find_video_by_categlory($value='')
	{
		# code...
	}
	

}	


?>