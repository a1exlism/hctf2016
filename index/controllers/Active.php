<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Active extends CI_Controller
{
	private $mail_salt;
	private $mail_checksum;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('email');

		$this->load->model('user_model');

		$this->mail_salt = 'fackactive';

	}

	public function mail()
	{
		$this->load->view('index/mail_active');
	}

	public function mail_check()
	{
		$result = array();
		$token = $this->input->post('query');
		$data = $this->user_model->user_select_token($token)->row();
		if (empty($data->team_name)) {
			$result = array(
				'status' => 'error_0',
				'message' => 'No such team'
			);
		} else {
			if ($data->active_status != 1) {
				$arr = array(
					'active_status' => 1
				);
				$this->user_model->user_update($token, $arr);
				$result = array(
					'status' => 'success',
					'message' => 'Welcome to HCTF: ' . $data->team_name
				);
			} else {
				$result = array(
					'status' => 'error',
					'message' => 'The team has been actived'
				);
			}
		}
		echo json_encode($result);
	}
}

?>
