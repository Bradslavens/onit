<?php
class User_model extends CI_Model {

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
	public function set_user($user_name, $email , $password = NULL)
	{
		/**
		 * if password then hash the password
		 */
		if($password !=NULL)
		{

			$this->hash_password = password_hash($password), PASSWORD_DEFAULT);

		}
		else
		{
			die('no direct access');
		}


		/**
		 * Collect form data
		 */
		$data = array(
			'email'=>$email,
			'password'=>$hash_password,
			'user_name'=>$user_name,
			);

		/**
		 * insert the new user
		 */
		$this->db->insert('users',$data);

		/**
		 * return the user id
		 */
		return $this->db->insert_id();
	}

}