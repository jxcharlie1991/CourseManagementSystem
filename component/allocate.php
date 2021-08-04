<?php
session_start();
include("./db_conn.php");
$choose_id=$_POST["choose_id"];
$action=$_POST["action"];
$choose_unit=$_POST["choose_unit"];

if ($action=="allocate"){
    $searchTimetableQuery="select * from assignmentimetable where timetable_id = '$choose_id'";
    $searchTimetableResult=$mysqli->query($searchTimetableQuery);
    $searchTimetableRow = $searchTimetableResult->fetch_array(MYSQLI_ASSOC);
    $count=0;
    $searchEnrolmentQuery="select * from assignmentenrolment where timetable_id = '$choose_id'";
    $searchEnrolmentResult=$mysqli->query($searchEnrolmentQuery);
    while($searchEnrolmentRow=$searchEnrolmentResult->fetch_array(MYSQLI_ASSOC)){
        $count++;
    }
    if ($count>=$searchTimetableRow["max_student"]){
        echo "Sorry this class is full, please try another.";
    }else{

    $enrolmentQuery="UPDATE `assignmentenrolment` SET `timetable_id` = '".$choose_id."' WHERE `unit_code` = '".$choose_unit."' AND `student_id` = '".$_SESSION["user"]["id"]."';";
    $enrolmentResult=$mysqli->query($enrolmentQuery);

    echo "Congratulations, you allocated to a tutorial successfully!";
    }

}else if ($action=="undo"){
    $enrolmentQuery="UPDATE `assignmentenrolment` SET `timetable_id` = '0' WHERE `unit_code` = '".$choose_unit."' AND `student_id` = '".$_SESSION["user"]["id"]."';";
    $enrolmentResult=$mysqli->query($enrolmentQuery);

    echo "You unallocated this tutorial now!";
}

?>