<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {
  
	
	public function mapoverview() {
    $data["THISURL"] = BASE_URL;
		$this->load->view('map',$data);
	}
}
