<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

	/**
	 * index Page for this controller.
	 *
	 * Maps to the following URL
	 *    http://example.com/index.php/welcome
	 *  - or -
	 *    http://example.com/index.php/welcome/index
	 *  - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('session_check');
	}

	public function index()
	{
		if ($this->session_check->check() === 1) {
			//  登录状态  以后会更改的
			redirect('index/team', 'location');
		} else {
			$this->load->view('index/login');
		}
	}

	public function register()
	{
		//  调用model
		$team_name = $this->security->xss_clean($_POST['teamname']);
		$team_school = $this->security->xss_clean($_POST['school']);
		$team_email = $this->security->xss_clean($_POST['email']);
		$team_pass = $this->security->xss_clean($_POST['password']);
		$team_phone = $this->security->xss_clean($_POST['phone']);

		$user_data = $this->user_model->user_select($team_name);

		if ($user_data) { //  如果用户存在
			echo '{"status": "Error: Username has been taken."}';
			return NULL;
		} else {
			if (empty($team_school) || empty($team_email) || empty($team_phone)) {
				echo '{"status": "Error: All info required."}';
				return NULL;
			}
		}

		$arr_reg = array(
			'team_name' => $team_name,
			'team_school' => $team_school,
			'team_email' => $team_email,
			'team_pass' => $team_pass,
			'team_phone' => $team_phone
		);

		$this->user_model->user_register($arr_reg);

		echo '{"status": "success"}';
		return NULL;
	}

	public function login()
	{

		$team_name = $this->security->xss_clean($_POST['teamname']);
		$team_pass = $this->security->xss_clean($_POST['password']);
		$user_data = $this->user_model->user_select($team_name);

		if ($user_data) {
			//  如果用户存在
			if ($user_data[0]->team_pass === $team_pass) {
				$session_arr = array(
					'team_token' => $user_data[0]->team_token,
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

	public function logout()
	{
		$this->session->unset_userdata('is_login');
		$this->session->unset_userdata('team_token');
	}

}
