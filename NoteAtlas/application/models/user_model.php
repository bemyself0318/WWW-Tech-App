<?php
date_default_timezone_set('Asia/Taipei');

class User_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function insert_user($name, $photo_url, $google_idx, $gmail) {
		$now = date('Y-m-d H:m:s');
		$data = array(
			'name' => $name,
			'photo_url' => $photo_url,
			'google_idx' => $google_idx,
			'gmail' => $gmail,
			'create_time' => $now
		);
		$this->db->insert('NoteAtlas_user',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	function getUserByIdx ($idx) {
		$this->db->select('*');
		$this->db->from('NoteAtlas_user');
		$this->db->where('idx',$idx);
		$query = $this->db->get('');
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
	function getByGidx ($google_idx) {
		$this->db->select('*');
		$this->db->from('NoteAtlas_user');
		$this->db->where('google_idx',$google_idx);
		$query = $this->db->get('');
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
	
	function getUidxByGidx ($google_idx) {

		$this->db->select('idx');
		$this->db->from('NoteAtlas_user');
		$this->db->where('google_idx',$google_idx);
		$query = $this->db->get('');
		$row = $query->result_array();
		$query->free_result();
		return $row[0]['idx'];
	}
}
