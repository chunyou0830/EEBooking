<?php

session_start();

require("../dbconn.php");

	$action = mysql_real_escape_string($_GET['action']);

if($action == 'order'){
	$bid = mysql_real_escape_string($_GET['bid']);
	$sid = mysql_real_escape_string($_GET['sid']);
	$sql = "INSERT INTO `order_10402` (`oid`, `sid`, `bid`, `status`) VALUES (NULL, '$sid', '$bid', 'ordered')";
	$result = mysql_query($sql);
	$sql = "SELECT * FROM `order_10402` WHERE `sid`='$sid' AND `bid`='$bid'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)!=0){
		echo "Ord_Success";
		exit(1);
	}
}

else if($action == 'delete'){
	$bid = mysql_real_escape_string($_GET['bid']);
	$sid = mysql_real_escape_string($_GET['sid']);
	$sql = "DELETE FROM `order_10402` WHERE  `sid`='$sid' AND `bid`='$bid'";
	$result = mysql_query($sql);
	$sql = "SELECT * FROM `order_10402` WHERE `sid`='$sid' AND `bid`='$bid'";
	$result = mysql_query($sql);
	if(mysql_num_rows($result)==0){
		echo "Del_Success";
		exit(1);
	}
}

else if($action == 'ordered' || $action == 'arrived' || $action == 'recieved' ){
	$oid = mysql_real_escape_string($_GET['oid']);
	$sql = "UPDATE `order_10402` SET `status` = '$action' WHERE `oid` = $oid";
	$result = mysql_query($sql);
	exit(1);
}

?>