<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * construct User 
	 * add users model
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
	}



	/**
	 * Register new user
	 * sets session user id to user id
	 * @return void
	 */
	public function register()
	{
		$this->load->view('templates/header');
		//load libraries
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('security');		
		//set validation rules for registration form
		$this->form_validation->set_rules('email', 'email', 'required|callback_email_check|valid_email');  // TODO XSS CLEAN | callback_email_check'
		$this->form_validation->set_rules('password', 'Password', 'required');  
		// validate form if false go back to registration elseif register user 
		// and redirect to home page... for now 
		if($this->form_validation->run($this)===FALSE)
		{
			// return to registraion page
			$this->load->view('registration');
		}
		else
		{
			// xss clean the registration form input
			$cd = $this->security->xss_clean($this->input->post());
			// set the user
			$user_id = $this->users_model->set_user($cd['email'], $cd['password'],$cd['first_name'],$cd['last_name']);
			// set the user session
			$this->session->set_userdata('user_id', $user_id);
			// goback home for now 
			// TODO CHANGE THE REDIRECT TO THE TRANSACTION HOME PAGE
			redirect(site_url());

		}

		$this->load->view('templates/footer');
	}






	/**
	 * Check if user already exists 
	 * part of form validation within user registration
	 * @param string $str 
	 * @return boolean
	 */
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
	 * Check login credentials
	 * @return void
	 */
	public function check_login()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');


		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run()===FALSE){
			redirect(site_url()); // TODO change to alt login
		}else{
			// get users hash
			$hash = $this->users_model->get_users_hash($this->input->post('email'));
			// check password vs hash
			if(password_verify($this->input->post('password'), $hash)){

				$_SESSION['is_logged_in'] = TRUE;
				redirect(site_url()); // TODO change to transaction list

			}else{  
				
				redirect(site_url()); // TODO change to alt login 

			}

		}
	}
}
