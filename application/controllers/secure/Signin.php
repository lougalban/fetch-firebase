<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Signin extends CI_Controller {

	

	public function __construct() {

		parent::__construct();

	}



	public function index() {

		$usr = $this->input->post('username');

		$pwd = $this->input->post('password');

		$this->__user->signin($usr, $pwd);

		$page = ($this->__user->is_authenticated())? '/': 'secure/login';

		

		redirect($page);

	}

}

