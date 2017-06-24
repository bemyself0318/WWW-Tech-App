<?php
date_default_timezone_set('Asia/Taipei');

class Comment_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function addComment($uidx, $pidx, $comment) {
		
		$now = date('Y-m-d H:m:s');
		$data = array(
			'uidx' => $uidx,
			'pidx' => $pidx,
			'comment' => $comment,
			'update_time' => $now
		);

		$this->db->insert('NoteAtlas_comment', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function getCommentByPidx($pidx) {
		
		$this->db->select('*');
		$this->db->from('NoteAtlas_comment');
		$this->db->where('pidx',$pidx);
		$query = $this->db->get('');
		$row = $query->result_array();
		$query->free_result();
		return $row;
	}
}
