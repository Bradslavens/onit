<?php
class Categories_model extends CI_Model {

	/**
	 * construct 
	 * load database
	 * @return void
	 */
	public function __construct()
	{
		//
         // Call the Model constructor
         parent::__construct();
	}

	public function add($category){

		$this->db->insert('categories', $category);

		// verify insert
		if($this->db->affected_rows()>0){
			return $this->db->insert_id();
		}

		// if insert fails
		else{
			return FALSE;
		}
	
	}
}