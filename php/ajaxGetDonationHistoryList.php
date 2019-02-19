
<?php
    session_start();
    include('connection.php');
    $donationHistoryIndexObj=json_decode($_POST["dataJson"]);
	$role=$donationHistoryIndexObj->role;
    $type=$donationHistoryIndexObj->type;
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

    if($role=="donor"&& $type=="na"){
        $sql="SELECT bank.name, preliminary_test, final_test, quantity, date_of_donation FROM `donation_request` INNER JOIN bank ON bankid=bank.id WHERE personid='$returnlist[0]'";
    }elseif ($role=="bank" && $type=="new") {
        $sql="SELECT donation_request.id, person.fname, person.address, preliminary_test, final_test, quantity, date_of_donation FROM `donation_request` 
              INNER JOIN bank ON bankid=bank.id
              INNER JOIN person ON personid=person.id
              WHERE donated='NO' AND bank.id=$returnlist2[0]";
    }
    elseif ($role=="bank" && $type=="history") {
        $sql="SELECT person.fname, person.address, preliminary_test, final_test, quantity, date_of_donation FROM `donation_request` 
              INNER JOIN bank ON bankid=bank.id
              INNER JOIN person ON personid=person.id
              WHERE donated='YES' AND bank.id=$returnlist2[0]";
    }
    //$sql1="select bankid,date_of_donation,quantity,preliminary_test,final_test from donation_request WHERE personid = '$returnlist[0]'";
	$result=mysql_query($sql,$conn);
    $donationHistoryList["donors"]=array();
    while($returnlist=mysql_fetch_object($result)){
        array_push($donationHistoryList["donors"],$returnlist);
    }
    echo json_encode($donationHistoryList);
    mysql_close($conn);
    exit;
?>

