<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	private $tcm;

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
		$this->load->model('transaction_contacts_model');
	}

	/**
	 * List transaction Contacts
	 * @param int $transaction_id 
	 * @return array
	 */
	public function index(){ // TODO CHANGE DEFAULT

		$data['contacts'] = $this->transaction_contacts_model->get($this->session->userdata('transaction_id'), $this->session->userdata('user_id'));

		$this->load->view('templates/header');
		$this->load->view('proc/contact_list', $data);
		$this->load->view('templates/footer');

	}

	public function add(){

		$this->load->view('templates/header');

		// set form validation rules
		$this->form_validation->set_rules('first_name','First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email','Email','valid_email');

		//TODO CHECK IF CONTACT ALREADY EXISTS AND USE THAT

		if($this->form_validation->run() === FALSE){

			// get the contact type list  buyer seller etc
			$this->load->model('items_model');
			$data['contact_types'] = $this->items_model->get_by_category(5, $this->session->userdata('user_id')); // 5 is Contact type
			
			// get current contacts
			$data_current_contacts = $this->transaction_contacts_model->get($this->session->userdata('transaction_id'), $this->session->userdata('user_id'));
			// load the form
			$this->load->view('proc/contacts', $data);
		}

		// if success process the form
		else{
			// add contact 
			$this->load->model('contacts_model');

			$contact = [
				 'first_name' => $this->input->post('first_name'), 
				 'mi' => $this->input->post('mi'), 
				 'last_name' => $this->input->post('last_name'), 
				 'company' => $this->input->post('company'), 
				 'email' => $this->input->post('email'), 		
				 'user_id' => $this->session->userdata('user_id'),		 
			];

			// add contact
			$contact_id = $this->contacts_model->add($contact);

			$transaction_contact_id = $this->transaction_contacts_model->add($contact_id, $this->session->userdata('transaction_id'), $this->input->post('party'));
			
		}

		$data['contacts'] = $this->transaction_contacts_model->get($this->session->userdata('transaction_id'), $this->session->userdata('user_id'));
		if(count($data['contacts']) > 0){

			$this->load->view('proc/contact_list', $data);

		}

		$this->load->view('templates/footer');
	}
}
