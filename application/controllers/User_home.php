<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// check login
		if($_SESSION['is_logged_in'] !== TRUE)
		{
			die('not logged in');
			redirect('welcome/index');
		}
		$this->load->model('transactions_model');
	}

	public function get_users_tranactions(){
		$transactions = $this->transactions_model->get_transaction_list($this->session->userdata('user_id'));
	}
}
