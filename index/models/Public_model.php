<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Public_model extends CI_Model
{

	private $salt;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->salt = "HC7F";
	}

	public function bulletin_select($num = null) {
		$this->db->select('*');
		$this->db->from('bulletin');
		$this->db->order_by('update_time', 'DESC');
		if ($num == null) {
			//  返回全部数据
			$query= $this->db->get();
		} else {
			$this->db->limit($num);
			$query = $this->db->get();
		}
		return $query;
	}
	
	
}
