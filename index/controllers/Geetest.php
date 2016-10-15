<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(dirname(__FILE__)) . '/libraries/Geetestlib.php';
//  暂时不会用library方法调用, 直接require_once 了
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-10-6
 * Time: 下午1:27
 */
class Geetest extends CI_Controller
{
	/* 
	* 私有变量
	*/
	private $captcha_id;
	private $private_key;
	private $GtSdk;

	public function __construct()
	{
		parent::__construct();

		/*
			PC Client
			$this->captcha_id = "9461f13fdaf942af20e90509d9149c6d";
			$this->private_key = "aac091f5965f4f87d542f95e77b16398";
			$this->GtSdk = new GeetestLib($this->captcha_id, $this->private_key);
		*/

		/* Mobile Client */
		$this->mobile_captcha_id = "32bbbde17a1a19c1fa06121f437ff2c8";
		$this->mobile_private_key = "aa9621efff0aa0cb09a0f85b00341b8f";
		$this->GtSdk = new GeetestLib($this->mobile_captcha_id, $this->mobile_private_key);
	}

	public function index()
	{
		//	codes?
	}

	public function startCaptcha()
	{

		session_start();
		$user_id = "test";
		$status = $this->GtSdk->pre_process($user_id);
		$_SESSION['gtserver'] = $status;
		$_SESSION['user_id'] = $user_id;
		echo $this->GtSdk->get_response_str();
	}

	public function verifyLogin()
	{
		/**
		 * 输出二次验证结果
		 */
		// error_reporting(0);
		session_start();

		$user_id = $_SESSION['user_id'];
		if ($_SESSION['gtserver'] == 1) {   //服务器正常
			$result = $this->GtSdk->success_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $user_id);
			if ($result) {
				echo '{"status":"success"}';
			} else {
				echo '{"status":"fail"}';
			}
		} else {  //服务器宕机,走failback模式
			if ($this->GtSdk->fail_validate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'])) {
				echo '{"status":"success"}';
			} else {
				echo '{"status":"fail"}';
			}
		}
	}
}