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

	public function add($data,$id)
	{
		$tem=$this->db->where('challenge_id',$id)->get('challenge_info');
		$tem=$tem->result_array();

		
		
		$result=$this->db->insert('challenge_info',$data,$where);
		return $result;
	}



}

?>