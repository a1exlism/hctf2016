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
		$this->load->model('public_model');
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

	/*
	 *  -- Dashboard -- 
	 */

	public function get_teamname()
	{
		$team_token = $this->session->userdata('team_token');
		$team_name_arr = $this->user_model->user_get_name($team_token);
		echo $team_name_arr;
	}

	public function get_solved()
	{
		//  solved
		$session_token = $this->session->userdata('team_token');
		$notifies = $this->public_model->notify_select($session_token)->result();
		$solved = array();
		for ($i = 0; $i < count($notifies); $i++) {
			foreach ($notifies[$i] as $key => $value) {
				if ($key == 'challenge_solved_time') {
					$solved[$i]['solvedTime'] = date('H:i:s m-d-Y', $value);
				} else if ($key == 'challenge_id') {
					$cha = $this->get_challenge($value);
					$solved[$i]['chaName'] = $cha->challenge_name;
					$solved[$i]['chaType'] = $cha->challenge_type;
					$solved[$i]['chaScore'] = $cha->challenge_score;
					$solved[$i]['chaLevel'] = $cha->challenge_level;
					$solved[$i]['solvedNum'] = $cha->challenge_solves;
				}
			}
		}
		echo json_encode($solved);
	}

	public function get_challenge($id)
	{
		$cha = $this->challenge_model->select($id);
		return $cha;
	}

	public function get_team_info()
	{
		//  sidebar
		$session_token = $this->session->userdata('team_token');
		$data = $this->user_model->user_select_token($session_token)->row();
		//  level
		$result = array();
		$result['level'] = $data->compet_level;
		//  total score
		$result['score'] = $data->total_score;
		//  ranking
		$result['ranking'] = $this->user_model->user_get_rank($session_token);
		echo json_encode($result);
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

	/*
	 *  -- Bulletin -- 
	 */

	public function get_bulletin()
	{
		$number = $this->input->post('number', TRUE); //  返回字段数
		echo $number;
		$results = $this->public_model->bulletin_select($number)->result();
		echo json_encode($results);
	}

	/*
	 *  -- Challenge -- 
	 */

	public function a()
	{

	}

	/*
	 *  -- Ranking -- 
	 */
	public function get_ranks()
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
	
}