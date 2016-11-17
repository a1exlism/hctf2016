<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Challenge_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->salt = "HC7F";
	}

	public function select($id)
	{
		$this->db->select('*');
		$this->db->from('challenge_info');

		if (empty($id)) {
			return false;
		} else {
			$this->db->where('challenge_id', $id);
			$query = $this->db->get();
			return $query->row();
		}
	}

	public function select_level($level)
	{
		$this->db->select('*');
		$this->db->from('challenge_info');
		$this->db->where('challenge_level <=', $level);
		$query = $this->db->get();
		return $query;
	}

	//  TABLE multi_flags
	public function multi_select($token, $cha_id)
	{
		$this->db->select('*');
		$this->db->from('multi_flags');
		$where = "challenge_id = '$cha_id' AND team_token = '$token'";
		$this->db->where($where);
		$query = $this->db->get();
		return $query;
	}
}