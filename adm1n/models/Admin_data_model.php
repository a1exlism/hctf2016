<?php

	class Admin_data_model extends CI_model
	{
			function __construct()
			{
					parent::__construct();
					$this->load->database();
			}
			
			public function get()
			{
				$sql = "select * from ADMIN_qwe";
				$re = $this->db->query($sql);
				$res = $re->result_array();
				return $res;
			}
	}

?>
