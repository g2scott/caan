<?php

class Video extends CI_Model {
	
	var $id = '';
	var $v_id = '';
	var $link = '';
	var $thumbnail = '';
	var $describe = '';
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
	public function create_video()
	{
		
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
	
	
	/**
	 * find video according user id or email
	 * @param string $user_id
	 * @param boolean $public A context variable 
	 * @return array $page
	 * @return null
	 */
	public function find_video_by_user($user_id, $public=true)
	{
		
	}
	
	public function find_video_by_categlory($value='')
	{
		# code...
	}
	

}	


?>