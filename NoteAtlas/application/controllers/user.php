<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
  
	
	public function login() {
    $data["THISURL"] = BASE_URL;
		print_r(BASE_URL);exit;
	}
}
