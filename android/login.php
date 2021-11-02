<?php
	include '../core/config.php';
	$uname = $_REQUEST["username"];
	$pass = $_REQUEST["password"];

	$get_user_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_users WHERE username = '$uname' AND password = '$pass'"));
    $response_array['response'] = array();
	if($uname == $get_user_data["username"] && $pass == $get_user_data["password"]){
	
		if($get_user_data["role"]=='admin'||$get_user_data["role"]=='AO'||$get_user_data["role"]=='DP'){

			if($get_user_data["role"]=='AO'){
                $response["status"] =1;
                $response["user_id"] =$get_user_data["user_id"];
                $response['employee_id'] = $get_user_data["employee_id"];
                $response["firstname"] = $get_user_data["firstname"];
                $response["middlename"] =$get_user_data["middlename"];
                $response["lastname"] =$get_user_data["lastname"];
                $response["role"] = $get_user_data["role"];
                array_push($response_array['response'], $response);
			}else if ($get_user_data["role"]=='DP'){
                $response["status"] =1;
                $response["user_id"] =$get_user_data["user_id"];
                $response['employee_id'] = $get_user_data["employee_id"];
                $response["firstname"] = $get_user_data["firstname"];
                $response["middlename"] =$get_user_data["middlename"];
                $response["lastname"] =$get_user_data["lastname"];
                $response["role"] = $get_user_data["role"];
                array_push($response_array['response'], $response);
			}

		}else{
            $response["status"] =0;
            array_push($response_array['response'], $response);
		}
	}else{
        $response["status"] =0;
        array_push($response_array['response'], $response);
	}

    echo json_encode($response_array);
?> 