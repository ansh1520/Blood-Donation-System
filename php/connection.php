<?php
	$mysql_hostname="localhost";
	$mysql_user="root";
	$mysql_password="";
	$mysql_db="bloodbank";
	$conn=mysql_connect($mysql_hostname,$mysql_user,$mysql_password) or die("Cannot able to connect database");
	mysql_select_db($mysql_db,$conn) or die("Cannot able to select database");
?>