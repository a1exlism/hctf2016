<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * index Page for this controller.
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('index/login');
	}

	function register () {
	//  调用model
		$this->load->model('user_model');
		$arr_reg = array(
			'team_name' => $_POST['teamname'],
			'team_school' => $_POST['school'],
			'team_email' => $_POST['email'],
			'team_pass' => $_POST['password'],
			'team_phone' => $_POST['phone']
		);
		$this->user_model->user_register($arr_reg);
	}
	
}
