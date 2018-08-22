<?php 

$total_users = $db->count("SELECT `id` FROM `". PH_PRIFIX ."users`");

$total_posts = $db->count("SELECT `id` FROM `". PH_PRIFIX ."posts`");

