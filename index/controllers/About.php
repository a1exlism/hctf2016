<?php
/**
 * Created by PhpStorm.
 * User: a1exlism
 * Date: 16-9-29
 * Time: 下午2:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class About extends CI_Controller {
	public function index() {
		$this->load->view('index/about');
	}
	
}
