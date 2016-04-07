<?php

session_start();

require("../../dbconn.php");

	$action = mysql_real_escape_string($_GET['action']);
	$bid = mysql_real_escape_string($_POST['bid']);
	$title = mysql_real_escape_string($_POST['title']);
	$author = mysql_real_escape_string($_POST['author']);
	$price = mysql_real_escape_string($_POST['price']);
	$isbn = mysql_real_escape_string($_POST['isbn']);
	$recieve_available = mysql_real_escape_string($_POST['recieve_available']);
	$recieve_start = mysql_real_escape_string($_POST['recieve_start']);
	$recieve_end = mysql_real_escape_string($_POST['recieve_end']);
	$recieve_place = mysql_real_escape_string($_POST['recieve_place']);
	$recieve_charge = mysql_real_escape_string($_POST['recieve_charge']);

if($action == 'add'){
	$sql = "INSERT INTO `books` (`bid`, `title`, `author`, `price`, `isbn`, `recieve_available`, `recieve_start`, `recieve_end`, `recieve_place`, `recieve_charge`) VALUES (NULL, '$title', '$author', '$price', '$isbn', '$recieve_available', '$recieve_start', '$recieve_end', '$recieve_place', '$recieve_charge')";
	$result = mysql_query($sql);
    header('Location: /booking/admin/books/index.php?status=updated');
	exit(1);
}

else if($action == 'update'){
	$sql = "UPDATE `books` SET `title`='$title',`author`='$author', `price`='$price', `isbn`='$isbn', `recieve_available`='$recieve_available', `recieve_start`='$recieve_start', `recieve_end`='$recieve_end', `recieve_place`='$recieve_place', `recieve_charge`='$recieve_charge' WHERE `bid` = $bid";
	$result = mysql_query($sql);
    header('Location: /booking/admin/books/edit.php?action=update&bid='.$bid.'&status=updated');
	exit(1);
}

else if($_GET['action'] == 'delete'){
	$bid = mysql_real_escape_string($_GET['bid']);
	$sql = "DELETE FROM `books` WHERE `books`.`bid` = $bid";
	$result = mysql_query($sql);
    header('Location: /booking/admin/books/index.php?status=updated');
	exit(1);
}

?>