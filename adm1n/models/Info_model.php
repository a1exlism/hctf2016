<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model extends CI_model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function del($id)
	{
		$temp=$this->db->where('bulletin_id',$id)->get('bulletin');
		$temp=$temp->result_array();
		if(empty($temp[0]))
			return 0;
		$result=$this->db->where('bulletin_id',$id)->delete('bulletin');
		return $result;
	}

	public function add($mes)
	{
		$data=array('bulletin_message'=>$mes);
		$result=$this->db->insert('bulletin',$data);
		return $result;
	}

	public function change($id,$mes)
	{
		$data=array('bulletin_message'=>$mes);
		$where=array('bulletin_id'=>$id);
		$result=$this->db->update('bulletin',$data,$where);
		return $result;
	}
}

?>