<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	private $active_salt;
	private $active_checksum;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('email');
		$this->load->library('form_validation');
		
		$this->load->model('user_model');
		$this->load->model('session_check');

		$this->load->helper('form');
		//  session check
		if ($this->session_check->check() === 1) {
			redirect('index/team', 'location');
		}
		
		$this->active_salt = 'fackactive';
	}

	public function index()
	{
		$this->load->view('index/login');
	}

	public function pass_reset()
	{
		$this->load->view('index/pass_reset');
	}
	
	public function mail_send()
	{
		$checksum = $this->input->post('checksum');
		$receiver = $this->input->post('email');
		
		$token = $this->user_model->user_select_email($receiver)->row()->team_token;
		$this->active_checksum = md5(md5($this->active_salt.$receiver));
		if ($this->active_checksum != $checksum) {
			echo "You are NOT allowed here.";
			exit();
		}

		$subject = 'HCTF2016 | Active Email';
		$link = 'http://115.159.26.130:8000/hctf2016/index/active/mail/' . $token;
		$sender = 'hctf_support@163.com';

		$message = "<p>Use the following link to active :<a href='" . $link . "' target='_blank'>$link</a></p>";

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
			'message' => 'Active mail has been post to you.'
		));
		exit();
	}
}
