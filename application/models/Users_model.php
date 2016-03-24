<?php
class Users_model extends CI_Model {

	protected $hash_password;
	public function __construct()
	{
		$this->load->database();
	}






	/**
	 * set up a new user
	 * @param string $username username
	 * @param string $email email
	 * @param string $password password
	 *
	 * @return int $user_id
	 */
	public function set_user($email , $password = NULL)	{

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
			);

		//insert the new user
		$this->db->insert('users',$data);

		//return the user id
		return $this->db->insert_id();
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

	// Todo logout

}