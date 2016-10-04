<?php

class	User_model extends CI_Model {
	function __construct() {
		parent::__construct();
		$this ->load->database();
		$this ->load->library('session');
	}

	public function user_register ($teamname, $email, $school, $password)
	{
		$token = $this->token_generate();
		$insert_data = array(
			'team_name' => $teamname,
			'team_email' => $email,
			'team_school' => $school,
			'team_token' => $token,
			'is_expand' => 0,
			'total_score' => 0,
			'compet_level' => 1,
			'is_cheat' => 0,
			'team_pass' => $password
		);
		$this->db->insert('team_info', $insert_data);
	}

	public function token_generate() {
		return md5(uniqid(rand()));
	}
	public function token_check() {
		
	}
}

?>
