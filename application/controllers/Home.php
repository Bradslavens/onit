<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 */

	public function __construct()
	{
		parent::__construct();

		$this->output->enable_profiler(TRUE);

		$this->load->helper('url');
		
		// check login
		if($this->session->userdata('is_logged_in') !== TRUE)
		{
			redirect('welcome');
		}

		$this->load->model('transactions_model');
		$this->load->model('users_model');
	}

	// home page
	public function index()
	{
		// load the main header
		$this->load->view('templates/header');

		// load the transactions nav
		$this->load->view('transactions/home');

		// transaction list
		// get transaction list FALSE IS FOR USER TRANSACTIONS COMING SOON
		$list = $this->transactions_model->get_transaction_list($this->session->userdata('user_id'), 7); // 7 is active
		$data['transactions'] = $list;
		$this->load->view('transactions/transaction_list', $data);

		// }

		$this->load->view('templates/footer');
	}
}
