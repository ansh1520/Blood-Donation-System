 <?php
    session_start();
    include('connection.php');
    $jsonIndexObj=json_decode($_POST["dataJson"]);
	$role=$jsonIndexObj->role;
    $userID=$_SESSION['userId'];
    $sql1="SELECT bankid from `user` where id = '$userID'";
    $result1=mysql_query($sql1,$conn);
    $returnlist1=mysql_fetch_row($result1);
    if($role=="bank"){
        $sql="  SELECT blood_group.blood_grp, stock
        FROM `blood_stock` 
        INNER JOIN blood_group ON bloodid=blood_group.id
        INNER JOIN bank ON bankid=bank.id
        WHERE bank.id=$returnlist1[0]";
    }elseif ($role=="hospital") {
        $bankId=$jsonIndexObj->bankId;
        $sql="  SELECT blood_group.blood_grp, stock
        FROM `blood_stock` 
        INNER JOIN blood_group ON bloodid=blood_group.id
        INNER JOIN bank ON bankid=bank.id
        WHERE bank.id='$bankId'";
    }

	$result=mysql_query($sql,$conn);
    $bloodStockList["bloodStock"]=array();
    while($returnlist=mysql_fetch_object($result)){
        array_push($bloodStockList["bloodStock"],$returnlist);
    }
    echo json_encode($bloodStockList);
    mysql_close($conn);
    exit;
?>
