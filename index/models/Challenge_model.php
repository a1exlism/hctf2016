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

	public function info_get($team_token = null)
	{
		$this->db->select('*');
		$this->db->form('challenge_info');

		if (empty($team_token)) {
			$query = $this->db->result();
			echo $query;
		} else {
			$this->db->where('team_token', $team_token);
			$query = $this->db->get();
			echo $query;
		}
	}

	public function ranking($token)
	{
		echo "aaa";
	}


}