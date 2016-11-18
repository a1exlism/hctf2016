<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class createapi extends CI_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this -> load -> library('session'); 
		$this -> load ->helper('file'); 
		$this -> load -> model('Admin_data_model');
		$this -> load -> model('session_check');

		if(!$this->session_check->check())
		{
			redirect('/adm1n/Web_admin/index');
		}

		$data = $this -> Admin_data_model -> get();
	}

	public function api()
	{
		$name=$this->input->post('apiname');
		$name=$this->security->xss_clean($name);

		$flag=$this->input->post('flag');
		$flag=$this->security->xss_clean($flag);
		$data="<?php defined('BASEPATH') OR exit('No direct script access allowed'); class $name {public function getflag(".'$token'."){".'$flag='."'$flag';return ".'$flag;}} ?>';
		$path="../index/libraries/".$name.'.php';

		//echo $path;
		if (!write_file($path, $data,'wb'))
		{
    		echo "<script>alert('Unable to write the file!')</script>";
    		echo "<script>window.location.href='/hctf2016/adm1n/createapi/index'</script>";
		}
		else
		{
			echo "<script>alert('success to create api!')</script>";
    		echo "<script>window.location.href='/hctf2016/adm1n/createapi/index'</script>";
		}		

		#function getflag($token){return $flag;}
	}

	public function index()
	{
		$this->load->view('adm1n/create_api');
	}

	public function join_json()
	{
		$id=$this->input->post('id',true);
		$json_name=$this->input->post('json',true);

		$status=$this->Admin_data_model->join_json($id,$json_name);

		if ($status)
		{
    		echo "<script>alert('json is in database!')</script>";
    		echo "<script>window.location.href='/hctf2016/adm1n/createapi/index'</script>";
		}
		else
		{
			echo "<script>alert('can\' join json!')</script>";
    		echo "<script>window.location.href='/hctf2016/adm1n/createapi/index'</script>";
		}	
	}
}

?>