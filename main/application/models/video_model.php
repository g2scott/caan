<?php

require_once '../vendor/autoload.php';
/**
 * video_model handle functions with video table
 */
class Video_model extends CI_Model {
	
	
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	

    /**
     * Query video table to get the video
     * @param $video_id string
     * @return $video, object
     */
    public function get($video_id)
    {
    	$this->db->where('v_id',$video_id);
    	$query = $this->db->get('videos');
    	if ($query && $query->num_rows() > 0)
			
    		return $query->row(0,'Video');
    	else
    		return null;
    }

    public function insert($video) {
    	return $this->db->insert('videos',$video);

    }

    /**
	 * upload video to sproutvideo site,
	 * @param associative array, contain file path, 
	 * @return json string
	 */
	public function upload_to_sprout($data_array)
	{
		Sproutvideo::$api_key = '1e376f3f3954ea1ef83163390092427c';
		$path = $data_array['full_path'];
		$json_return = SproutVideo\Video::create_video($path);
		return $json_return;	
	}

	/**
	 * delete video from sprout video site
	 * @param int/string $sprout_id 
	 */
	public function delete_from_sprout($sprout_id)
	{
		Sproutvideo::$api_key = '1e376f3f3954ea1ef83163390092427c';
		$return = SproutVideo\Video::delete_video($sprout_id);
		return $return;
	}

	/**
	 * This function find video acoording to provide video_id
	 * @param String $video_id, passed from controller
	 * @return Object return a video object
	 */
	public function find_video_by_id($video_id)
	{
	
		$id = $video_id;
		$this->db->where("v_id", $id);
		$query = $this->db->get('videos');
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row){
				return $row;
			}
		}
	}

	/**
	 * crate a new row in the video table,
	 * the $link @param need get from 'upload_to_sprout' function return.
	 * @param table fields 
	 */
	public function create_video($id, $link, $describe, $type)
	{
		$new_video = array (
			'id' => $id,			// this is user_id
			'link' => $link,
			'describe' => $describe,
			'type' => $style
		);
		// active record, database function
		$this->db->insert('videos', $new_video);

		return true;
	}
	
	/**
	 * find video according user id
	 * @param string $user_id
	 * @return $result_json a json string
	 */
	public function find_video_by_user($user_id)
	{
		$query_string = "select * from videos where u_id='{$user_id}'";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0) {
			$result_array = $query->result_array();
			$result_json = json_encode($result_array);
			return $result_json;
		}
	}

	/**
	 * find video according user's first name
	 * @param string $first_name
	 * @return $result_json a json string
	 */
	public function find_video_by_user_first($first_name)
	{
		$query_string = "select * from videos where first='{$first_name}'";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0) {
			$result_array = $query->result_array();
			$result_json = json_encode($result_array);
			return $result_json;
		}
	}

	public function find_video_by_video_name($video_name)
	{
		$query_string = "select * from videos where video_name='{$video_name}'";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0) {
			$result_array = $query->result_array();
			$result_json = json_encode($result_array);
			return $result_json;
		}
	}
	
	/**
	 * Query Video table to select all videos sorted by type
	 * @return $result_json a json string
	 */
	public function find_video_catgories()
	{
		$query_string = "select link, name, description, u_id, first, last, type from videos join users where videos.u_id=users.id order by type";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0)
		{
			$result_array = $query->result_array();
			$result_json = json_encode($result_array);
		   return $result_json;
		}
	}

	/**
	 * delete video according video id
	 * @param string $video_id 
	 * update session message
	 */
	public function delete_video_by_id($video_id)
	{
		$query_string = "delete from videos where v_id = {$video_id}";
		$query = $this->db->query($query_string);
		// might update session 
	}

	/**
	 * 
	 */
	public function like_video($video_id)
	{
		$this->db->where('id',$video_id);
		$query = $this->db->get('likes');
		if ($query && $query->num_rows() > 0)
			$likes =  $query->row(0,'likes');
		return $this->db->update('video',array('likes'=>$likes + 1));
		
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
	
}	
?>