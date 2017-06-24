<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Map extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		if(! $this->session->userdata('google_idx')) {
			header("Location:../login/noteatlas");
			return ;
	}
}
  public function mapoverview() {
    $data["THISURL"] = BASE_URL;

		$this->load->model('post_model');
		$this->load->model('comment_model');
		$this->load->model('user_model');
		$data["outputData"] = $this->post_model->getAllPost();
    foreach($data["outputData"] as $onepost) {
      $comment[$onepost["idx"]] = $this->comment_model->getCommentByPidx($onepost["idx"]);
      if($comment[$onepost["idx"]]){
        foreach($comment[$onepost["idx"]] as &$oneComment) {
          $temp = $this->user_model->getUserByIdx($oneComment["uidx"]);
          $photo = array (
            "photo_url" => $temp[0]["photo_url"]
          );
           $oneComment += $photo; 
        }
      }
    }
    $data["comment"] = $comment;
    $this->load->view('map',$data);
  }

  public function ajaxUpload(){
		$this->load->model('post_model');
		$this->load->model('user_model');
    $output_dir = "/home/student/s403410012/WWW/NoteAtlas/css/uploads/";
		$uidx= $this->user_model->getUidxByGidx($this->session->userdata('google_idx'));
    if(isset($_FILES["myfile"]))
    {
      $ret = array();
      //  This is for custom errors;  
    /*$custom_error= array();
      $custom_error['jquery-upload-file-error']="File already exists";
      echo json_encode($custom_error);
      die();        
     */
      $dataType = explode(".",$_FILES["myfile"]["name"]);
      $_FILES["myfile"]["name"] = uniqid().".".$dataType[1];
      $error = $_FILES["myfile"]["error"];
      //You need to handle  both cases
      //If Any browser does not support serializing of multiple files using FormData() 
      if(!is_array($_FILES["myfile"]["name"])) //single file
      {
        $fileName = $_FILES["myfile"]["name"];
        move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
        $ret[]= $fileName;
      }
      else  //Multiple files, file[]
      {
        $fileCount = count($_FILES["myfile"]["name"]);
        for($i=0; $i < $fileCount; $i++)
        {
          $fileName = $_FILES["myfile"]["name"][$i];
          move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
          $ret[]= $fileName;
        }

      }

      $url = "http://".BASE_URL."css/uploads/".$_FILES["myfile"]["name"];
      $ret["pidx"] = $this->post_model->createPost($uidx, $url);
      $ret["fileName"] = $_FILES["myfile"]["name"];
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($ret);

    }
  }

  public function ajaxImgDelete() {
    $output_dir = "/home/student/s403410012/WWW/NoteAtlas/css/uploads/";
    if(isset($_POST["op"]) && $_POST["op"] == "delete" && isset($_POST['name']))
    {
      $fileName =$_POST['name'];
      $fileName=str_replace("..",".",$fileName); //required. if somebody is trying parent folder files  
      $filePath = $output_dir. $fileName;
      if (file_exists($filePath)) 
      {
        unlink($filePath);
      }
      echo "Deleted File ".$fileName."<br>";
    }
  }

  public function ajaxInputPost() {
		$title = $this->input->post('title');
    $latitude = $this->input->post("lat");
    $longtitude = $this->input->post("lng");
    $comment = $this->input->post("comment");
    $pidx = $this->input->post("idx");

		$this->load->model('post_model');
		$this->post_model->updatePost($pidx, $title, $comment, $longtitude, $latitude);

    $rtn["inputData"] = $this->post_model->getPostByPidx($pidx);
 
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($rtn);

  }

  public function ajaxComment() {
    $pidx = $this->input->post("pidx");
    $comment = $this->input->post("comment");

		$this->load->model('post_model');
		$this->load->model('user_model');
		$this->load->model('comment_model');
	
		$uidx = $this->user_model->getUidxByGidx($this->session->userdata['google_idx']);
		$this->comment_model->addComment($uidx, $pidx, $comment);

		$rtn = $this->user_model->getByGidx($this->session->userdata('google_idx')); 
    header('content-type: application/json; charset=utf-8');
    echo json_encode($rtn);

  }

	public function ajaxGetComment() {

		$pidx = $this->input->post('pidx');
		$this->load->model('comment_model');
		$rtn = $this->comment_model->getCommentByPidx($pidx);
    header('content-type: application/json; charset=utf-8');
    echo json_encode($rtn);
	}
}
