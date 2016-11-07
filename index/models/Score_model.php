<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Score_model extends CI_Model
{
	//  model for score graphic
	private $salt;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->salt = "HC7F";
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
				'score_f' => 0,
				'total_score' => 0
			);
			$this->db->update('score_record', $arr);
		}
	}

	public function select($token)
	{
		$this->db->select('*');
		$this->db->from('score_record');
		$this->db->where('team_token', $token);
		$query = $this->db->get();
		return $query;
	}
	
	public function update($token, $arr) {
		$this->db->where('team_token', $token);
		$this->db->update('score_record', $arr);	
	}
}