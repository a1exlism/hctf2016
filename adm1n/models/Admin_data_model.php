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

			public function join_json($id,$json)
			{
				$json_file=file_get_contents($json);
				$data=json_decode($json_file);
				var_dump($data);
				foreach ($data as $value) 
				{
					//$value->challenge_id=$id;
					if(!empty($value->file_name))
						$data=array('challenge_id'=>$id,'challenge_flag'=>$value->flag,'file_name'=>$value->file_name);
					else
						$data=array('challenge_id'=>$id,'challenge_flag'=>$value->flag);
					$status=$this->db->insert('multi_flags',$data);
				}
				return $status;
			}
	}

?>
