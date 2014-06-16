<?php 


class User extends CI_Model {

	var $email = '';
	var $user_name = '';
	var $id = '';
	var $first = '';
	var $last = '';
	var $password = '';
	var $img_path = '';
	var $about_me_text = '';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    public function get_last_entrie()
    {
        $query = $this->db->get('user', 1);
        return $query->result();
    }
	
	/**
	 *  add a use 
	 */
	public function register($email, $login, $first, $last, $password, $about_me_text)
	{
		$new_user = array (
			'email' => $email,
			'login' => $login,
			'password' => $password,
			'first' => $first,
			'last' => $last,
			'about_me_text' => $about_me_text
		);
		// active record, database function
		$this->db->insert('users', $new_user);
		
		return true;
	}
	
	public function find_user_id($user_name)
	{
		$query_string = "select id from users where user_name='{$user_name}'";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->id;
			}
		}
	}
	
	public function find_user_by_id($user_id)
	{
		$query_string = "select * from users where id={$user_id}";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0) {
		   $result = $query->result_array();
			return $result;
		}
		
	}
	
	public function find_user_password($user_name)
	{
		$query_string = "select password from users where user_name='{$user_name}'";
		$query = $this->db->query($query_string);
		
		if ($query->num_rows() > 0) {			
			$row = $query->row();
			return $row->password;
		}
	}
	
	public function delete_user()
	{
		
	}
	
	public function edit_user()
	{
		
	}
	

    // function insert_entry()
    //     {
    //         $this->title   = $_POST['title']; // please read the below note
    //         $this->content = $_POST['content'];
    //         $this->date    = time();
    // 
    //         $this->db->insert('entries', $this);
    //     }
    // 
    //     function update_entry()
    //     {
        // $this->title   = $_POST['title'];
        //        $this->content = $_POST['content'];
        //        $this->date    = time();
        // 
        //        $this->db->update('entries', $this, array('id' => $_POST['id']));
        //    }

}

 ?>