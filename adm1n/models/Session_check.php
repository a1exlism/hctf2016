<?php

	class session_check extends CI_model
	{
		private $is_login;
		private $admin;
		private $key;
		function __construct()
		{
			parent::__construct();
			$this->load->library('session');
			$this -> is_login=$this -> session -> userdata('is_login');
			$this -> admin=$this -> session ->userdata('admin');
			$this -> key=$this-> session ->userdata('key');
		}
			
		public function check()
		{
			if(empty($this -> admin) || empty($this -> is_login) || empty($this -> key))
			{
				return 0;
			}
			else 
			{
				return 1;
			}
		}
	}

?>