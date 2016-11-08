<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info extends CI_Controller 
{
	private $run;

	function __construct()
	{
		parent::__construct();
		#$this->load->library('session');
		$this->load->model('session_check');
		$this->run=$this->session_check->check();
		if($this->run==0)
		{
			redirect('/adm1n/web_admin/index');
		}
	}

	public function index()
	{
		$this -> load -> view('adm1n/info_view');
	}

	public function delete()
	{
		$this -> load ->model('info_model');
		
		$id=$this -> input -> post('id');
		$id=$this -> security ->xss_clean($id);

		$bool=$this ->info_model-> del($id);
		if($bool==0)
		{
			echo "<script>alert('delete failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/info/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('delete succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/info/index'</script>";
		}
	}

	public function add()
	{
		$this -> load ->model('info_model');

		$mes=$this->input->post('message');
		$mes=$this->security->xss_clean($mes);

		//var_dump($mes);

		$bool=$this->info_model->add($mes);
		if($bool==0)
		{
			echo "<script>alert('add failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/info/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('add succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/info/index'</script>";
		}
	}

	public function change()
	{
		$this->load->model('info_model');

		$c_id=$this->input->post('c_id');
		$c_id=$this->security->xss_clean($c_id);

		$c_mes=$this->input->post('c_message');
		$c_mes=$this->security->xss_clean($c_mes);

		$bool=$this->info_model->change($c_id,$c_mes);
		if($bool==0)
		{
			echo "<script>alert('change failed!')</script>";
    		echo "<script>window.location.href='/hctf2016/adm1n/info/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('change succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/info/index'</script>";
		}
	}
}