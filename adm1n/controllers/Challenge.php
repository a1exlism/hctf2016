<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class challenge extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('session_check');
		$run=$this->session_check->check();
		if($run==0)
		{
			echo "<script>window.location.href='/hctf2016/adm1n/Web_admin/index'</script>";
		}
	}

	public function index()
	{
		$this->load->view('adm1n/challenge_view');
	}	

	public function show()
	{
		$this->load->model('challenge_model');
		$id=$this->input->post('id');
		$result=$this->challenge_model->show($id);
		//var_dump($result);
		$data=array('result'=>$result);

		$this->load->view('adm1n/challenge_view');

		$this->load->view('adm1n/show_challenge',$data);
	}

	public function add()
	{
		$this->load->model('challenge_model');
		
		$id=$this->input->post('id');
		$id=$this->security->xss_clean($id);

		$score=$this->input->post('score');
		$score=$this->security->xss_clean($score);

		$description=$this->input->post('description');
		$description=$this->security->xss_clean($description);

		$level=$this->input->post('$level');
		$level=$this->security->xss_clean($level);

		$hit=$this->input->post('hit');
		$hit=$this->security->xss_clean($hit);

		$api=$this->input->post('api');
		$api=$this->security->xss_clean($api);

		$data=array(
					'challenge_score'=>$score,
					'challenge_description'=>$description,
					'challenge_level'=>$level,
					'challenge_hit'=>$hit,
					'challenge_api'=>$api
					);
		$bool=$this->challenge_model->add($data,$id);
		if($bool==0)
		{
			echo "<script>alert('add failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('add succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";	
		}

	}

	public function change()
	{
		$this->load->model('challenge_model');
		
		$id=$this->input->post('id');
		$id=$this->security->xss_clean($id);

		$score=$this->input->post('score');
		$score=$this->security->xss_clean($score);

		$description=$this->input->post('description');
		$description=$this->security->xss_clean($description);

		$level=$this->input->post('$level');
		$level=$this->security->xss_clean($level);

		$hit=$this->input->post('hit');
		$hit=$this->security->xss_clean($hit);

		$api=$this->input->post('api');
		$api=$this->security->xss_clean($api);

		$data=array(
					'challenge_score'=>$score,
					'challenge_description'=>$description,
					'challenge_level'=>$level,
					'challenge_hit'=>$hit,
					'challenge_api'=>$api
					);
		$bool=$this->challenge_model->change($data,$id);

		if($bool==0)
		{
			echo "<script>alert('update failed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";
		}
		else if($bool == 1)
		{
			echo "<script>alert('update succeed!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";	
		}
	}
}

?>