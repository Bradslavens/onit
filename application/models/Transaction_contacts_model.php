<?php
class Transaction_contacts_model extends CI_Model {

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

	public function get($transaction_id, $user_id){
		
		$this->db->select('*');
		$this->db->from('transaction_parties');
		$this->db->join('contacts', 'transaction_parties.contact_id = contacts.id');

		$this->db->where('transaction_id', $transaction_id);
		$this->db->where('user_id', $user_id);
		
		$q = $this->db->get();

		return $q->result_array();
	}

	/**
	 * add a transactin contact
	 * @param int $contact_id 
	 * @param int $transaction_id 
	 * @param int $party_id 
	 * @return int id
	 */
	public function add($contact_id, $transaction_id, $party_id){

		$data= [
			'transaction_id' => $transaction_id,
			'party' => $party_id,
			'contact_id' => $contact_id,
		];

		$this->db->insert('transaction_parties', $data);

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