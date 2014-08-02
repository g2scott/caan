<?php
/**
 * User_model collect functions with working with User Table
 */
class User_model extends CI_Model {

    /**
     * function to support main_page controller stream function
     * to find following users for provide user
     * @param int $user_id
     * @return string like grouped user id '2,5,9'
     */
    public function find_following_users($user_id)
    {
        $this->db->where('id', $user_id);
        $this->db->select('following');
        $query = $this->db->get('users');
        if ($query && $query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                return $row['following'];
            }
        }
    }

    public function update_following_users($user_id, $update_field)
    {
        $user = $this->find_user_object_by_id($user_id);
        $user->following = $update_field;
        $this->db->where('id', $user_id);
        return $this->db->update('users', $user);
    }

    public function update_user($user)
    {
        $this->db->where('id', $user->id);
        return $this->db->update('users', $user);
    }

    /**
     * This function test if the submit user if been followed or not
     * @param $user_id if this user is been followed
     * @return boolean $boolean for if the user been followed
     */
    public function is_following($user_id)
    {
        $boolean = FALSE;
        $current_user_id = $this->session->userdata('user_id');
        if ($current_user_id && ($current_user_id != $user_id)) {
            $following_string = $this->find_following_users($current_user_id);
            $following_array = explode(",", $following_string);
            foreach ($following_array as $key => $value) {
                if ($user_id == $value ) {
                    $boolean = TRUE;
                }
            }
        }else{
            // user not logged in 
            $boolean = NULL;
        }
        
        return $boolean;
    }

    /**
     * Query user database to get the usr
     * @param $username string
     * @return $user, object
     */
    function get($username)
    {
    	$this->db->where('user_name',$username);
    	$query = $this->db->get('users');
    	if ($query && $query->num_rows() > 0)
			
    		return $query->row(0,'User');
    	else
    		return null;
    }
    
    
    function insert($user) {
    	return $this->db->insert('users',$user);
    }
    
    function updatePassword($user) {
    	$this->db->where('id',$user->id);
    	return $this->db->update('user',array('password'=>$user->password, 'salt' => $user->salt));
    }
    
    function getFromEmail($email)
    {
    	$this->db->where('email',$email);
    	$query = $this->db->get('users');
    	if ($query && $query->num_rows() > 0)
    		return $query->row(0,'User');
    	else
    		return null;
    }
    
    
    //NEED TO ASSEMBLE THESE 2 FUNCTIONS INTO 1.  Vincent is an IDIOT.
    public function find_user_by_id($user_id)
    {
        $query = $this->db->get_where('users',array('id' => $user_id));
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result;
        }
    }
    
    public function find_user_object_by_id($user_id)
    {
        $query = $this->db->get_where('users',array('id' => $user_id));
        if ($query->num_rows() > 0) {
			$row = $query->row();
			return $row;
        }      
    }
    
    
    
/**
* add a use
*/
public function register($email, $login, $first, $last, $password, $about_me_text)
{
	$new_user = array (
	'email' => $email,
	'user_name' => $login,
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
		$row = $query->row();
		return $row->id;
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

// Initializes the password to a random value
public function initPassword() {
	$this->salt = mt_rand();
	$clearPassword = mt_rand();
	$this->password = sha1($this->salt . $clearPassword);
	return $clearPassword;
}

public function delete_user()
{

}

public function edit_user()
{

}

public function get_last_entrie()
    {
        $query = $this->db->get('user', 1);
        return $query->result();
    }

function get_image_path($id)
    {
	$query_string = "select img_path from users where id='{$id}'";
	$query = $this->db->query($query_string);

	if ($query->num_rows() > 0) {	
		$row = $query->row();
		return $row->img_path;
	}
    }
     
    
}