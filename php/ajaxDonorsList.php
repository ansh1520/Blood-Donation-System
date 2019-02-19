<?php
	session_start();
    include('connection.php');
    $donationHistoryIndexObj=json_decode($_POST["dataJson"]);
	$bloodGrpId=$donationHistoryIndexObj->bloodGrpId;
    


    $userID=$_SESSION['userId'];
    $sql1="SELECT bankid from `user` where id = '$userID'";
    $result1=mysql_query($sql1,$conn);
    $returnlist1=mysql_fetch_row($result1);

    $sql="  SELECT DISTINCT(person.id),person.fname, person.mname, person.lname, person.address, person.email, person.phone
			FROM `donation_request` 
 			INNER JOIN person ON personid=person.id
			WHERE bankid = $returnlist1[0] AND person.bloodgrpid='$bloodGrpId'";
	$result=mysql_query($sql,$conn);
    $donorsList["donorsList"]=array();
    while($returnlist=mysql_fetch_object($result)){
        array_push($donorsList["donorsList"],$returnlist);
    }
    echo json_encode($donorsList);
    mysql_close($conn);
    exit;
?>