<?php



$site_url1 = $db->get_row("SELECT * FROM `". PH_PRIFIX ."config` Where name='site_url'");

$site_url = $site_url1->value;

$site_name1 = $db->get_row("SELECT * FROM `". PH_PRIFIX ."config` Where name='site_name'");

$site_name = $site_name1->value;

$site_desc1 = $db->get_row("SELECT * FROM `". PH_PRIFIX ."config` Where id='3'");

$site_desc = $site_desc1->value;

$postsperpage1 = $db->get_row("SELECT * FROM `". PH_PRIFIX ."config` Where id='5'");

$posts_per_page = $postsperpage1->value;
