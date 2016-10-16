<?php
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-10-13
 * Time: 上午12:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Session_check extends CI_Model
{
	private $is_login;
	private $team_token;

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->is_login = $this->session->userdata('is_login');
		$this->team_token = $this->session->userdata('team_token');
	}

	public function check()
	{
		if (empty($this->is_login) || empty($this->team_token)) {
			return 0;
		} else {
			return 1;
		}
	}
}
