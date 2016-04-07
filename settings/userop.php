<?php

session_start();

require("../dbconn.php");

	$uid = mysql_real_escape_string($_POST['uid']);
	$name = mysql_real_escape_string($_POST['name']);
	$sid = mysql_real_escape_string($_POST['sid']);
	$email = mysql_real_escape_string($_POST['email']);
	$fb_id = mysql_real_escape_string($_POST['fb_id']);
	$fb_token = mysql_real_escape_string($_POST['fb_token']);
	$password_old = md5(mysql_real_escape_string($_POST['password_old']));
	$password = md5(mysql_real_escape_string($_POST['password']));



    $sql = "SELECT * FROM users WHERE uid='$uid'";
    $result = mysql_query($sql);

    while($row = mysql_fetch_array($result)){
        $password_old_db = $row['password'];
    }

if($_GET['action'] == 'update'){
	if($password_old_db == $password_old){
		$sql = "UPDATE `users` SET `sid`='$sid',`name`='$name', `email`='$email' WHERE `uid` = $uid";
		$result = mysql_query($sql);
		if($_POST['password'] != ""){
			$sql = "UPDATE `users` SET `password`='$password' WHERE `uid` = $uid";
			$result = mysql_query($sql);
		}
		header('Location: ../settings/index.php?status=updated');
		exit(1);
	}
	else{
		header('Location: ../settings/index.php?status=incorrect');
		exit(1);
	}
}

else if($_GET['action'] == 'register'){
	$sql = "INSERT INTO `users` (`uid`, `sid`, `name`, `email`, `password`, `auth`, `fb_id`, `fb_token`) VALUES (NULL, '$sid', '$name', '$email', '$password', '100', '$fb_id', '$fb_token')";
	$result = mysql_query($sql);
	header('Location: ../login/index.php?status=regsuc');
	exit(1);
}

?>