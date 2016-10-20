<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		//$this->load->model('team_model');
		$this->load->model('session_check');

		$this->load->helper('form');
		$this->load->library('form_validation');  //表单验证类

	}

	public function index()
	{

	}

	public function get_source()
	{
		$source = array(
			'name' => $this->input->post('name', TRUE),
			'type' => $this->input->post('type', TRUE)
		);
		$url = base_url('assets/'.$source['type'].'/index/'.$source['name'].'.'.$source['type']);
		$arr = array(
			'type' => $source['type'],
			'url'  => $url
		);
		echo json_encode($arr);
	}
}