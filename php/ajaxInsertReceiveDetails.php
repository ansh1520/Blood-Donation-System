<?php
    session_start();
    include('connection.php');
    $jsonIndexObj=json_decode($_POST["dataJson"]);
    $userId=$jsonIndexObj->personid;     
    $bankId=$jsonIndexObj->bankid;
    $bloodId=$jsonIndexObj->bloodGroupId;
    $qty=$jsonIndexObj->qty;
    //echo(bankId);
    $sql="SELECT id FROM `person` WHERE `userid` = '$userId'  LIMIT 1";
	$result=mysql_query($sql,$conn);
    $returnlist=mysql_fetch_row($result);        
    $receive_request="INSERT INTO receive_request (personid, bankid, bloodid, quantity) VALUES($returnlist[0], '$bankId', '$bloodId', '$qty')";
    mysql_query($receive_request);


    $sql1="SELECT id FROM `role` WHERE `rolename` = 'recepient'  LIMIT 1";
    $result1=mysql_query($sql1,$conn);
    $returnlist1=mysql_fetch_row($result1);

    $sql2="SELECT `roleid` FROM `rolemapping` WHERE `userid` = '$userId' AND  `roleid`='$returnlist1[0]' LIMIT 1";
    $result2=mysql_query($sql2,$conn);
    $returnlist2=mysql_fetch_row($result2);

    if(!$returnlist2){
        $role_assign="INSERT INTO `rolemapping` (`userid`,`roleid`)  VALUES  ('$userId',$returnlist1[0] )";
        mysql_query($role_assign);
    }


    echo json_encode($returnlist2[0]);
    mysql_close($conn);
    exit;
?>