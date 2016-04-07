<?php

session_start();

require("../../dbconn.php");

	$action = mysql_real_escape_string($_GET['action']);
	$cid = mysql_real_escape_string($_POST['cid']);
	$title = mysql_real_escape_string($_POST['title']);
	$teacher = mysql_real_escape_string($_POST['teacher']);
	$cnum = mysql_real_escape_string($_POST['cnum']);
	$book = mysql_real_escape_string($_POST['isbn']);

if($action == 'add'){
	$sql = "INSERT INTO `classes` (`cid`, `title`, `teacher`, `cnum`, `book`) VALUES (NULL, '$title', '$teacher', '$cnum', '$book')";
	$result = mysql_query($sql);
	header('Location: /booking/admin/classes/index.php?status=updated');
	exit(1);
}

else if($action == 'update'){
	$sql = "UPDATE `classes` SET `title`='$title',`teacher`='$teacher' WHERE `cnum` = '$cnum'";
	$result = mysql_query($sql);
	header('Location: /booking/admin/classes/edit.php?action=update&cnum='.$cnum.'&status=updated');
	exit(1);
}

else if($_GET['action'] == 'delete'){
	$cnum = mysql_real_escape_string($_GET['cnum']);
	$sql = "DELETE FROM `classes` WHERE `classes`.`cnum` = '$cnum'";
	$result = mysql_query($sql);
	header('Location: /booking/admin/classes/index.php?status=updated');
	exit(1);
}

else if($_GET['action'] == 'add_book'){
	$cnum = mysql_real_escape_string($_GET['cnum']);
	$book = mysql_real_escape_string($_GET['isbn']);
	$sql = "SELECT DISTINCT `title`, `teacher` FROM `classes` WHERE `cnum`='$cnum'";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$title = $row['title'];
		$teacher = $row['teacher'];
	}
	$sql = "INSERT INTO `classes` (`cid`, `title`, `teacher`, `cnum`, `book`) VALUES (NULL, '$title', '$teacher', '$cnum', '$book')";
	//echo $sql;
	$result = mysql_query($sql);
	header('Location: /booking/admin/classes/index.php?status=updated');
	exit(1);
}

else if($_GET['action'] == 'delete_book'){
	$cnum = mysql_real_escape_string($_GET['cnum']);
	$isbn = mysql_real_escape_string($_GET['isbn']);
	$sql = "DELETE FROM `classes` WHERE `cnum` = '$cnum' AND `book` = '$isbn'";
	echo $sql;
	$result = mysql_query($sql);
	//header('Location: /booking/admin/classes/edit.php?action=update&cnum='.$cnum.'&status=updated');
	exit(1);
}

?>