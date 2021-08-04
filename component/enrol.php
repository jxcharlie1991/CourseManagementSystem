<?php
session_start();
include("./db_conn.php");
$studentID = $_SESSION["user"]["id"];
$enrolCode = $_POST["enrolCode"];
$action = $_POST["action"];
if ($action == "insert") {
    $insertQuery = "INSERT INTO `assignmentenrolment` (`student_id`, `unit_code`) VALUES ('$studentID', '$enrolCode')";
    $insertResult = $mysqli->query($insertQuery);
    if ($insertResult != 0) {
        echo "You have success enrolled " . $enrolCode . "!";
    } else {
        echo "Failed, please refresh the website!";
    }
    $mysqli->close();
} else if ($action == "delete") {
    $deleteQuery = "DELETE FROM `assignmentenrolment` WHERE `student_id` = '$studentID' AND `unit_code` ='$enrolCode'";
    $deleteResult = $mysqli->query($deleteQuery);
    if ($deleteResult != 0) {
        echo "You have success unenrolled " . $enrolCode . "!";
    } else {
        echo "Failed, please refresh the website!";        
    }
    $mysqli->close();
}
?>