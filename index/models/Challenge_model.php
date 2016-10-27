<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Challenge_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->salt = "HC7F";
	}

	public function select($id)
	{
		$this->db->select('*');
		$this->db->from('challenge_info');

		if (empty($id)) {
			return false;
		} else {
			$this->db->where('challenge_id', $id);
			$query = $this->db->get();
			return $query->row();
		}
	}
	

}