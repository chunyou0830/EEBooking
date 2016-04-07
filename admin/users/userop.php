<?php

session_start();

require("../../dbconn.php");


	$act_uid = $_SESSION['uid'];
	$sql = "SELECT * FROM `users` WHERE `uid`='$act_uid'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$act_auth = $row['auth'];
	}

	$uid = mysql_real_escape_string($_POST['uid']);
	$name = mysql_real_escape_string($_POST['name']);
	$sid = mysql_real_escape_string($_POST['sid']);
	$email = mysql_real_escape_string($_POST['email']);
	$fb_id = mysql_real_escape_string($_POST['fb_id']);
	$auth = mysql_real_escape_string($_POST['auth']);

	if($act_auth >= '200'){
		$sql = "UPDATE `users` SET `sid`='$sid',`name`='$name', `email`='$email', `auth`='$auth', `fb_id`='$fb_id' WHERE `uid` = $uid";
		$result = mysql_query($sql);
		if($_POST['password'] != ""){
			$password = md5(mysql_real_escape_string($_POST['password']));
			$sql = "UPDATE `users` SET `password`='$password' WHERE `uid` = $uid";
			$result = mysql_query($sql);
		}
		header('Location: edit.php?action=update&status=updated&uid='.$uid);
		exit(1);
	}
	else{
		header('Location: edit.php?action=update&status=unauth&uid='.$uid);
		exit(1);
	}

?>