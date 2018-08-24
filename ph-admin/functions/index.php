<?php 

$total_users = $db->count("SELECT `id` FROM `". PH_PREFIX ."users`");

$total_posts = $db->count("SELECT `id` FROM `". PH_PREFIX ."posts`");

