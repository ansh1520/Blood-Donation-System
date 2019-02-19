<?php
    session_start();
    include('connection.php');
    $receiveHistoryIndexObj=json_decode($_POST["dataJson"]);
	$role=$receiveHistoryIndexObj->role;
    $type=$receiveHistoryIndexObj->type;
    //$hospitalId=$donationIndexObj->hospitalid;
    //$bankId=$donationHistoryIndexObj->bankid;
    //echo($bankIndexObj->banks);


    $userID=$_SESSION['userId'];
    $sql="SELECT id FROM `person` WHERE `userid` = '$userID'  LIMIT 1";
    $result1=mysql_query($sql,$conn);
    $returnlist=mysql_fetch_row($result1);

    $sql1="SELECT bankid from `user` where id = '$userID'";
    $result2=mysql_query($sql1,$conn);
    $returnlist2=mysql_fetch_row($result2);

    if($role=="recepient"&& $type=="na"){
        $sql="SELECT bank.name, blood_group.blood_grp, `date_of_receive`, `quantity`, `status`
                FROM `receive_request` 
                INNER JOIN person ON personid=person.id
                INNER JOIN bank ON bankid=bank.id
                INNER JOIN blood_group ON bloodid=blood_group.id
                WHERE person.id='$returnlist[0]'";
    }elseif ($role=="bank" && $type=="new") {
        $sql="  SELECT receive_request.id,person.fname, blood_group.blood_grp, `date_of_receive`, `quantity`, `status`
                FROM `receive_request` 
                INNER JOIN person ON personid=person.id
                INNER JOIN bank ON bankid=bank.id
                INNER JOIN blood_group ON bloodid=blood_group.id
                WHERE bank.id='$returnlist2[0]' AND status='pending'";
    }
    elseif ($role=="bank" && $type=="history") {
        $sql="SELECT person.fname, blood_group.blood_grp, `date_of_receive`, `quantity`, `status`
                FROM `receive_request` 
                INNER JOIN person ON personid=person.id
                INNER JOIN bank ON bankid=bank.id
                INNER JOIN blood_group ON bloodid=blood_group.id
                WHERE bank.id='$returnlist2[0]' AND status!='pending'";
    }
    //$sql1="select bankid,date_of_donation,quantity,preliminary_test,final_test from donation_request WHERE personid = '$returnlist[0]'";
	$result=mysql_query($sql,$conn);
    $receiveHistoryList["receivers"]=array();
    while($returnlist=mysql_fetch_object($result)){
        array_push($receiveHistoryList["receivers"],$returnlist);
    }
    echo json_encode($receiveHistoryList);
    mysql_close($conn);
    exit;
?>

