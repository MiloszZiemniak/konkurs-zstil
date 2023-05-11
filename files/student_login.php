<?php
	include '../database/config.php';
    session_start();
	$student_login = $_POST['login'];
	
	$sql0 = "select rollno from student_login where login = '$student_login'";
	$rollnum = mysqli_query($conn,$sql0);

	$roll_fetch = mysqli_fetch_assoc($rollnum);
	$student_roll_number = $roll_fetch['rollno'];
    $student_password = $_POST['password'];

    $sql1 = "select id from student_data where rollno = '$student_roll_number'";
    $result1 = mysqli_query($conn,$sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $student_id = $row1["id"];
		
		$result = mysqli_query($conn, "Select id, test_id, rollno, score, status from students where rollno = '".$student_id."' and password = '".$student_password."' and status = 0 "); 
		//var_dump($student_id);
		$time =  date("h:i:s");
		$sql = "INSERT INTO time (rollnum,times) VALUES ('$student_roll_number','$time')";
		
		if (mysqli_num_rows($result) > 0){      //Creds arezz
			//echo "<script>console.log('OK');</script>";
			while($row = mysqli_fetch_assoc($result)) 
				$info[] = $row;
				mysqli_query($conn,$sql);
			echo 'CREDS_OK';
		    $_SESSION['student_details'] = json_encode($info); 
			//header("Location: dashboard.php");
		}else{
			//echo "<script>console.log('NOT OK');</script>";
      //echo "<script>console.log('".mysqli_error($conn)."');</script>";
      echo json_encode("STUDENT_RECORD_NOT_FOUND");
		}

	mysqli_close($conn);
?>

