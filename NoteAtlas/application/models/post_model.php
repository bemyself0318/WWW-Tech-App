<?php
date_default_timezone_set('Asia/Taipei');

class Post_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	public function createPost($uidx, $url) {
		
		$now = date('Y-m-d H:m:s');
		$data = array(
			'author_idx' => $uidx,
			'photo_url' => $url,
			'create_time' => $now
		);
		
		$this->db->insert('NoteAtlas_post', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function updatePost($idx, $title, $comment, $longtitude, $latitude) {
		
		$now = date('Y-m-d H:m:s');
		$data = array(
			'title' => $title,
			'comment' => $comment,
			'longtitude' => $longtitude,
			'latitude' => $latitude,
			'update_time' => $now
		);
		$this->db->where('idx',$idx);
		$this->db->update('NoteAtlas_post', $data);
	}

	public function getPostByPidx($pidx) {
		
		$this->db->select('*');
		$this->db->from('NoteAtlas_post');
		$this->db->where('idx',$pidx);
		$query = $this->db->get('');
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}

	public function getAllPost() {

		$this->db->select('*');
		$this->db->from('NoteAtlas_post');
		$query = $this->db->get('');
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
}
