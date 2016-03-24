<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}


	public function index()
	{
		/**
		 * load the helpers and libraries
		 */
		$this->load->helper('form');
		$this->load->library('form_validation');

		/**
		 * load the header , includes bootstrap etc.
		 */
		$this->load->view('templates/header');

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

	/**
	 * Register new user
	 */
	public function register()
	{
		$this->load->view('templates/header');

		/**
		 * load libraries
		 */
		$this->load->helper('form');
		$this->load->library('form_validation');


		/**
		 * Set vaildation rules
		 */
		$this->form_validation->set_rules('email', 'email', 'required|xss_clean | callback_email_check');  //TODO MAKE EMAIL UNIQUE
		$this->form_validation->set_rules('password', 'Password', 'required | xss_clean');


		public function email_check($str)
		{
			// check email

			if ($this->users_model->check_email_unique($str))
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('email_check', 'That email is already in use.');
				return FALSE;
			}
		}

		/**
		 * Validate form
		 */
		if($this->form_validation->run()===FALSE)
		{
			/**
			 * return to registration page
			 */
			$this->load->view('registration');
		}
		else
		{
			/**
			 * set the new user
			 */
			###################################################



			// start here


			##################################################

			
			$user_id = $this->users_model->set_user('bradslavens@gmail.com', 'water');
			$this->session->set_userdata('user_id', $user_id);
			echo $this->session->userdata('user_id');

		}

		$this->load->view('footer');
	}



	public function check_login()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');


		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['login']=$this->user_model->get_login();

		if($this->form_validation->run()===FALSE)
		{
			redirect(site_url());
		}
		elseif(password_verify($this->input->post('password'),$data['login']['password']))
		{
			$_SESSION['first_name']=$data['login']['first_name'];
			$_SESSION['user_id']=$data['login']['id'];
			$_SESSION['is_logged_in'] = TRUE;
			redirect('transaction/index/home');

		}
		else
		{
			redirect(site_url());
		}
	}
}
