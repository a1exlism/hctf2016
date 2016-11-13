<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
	}

	public function index()
	{
		$this->load->view('index/forget');
	}

	public function send_email($token) {
		$this->email->from('ji2hanpgf@163.com', 'admin');
		$this->email->to('someone@example.com');
//		$this->email->cc('another@another-example.com');
//		$this->email->bcc('them@their-example.com');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();
	}
}