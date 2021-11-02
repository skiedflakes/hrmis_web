<?php
	include '../core/config.php';
	$employee_id = '2';
	$data = mysqli_query($conn,"SELECT * FROM tbl_leave_transaction_master WHERE employee_id = '$employee_id'");
	$response["data"] = array();
	$total_amount = 0;
	$total_qty = 0;
	while($row = mysqli_fetch_array($data)){
		$list = array();
        $response2["response_details"] = array();
		$list["leave_transaction_master_id"] = 	$row["leave_transaction_master_id"];
		$list["date_filled"] = $row["date_filled"];
		$list["leave_type"] = $row["leave_type"];
        $leave_transaction_master_id =$row["leave_transaction_master_id"];
        $data2 = mysqli_query($conn,"SELECT * FROM tbl_leave_transaction_deatail WHERE leave_transaction_master_id = '$leave_transaction_master_id'");
        while($row2 = mysqli_fetch_array($data2)){
            $list2 = array();
            $list2["id"] = $row2["leave_transaction_deatail_id"];
            $list2["title"] = $row2["date_of_leave"];
            array_push($response2["response_details"], $list2);
        }

        $list["response_details"] = $response2;
        $list["status"] = $row["status"];
		array_push($response["data"], $list);
	}

	echo json_encode($response);
?> 