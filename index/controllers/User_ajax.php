<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_ajax extends CI_Controller
{
	private $mail_salt;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('session_check');
		$this->load->model('score_model');
		$this->load->model('flag_model');
		$this->load->helper('form');
		$this->load->library('form_validation');  //表单验证类
		$this->mail_salt = 'fackemail';
	}

	public function pass_reset()
	{
		$token = $this->input->post('query-1', TRUE);
		$checksum = $this->input->post('query-2', TRUE);
		$passwd = $this->user_model->str_encode($this->input->post('pass', TRUE));
		$team_email = $this->user_model->user_select_token($token)->row()->team_email;
		$mail_checksum = md5(md5($this->mail_salt.$team_email));
		if (empty($token)) {
			echo json_encode(array(
				'status' => 'error',
				'message' => 'Team not found'
			));
			exit();
		}

		if ($mail_checksum != $checksum) {
			echo json_encode(array(
				'status' => 'error',
				'message' => 'Check error, you may need new address.'
			));
			exit();
		}

		$arr = array('team_pass' =>  $passwd);
		$this->user_model->user_update($token, $arr);
		$notice = array(
			'status' => 'success',
			'message' => 'Password changed'
		);

		echo json_encode($notice);
	}
}