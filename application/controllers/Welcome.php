<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
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



	public function check_login()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');


		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data['login']=$this->user_model->get_login();

		if($this->form_validation->run()===FALSE)
		{
			redirect('http://tc.srsample.us');
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
