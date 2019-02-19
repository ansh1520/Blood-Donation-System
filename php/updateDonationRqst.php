<?php
	session_start();
    include('connection.php');
    $updateDonationRqst=json_decode($_POST["dataJson"]);
	$mode=$updateDonationRqst->mode;
    $id=$updateDonationRqst->id;
    if($mode=="pTest"){ 
        $status=$updateDonationRqst->status;
        $updatequery="UPDATE `donation_request` SET `preliminary_test` = '$status' WHERE `donation_request`.`id` = '$id'";
        mysql_query($updatequery,$conn);
    }
    if($mode=="fTest"){ 
        $status=$updateDonationRqst->status;
        $updatequery="UPDATE `donation_request` SET `final_test` = '$status' WHERE `donation_request`.`id` = '$id'";
        mysql_query($updatequery,$conn);
    }
    if($mode=="donation"){ 
        $date=$updateDonationRqst->date;
        $qty=$updateDonationRqst->qty;
        $updatequery="  UPDATE `donation_request` 
                        SET `date_of_donation` = '$date', `quantity` = '$qty', `donated`='YES'
                        WHERE `donation_request`.`id` = '$id'";
        mysql_query($updatequery,$conn);

        $sql1=" SELECT bankid, person.bloodgrpid FROM `donation_request`
                JOIN person ON person.id = donation_request.personid
                WHERE donation_request.id = '$id'";
        $result1=mysql_query($sql1,$conn);
        $returnlist1=mysql_fetch_row($result1);

        $updateStockquery=" UPDATE `blood_stock` 
                            SET `stock` = `stock`+ '$qty'
                            WHERE `blood_stock`.`bankid` = '$returnlist1[0]' AND `blood_stock`.`bloodid` = '$returnlist1[1]'";
        mysql_query($updateStockquery,$conn);

    }
    
    

    echo json_encode($returnlist1[1]);
    mysql_close($conn);
    exit;
?>