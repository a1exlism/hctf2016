<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_model extends CI_Model
{

	private $salt;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->salt = "HC7F";
	}

	public function bulletin_select($num = null)
	{
		$this->db->select('*');
		$this->db->from('bulletin');
		$this->db->order_by('update_time', 'DESC');
		if ($num == null) {
			//  返回全部数据
			$query = $this->db->get();
		} else {
			$this->db->limit($num);
			$query = $this->db->get();
		}
		return $query;
	}

	//  notify query
	public function notify_select($token = null)
	{
		$this->db->from('dynamic_notify');
		if (!empty($token)) {
			$this->db->select('*');
			$this->db->where("team_token = '$token' AND challenge_solved_time IS NOT NULL");
			$this->db->order_by('challenge_solved_time', 'DESC');
		} else {
			//  solved_info_public
			$this->db->select(array('dynamic_notify.challenge_id', 'dynamic_notify.challenge_solved_time', 'team_info.team_name'));
			$this->db->join('team_info', 'team_info.team_token = dynamic_notify.team_token');
			$this->db->where('dynamic_notify.challenge_solved_time IS NOT NULL AND team_info.is_cheat = 0');
			$this->db->order_by('team_info.score_update', 'ASC');
		}
		$query = $this->db->get();
		return $query;
	}
}
