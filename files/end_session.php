<?php
    session_start();
    include '../database/config.php';
    $temp = $_SESSION['student_details'];
    $student_data = json_decode($temp);

    foreach($student_data as $obj){
        $student_id = $obj->id;
        $student_roll_number = $obj->rollno;
		$timee =  date("h:i:s");
        $sql1 = "UPDATE students set status = 1 where id = '$student_id'; UPDATE time set timee = '$timee' where rollnum = '$student_roll_number'";
        $conn->multi_query($sql1);
    }

    if($_POST['message'] == 1)
        echo "Przerwano!";
    else
        echo "Test zakończony!";   

    session_destroy();   
?>