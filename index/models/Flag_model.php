<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flag_model extends CI_model
{
	private $score_table;
	private $level_table;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->score_table = array(600, 550, 515, 492, 473, 457, 443, 429, 417, 404, 393, 381, 371, 360, 350, 340, 332, 323, 316, 309, 302, 295, 289, 283, 277, 271, 266, 260, 255, 250, 245, 240, 236, 231, 226, 222, 218, 213, 209, 205, 201, 197, 193, 189, 185, 182, 178, 174, 171, 167, 164, 160, 157, 153, 150, 147, 144, 140, 138, 135, 132, 129, 127, 124, 122, 120, 117, 115, 113, 111, 109, 107, 105, 103, 102, 100, 98, 97, 95, 94, 92, 91, 89, 88, 86, 85, 84, 83, 81, 80, 79, 78, 77, 76, 75, 74, 73, 72, 71, 70, 69, 68, 67, 67, 66, 65, 64, 63, 62, 62, 61, 60, 59, 58, 58, 57, 56, 55, 55, 54, 53, 52, 52, 51, 50, 50, 49, 48, 48, 47, 46, 46, 45, 44, 44, 43, 43, 42, 41, 41, 40, 40, 39, 39, 38, 37, 37, 36, 36, 35, 35, 34, 34, 33, 33, 32, 32, 31, 30, 30, 29, 29, 29, 28, 28, 27, 27, 26, 25, 25, 24, 24, 24, 23, 23, 22, 21, 21, 20, 20, 20, 19, 18, 18, 17, 17, 17, 16, 15, 15, 14, 14, 14, 13, 12, 12, 11, 11, 11, 10);

		$this->level_table = array(2,4,15,21);
	}

	private function get_score($num)
	{
		if ($num <= 200) {
			$score = $this->score_table[$num - 1];
		} else if ($num > 200) {
			$score = 10;
		}
		return $score;
	}

	private function get_level($token)
	{
		$team_tmp=$this->db->where('team_token',$token)->get('team_info')->result_array();
		if(!empty($team_tmp[0]))
		{
			$level=$team_tmp[0]['compet_level'];
			switch ($level) {
				case ('0'):
					$level_now=1;
					break;
				case ('1'):
					$sql="select * from dynamic_notify where challenge_level=1 and team_token=? and challenge_solved_time is not NULL";
					$challenge=$this->db->query($sql,$token)->result_array();
					$num=count($challenge);
					if($num>=$this->level_table[0])
						$level_now=2;
					else
						$level_now=1;
					break;

				case ('2'):
					$sql="select * from dynamic_notify where challenge_level=2 and team_token=? and challenge_solved_time is not NULL";
					$challenge=$this->db->query($sql,$token)->result_array();
					$num=count($challenge);
					if($num>=$this->level_table[1])
						$level_now=3;
					else
						$level_now=2;
					break;

				case ('3'):
					$sql="select * from dynamic_notify where team_token=? and challenge_solved_time is not NULL";
					$challenge=$this->db->query($sql,$token)->result_array();
					$num=count($challenge);
					if($num>=$this->level_table[2])
						$level_now=4;
					else
						$level_now=3;
					break;

				case ('4'):
					$sql="select * from dynamic_notify where team_token=? and challenge_solved_time is not NULL";
					$challenge=$this->db->query($sql,$token)->result_array();
					$num=count($challenge);
					if($num>=$this->level_table[3])
						$level_now=5;
					else
						$level_now=4;
					break;
			}
		}
		//var_dump($level_now);
		return $level_now;
	}

	public function level_check($token)
	{
		//$sql = "SELECT * FROM dynamic_notify WHERE team_token = ? AND challenge_solved_time LIKE '%' ";
		//$change = $this->db->query($sql, $token);
		//$change = $change->result_array();
		//$number = count($change);
		$level = $this->get_level($token);
		$team = $this->db->where('team_token', $token)->get('team_info');
		$team = $team->result_array();
		if ($team[0]['compet_level'] <= $level)#level提升
		{
			$arr = array(
				"compet_level" => $level
			);
			$this->db->where('team_token', $token)->update('team_info', $arr);
			#开题
			$challenge = $this->db->where('challenge_level', $level)->get('challenge_info');
			$challenge = $challenge->result_array();
			$time = time();
			foreach ($challenge as $value)
			{
				$challenge_id = $value['challenge_id'];
				#检查是否开过该题
				$tmp_where = array('team_token' => $token, 'challenge_id' => $challenge_id);
				$tmp_challenge = $this->db->where($tmp_where)->get('dynamic_notify');
				$tmp_challenge = $tmp_challenge->result_array();
				if (empty($tmp_challenge[0]))#未开题时开题
				{
					if(!empty($value['challenge_api']))
					{
						$this->load->library($value['challenge_api']);
						$flag = $this->$value['challenge_api']->getflag($token);
					}
					else
					{
						$sql="select * from multi_flags where team_token is NULL and challenge_id = ?";

						$flag_tmp = $this->db->query($sql,$value['challenge_id'])->result_array();
						$where=$flag_tmp[0];
						$flag_tmp[0]['team_token']=$token;
						$this->db->update('multi_flags',$flag_tmp[0],$where);
						$flag=$flag_tmp[0]['challenge_flag'];
					}

					$new_challenge_data = array
					(
						'team_token' => $token,
						'challenge_id' => $value['challenge_id'],
						'challenge_open_time' => $time,
						'challenge_flag' => $flag,
						'challenge_level'=>$value['challenge_level']
					);
					$this->db->insert('dynamic_notify', $new_challenge_data);
				}
			}

		}
		return $level;
	}

	public function check($id, $flag, $token)
	{
		$team_cheat=$this->db->where('team_token',$token)->get('team_info')->result_array();

		if($team_cheat[0]['is_cheat']!=0)
		{
			$api['status']=1;
			$level_temp=$this->db->where('team_token',$token)->get('team_info')->result_array();
			$level=$level_temp[0]['compet_level'];
			$api['level']=$level;
			$api['score']='';
			$api['token']=$token;
			$api['another_token']='';
			return $api;
		}

		$final_time = time();
		$where = array(
			'challenge_id' => $id,
			'team_token' => $token
		);
		$result = $this->db->where($where)->get('dynamic_notify');
		$result = $result->result_array();

		if(empty($result[0]))
		{
			$api['status']=4;
			$level_temp=$this->db->where('team_token',$token)->get('team_info')->result_array();
			$level=$level_temp[0]['compet_level'];
			$api['level']=$level;
			$api['score']='';
			$api['token']=$token;
			$api['another_token']='';
			return $api;
		}

		else if($result[0]['challenge_flag'] == $flag && empty($result[0]['challenge_solved_time']))#正确flag
		{
			$tmp = $this->db->where('challenge_id', $id)->get('challenge_info');
			$tmp = $tmp->result_array();
			$time = $final_time - $result[0]['challenge_open_time'];
			if ($time < $tmp[0]['challenge_threshold'])#时间低于阈值
			{
				$data = array('is_cheat' => 1);
				$this->db->where('team_token', $token)->update('team_info', $data);

				$qisiwole=$this->db->where('team_token',$token)->get('team_info')->result_array();
				$challenge_tmp_name=$this->db->where('challenge_id',$id)->get('challenge_info')->result_array();
				$fp=fopen('log/cheat_log', 'a+');
				fwrite($fp, date('y-m-d h:m:s').' '.$token.' '.$qisiwole[0]['team_name'].' '.$challenge_tmp_name[0]['challenge_name'].' '.$time."\r\n");
				fclose($fp);

				$api['status']=1;
				$level_temp=$this->db->where('team_token',$token)->get('team_info')->result_array();
				$level=$level_temp[0]['compet_level'];
				$api['level']=$level;
				$api['score']='';
				$api['token']=$token;
				$api['another_token']='';
				return $api;
			} 
			else#解题完全正确
			{
				$data = array('challenge_solved_time' => $final_time);
				$this->db->update('dynamic_notify', $data, $where);
				$bool = 2;
				$qisiwole=$this->db->where('team_token',$token)->get('team_info')->result_array();
				$fp=fopen('log/right_log', 'a+');
				fwrite($fp, date('y-m-d h:m:s').' '.$token.' '.$qisiwole[0]['team_name'].' '.$tmp[0]['challenge_name']."\r\n");
				fclose($fp);
				$challenge = $this->db->where('challenge_id', $id)->get('challenge_info');
				$challenge = $challenge->result_array();
				$num = $challenge[0]['challenge_solves'] + 1;
				$score = $this->get_score($num);
				$challenge[0]['challenge_solves'] = $num;
				$challenge[0]['challenge_score'] = $score;
				$this->db->where('challenge_id', $id)->update('challenge_info', $challenge[0]);#题目分值修改
				$now_time=time();
				$this->db->where('team_token',$token)->update('team_info',array('score_update'=>$now_time));

				#队伍level提升
				$level=$this->level_check($token);
				$api['status']=2;
				$api['level']=$level;
				$api['score']=$score;
				$api['token']=$token;
				$api['another_token']='';
				#修改各个队伍分数
				$ready_team = $this->db->where('challenge_id', $id)->select('team_token')->get('dynamic_notify');
				$ready_team = $ready_team->result_array();
				foreach ($ready_team as $value)
				{
					$team_token = $value['team_token'];
					#查询每队解出题目
					$sql = "SELECT challenge_id FROM dynamic_notify WHERE team_token = ? AND challenge_solved_time LIKE '%' ";
					$team_challenge = $this->db->query($sql, $team_token);
					$team_challenge = $team_challenge->result_array();
					#查询每队解题分数并相加
					$sum = 0;
					foreach ($team_challenge as $tc) {
						$ready_challenge = $this->db->where('challenge_id', $tc['challenge_id'])->get('challenge_info');
						$ready_challenge = $ready_challenge->result_array();
						$sum = $sum + $ready_challenge[0]['challenge_score'];
					}
					$basic_score=$this->db->where('team_token', $team_token)->get('team_info');
					$basic_score=$basic_score->result_array();
					if(empty($basic_score[0]))
					{
						continue;
					}
					$sum=$sum+$basic_score[0]['basic_score'];
					$team_data = array('total_score' => $sum);
					$this->db->where('team_token', $team_token)->update('team_info', $team_data);
				}
				return $api;
			}
		}
		else if (!empty($result[0]['challenge_solved_time']))#flag已经提交
		{
			$api['status']=3;
			$level_temp=$this->db->where('team_token',$token)->get('team_info')->result_array();
			$level=$level_temp[0]['compet_level'];
			$api['level']=$level;
			$api['score']='';
			$api['token']=$token;
			$api['another_token']='';
			return $api;
		}
		else if ($result[0]['challenge_flag'] !== $flag)#flag错误
		{
			$where = array(
				'challenge_id' => $id,
				'challenge_flag' => $flag
			);
			$result = $this->db->where($where)->get('dynamic_notify');
			$result = $result->result_array();
			if (!empty($result[0]))#作弊
			{
				$data = array(
					array('team_token' => $token, 'is_cheat' => 1),
					array('team_token' => $result[0]['team_token'], 'is_cheat' => 1)
				);
				$this->db->update_batch('team_info', $data, 'team_token');

				$qisiwole=$this->db->where('team_token',$token)->get('team_info')->result_array();
				$qisiwole2=$this->db->where('team_token',$result[0]['team_token'])->get('team_info')->result_array();
				$challenge_tmp_name=$this->db->where('challenge_id',$id)->get('challenge_info')->result_array();
				$fp=fopen('log/cheat_log', 'a+');
				fwrite($fp, date('y-m-d h:m:s').' '.$token.' '.$qisiwole[0]['team_name'].' '.$result[0]['team_token'].' '.$qisiwole2[0]['team_name'].' '.$challenge_tmp_name[0]['challenge_name']."\r\n");
				fclose($fp);
				
				$bool = 1;
				$api['status']=1;
				$level_temp=$this->db->where('team_token',$token)->get('team_info')->result_array();
				$level=$level_temp[0]['compet_level'];
				$api['level']=$level;
				$api['score']='';
				$api['token']=$token;
				$api['another_token']=$result[0]['team_token'];
				return $api;
			} 
			else#错误
			{
				$api['status']=0;
				$level_temp=$this->db->where('team_token',$token)->get('team_info')->result_array();
				$level=$level_temp[0]['compet_level'];
				$api['level']=$level;
				$api['score']='';
				$api['token']=$token;
				$api['another_token']='';
				return $api;
			}
		}

		return $bool;
	}

}


?>
