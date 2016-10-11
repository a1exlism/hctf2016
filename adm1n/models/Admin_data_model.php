<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class Admin_data_model extends CI_model
	{
			function __construct()
			{
				parent::__construct();
				$this->load->database();
			}
			
			public function get()
			{
				$sql = "select * from admin_qwe";
				$re = $this->db->query($sql);
				$res = $re->result_array();
				return $res;
			}
	}

?>
