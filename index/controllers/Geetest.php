<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(dirname(__FILE__)) . '/libraries/Geetestlib.php';
//  暂时不会用library方法调用, 直接require_once 了
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-10-6
 * Time: 下午1:27
 * --- 整合注册登录/flag提交/忘记密码功能 ---
 */
class Geetest extends CI_Controller
{
	/* 
	* 私有变量
	*/
	private $captcha_id;
	private $private_key;
	private $GtSdk;
	private $mail_checksum;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');

		$this->load->library('session');
		$this->load->library('form_validation');

		$this->load->model('session_check');
		$this->load->model('user_model');

		$this->mobile_captcha_id = "32bbbde17a1a19c1fa06121f437ff2c8";
		$this->mobile_private_key = "aa9621efff0aa0cb09a0f85b00341b8f";
		$this->GtSdk = new GeetestLib($this->mobile_captcha_id, $this->mobile_private_key);

		$this->mail_checksum = md5(md5('fackemail'));
	}

	public function startCaptcha()
	{
		$user_id = md5(uniqid());
		$status = $this->GtSdk->pre_process($user_id);
		$_SESSION['gtserver'] = $status;
		$_SESSION['user_id'] = $user_id;
		echo $this->GtSdk->get_response_str();
	}

	//  todo: verifyLogin verifyRegister 功能重写


	public function verifyLogin()
	{
		/**
		 * 输出二次验证结果
		 */
		// error_reporting(0);

		$user_id = $_SESSION['user_id'];
		if ($_SESSION['gtserver'] == 1) {   //服务器正常
			$result = $this->GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
			if ($result) {
				echo '{"status":"success"}';
			} else {
				echo '{"status":"fail_1"}';
			}
		} else {  //服务器宕机,走failback模式
			if ($this->GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
				echo '{"status":"success"}';
			} else {
				echo '{"status":"fail_2"}';
			}
		}
	}

	public function verifyFlag()
	{
		/**
		 * 输出二次验证结果
		 */
		//  session check
		if ($this->session_check->check() !== 1) {
			redirect('index/login', 'location');
		}

		$user_id = $_SESSION['user_id'];
		if ($_SESSION['gtserver'] == 1) {   //服务器正常
			$result = $this->GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
			if ($result) {
				$flag = $this->input->post('flag');
				if (!empty($flag)) {
					echo '{"status":"success"}';
				} else {
					echo '{"status":"fail_0"}';
				}
			} else {
				echo '{"status":"fail_1"}';
			}
		} else {  //服务器宕机,走failback模式
			if ($this->GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
				echo '{"status":"success"}';
			} else {
				echo '{"status":"fail_2"}';
			}
		}
	}

	//  mail check	

	public function mail_check()
	{
		$validate_result = array();

		$user_id = $this->session->user_id;
		$geetest_challenge = $this->input->post('geetest_challenge');
		$geetest_validate = $this->input->post('geetest_validate');
		$geetest_seccode = $this->input->post('geetest_seccode');

		$team_email = $this->input->post('email');
		$config = array(
			array(
				'field' => 'email',
				'label' => 'email',
				'rules' => 'required|valid_email',
				'errors' => array(
					'required' => 'Email required.',
					'valid_email' => 'Invalid email.'
				)
			)
		);

		$this->form_validation->set_rules($config);

		if ($this->session->gtserver == 1) {   //服务器正常
			$result = $this->GtSdk->success_validate($geetest_challenge, $geetest_validate, $geetest_seccode, $user_id);
			if ($result) {
				if ($this->form_validation->run() == FALSE) {
					$validate_result = array(
						'status' => 'error',
						'message' => 'Email empty || Invalid email'
					);
				} else {
					$team_obj = $this->user_model->user_select_email($team_email)->row();
					if (empty($team_obj)) {
						$validate_result = array(
							'status' => 'error',
							'message' => 'No such team.'
						);
					} else {
						$validate_result = array(
							'status' => 'success',
							'checksum' => $this->mail_checksum, //  防爆破
							'message' => 'Password reset address has been sent to your email.'
						);
					}
				}

			} else {
				echo '{"status":"error"}';
			}
		} else {
			if ($this->GtSdk->fail_validate($geetest_challenge, $geetest_validate, $geetest_seccode)) {
				echo json_encode(array(
					'status' => 'error',
					'message' => 'geetest validate error'
				));
			}
		}
		echo json_encode($validate_result);
	}
}


