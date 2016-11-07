<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_flag extends CI_Controller
{
	/* 
	 * 私有变量
	 */
	 
	private $token;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('flag_model');
		$is_login = $this->session->userdata('is_login');
		$this->token = $this->session->userdata('team_token');
		if (!$is_login) {
			redirect('index/login', 'location');
		}
	}

	public function check()
	{
		$id = $this->input->post('id'); //  challenge_id
		$id = $this->security->xss_clean($id);

		$flag = $this->input->post('flag');
		$flag = $this->security->xss_clean($flag);
		//$this->token='token';
		$bool = $this->flag_model->check($id, $flag, $this->token);
		#bool 0校验错误 1作弊 2校验正确 3flag已经正确提交 4没有开题
		echo json_encode(array("statusCode" => $bool));
	}
}

?>
