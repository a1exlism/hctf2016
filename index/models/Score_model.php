<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score_model extends CI_Model
{
	//  model for score graphic
	private $salt;
	private $is_cheat;
	private $session_token;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->salt = "HC7F";
		$this->session_token = $this->session->userdata('team_token');
		$this->is_cheat = $this->get_status($this->session_token)->row()->is_cheat;
	}

	public function init($token, $name)
	{
		$team_data = $this->select($token)->result();
		if (empty($team_data)) {
			$arr = array(
				'team_name' => $name,
				'team_token' => $token,
				'score_a' => 0,
				'score_b' => 0,
				'score_c' => 0,
				'score_d' => 0,
				'score_e' => 0,
				'total_score' => 0
			);
			$this->db->where('team_token', $token);
			$this->db->update('score_record', $arr);
		}
	}

	public function get_status($token)
	{
		$this->db->select('is_cheat');
		$this->db->from('team_info');
		$this->db->where('team_token', $token);
		$query = $this->db->get();
		return $query;
	}

	public function select($token)
	{


		$this->db->select('*');
		$this->db->from('score_record');
		$this->db->where('team_token', $token);
		$query = $this->db->get();
		return $query;
	}

	public function update($token, $arr)
	{
		$this->db->where('team_token', $token);
		$this->db->update('score_record', $arr);
	}

	public function select_top10()
	{
		$this->db->select('*');
		$this->db->from('score_record');
		$this->db->order_by('total_score', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();

		return $query;
	}
}