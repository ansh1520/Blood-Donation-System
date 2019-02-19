<?php
	session_start();
    include('connection.php');
    $updateReceiveRqst=json_decode($_POST["dataJson"]);
	$status=$updateReceiveRqst->status;
    $id=$updateReceiveRqst->id;
    $date=$updateReceiveRqst->date;
    $qty=$updateReceiveRqst->qty;
    if($status=="Accepted"){    
        $updatequery="  UPDATE `receive_request` 
                        SET `status` = '$status',
                            `received` = 'YES',
                            `quantity` = '$qty',
                            `date_of_receive` = '$date'
                        WHERE `receive_request`.`id` = '$id'";
        mysql_query($updatequery,$conn);

        /*$sql1=" SELECT bankid, bloodid FROM `receive_request`
                WHERE receive_request.id = '$id'";
        $result1=mysql_query($sql1,$conn);
        $returnlist1=mysql_fetch_row($result1);

        $updateStockquery=" UPDATE `blood_stock` 
                            SET `stock` = `stock` - '$qty'
                            WHERE   `blood_stock`.`bankid` = '$returnlist1[0]' AND 
                                    `blood_stock`.`bloodid` = '$returnlist1[1]'";
        mysql_query($updateStockquery,$conn);*/
    }
    if($status=="Rejected"){    
        $updatequery="  UPDATE `receive_request` 
                        SET `status` = '$status',
                            `received` = 'NO',
                            `quantity` = '$qty',
                            `date_of_receive` = '$date'
                        WHERE `receive_request`.`id` = '$id'";
        mysql_query($updatequery,$conn);
    }   

    echo json_encode("success");
    mysql_close($conn);
    exit;
?>