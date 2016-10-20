<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user_model');
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
		$url = base_url('assets/' . $source['type'] . '/index/' . $source['name'] . '.' . $source['type']);
		$arr = array(
			'type' => $source['type'],
			'url' => $url
		);
		echo json_encode($arr);
	}

	public function get_teamname()
	{
		$team_token = $this->session->userdata('team_token');
		$team_name_arr = $this->user_model->user_get_name($team_token);
		echo $team_name_arr[0]->team_name;
	}
}