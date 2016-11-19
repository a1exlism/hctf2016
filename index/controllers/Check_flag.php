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
		$this->load->model('user_model');
		$is_login = $this->session->userdata('is_login');
		$this->token = $this->session->userdata('team_token');
		// if (!$is_login) {
		// 	redirect('index/login', 'location');
		// }
	}

	public function check()
	{
		$id = $this->input->post('id'); //  challenge_id
		$id = $this->security->xss_clean($id);

		$flag = $this->input->post('flag');
		$flag = $this->security->xss_clean($flag);
		
		$token=$this->input->post('token',true);

		$api = $this->flag_model->check($id, $flag, $token);
		#bool 0校验错误 1作弊 2校验正确 3flag已经正确提交 4没有开题

		echo json_encode($api);
	}

	public function check_level()
	{
		$token=$this->input->post('token',true);
		$level=$this->flag_model->level_check($token);
		echo json_encode(array('level'=>$level));
	}

	public function reset()
	{ //  作弊处理
		$session_token = $this->session->userdata('team_token');
		$arr = array(
			'team_pass' => md5(md5(uniqid(rand() . 'xxxx')))
		);
		$this->user_model->user_update($session_token, $arr);
		$this->session->sess_destroy();
	}
}

?>
