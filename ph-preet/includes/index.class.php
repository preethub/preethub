<?php



Class index{
		
	function getposts($pages,$limit){
		
		global $db;
		
		if(isset($pages)){ $page = $pages;}else{$page = 1; }
		
$start_from = ($page - 1) * $limit;
		
		$query1 = "SELECT * FROM ". PH_PREFIX ."posts LIMIT $start_from, $limit";
		
		if($db->count($query1) > 0){
	
		$posts = $db->select($query1);
		
		return $posts;
		}
		
	}
	
}
