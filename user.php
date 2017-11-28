<?php
require_once("servertoserver.php");
session_start();
$posts = get_web_page("https://graph.facebook.com/me?fields=name,picture&access_token=".$_SESSION['accesstoken']);
echo $posts;
?>
