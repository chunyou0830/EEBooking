<?php

session_start();

require("../dbconn.php");

	$uid = mysql_real_escape_string($_GET['uid']);
	$name = mysql_real_escape_string($_GET['name']);
	$sid = mysql_real_escape_string($_GET['sid']);
	$email = mysql_real_escape_string($_GET['email']);
	$fb_id = mysql_real_escape_string($_GET['fb_id']);
	$fb_token = mysql_real_escape_string($_GET['fb_token']);
	$password = md5(mysql_real_escape_string($_GET['password']));

if($_GET['action'] == 'update'){
	$sql = "UPDATE `users` SET `sid`='$sid',`name`='$name', `email`='$email', `password`='$password' WHERE `uid` = $uid";
	$result = mysql_query($sql);
	header('Location: ../login/index.php?status=updated');
	exit(1);
}

else if($_GET['action'] == 'add'){
	$sql = " INSERT INTO 'users' ('uid', 'sid', 'name', 'email', 'password', 'auth', 'fb_id', 'fb_token') VALUES (NULL, '$sid', '$name', '$email', '$password', 'student', NULL, NULL)";
	$result = mysql_query($sql);
	echo "as";
	exit(1);
}

?>