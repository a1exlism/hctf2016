<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_flag extends CI_Controller
{
	private $token;
	function __construct()
	{
		parent::__construct();
		$this->load->libiary('session');
		$this->load->model('flag_model');
		$is_login=$this->session->userdata('is_login');
		$this->token=$this->session->userdata('token');
		if(!$is_login)
		{
			echo "<script>window.location.href='/hctf2016/index'</script>";
		}
	}

	public function check()
	{
		$id=$this->input->post('id');
		$id=$this->security->xss_clean($id);

		$flag=$this->input->post('flag');
		$flag=$this->security->xss_clean($flag);

		$bool=$this->flag_model->check($id,$flag,$this->token);

		#bool 0 校验错误 1 作弊 2 校验正确 

	}
}

?>