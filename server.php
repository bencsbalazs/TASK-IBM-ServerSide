<?php

require_once("servertoserver.php");

session_start();
$posts = get_web_page("https://graph.facebook.com/me/posts?scope=user_posts&access_token=".$_SESSION['accesstoken']);
echo $posts;

?>
