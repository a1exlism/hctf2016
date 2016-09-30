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
			$sql='select * from team_info';
			$result=$this->db->query($sql);
			$result=$result->result_array();
		}
		else if(empty($id) && !empty($token))
		{
			$result=$this->db->where('team_token',$token)->get('team_info');
			$result=$result->result_array();
		}
		else if(!empty($id) && empty($token))
		{
			$result=$this->db->where('team_name',$id)->get('team_info');
			$result=$result->result_array();
		}
		else
		{
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
		$result=$this->db->update('team_info',$data,$where);
		return $result;
	}

	public function add($method,$value,$score)
	{
		$where=array($method=>$value);
		$tmp=$this->db->where($where)->get('team_info');
		$tmp=$tmp->result_array();
		$a=$tmp[0]['total_score']+$score;
		$data=array('total_score'=>$a);
		$result=$this->db->update('team_info',$data,$where);
		$data=array(
			'team_token'=>$tmp[0]['team_token'],
			'challenge_id'=>0,
			'challenge_open_time'=>0,
			'challenge_solved_time'=>1
		);
		$res=$this->db->insert('dynamic_notify',$data);
		$result=$res&$result;
		return $result;
	}

	public function open($id)
	{
		$tmp=$this->db->where('is_cheat'=>0)->get('team_info');
		$tmp=$tmp->result_array();
		$level=$this->db->where('challenge_id',$id)->select('challenge_level')->get('challenge_info');
		$level=$level->result_array();
		$level=$level[0]['challenge_level'];
		$result=1;

		foreach ($tmp as $team) 
		{
			if($team['compet_level']<$level)
			{
				$data=array(
				'team_token'=>$team['team_token'],
				'challenge_id'=>$id,
				'challenge_open_time'=>time(),
				'challenge_flag'=>'flag'#获取flag方式未定
				);
				$res=$this->db->insert('dynamic_notify',$data);
				$result=$result&$res;
			}
		}
		return $result;
	}

	public function card($method,$value,$id)
	{
		if($method=='name')
		{
			$tmp=$this->db->where('team_name',$value)->select('team_token')->get('team_info');
			$tmp=$tmp->result_array();
			$token=$tmp['team_token'];
		}
		else if($method=='token')
		{
			$token=$value;
		}
		$data=array(
			'card_id'=>$id,
			'team_token'=>$token
		);
		$result=$this->db->insert('card_info',$data);
		return $result;
	}

}


?>