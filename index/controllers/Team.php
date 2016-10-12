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

	}

	public function index() {
		$this->load->view('index/team');
	}

}
