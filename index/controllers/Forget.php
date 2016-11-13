<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forget extends CI_Controller
{
	private $mail_checksum;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');
		
		$this->mail_checksum = md5(md5('fackemail'));
	}

	public function index()
	{
		$this->load->view('index/forget');
	}

	public function mail_send($token, $receiver, $checksum) {
		if($this->mail_checksum != $checksum) {
			echo "You are NOT allowed to here.";
			exit();
		}
	
		$subject = 'HCTF2016 | Password Reset';
		$link = 'user_ajax/pass_reset/'.$token;
		$sender = 'a1ex_x@126.com';
		
		$message = "<p>Use the following link within the next day to reset your password:<a href='$link' target='_blank'>$link</a></p>";

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

		exit();
	}
}