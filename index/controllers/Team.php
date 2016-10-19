<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-10-13
 * Time: 上午12:45
 */
class Team extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('session_check');

		//  session check
		if ($this->session_check->check() !== 1) {
			redirect('index/login', 'location');
		}

	}


	public function logout()
	{
		$this->session->sess_destroy(); //CI封装
		redirect('index/login', 'location');
	}

	public function index()
	{
		$this->load->view('index/team');
	}

	public function settings()
	{
		$this->load->view('index/team_settings');
	}

	public function bulletin()
	{
		$this->load->view('index/team_bulletin');
	}

	public function challenge()
	{
		$this->load->view('index/team_challenge');
	}

	public function rank()
	{
		$this->load->view('index/team_rank');
	}

	public function solved()
	{
		$this->load->view('index/team_solved');
	}
}
