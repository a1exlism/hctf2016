<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  User_model extends CI_Model
{

	private $salt;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->salt = "HC7F";
	}

	/*
	 * --- 基础方法 ---
	 * */

	public function user_select($teamname)
	{
		//  组装sql查询语句
		$this->db->where('team_name', $teamname);
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
		//  插入
		$this->db->insert('team_info', $arr);
	}

	public function user_update($token, $arr)
	{
		//  更新
		$this->db->where('team_token', $token);
		$this->db->update('team_info', $arr);
	}

	public function user_delete($token)
	{
		//  删除
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

	public function user_pass_update($arr)
	{
		//  用户信息验证

	}
}

?>

