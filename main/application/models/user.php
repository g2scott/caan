<?php
Class User {
	
public $email;
public $user_name;
public $id;
public $first;
public $last;
public $password; //encrypted
public $salt;
public $img_path;
public $about_me_text;


public function encryptPassword($clearPassword) {
	$this->salt = mt_rand();
	$this->password = sha1($this->salt . $clearPassword);
}


// Initializes the password to a random value
public function initPassword() {
	$this->salt = mt_rand();
	$clearPassword = mt_rand();
	$this->password = sha1($this->salt . $clearPassword);
	return $clearPassword;
}

public function comparePassword($clearPassword) {
	if ($this->password == sha1($this->salt . $clearPassword))
		return true;
	return false;
}

public function fullName() {
	return $this->first . " " . $this->last;
}





}