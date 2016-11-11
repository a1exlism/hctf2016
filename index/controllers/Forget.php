<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('session_check');
		$this->load->helper('form');
	}

	public function index()
	{
		$this->load->view('index/forget');
	}

	
}