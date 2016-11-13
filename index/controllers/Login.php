<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	/**
	 * index Page for this controller.
	 *
	 * Maps to the following URL
	 *    http://example.com/index.php/welcome
	 *  - or -
	 *    http://example.com/index.php/welcome/index
	 *  - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('session_check');

		$this->load->helper('form');
		$this->load->library('form_validation');  //表单验证类

		//  session check
		if ($this->session_check->check() === 1) {
			redirect('index/team', 'location');
		}
	}

	public function index()
	{
		$this->load->view('index/login');
	}

	public function pass_reset()
	{
		$this->load->view('index/pass_reset');
	}

}
