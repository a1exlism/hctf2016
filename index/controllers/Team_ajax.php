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
		$this->load->model('challenge_model');
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
			//  TRUE : xss 过滤
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

	/* -- Main -- */
	public function get_teamname()
	{
		$team_token = $this->session->userdata('team_token');
		$team_name_arr = $this->user_model->user_get_name($team_token);
		echo $team_name_arr;
	}

	public function pass_change()
	{
		$session_token = $this->session->userdata('team_token');
		$post_data = array(
			'ori_pass' => $this->user_model->str_encode($this->input->post('ori_pass', TRUE)),
			'new_pass' => $this->user_model->str_encode($this->input->post('new_pass', TRUE))
		);
		$db_data = $this->user_model->user_select_token($session_token)->row();
		if ($db_data->team_pass === $post_data['ori_pass']) {
			$query = array(
				'team_pass' => $post_data['new_pass']
			);
			$this->user_model->user_update($session_token, $query);
			$res = array(
				'status' => 'success'
			);
		} else {
			$res = array(
				'status' => 'fail'
			);
		}
		echo json_encode($res);
	}


	/*-- Ranking --*/
	public function get_rank()
	{
		$number = $this->input->post('number', TRUE); //  查询人数
		if ($number === 1) {
			$session_token = $this->session->userdata('team_token');
			$arr = array(
				"total_score" => $this->team_info->user_select_token($session_token)->total_score,
				"ranking" => $this->team_info->ranking($session_token)
			);
		} else if ($number === 15) {
			//  返回15条最上数据
			$arr = array(
				array(
					"total_score" => "team's score",
					"ranking" => "team's ranking"
					//  修改
				)
			);
		} else {
			//  返回所有数据
			$arr = array(
				array(
					"total_score" => "team's score",
					"ranking" => "team's ranking"
				)
			);
		};
		echo $arr;
		return NULL;
	}

	public function get_solved()
	{
		//  解题情况
		$session_token = $this->session->userdata('team_token');
		$results = $this->challenge_model->select($session_token);
		echo $results;
		//  需要json序列化
	}

}