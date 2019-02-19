<?php
	session_start();
	include('connection.php');
	$username=$_POST["username"];
	$password= md5($_POST["password"]);
    //$password=$_POST["password"];
    
	$sql=   "select id,username, pwd from user
            where username='$username' and pwd='$password'";
	$result=mysql_query($sql,$conn);
	$rowUser=mysql_fetch_row($result);
    $_SESSION['userId']=$rowUser[0];
    $_SESSION['userName']=$rowUser[1];
    if($rowUser){
        header("location: ../html/dasboard.php");
    }else{
        header("location: ../index.html");
    }
	mysql_close($conn);
?>