<?php 

$total_users = $db->count("SELECT `id` FROM `". PH_PREFIX ."users`");

$total_posts = $db->count("SELECT `id` FROM `". PH_PREFIX ."posts`");

$total_comments = $db->count("SELECT `comment_id` FROM `". PH_PREFIX ."comments`");

