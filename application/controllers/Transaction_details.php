<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_details extends CI_Controller {

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

	public function index(){
		
	}
}
