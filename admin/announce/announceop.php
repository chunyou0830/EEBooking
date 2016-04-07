<?php

session_start();

require("../../dbconn.php");

	$action = mysql_real_escape_string($_GET['action']);
	$aid = mysql_real_escape_string($_POST['aid']);
	$content = mysql_real_escape_string($_POST['content']);
	$link = mysql_real_escape_string($_POST['link']);
	$color = mysql_real_escape_string($_POST['color']);
	$start_date = mysql_real_escape_string($_POST['recieve_start']);
	$end_date = mysql_real_escape_string($_POST['recieve_end']);

if($action == 'add'){
	$sql = "INSERT INTO `announce` (`aid`, `content`, `link`, `color`, `start_date`, `end_date`) VALUES (NULL, '$content', '$link', '$color', '$start_date', '$end_date')";
	$result = mysql_query($sql);
    header('Location: /booking/admin/announce/index.php?status=updated');
	exit(1);
}

else if($_GET['action'] == 'update'){
	$sql = "UPDATE `announce` SET `content`='$content',`link`='$link', `color`='$color', `start_date`='$start_date', `end_date`='$end_date' WHERE `aid` = $aid";
	$result = mysql_query($sql);
    header('Location: /booking/admin/announce/edit.php?action=update&aid='.$aid.'&status=updated');
	exit(1);
}

else if($_GET['action'] == 'delete'){
	$aid = mysql_real_escape_string($_GET['aid']);
	$sql = "DELETE FROM `announce` WHERE `announce`.`aid` = $aid";
	$result = mysql_query($sql);
    header('Location: /booking/admin/announce/index.php?status=updated');
	exit(1);
}

?>