<?php

class comment{
	
  public $postid = '';
	
  public $massages = array();
	
  public $db = '';
  
 function __construct($id,$conn){
 
 $this->postid = $id;
 
 $this->db = $conn;

 }	
  	
	function have_comments(){
							
		if($this->db->count("SELECT `comment_id` FROM `". PH_PREFIX ."comments` Where comment_post_id='$this->postid'") > 0){
	return TRUE;
	return FALSE;
		}	
		
	}
		
	function getcomments(){
					
	$query = "SELECT * FROM ". PH_PREFIX ."comments Where comment_post_id='$this->postid'";
	
if($this->have_comments()){	
	
 $comments = $this->db->select($query);
		
	return $comments;					
		}
	}
	
	function add_comment($userid){
				
	global $site_url;
				if(isset($_POST['addcomment'])){
			
$comment = $this->db->escape($_POST['comment']);
			
      if(empty($comment)){
				
				$this->massages = "Empty comment";						
				
	}elseif($this->db->query("INSERT INTO `". PH_PREFIX ."comments`(comment_user_id, comment_post_id, comment_content) VALUES ('$userid', '$this->postid', '$comment')") === TRUE){ 
			
	$this->massages = "Comment Added";
		
 $link = "$site_url/post/$this->postid";	
 
 header("location: $link");	
 
			}else{
				
$this->massages = "ERROR: Could not able to execute $query. ". mysqli_error($db->link);			
				
}
																							
}
					
}
	
}
