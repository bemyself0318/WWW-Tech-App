<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		//if($this->session->userdata('google_idx')) {
		//	header("Location:http://dmplus.cs.ccu.edu.tw/~s403410035/NoteAtlas/index.php/map/mapoverview");
		 // return ;
		//}
	}  
	
	public function noteatlas() {
    $data["THISURL"] = BASE_URL;
		$this->load->view('login',$data);
	}

	public function google_login() {
		$this->load->model('user_model');
		$data = $this->input->post();
		//$data = array('name'=>'testbot', 'photo_url'=>'test_url','google_idx'=>'test_gidx','gmail'=>'test_gmail' );
		$this->session->set_userdata($data);
		$user = $this->user_model->getByGidx($data['google_idx']);
		if(! $user) {
				if($uid = $this->user_model->insert_user($data['name'],$data['photo_url'],$data['google_idx'],$data['gmail'])) {
					$this->session->set_userdata(array('uid' => $uid));
				}
				else {
					//TODO
				}
		}
		else {
			$this->session->set_userdata(array('uid' => $user['idx']));
		}
	}

	public function google_logout() {
		$this->session->unset_userdata(array('google_idx' => '', 'name' => '', 'gmail' => ''));
	}
}

