<?php

session_start();

require("../dbconn.php");

if($_GET['action'] == 'login'){
	$email = mysql_real_escape_string($_POST['email']);
	$password = md5(mysql_real_escape_string($_POST['password']));

	$sql = "SELECT * FROM `users` WHERE `email`='$email'";
	$result = mysql_query($sql);

	if(mysql_num_rows($result)==0){
		header('Location: ../login/index.php?status=notfound');
		exit(1);
	}
	else{
		while($row = mysql_fetch_array($result)){
			if($row['password'] == $password){
				$_SESSION['login'] = true;
				$_SESSION['uid'] = $row['uid'];
				if($row['auth'] <= '50'){
					header('Location: ../seller/index.php');
				}
				else{
					header('Location: ../dashboard/index.php');
				}
				exit(1);
			}
			else{
				header('Location: ../login/index.php?status=incorrect');
				exit(1);
			}
		}
	}
}

else if($_GET['action'] == 'logout'){
	unset($_SESSION['login']);
	unset($_SESSION['uid']);
	header('Location: ../login/index.php?status=logout');
	exit;
}

else if($_GET['action'] == 'fb'){
	$fb_id = mysql_real_escape_string($_GET['fb_id']);
	$fb_token = mysql_real_escape_string($_GET['fb_token']);
	$email = mysql_real_escape_string($_GET['email']);

	$sql = "SELECT * FROM `users` WHERE `fb_id`='$fb_id'";
	$result = mysql_query($sql);

	$sql2 = "SELECT * FROM `users` WHERE `email`='$email'";
	$result2 = mysql_query($sql2);

	if(mysql_num_rows($result)==0 && mysql_num_rows($result2)==0){
		header('Location: ../login/register.php?fb_id='.$fb_id.'&fb_token='.$fb_token.'&email='.$email);
		exit(1);
	}
	else if(mysql_num_rows($result)==0 && mysql_num_rows($result2)!=0){
		while($row = mysql_fetch_array($result2)){
			if($email == $row['email']){
				$sql = "UPDATE `users` SET `fb_id`='$fb_id',`fb_token`='$fb_token' WHERE `email` = '$email'";
				echo $sql;
				$result = mysql_query($sql);
				$_SESSION['login'] = true;
				$_SESSION['uid'] = $row['uid'];
				header('Location: ../dashboard/index.php');
				exit(1);
			}
		}
	}
	else{
		while($row = mysql_fetch_array($result)){
			if($fb_id == $row['fb_id']){
				$_SESSION['login'] = true;
				$_SESSION['uid'] = $row['uid'];
				header('Location: ../dashboard/index.php');
				exit(1);
			}
		}
	}
}
?>