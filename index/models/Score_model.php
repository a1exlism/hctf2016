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
				'total_score' => 0
			);
			$this->db->insert('score_record', $arr);
		}
	}

	public function select($token)
	{
		$this->db->select('team_name, total_score');
		$this->db->from('score_record');
		$this->db->where('team_token', $token);
		$query = $this->db->get();
		return $query;
	}

	public function insert($arr) {
		$this->db->insert('score_record', $arr);
	}
	
	public function update($token, $arr) {
		$this->db->where('team_token', $token);
		$this->db->update('score_record', $arr);	
	}
}