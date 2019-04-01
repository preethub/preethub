<?php 
require('admin-core.php');
?>   
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo get_config('site_name'); ?></title>	
			<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:700, 600,500,400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="style/font-awesome/css/font-awesome.css">
		<link rel="stylesheet" href="style/admin.css">	
<?php run_hook('admin_head') ?>
</head>
	<body>
		<div class="header">		 
			<a href="#" class="nav-trigger"><span></span></a>
			<div class="logo">			
				<a href="<?php echo get_config('site_url'); ?>"><span><?php echo get_config('site_name'); ?></span></a>
			</div> 		</div>		
		<div class="side-nav">
			<div class="logo">
				<i class="fa fa-tachometer"></i>
				<span><?php echo get_config('site_name'); ?></span>
			</div>
			<nav>		
			<ul>		
			
	<?php 
run_hook('admin_menu');
	foreach($admin_menu as $menuname => $menud){

if(!empty($admin_submenu[$menuname])){
	?>
  
  <li><i class='fa fa-pie-chart'></i><span><?php echo $menuname ?></span>
  <i class='fa fa-angle-left pull-right'></i>
	<ul class="submenu">
	<li>
	<a href="<?php echo  $menud['url'] ?>">  
	<span><i class="fa <?php echo  $menud['icon'] ?>"></i>	</span>
	<span><?php echo $menuname ?></span></a>
 </li>
<?php 
foreach($admin_submenu[$menuname] as $theme){
?>
<li><a href="<?php echo $theme['url'] ?>">  
	<span><i class="fa <?php echo  $menud['icon'] ?>"></i>	</span>
	<span><?php echo  $theme['name'] ?></span></a>
 </li></ul></li>

<?php } }else{ ?>
	<li><a href="<?php echo $menud['url'] ?>">  <span><i class="fa <?php echo $menud['icon'] ?>"></i>	</span>
	<span><?php echo $menuname ?></span></a>
 </li>
	
<?php	} } ?>		
				</ul>
			</nav>
		</div>
			<div class="main-content">
