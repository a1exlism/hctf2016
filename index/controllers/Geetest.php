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
	private $mail_salt;
	private $active_salt;

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('email');

		$this->load->model('session_check');
		$this->load->model('user_model');
		$this->load->model('score_model');
		$this->load->model('flag_model');

		$this->mobile_captcha_id = "32bbbde17a1a19c1fa06121f437ff2c8";
		$this->mobile_private_key = "aa9621efff0aa0cb09a0f85b00341b8f";
		$this->GtSdk = new GeetestLib($this->mobile_captcha_id, $this->mobile_private_key);

		$this->mail_salt = 'fackemail';
		$this->active_salt = 'fackactive';
	}

	public function startCaptcha()
	{
		$user_id = md5(uniqid());
		$status = $this->GtSdk->pre_process($user_id);
		$_SESSION['gtserver'] = $status;
		$_SESSION['user_id'] = $user_id;
		echo $this->GtSdk->get_response_str();
	}


	//  register

	public function register_check()
	{
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
		$this->form_validation->set_rules($config);

		$user_id = $this->session->user_id;
		$geetest_challenge = $this->input->post('geetest_challenge');
		$geetest_validate = $this->input->post('geetest_validate');
		$geetest_seccode = $this->input->post('geetest_seccode');

		$validate_result = array();

		if ($_SESSION['gtserver'] == 1) {   //服务器正常
			$result = $this->GtSdk->success_validate($geetest_challenge, $geetest_validate, $geetest_seccode, $user_id);
			if ($result) {
				//  form data validation
				if ($this->form_validation->run() == FALSE) {

					//  创建error_json
					$validate_result = array(
						'status' => 'error',
						'name' => form_error('teamname'),
						'school' => form_error('school'),
						'email' => form_error('email'),
						'pass' => form_error('password'),
						'phone' => form_error('phone')
					);

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
					$validate_result = array(
						'status' => 'success',
						'message' => 'Register success',
						'checksum' => md5(md5($this->active_salt.$team_email)),
						'to_active' => 1 //  发邮件
					);
				}

			} else {
				$validate_result = array(
					'status' => 'error',
					'message' => 'Geetest test error'
				);

			}
		} else {  //服务器宕机,走failback模式
			if ($this->GtSdk->fail_validate($geetest_challenge, $geetest_validate, $geetest_seccode)) {
				$validate_result = array(
					'status' => 'error',
					'message' => 'Geetest server broke, try again.'
				);
			}
		}
		echo json_encode($validate_result);
	}


	//  login

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

	//  flag

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
							'checksum' => md5(md5($this->mail_salt . $team_email))
						);
					}
				}

			} else {
				$validate_result = array(
					'status' => 'error',
					'message' => 'geetest validate error:1'
				);
			}
		} else {
			if ($this->GtSdk->fail_validate($geetest_challenge, $geetest_validate, $geetest_seccode)) {
				echo json_encode(array(
					'status' => 'error',
					'message' => 'geetest validate error:2'
				));
			}
		}
		echo json_encode($validate_result);
	}
}


