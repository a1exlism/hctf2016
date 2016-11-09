<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  User_model extends CI_Model
{

	private $salt;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->salt = "HC7F";
	}

	/*
	 * --- 基础方法 ---
	 * */

	public function user_select($teamname = null)
	{
		//  组装sql查询语句
		if (!empty($teamname)) {
			$this->db->where('team_name', $teamname);
		}
		$this->db->select('*');
		$query = $this->db->get('team_info');  //获取表数据
		return $query;
		//  返回查询对象 result() 所有 row(x) 第x行
	}

	public function user_select_token($teamtoken)
	{
		$this->db->select('*');
		$this->db->from('team_info');
		$this->db->where('team_token', $teamtoken);
		$query = $this->db->get();
		return $query;
	}

	public function user_insert($arr)
	{
		$this->db->insert('team_info', $arr);
	}

	public function user_update($token, $arr)
	{
		$this->db->where('team_token', $token);
		$this->db->update('team_info', $arr);
	}

	public function user_delete($token)
	{
		$this->db->where('team_token');
		$this->db->delete('team_info');
	}

	//	Login logic

	public function user_register($arr)
	{
		//	$teamname, $email, $school, $password, $phone
		$token = $this->str_encode();
		$insert_data = array(
			'compet_level' => 1,
			'is_cheat' => 0,
			'is_expand' => 0,
			'total_score' => 0,
			'team_name' => $arr['team_name'],
			'team_school' => $arr['team_school'],
			'team_phone' => $arr['team_phone'],
			'team_token' => $token,
			'team_pass' => $this->str_encode($arr['team_pass']),
			'team_email' => $arr['team_email']
		);
		$this->db->insert('team_info', $insert_data);
	}

	public function str_encode($str = null)
	{
		if ($str) {
			//  pass encode
			return md5($str . $this->salt);
		} else {
			//  token generate
			return md5(uniqid(rand() . $this->salt));
		}
	}

	public function user_get_name($teamtoken)
	{
		return $this->user_select_token($teamtoken)->row()->team_name;
	}

	public function user_get_rank($token = null, $num = null)
	{
		if (empty($num) && !empty($token)) {
			//  Ranking 排位
			$score = $this->user_select_token($token)->row()->total_score;  //这边已经定义了db
			$this->db->select('*');
			$this->db->where('total_score >', $score);
			//  return int , include table
			return $this->db->count_all_results('team_info') + 1;
		} else if (empty($token) && empty($num)) {
			//  ranks
			$this->db->select(array('team_name', 'total_score'));
			$this->db->from('team_info');
			$this->db->order_by('total_score', 'DESC');
			$query = $this->db->get();
			return $query;
		} else if (empty($token) && !empty($num)) {
			//  challenge_sidebar's ranks
			$this->db->select(array('team_name', 'total_score'));
			$this->db->from('team_info');
			$this->db->order_by('total_score', 'DESC');
			$this->db->limit($num);
			$query = $this->db->get();
			return $query;
		}
	}

	public function select_records()
	{
		$this->db->from('team_info');
		return $this->db->count_all_results();
	}

	public function get_rank_10($start = 0)
	{
		$this->db->select(array('team_name', 'total_score'));
		$this->db->from('team_info');
		$this->db->limit(10, $start);
		$this->db->order_by('total_score', 'DESC');
		$query = $this->db->get();

		return $query;
	}

}

?>

