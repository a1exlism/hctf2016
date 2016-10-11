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

	public function user_register($arr)
	{
//	$teamname, $email, $school, $password, $phone
		$token = $this->token_generate();
		$insert_data = array(
			'compet_level' => 1,
			'is_cheat' => 0,
			'is_expand' => 0,
			'total_score' => 0,
			'team_name' => $arr['team_name'],
			'team_school' => $arr['team_school'],
			'team_phone' => $arr['team_phone'],
			'team_token' => $token,
			'team_pass' => $arr['team_pass'],
			'team_email' => $arr['team_email']
		);
		$this->db->insert('team_info', $insert_data);
	}

	public function token_generate()
	{
		return md5(uniqid(rand() + $this->salt));
	}

	public function user_select($teamname)
	{
		//  组装sql查询语句
		$this->db->where('team_name', $teamname);
		$this->db->select('*');
		$query = $this->db->get('team_info');  //获取表数据
		return $query->result();  //返回查询数据(return array)
	}

	public function token_check()
	{
		//	在登录页面判断session中存的token, 存在则直接登录
		return null;
	}

}

?>

