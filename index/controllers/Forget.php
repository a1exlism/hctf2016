<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller
{
	private $mail_salt;
	private $mail_checksum;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');

		$this->load->model('user_model');

		$this->mail_salt = 'fackemail';
	}

	public function index()
	{
		$this->load->view('index/forget');
	}

	public function mail_send()
	{
		$checksum = $this->input->post('checksum');
		$receiver = $this->input->post('email');
		$token = $this->user_model->user_select_email($receiver)->row()->team_token;
		$this->mail_checksum = md5(md5($this->mail_salt.$receiver));
		if ($this->mail_checksum != $checksum) {
			echo "You are NOT allowed here.";
			exit();
		}

		$subject = 'HCTF2016 | Password Reset';
		//  todo: URL 需要一个绝对路径
		$link = 'http://115.159.26.130:8000/hctf2016/index/forget/pass_reset/' . $token . '/' . $checksum;
		$sender = 'a1ex_x@126.com';

		$message = "<p>Use the following link to reset your password:<a href='" . $link . "' target='_blank'>$link</a></p>";

		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=' . strtolower(config_item('charset')) . '" />
        <title>' . html_escape($subject) . '</title>
        <style type="text/css">
            body {
                font-family: Arial, Verdana, Helvetica, sans-serif;
                font-size: 30px;
            }
        </style>
    </head>
    <body>
    ' . $message . '
    </body>
    </html>';

		$result = $this->email
			->from($sender)
//			->reply_to('yoursecondemail@somedomain.com')    // Optional, an account where a human being reads.
			->to($receiver)
			->subject($subject)
			->message($body)
			->send();

//		var_dump($result);
//		echo '<br />';
//		echo $this->email->print_debugger();
		echo json_encode(array(
			'status' => 'success',
			'message' => 'Password reset address has been sent to your email.'
		));
		exit();
	}

	public function pass_reset($token = null, $checksum = null)
	{
		$team_email = $this->user_model->user_select_token($token)->row()->team_email;
		$this->mail_checksum = md5(md5($this->mail_salt.$team_email));
		if ($this->mail_checksum != $checksum) {
			echo "You are NOT allowed to change passwords.";
			exit();
		}

		$this->load->view('index/pass_reset');
	}
}