<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class challenge extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('session_check');
		$this->run=$this->session_check->check();
		if($this->run==0)
		{
			echo "<script>window.location.href='/hctf2016/adm1n/Web_admin/index'</script>";
		}
	}	
}

?>