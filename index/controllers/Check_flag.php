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
		if($bool == 1) {
			$this->reset();
		}
		echo json_encode(array("statusCode" => $bool));
	}

	public function reset()
	{ //  作弊处理
		if ($this->session_check->check() === 0) {
			redirect('index/login', 'location');
		}

		$session_token = $this->session->userdata('team_token');
		$status = $this->input->post('status', TRUE);
		if (!empty($status) && $status == 'reset') {
			$arr = array(
				'team_pass' => md5(md5(uniqid(rand() . 'xxxx')))
			);
			$this->user_model->update($session_token, $arr);
			$this->session->sess_destroy();
		}
	}
}

?>
