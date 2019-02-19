<?php
    session_start();
    include('connection.php');
    $bankIndexObj=json_decode($_POST["dataJson"]);	
    //echo($bankIndexObj->banks);
    $sql="call displayBanks()";
	$result=mysql_query($sql,$conn);
    $banklList["banks"]=array();
    while($returnlist=mysql_fetch_object($result)){
        array_push($banklList["banks"],$returnlist);
    }
    echo json_encode($banklList);
    mysql_close($conn);
    exit;
?>