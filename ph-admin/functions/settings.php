<?php

if(isset($_POST['settings'])){
	
	$siteurl = $db->escape($_POST['siteurl']);
	
	$sitename = $db->escape($_POST['sitename']);
	
	$sitedesc = $db->escape($_POST['sitedesc']);
	
	$postsperpage = $db->escape($_POST['postsperpage']);
	
	$sql1 = "UPDATE ". PH_PREFIX ."config SET value='$siteurl' Where name='site_url'";
	
		$sql2 = "UPDATE ". PH_PREFIX ."config SET value='$sitename' Where name='site_name'";
		
		$sql3 = "UPDATE ". PH_PREFIX ."config SET value='$sitedesc' Where name='site_description'";	
	
			$sql4 = "UPDATE ". PH_PREFIX ."config SET value='$postsperpage' Where name='posts_per_page'";	
	
	
	if($db->query($sql1) && $db->query($sql2) && $db->query($sql3) && $db->query($sql4) === TRUE){
		
		$echo = "Successfully settings updated";
		
	}else{
		
		$echo = "Unable to Update data";
	}
	
}
