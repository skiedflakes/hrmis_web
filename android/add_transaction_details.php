<?php
	include '../core/config.php';
	$transaction_id = $_REQUEST["transaction_id"];
	$date = $_REQUEST["date"];

	$get_user_data = mysqli_query($conn,"INSERT INTO `tbl_leave_transaction_deatail` (`leave_transaction_deatail_id`, `leave_transaction_master_id`, `date_of_leave`, `status`) VALUES (NULL, '$transaction_id', '$date', '1')");
    $response_array['response'] = array();
	if($get_user_data){


        $response["status"] =1;
        array_push($response_array['response'], $response);
	}else{
        $response["status"] =0;
        array_push($response_array['response'], $response);
	}

    echo json_encode($response_array);
?> 