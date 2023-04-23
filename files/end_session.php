<?php
    session_start();
    include '../database/config.php';
    $temp = $_SESSION['student_details'];
    $student_data = json_decode($temp);

    foreach($student_data as $obj){
        $student_id = $obj->id;
        $student_roll_number = $obj->rollno;
		$timee =  date("h:i:s");
        $roll = mysqli_query($conn, "SELECT rollno from student_data where id = '$student_id'");
        $rollfetch = mysqli_fetch_assoc($roll);
        $rollnum = $rollfetch["rollno"];
        $sql1 = "UPDATE students set status = 1 where id = '$student_id'; UPDATE time set timee = '$timee' where rollnum = '$rollnum'";
        $conn->multi_query($sql1);
    }

    if($_POST['message'] == 1)
        echo "Przerwano!";
    else
        echo "Test zakończony!";   

    session_destroy();   
?>