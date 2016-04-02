<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

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

	public function add(){
		$this->load->view('templates/header');
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_rules('name','Name', 'required');

		if($this->form_validation->run() == FALSE){
			//LOAD THE FORM
			$this->load->view('transactions/add');
		}
		else
		{
			echo "here";
			die();
			// set the data
			$data = [
			'name' => $this->input->post('name'),
			'user_id' => $this->session->userdata('user_id'),
			'status' => 7,
			];

			$id = $this->transactions_model->add($data);
			var_dump($id);
		}


		$this->load->view('templates/footer');
	}
}
