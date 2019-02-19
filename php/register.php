<?php
	session_start();
	include('connection.php');
    $username=$_POST["usernameRegstr"];
	$password= md5($_POST["passwordRestr"]);
	$firstname=$_POST["firstName"];
    $middlename=$_POST["middleName"];
    $lastname=$_POST["lastName"];


    
	$bloodGroup=$_POST["bloodGroup"];
    $address=$_POST["address"];
    $email=$_POST["email"];
    $phoneNo=$_POST["phoneNumber"];
    
    $sql="insert into user(username,pwd) values('$username','$password')";
    //echo($sql);
    mysql_query($sql);
    $sql1="SELECT  id FROM user WHERE username = '$username' LIMIT 1";
    $resultUser=mysql_query($sql1);
    $rowUser = mysql_fetch_row($resultUser);
    
    $sql2="SELECT  id FROM blood_group WHERE blood_grp = '$bloodGroup' LIMIT 1";
    $resultBlood=mysql_query($sql2);
    $rowBloodGrp = mysql_fetch_row($resultBlood);
    //echo($row[0]);
    $person_sql=   "insert into person(userid,bloodgrpid,fname,mname,lname,address,email,phone)
                    values($rowUser[0],$rowBloodGrp[0],'$firstname','$middlename','$lastname','$address','$email','$phoneNo')";
    mysql_query($person_sql);
    header("location: ../html/registerSuccess.html");
    
    mysql_close($conn);
?>