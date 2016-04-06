<?php
class Items_model extends CI_Model {

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
	 * get item by category for form select lists
	 */
	public function get_by_category($category, $user_id){

		$this->db->select('items.id as id, items.name as name, items.subject as subject, items.description as description');
		$this->db->from('item_categories');
		$this->db->join('items', 'items.id = item_categories.item_id');
		$this->db->where('item_categories.cat_id', $category);
		$this->db->where('items.user_id', $user_id);

		$q= $this->db->get();

		return $q->result_array();
	}

	/**
	 * add item
	 */
	public function add($item){
		// add item
		$data  = [
			'name' => $item['name'],
			'subject' => $item['subject'],
			'description' => $item['description'],
			'user_id' => $item['user_id'],
			'category' => $item['category'],
		];

		$this->db->insert('items', $data);

		// verify insert
		if($this->db->affected_rows()>0){

			// set item id  
			$item_id = $this->db->insert_id();

			// if insert was successful add item_parties
			foreach ($item['item_parties'] as $value) {
				# code...
				$data1 = [
					'item_id' => $item_id,
					'party_id' => $value,
					'user_id' => $item['user_id'],
				];

				$this->db->insert('item_parties', $data1);

				if($this->db->affected_rows() > 0){
					echo "success<br>";
				}

				// if fail
				else{
					echo "fail<br>";
				}
			}

			return $item_id;
		}

		// if insert fails
		else{
			return FALSE;
		}
	
	}
}