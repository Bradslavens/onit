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
		var_dump($data);
		$this->db->insert('transactions', $data);
		
		return $this->db->insert_id();

	}
}