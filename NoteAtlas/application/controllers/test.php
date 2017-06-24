<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function gidx() {
		$this->load->model('user_model');
		$rtn = $this->post_model->getUidxByGidx(112823812497872060991);
		print_r($rtn);exit;
	}
//test	
	public function update() {
		$this->load->model('post_model');
		$this->post_model->updatePost(1,'test_title','test comment',127.5,23.5);
		print_r('ok');exit;
	}

	public function getuser() {

		$this->load->model('user_model');
		$data = $this->user_model->getUserByIdx(18);
		print_r($data);exit;
	}

	public function testsession() {

		$this->load->model('user_model');
		$idx = $this->user_model->getUidxByGidx($this->session->userdata('google_idx'));
		print_r($idx);exit;
	}	

	public function comment () {
		$this->load->model('comment_model');
		$rtn = $this->comment_model->getCommentByPIdx(19);
		
	}

	public function updatepost () {
		$this->load->model('post_model');
		$this->post_model->addComment(18,7,'james test');
	}
}
