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

	public function register_check()
	{
		//  调用model
		$team_name = $this->input->post('teamname', TRUE);
		$team_school = $this->input->post('school', TRUE);
		$team_email = $this->input->post('email', TRUE);
		$team_pass = $this->input->post('password', TRUE);
		$team_phone = $this->input->post('phone', TRUE);

		//  form-validation
		$config = array(
			array(
				'field' => 'teamname',
				'label' => 'team_name',
				'rules' => 'required|is_unique[team_info.team_name]',
				'errors' => array(
					'required' => 'Team name required.',
					'is_unique' => 'The user name has been taken.'
				)
			),
			array(
				'field' => 'school',
				'label' => 'school_name',
				'rules' => 'required',
				'errors' => array(
					'required' => 'School name required.'
				)
			),
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email|is_unique[team_info.team_email]',
				'errors' => array(
					'required' => 'Email required.',
					'valid_email' => 'Invalid email',
					'is_unique' => 'The email has been taken.'
				)
			),
			array(
				'field' => 'password',
				'label' => 'team_password',
				'rules' => 'required',
				'errors' => array(
					'required' => 'Password required.'
				)
			),  //  前端验证的pass confirm
			array(
				'field' => 'phone',
				'label' => 'phone_number',
				'rules' => 'required|min_length[8]|max_length[13]|numeric',
				'errors' => array(
					'min_length' => 'Wrong number length!',
					'max_length' => 'Wrong number length!',
					'numeric' => 'Phone number should be numeric!',
					'required' => 'Phone number is required.'
				)
			)
		);
		//  $this->form_validation->set_rules('teamname', 'team_name', 'required');
		$this->form_validation->set_rules($config);

		//  form data validation
		if ($this->form_validation->run() == FALSE) {

			//  创建error_json
			$err_obj = array(
				'status' => 'error',
				'name' => form_error('teamname'),
				'school' => form_error('school'),
				'email' => form_error('email'),
				'pass' => form_error('password'),
				'phone' => form_error('phone')
			);
			echo json_encode($err_obj);
			return NULL;
		} else {

			$arr_reg = array(
				'team_name' => $team_name,
				'team_school' => $team_school,
				'team_email' => $team_email,
				'team_pass' => $team_pass,
				'team_phone' => $team_phone
			);

			$this->user_model->user_register($arr_reg);
			//  table score_record init
			$team_token = $this->user_model->user_select($team_name)->row()->team_token;
			$this->score_model->init($team_token, $team_name);
			$this->flag_model->level_check($team_token); //  调用开题脚本
			echo '{"status": "success"}';
			return NULL;
		}

	}

	public function login_check()
	{
		//  CI封装
		$team_name = $this->input->post('teamname', TRUE);
		$team_pass = $this->input->post('password', TRUE);
		$user_data = $this->user_model->user_select($team_name)->row();

		if ($user_data) {
			//  如果用户存在
			$team_pass = $this->user_model->str_encode($team_pass);
			if ($user_data->team_pass === $team_pass) {
				$session_arr = array(
					'team_token' => $user_data->team_token,
					'is_login' => 1
				);
				$this->session->set_userdata($session_arr);

				echo '{"status": "success"}';

			} else {
				echo '{"status": "fail_1"}';
			}
		} else {
			echo '{"status": "fail_2"}';
		}
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