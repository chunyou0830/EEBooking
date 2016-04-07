<?php

$db_host = "localhost";
$db_user = "eclab";
$db_pass = "eecs808";
$db_name = "eclab";

if(! (@$link=mysql_connect($db_host, $db_user, $db_pass))){
	printf("error connecting");
	exit();
}
mysql_select_db($db_name);
mysql_query("SET NAMES 'utf8'");