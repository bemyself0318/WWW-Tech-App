<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
  
	function __construct(){
		parent::__construct();
	}	


	public function test () {
		$this->load->model('user_model');
		$this->user_model->insert_user('test','bemyself0318@gmail.com','xxx','xxx');
	}	

	public function test_getbygidx() {
		$this->load->model('user_model');
		$data = $this->user_model->getByGidx('112823812497872060991');	
		print_r($data);exit;
	}

	public function test_session() {
		$tmp = BASE_URL;
		print_r($tmp);exit;
		$ans = $this->session->all_userdata();
		$now_user = $ans['name'];
		print_r($ans);exit;
	}
}
