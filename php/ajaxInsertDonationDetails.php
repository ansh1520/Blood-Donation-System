<?php
    session_start();
    include('connection.php');
    $donationIndexObj=json_decode($_POST["dataJson"]);
    $userId=$donationIndexObj->personid;
    $hospitalId=$donationIndexObj->hospitalid;
    $bankId=$donationIndexObj->bankid;
    //echo(bankId);
    $sql="SELECT id FROM `person` WHERE `userid` = '$userId'  LIMIT 1";
	$result=mysql_query($sql,$conn);
    $returnlist=mysql_fetch_row($result);
    
    if($hospitalId==""){
        $donation_request="INSERT INTO `donation_request` ( `personid`, `hospitalid`, `bankid`, `date_of_donation`, `quantity`, `preliminary_test`, `final_test`) VALUES ($returnlist[0], NULL ,'$bankId', NULL, NULL, 'Pending', 'Pending')";
    }
    if($bankId==""){
        $donation_request="INSERT INTO `donation_request` ( `personid`, `hospitalid`, `bankid`, `date_of_donation`, `quantity`, `preliminary_test`, `final_test`) VALUES ($returnlist[0], '$hospitalId' ,NULL, NULL, NULL, 'Pending', 'Pending')";
    }    
    mysql_query($donation_request);


    $sql1="SELECT id FROM `role` WHERE `rolename` = 'donor'  LIMIT 1";
    $result1=mysql_query($sql1,$conn);
    $returnlist1=mysql_fetch_row($result1);

    $sql2="SELECT `roleid` FROM `rolemapping` WHERE `userid` = '$userId' AND  `roleid`='$returnlist1[0]'  LIMIT 1";
    $result2=mysql_query($sql2,$conn);
    $returnlist2=mysql_fetch_row($result2);

    if(!$returnlist2){
        $role_assign="INSERT INTO `rolemapping` (`userid`,`roleid`)  VALUES  ('$userId',$returnlist1[0] )";
        mysql_query($role_assign);
    }

    echo json_encode($hospitalId);
    mysql_close($conn);
    exit;
?>