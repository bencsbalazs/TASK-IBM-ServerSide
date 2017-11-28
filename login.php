<?php

// Init Facebook app data
$clientid = "540802199590930";
$redirecturi = "https://facebook-connect.eu-gb.mybluemix.net/login.php";
$state = md5(time());
$appsecret = "20e9ddf88a9511a6e69f9241a4d95438";

$code = (isset($_GET['code'])) ? $_GET['code'] : false;
$state = (isset($_GET['state'])) ? $_GET['state'] : false;

// This function handle the server to server requests, thrugh PHP curl.
require_once("servertoserver.php");

// If not logged in to Facebook or app redirect to login window
if (!$code) {
	header("Location: https://www.facebook.com/v2.11/dialog/oauth?client_id=$clientid&redirect_uri=$redirecturi&scope=public_profile,user_posts,email&auth_type=rerequest");
} else {
	
	// If logged in, get the access_token and store it in the session for further use.
	
	$response = get_web_page("https://graph.facebook.com/v2.11/oauth/access_token?client_id=$clientid&redirect_uri=$redirecturi&client_secret=$appsecret&code=$code");
	$resArr = array();
	$resArr = json_decode($response);
	
	session_start();
	$_SESSION['accesstoken'] = $resArr -> access_token;
	setcookie("fblogin", $resArr -> access_token, time() + $resArr -> expires_in);
	header("Location: index.html");
}

?>
