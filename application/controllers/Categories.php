<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	/**
	 * construct Contact
	 * add contact model
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// check login
		if($this->session->userdata['is_logged_in'] !== TRUE)
		{
			die('must be logged in');
		}

		// load libraries
		$this->load->model('Categories_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}



	/**
	 * Register new user
	 * sets session user id to user id
	 * @return void
	 */
	public function index()
	{
		echo "list categories";
	}


	public function add(){

		$this->load->view('templates/header');

		//TODO set validation rules?
		$this->form_validation->set_rules('first_name', 'First Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('mi', 'MI', 'alpha_numeric');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('company', 'Company', 'alpha_numeric');
		$this->form_validation->set_rules('email', 'Email','valid_email|required');

		if($this->form_validation->run() === FALSE){
			// load the contact form
			$data['user_id'] = $this->session->userdata('user_id');
			$this->load->view('admin/contact_form', $data);
		}

		// add the contact
		else{
			if($this->input->post('user_id')){
				// add the contact
				$contact_id = $this->Contacts_model->add($this->input->post());
				echo $contact_id;
				die();
			}
			// if no user id return to welcome screen
			else{
				redirect(site_url());
			}
		}

		$this->load->view('templates/footer');

	}
}
