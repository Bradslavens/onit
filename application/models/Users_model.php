<?php
class Users_model extends CI_Model {

	protected $hash_password;

	public function __construct()
	{		
         // Call the Model constructor
         parent::__construct();
	}


	/**
	 * set up a new user
	 * @param string $username username
	 * @param string $email email
	 * @param string $password password
	 *
	 * @return int $user_id
	 */
	public function set_user($email , $password = NULL, $fn, $ln)	{

		//if password then hash the password
		if($password !=NULL)		{
			$this->hash_password = password_hash($password, PASSWORD_DEFAULT);
		}
		else		{
			die('no direct access');
		}
		//Collect form data
		$data = array(
			'pw'=>$this->hash_password,
			'email'=>$email,
			'first_name' => $fn,
			'last_name' => $ln,
			);
		//insert the new user
		$this->db->insert('users',$data);
		//return the user id if inserted successfully
		if($this->db->affected_rows() > 1){
			return $this->db->insert_id();	
		}

		// if insert failed return false
		else{
			return FALSE;
		}
	}






	/**
	 * check if the users email is unique
	 */
	public function check_email_unique($email)
	{
		$this->db->where('email', $email);
		$this->db->from('users');
		$count = $this->db->count_all_results();

		if($count == 0){
			return TRUE; // email IS unique
		}else{
			return  FALSE;  // email IS NOT unique
		}
	}

	/**
	 * get the requested users hash
	 * @param string $email 
	 * @return string hash
	 */
	public function get_users_hash($email){
		$this->db->select('pw');
		$this->db->where('email', $email);
		$q = $this->db->get('users');
		$r = $q->row();
		return $r->pw;
	}

	public function get_users_id_by_email($email){
		$this->db->select('id');
		$this->db->where('email', $email);
		$q = $this->db->get('users');
		$r = $q->row();
		return $r->id;

	}
	// Todo logout

}