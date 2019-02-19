<?php
    session_start();
    include('connection.php');
    $hospitalIndexObj=json_decode($_POST["dataJson"]);
	//echo($hospitalIndexObj->hospitals);
    $sql="select * from hospital";
	$result=mysql_query($sql,$conn);
    $hospitalList["hospitals"]=array();
    while($returnlist=mysql_fetch_object($result)){
        array_push($hospitalList["hospitals"],$returnlist);
    }
    echo json_encode($hospitalList);
    mysql_close($conn);
    exit;
?>