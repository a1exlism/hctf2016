<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Teams extends CI_Controller
{
	public $data;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->model('session_check');
		$this->load->model('user_model');
		$this->load->model('public_model');
		$this->load->model('challenge_model');
		//  session check
		if ($this->session_check->check() !== 1) {
			redirect('index/login', 'location');
		}

	}
	
	public function get_challenge($id)
	{
		$cha = $this->challenge_model->select($id);
		return $cha;
	}

	public function search($team_name)
	{
		if (empty($team_name)) {
			echo "Empty team name";
			exit();
		} else {
			$res_user = $this->user_model->user_select($team_name)->row();
			if (empty($res_user)) {
				echo "Wrong team name.";
				exit();
			}

			$notifies = $this->public_model->notify_select($res_user->team_token)->result();
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
					}
				}
			}

			$this->data = array(
				'name' => $res_user->team_name,
				'school' => $res_user->team_school,
				'score' => $res_user->total_score,
				'level' => $res_user->compet_level,
				'solved' => $solved
			);
		}
		$this->load->view('index/teams');

	}

}