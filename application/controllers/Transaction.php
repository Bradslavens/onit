<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// check login
		if($this->session->userdata['is_logged_in'] !== TRUE)
		{
			die('must be logged in');
		}
		$this->load->model('transactions_model');
	}

	public function add(){
		// load libraries
		$this->load->helper('form');
		$this->load->library('form_validation');


		$this->load->view('templates/header');

		$this->form_validation->set_rules('name','Name', 'required');

		if($this->form_validation->run() === FALSE){
			//LOAD THE FORM
			$this->load->view('transactions/add');
		}
		else
		{
			//xxs lean the data
			$clean = $this->security->xss_clean($this->input->post());

			// set the data
			$data = [
			'name' => $clean['name'],
			'user_id' => $this->session->userdata('user_id'),
			'status' => 7,
			];

			$id = $this->transactions_model->add($data);

			// if failed send error
			if($id === FALSE){
				echo "submission failed please try again";
			}

			// if success back to home

			else{
				redirect(site_url('home'));
			}

		}


		$this->load->view('templates/footer');
	}
}
