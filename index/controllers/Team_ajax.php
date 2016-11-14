<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_ajax extends CI_Controller
{
	public $session_token;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('challenge_model');
		$this->load->model('public_model');
		$this->load->model('score_model');
		$this->load->model('session_check');
		$this->load->helper('form');
		$this->load->library('form_validation');  //表单验证类

		if ($this->session_check->check() === 0) {
			redirect('index/login', 'location');
		}
		$this->session_token = $this->session->userdata('team_token');
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
		$session_token = $this->session_token;
		$team_name_arr = $this->user_model->user_get_name($session_token);
		echo $team_name_arr;
	}

	public function get_solved()
	{
		//  solved
		$session_token = $this->session_token;
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
		$session_token = $this->session_token;
		$data = $this->user_model->user_select_token($session_token)->row();
		//  level
		$result = array();
		$result['level'] = $data->compet_level;
		//  total score
		$result['score'] = $data->total_score;
		//  ranking
		$result['ranking'] = $this->user_model->user_get_rank($session_token);
		//  token
		$result['token'] = $session_token;
		echo json_encode($result);
	}


	public function pass_change()
	{
		$session_token = $this->session_token;
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
		$results = $this->public_model->bulletin_select($number)->result();
		echo json_encode($results);
	}

	/*
	 *  -- Challenge -- 
	 */

	public function get_solved_public()
	{
		$notifies = $this->public_model->notify_select()->result();
		$results = array();
var_dump($notifies);
		for ($i = 0; $i < count($notifies); $i++) {
			foreach ($notifies[$i] as $key => $value) {
				var_dump($value);
				echo $i."<br>";
				switch ($key) {
					case 'challenge_solved_time':
						$results[$i]['solvedTime'] = date('H:i:s m-d-Y', $value);
						break;
					case 'team_name':
						$results[$i]['teamName'] = $value;
						break;
					case 'challenge_id':
						$cha = $this->get_challenge($value);
						$results[$i]['chaName'] = $cha->challenge_name;
						break;
				}
			}
		}

		echo json_encode($results);
	}

	public function get_challenges()
	{
		//  根据$level显示
		$session_token = $this->session_token;
		$level = $this->user_model->user_select_token($session_token)->row()->compet_level;
		$result = $this->challenge_model->select_level($level)->result();
		echo json_encode($result);
	}

	public function get_done_names()
	{
		$session_token = $this->session_token;
		$result = $this->public_model->notify_select($session_token)->result();
		$cha_names = array();
		for ($i = 0; $i < count($result); $i++) {
			foreach ($result[$i] as $key => $val) {
				if ($key == 'challenge_id') {
					$cha_name = $this->challenge_model->select($val)->challenge_name;
					array_push($cha_names, $cha_name);
				}
			}
		}
		echo json_encode($cha_names);
	}

	/*
	 *  -- Ranking -- 
	 */

	public function get_ranks($num = null)
	{
		$arr = $this->user_model->user_get_rank(null, $num)->result();
		echo json_encode($arr);
	}

	public function get_ranks_nums()
	{
		$nums = $this->user_model->select_records();
		echo json_encode(
			array('nums' => $nums)
		);
	}

	/*
	 * -- Score Graphic --
	 */

	public function update_score()
	{
		$ori_data = $this->score_model->select($this->session_token)->row();
		$total_score = $this->user_model->user_select_token($this->session_token)->row()->total_score;

		$new_data = array(
			"score_a" => $ori_data->score_b,
			"score_b" => $ori_data->score_c,
			"score_c" => $ori_data->score_d,
			"score_d" => $ori_data->score_e,
			"score_e" => $ori_data->score_f,
			"total_score" => $total_score
		);
		$this->score_model->update($this->session_token, $new_data);
	}

	public function get_top10()
	{
		echo json_encode($this->score_model->select_top10()->result());
	}

	public function get_ranks10($start = 0)
	{
		$res = $this->user_model->get_rank_10($start)->result();
		echo json_encode($res);
	}
}