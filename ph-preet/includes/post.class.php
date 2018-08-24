<?php


Class Post{
	
	
	
	function getpost($url){
		
		global $db;
		
		if(!empty($url)){
			
			$postid = $url;
		}else{
			
			header('location: index.php');
		}
		
		$query = "SELECT * FROM ". PH_PREFIX ."posts Where id='$postid'";
		
		$posts = $db->select($query);
		
		
		return $posts;
		
			}
	
	
	
	
	




}
