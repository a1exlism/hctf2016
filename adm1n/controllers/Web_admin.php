<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_admin extends CI_Controller 
{
	private $admin;
	private $pass;
	private $key;

	function __construct()
	{
		parent::__construct();
		$this -> load -> library('session'); 
		$this -> load -> model('Admin_data_model');
		$data = $this -> Admin_data_model -> get();

		if(!empty($data))
		{
			$this -> admin = $data[0]['user'];
			$this -> pass = $data[0]['pass'];
			$this -> key = $data[0]['key'];	
		}
	}
	
	public function index()
	{
		$this->load->model('session_check');
		$s=$this->session_check->check();
		if($s)
		{
			redirect('/adm1n/web_admin/admin');
		}
		else 
		{
			$key = $this -> uri -> segment(3);
			$data=array('key' => $key);
			$this -> load ->view('adm1n/index',$data);
		}
	}

	public function login()
	{
		$user=$this -> input ->post('user');
		$user=$this -> security -> xss_clean($user);

		$pass=$this -> input ->post('pass');
		$pass=$this -> security ->xss_clean($pass);
		$pass=md5($pass);

		$key = $this -> uri -> segment(3);	

		if(empty($user)||empty($pass))
		{
		echo "<script>alert('Please input admin name and password first')</script>";
		echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
		else
		{
			if($user!=$this-> admin || $pass!=$this-> pass || $key!=$this-> key)
			{
				echo "<script>alert('Wrong input!')</script>";
				echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
			}

			else
			{
				$set_data=array(
					'admin' => $user,
					'is_login' => 1,
					'key' => $key
				);
				$this -> session -> set_userdata($set_data);
				redirect('/adm1n/web_admin/admin');
			}
		}
	}

	public function admin()
	{

		$this->load->model('session_check');
		$s=$this->session_check->check();
		if(!$s)
		{
			redirect('/adm1n/Web_admin/index');
		}

		else
		{
			$this -> load ->view('adm1n/admin_view');
		}
	}

	public function logout()
	{
		$this->load->model('session_check');
		$s=$this->session_check->check();
		if(!$s)
		{
			redirect('/adm1n/web_admin/index');
		}

		else
		{
			$unset_data = array('admin', 'is_login','key');
			$this->session->unset_userdata($unset_data);
			redirect('/adm1n/web_admin/index');
		}
	}

	

}