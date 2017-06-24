<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
  
	
	public function noteatlas() {
    $data["THISURL"] = BASE_URL;
		$this->load->view('login',$data);
		if($this->session->userdata('google_idx')) {
			header("Location:../map/mapoverview");
			return ;
		}
	}
	function test() {
		$tmp = $this->session->all_userdata('uid');
		print_r($tmp);exit;
	}
	public function google_login() {
		$this->load->model('user_model');
		$data = $this->input->post();
		//$data = array('name'=>'testbot', 'photo_url'=>'test_url','google_idx'=>'test_gidx','gmail'=>'test_gmail' );
		$this->session->set_userdata($data);
		$user = $this->user_model->getByGidx($data['google_idx']);
		if(!$user) {
				if($uid = $this->user_model->insert_user($data['name'],$data['photo_url'],$data['google_idx'],$data['gmail'])) {
					$this->session->set_userdata(array('uidx' => $uid));
				}
				else {
					//TODO
				}
		}
		else {
			$this->session->set_userdata(array('uidx' => $user['idx']));
		}
	}

	public function google_logout() {
		$this->session->unset_userdata(array('google_idx' => '', 'name' => '', 'gmail' => ''));
	}
}
