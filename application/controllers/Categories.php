<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	/**
	 * construct Contact
	 * add contact model
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// check login
		if(!isset($_SESSION['user_id'])){
			redirect(site_url());
		}

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
		$this->form_validation->set_rules('name', 'Category Name', 'required|alpha_numeric');
		$this->form_validation->set_rules('description', 'Description', 'alpha_numeric');

		if($this->form_validation->run() === FALSE){
			// load the contact form
			$data['user_id'] = $this->session->userdata('user_id');
			$this->load->view('admin/categories_form', $data);
		}

		// add the contact
		else{
			if($this->input->post('user_id')){
				// check user id match
				if($this->input->post('user_id') === $this->session->userdata('user_id')){

					// add the contact
					$contact_id = $this->Categories_model->add($this->input->post());
					echo $contact_id;
					die();
				}
				
				// send back home
				else
				{
					redirect(site_url());
				}
			}
			// if no user id return to welcome screen
			else{
				redirect(site_url());
			}
		}

		$this->load->view('templates/footer');

	}
}
