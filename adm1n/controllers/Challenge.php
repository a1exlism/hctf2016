<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class challenge extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('session_check');
		$this->load->model('challenge_model');
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
		//$this->load->model('challenge_model');
		$id=$this->input->post('id');
		$result=$this->challenge_model->show($id);
		//var_dump($result);
		$data=array('result'=>$result);

		$this->load->view('adm1n/challenge_view');

		$this->load->view('adm1n/show_challenge',$data);
		//var_dump($result);
	}

	public function detail($id)
	{
		$result=$this->challenge_model->show($id);
		$data=array('result'=>$result);
		$this->load->view('adm1n/challenge_detail',$data);
	}

	public function add()
	{
		//$this->load->model('challenge_model');

		$name=$this->input->post('name');
		$name=$this->security->xss_clean($name);

		$type=$this->input->post('type');
		$type=$this->security->xss_clean($type);

		$score=$this->input->post('score');
		$score=$this->security->xss_clean($score);

		$description=$this->input->post('description');
		$description=$this->security->xss_clean($description);

		$level=$this->input->post('level');
		$level=$this->security->xss_clean($level);

		$threshold=$this->input->post('threshold');
		$threshold=$this->security->xss_clean($threshold);

		$hit=$this->input->post('hit');
		$hit=$this->security->xss_clean($hit);

		$api=$this->input->post('api');
		$api=$this->security->xss_clean($api);



		if(!is_numeric($score) || empty($description) || !is_numeric($level) || empty($name) || empty($type))
		{
			echo "<script>alert('you have to input something!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";
			//var_dump($score);
			//var_dump($description);
			//var_dump($level);
			//var_dump($hit);
			//var_dump($api);
		}
		else
		{
			$data=array(
					'challenge_name'=>$name,
					'challenge_type'=>$type,
					'challenge_score'=>$score,
					'challenge_description'=>$description,
					'challenge_level'=>$level,
					'challenge_hit'=>$hit,
					'challenge_api'=>$api,
					'challenge_threshold'=>$threshold
					);
			$bool=$this->challenge_model->add($data);
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

	}

	public function change()
	{
		//$this->load->model('challenge_model');
		
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

		$threshold=$this->input->post('threshold');
		$threshold=$this->security->xss_clean($threshold);

		if(!is_numeric($id))
		{
			echo "<script>alert('you have to input id!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";
		}

		$data=array(
					'challenge_score'=>$score,
					'challenge_description'=>$description,
					'challenge_level'=>$level,
					'challenge_hit'=>$hit,
					'challenge_api'=>$api,
					'challenge_threshold'=>$threshold
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

	public function delete()
	{
		$id=$this->input->post('id');
		$id=$this->security->xss_clean($id);

		if(!is_numeric($id))
		{
			echo "<script>alert('you have to input id!')</script>";
			echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";	
		}
		else
		{
			$bool=$this->challenge_model->delete($id);

			if($bool==0)
			{
				echo "<script>alert('delete failed!')</script>";
				echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";
			}
			else if($bool == 1)
			{
				echo "<script>alert('delete succeed!')</script>";
				echo "<script>window.location.href='/hctf2016/adm1n/challenge/index'</script>";	
			}
		}
	}

}

?>