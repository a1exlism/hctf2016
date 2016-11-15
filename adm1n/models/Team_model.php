<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function search($id,$token)
	{
		if(empty($id) && empty($token))
		{
			//echo 1;
			$sql='select * from team_info';
			$result=$this->db->query($sql);
			$result=$result->result_array();
		}
		else if(empty($id) && !empty($token))
		{
			//echo 2;
			$result=$this->db->where('team_token',$token)->get('team_info');
			$result=$result->result_array();
		}
		else if(!empty($id) && empty($token))
		{
			//echo 3;
			$result=$this->db->where('team_name',$id)->get('team_info');
			$result=$result->result_array();
		}
		else
		{
			//echo 4;
			$where=array(
				'team_name'=>$id,
				'team_token'=>$token
			);
			$result=$this->db->where($where)->get('team_info');
			$result=$result->result_array();
		}
		return $result;
	}

	public function ban($method,$value)
	{
		$where=array($method=>$value);
		$data=array('is_cheat'=>1);
		var_dump($where);
		$result=$this->db->update('team_info',$data,$where);
		return $result;
	}

	public function add($method,$value,$score)
	{
		$where=array($method=>$value);
		$tmp=$this->db->where($where)->get('team_info');
		$tmp=$tmp->result_array();
		if(empty($tmp[0]))
			return 0;
		else
		{
			$a=$tmp[0]['total_score']+$score;
			$b=$tmp[0]['basic_score']+$score;
			$data=array('total_score'=>$a,'basic_score'=>$b);
			$result=$this->db->update('team_info',$data,$where);
			return $result;
		}
	}

	public function open($id)
	{
		$tmp=$this->db->where('is_cheat', 0)->get('team_info');
		$tmp=$tmp->result_array();

		$level=$this->db->where('challenge_id',$id)->select('challenge_level')->get('challenge_info');
		$level=$level->result_array();
		$level=$level[0]['challenge_level'];
		$result=1;
		//var_dump($tmp);
		foreach ($tmp as $team) 
		{
			if($team['compet_level']<$level)
			{
				$token=$team['team_token'];
				$where=array('team_token'=>$token,'challenge_id'=>$id);
				$check=$this->db->where($where)->get('dynamic_notify');
				if(empty($check)){
					$data=array(
						'team_token'=>$token,
						'challenge_id'=>$id,
						'challenge_open_time'=>time(),
						'challenge_flag'=>'flag'#获取flag方式未定
						);
					$res=$this->db->insert('dynamic_notify',$data);
					$result=$result&$res;}
			}
		}
		return $result;
	}

	public function card($method,$value,$id)
	{
		if($value==='allteamgetcard')
		{
			$result=1;
			$tmp=$this->db->where('is_cheat', 0)->get('team_info');
			$tmp=$tmp->result_array();
			foreach ($tmp as $team) 
			{
				$data=array(
					'card_id'=>$id,
					'team_token'=>$team['team_token']
					);
				$re=$this->db->insert('card_info',$data);
				$result=$result&$re;
			}
		}
		else
		{
			if($method=='team_name')
			{
				$tmp=$this->db->where('team_name',$value)->select('team_token')->get('team_info');
				$tmp=$tmp->result_array();
				$token=$tmp[0]['team_token'];
			}
			else if($method=='team_token')
			{
				$token=$value;
			}
			$data=array(
				'card_id'=>$id,
				'team_token'=>$token
			);
			$result=$this->db->insert('card_info',$data);
		}
		return $result;
	}

}


?>