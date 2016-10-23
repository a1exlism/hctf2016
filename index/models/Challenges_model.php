<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class  Challenge_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		$this->salt = "HC7F";
	}

	/*-- Ranking --*/
	public function get_rank_self()
	{
		//  通过session进行取值
		
	}

	public function get_rank_15()
	{

	}

	public function get_rank_all()
	{

	}

	public function get_solved()
	{
		//  解题情况	
	}

	
}