<?php 


class User extends CI_Model {

	var $email = '';
	var $login = '';
	var $id = '';
	var $first = '';
	var $last = '';
	var $password = '';
	var $salt = '';
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
		$this->db->insert('user', $new_user);
		
		return true;
	}
	
	public function find_user_id($login)
	{
		$query_string = "select id from user where login='{$login}'";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row->id;
			}
		}
	}
	
	public function find_user_by_id($user_id)
	{
		$query_string = "select * from user where id={$user_id}";
		$query = $this->db->query($query_string);
		if ($query->num_rows() > 0)
		{
		   foreach ($query->result() as $row)
		   {
		     
		      return $row;
		   }
		}
		
	}
	
	public function find_user_password($login)
	{
		$query_string = "select password from users where login='{$login}'";
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