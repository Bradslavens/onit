<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if($this->session->userdata['is_logged_in'] !== TRUE)
		{
			die('must be logged in');
		}

		// load the form libraries
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->load->model('transactions_model');
	}

	public function index($transaction_id = 181){ // TODO CHANGE DEFAULT

		// GET TRANSACTION
		$user_id = $this->session->userdata('user_id');
		$data['transaction'] = $this->transactions_model->get_transaction_details($transaction_id, $user_id);

		// set the transaction session
		$this->session->set_userdata(['transaction_id'=>$transaction_id]);
		// load the header
		$this->load->view('templates/header');

		// load the transaction details view (cover)
		$this->load->view('proc/cover', $data);


		// load the footer
		$this->load->view('templates/footer');
	}

	public function update(){

		// TODO VALIDATE THE FORM?
		$udate = $this->transactions_model->update_transaction_details($this->input->post(), $this->session->userdata('transaction_id'), $this->session->userdata('user_id'));
	}
}
