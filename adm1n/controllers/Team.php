<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('session_check');
		$this->load->model('team_model');
		$run=$this->session_check->check();
		if($run==0)
		{
			redirect('/adm1n/web_admin/index');
		}
	}

	public function index()
	{
		$this->load->view('adm1n/team_view');
	}

	public function ban()
	{
		$method=$this->input->post('method');
		$method=$this->security->xss_clean($method);

		$value=$this->input->post('value');
		$value=$this->security->xss_clean($value);

		$bool=$this->team_model->ban($method,$value);

		if($bool==0)
		{
			echo "<script>alert('ban failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('ban succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
	}

	public function search()
	{
		$id=$this->input->post('team_name');
		$id=$this->security->xss_clean($id);

		$token=$this->input->post('team_token');
		$token=$this->security->xss_clean($token);


		$result=$this->team_model->search($id,$token);

		$data=array('result'=>$result);

		$this->load->view('adm1n/team_view');
		$this->load->view('adm1n/show_team',$data);
	}

	public function score()
	{
		$method=$this->input->post('method');
		$method=$this->security->xss_clean($method);

		$value=$this->input->post('value');
		$value=$this->security->xss_clean($value);

		$score=$this->input->post('score');
		$score=$this->security->xss_clean($score);

		echo $method.' '.$value;

		$bool=$this->team_model->add($method,$value,$score);

		if($bool==0)
		{
			echo "<script>alert('change score failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('change score succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
	}

	public function open()
	{
		$id=$this->input->post('id');
		$id=$this->security->xss_clean($id);

		$bool=$this->team_model->open($id);

		if($bool==0)
		{
			echo "<script>alert('open challenge failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('open challenge succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
	}

	public function card()
	{
		$method=$this->input->post('method');
		$method=$this->security->xss_clean($method);

		$value=$this->input->post('value');
		$value=$this->security->xss_clean($value);

		$id=$this->input->post('id');
		$id=$this->security->xss_clean($id);

		$bool=$this->team_model->card($method,$value,$id);

		if($bool==0)
		{
			echo "<script>alert('give card failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('give card succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/team/index'</script>";
		}
	}


}

?>