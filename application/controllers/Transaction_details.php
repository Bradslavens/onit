<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_details extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// check login
		if($_SESSION['is_logged_in'] !== TRUE)
		{
			die('must be logged in');
		}
		$this->load->model('transactions_model');
	}

	public function transaction_details($transaction_id = 4){
		$user_id = $this->session->userdata('user_id');
		$transaction_details = $this->transactions_model->get_transaction_details($transaction_id, $user_id);
		var_dump($transaction_details->name);
	}
}
