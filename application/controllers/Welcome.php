<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * default controller
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('users_model');
		$this->load->helper('url');
	}


	public function index()
	{
		/**
		 * load the form helper
		 */
		$this->load->helper('form');

		/**
		 * load the header , includes bootstrap etc.
		 */
		$this->load->view('templates/header');

		/**
		 * Validate login
		 */
		$this->load->library('form_validation');

		/**
		 * Set vaildation rules
		 */
		$this->form_validation->set_rules('email', 'email', 'required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required | xss_clean');


		/**
		 * Check validation
		 */
		if($this->form_validation->run()===FALSE)
		{
			/**
			 * If the login fails validation
			 * load the welcome page
			 */
			$this->load->view('welcome_message');
		}
		else
		{
			/**
			 * If the login succeeds set the user 
			 */
			$data['users']=$this->user_model->set_user();
		}

		/**
		 * Load the footer , includes scripts
		 */
		$this->load->view('templates/footer');

	}
}
