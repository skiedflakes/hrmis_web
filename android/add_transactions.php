<?php
	include '../core/config.php';
	$empid = $_REQUEST["empid"];
	$leavetype = $_REQUEST["leavetype"];
    $date_applied = $_REQUEST["date_applied"];
	$get_user_data = mysqli_query($conn,"INSERT INTO `tbl_leave_transaction_master` (`leave_transaction_master_id`, `employee_id`, `date_filled`, `leave_type`, `status`) VALUES (NULL, '$empid', ' $date_applied', '$leavetype','P')");
    $response_array['response'] = array();
	if($get_user_data){


        $response["status"] =1;
        $response["id"] = mysqli_insert_id($conn);
        array_push($response_array['response'], $response);
	}else{
        $response["status"] =0;
        array_push($response_array['response'], $response);
	}

    echo json_encode($response_array);
?> 