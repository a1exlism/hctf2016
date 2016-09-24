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
		$this -> load -> library('form_validation'); 
		$this -> load -> model('Admin_data_model');
		$data = $this -> Admin_data_model -> get();
		$this -> admin = $data[0]['user'];
		$this -> pass = $data[0]['pass'];
		$this -> key = $data[0]['key'];	
	}
	
	public function index()
	{
		$is_login = $this -> session -> userdata('is_login');
		$admin = $this -> session -> userdata('admin');
		$key = $this -> session -> userdata('key');



		if($is_login==1 && $admin==$this -> admin && $key==$this -> key)
		{
			echo "<script>window.location.href='/hctf2016/adm1n/Web_admin/admin'</script>";
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
		echo "<script>window.location.href='/hctf2016/adm1n/Web_admin/index/".$key."'</script>";
		}
		else
		{
			if($user!=$this-> admin || $pass!=$this-> pass || $key!=$this-> key)
			{
				echo "<script>alert('Wrong input!')</script>";
				echo "<script>window.location.href='/hctf2016/adm1n/Web_admin/index/".$key."'</script>";
			}

			else
			{
				$set_data=array(
					'admin' => $user,
					'is_login' => 1,
					'key' => $key
				);
				$this -> session -> set_userdata($set_data);
				echo "<script>window.location.href='/hctf2016/adm1n/web_admin/admin'</script>";
			}
		}
	}


}