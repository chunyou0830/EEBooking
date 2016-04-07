<?php

session_start();

require("../../dbconn.php");
require("../../settings.php");

	if($auth < '255'){
    	header('Location: /booking/admin/system/index.php?status=unauth');
		exit(1);
	}


	$value_order = mysql_real_escape_string($_POST['order']);
	$value_system = mysql_real_escape_string($_POST['system']);
	$sql = "UPDATE `setting` SET `value`='$value_order' WHERE `name` = 'order'";
	$result = mysql_query($sql);
	$sql = "UPDATE `setting` SET `value`='$value_system' WHERE `name` = 'system'";
	$result = mysql_query($sql);
    header('Location: /booking/admin/system/index.php?status=updated');
	exit(1);

?>