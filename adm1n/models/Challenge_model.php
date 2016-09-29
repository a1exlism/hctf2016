<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Challenge_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function show($id)
	{
		if(empty($id))
		{
			$sql='select * from challenge_info';
			$result=$this->db->query($sql);
			$result=$result->result_array();
		}
		else
		{
			$result=$this->db->where('challenge_id',$id)->get('challenge_info');
			$result=$result->result_array();
		}
		//var_dump($result);
		return $result;
	}

	public function add($data)
	{
		$result=$this->db->insert('challenge_info',$data);
		return $result;
	}

	public function change($data,$id)
	{
		$tmp=$this->db->where('challenge_id',$id)->get('challenge_info');
		$tmp=$tmp->result_array();

		foreach ($data as $key => $value) 
		{
			if($value=='')
			{
				$data[$key]=$tmp[0][$key];
			}
		}

		$where=array('challenge_id'=>$id);

		$result=$this->db->update('challenge_info',$data,$where);
		return $result;
	}

	public function delete($id)
	{
		$where=array('challenge_id'=>$id);

		$result=$this->db->delete('challenge_info',$where);
		return $result;
	}

}

?>