<?php
class Transactions_model extends CI_Model {

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

	/**
	 * get the users transactions
	 * @param int $user_id 
	 * @return array list of transactions
	 */
	public function get_transaction_list($user_id, $status = 7){ //TODO ALLOW OPTIONAL STATUS

		$this->db->where('user_id', $user_id);
		$this->db->where('status', $status);
		$q = $this->db->get('transactions');

		return $q->result_array();
	}

	public function get_transaction_details($transaction_id, $user_id){
		$this->db->where('user_id', $user_id);
		$this->db->where('id', $transaction_id);
		$q=$this->db->get('transactions');
		$row = $q->row();

		return $row;

	}

	public function add($data){

		$this->db->insert('transactions', $data);
		
		// if insert succeeded return id
		if($this->db->affected_rows() > 0){

			return $this->db->insert_id();	
		}

		// if it failed return FALSE
		else{
			return FALSE;
		}

	}

	public function update_transaction_details($transaction_details, $transaction_id, $user_id){

		$this->db->where('id', $transaction_id);
		$this->db->where('user_id', $user_id);
		$this->db->update('transactions', $transaction_details);

		echo $this->db->affected_rows();
		die();
	}
}