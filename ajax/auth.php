<?php
	include '../core/config.php';
	session_start();
	$uname = $_POST["uname"];
	$pass = $_POST["pass"];

	$get_user_data = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM tbl_users WHERE username = '$uname' AND password = '$pass'"));

	if($uname == $get_user_data["username"] && $pass == $get_user_data["password"]){
		$_SESSION["in"] = 1;
		$_SESSION["role"] = $get_user_data["role"];
		$_SESSION["name"] = $get_user_data["name"];
		$_SESSION["uid"] = $get_user_data["user_id"];
		if($get_user_data["role"]=='admin'||$get_user_data["role"]=='AO'||$get_user_data["role"]=='DP'){

			if($get_user_data["role"]=='AO'){
				echo 1;
			}else if ($get_user_data["role"]=='DP'){
				echo 2;
			}

		}else{
			echo 0;
		}
	}else{
		echo 0;
	}

?> 