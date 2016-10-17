<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flag_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
#待修改
	public function number($id,$num)
	{
		$result=$this->db->where('challenge_id',$id)->get('challenge_info');
		$result=$result->result_array();
		$mark=$result[0]['challenge_scoer'];
		return $mark-$num;
	}
#待修改
	public function check($id,$flag,$token)
	{
		$final_time=time();
		$where=array(
			'challenge_id'=>$id,
			'team_token'=>$token
			);
		$result=$this->db->where($where)->get('dynamic_notify');
		$result=$result->result_array();
		if($result[0]['challenge_flag']===$flag)
		{
			$tmp=$this->db->where('challenge_id',$id)->get('challenge_info');
			$tmp=$tmp->result_array();
			$time=$final_time-$result[0]['challenge_open_time'];
			if($time<$tmp[0]['challenge_threshold'])
			{
				$data=array('is_cheat'=>1);
				$this->db->where('team_token',$token)->update('team_info',$data);
				$bool=1;
			}
			else
			{
				$data=array('challenge_solved_time'=>$final_time);
				$this->db->update('dynamic_notify',$data,$where);
				$bool=2;
				$solved_where=array('challenge_id'=>$id,'challenge_solved_time'=>'%');
				$change=$this->db->where($solved_where)->get('dynamic_notify');
				$change=$change->result_array();
				$num=count($change);
				#待产生的分数算法
				$mark=number($id,$num);
				
			}
		}
		else
		{
			$where=array(
				'challenge_id'=>$id,
				'challenge_flag'=>$flag
				);
			$result=$this->db->where($where)->get('dynamic_notify');
			$result=$result->result_array();
			if(!empty($result[0]))
			{
				$data=array(
					array('team_token'=>$token,'is_cheat'=>1),
					array('team_token'=>$result[0]['team_token'],'is_cheat'=>1)
					);
				$this->db->update_batch('team_info',$data,'team_token');
				$bool=1;
			}
			else
			{
				$bool=0;
			}
		}
	}

}


?>