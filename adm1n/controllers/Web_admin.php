<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_admin extends CI_Controller 
{
	private $admin;
	private $pass;
	function __construct()
	{
		parent::__construct();
		$this -> load -> library('session'); 
		$this -> load -> library('form_validation'); 
		$this -> load -> model('Admin_data_model');
		$data = $this -> Admin_data_model -> get();
		var_dump($data);
	}
	
	public function index()
	{
		//$is_login = $this -> session -> userdata('is_login');
		//$admin = $this -> session -> userdata('admin');
		echo 1;
	}
}