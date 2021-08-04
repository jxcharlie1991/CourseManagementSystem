<?php
session_start();
include("./db_conn.php");

$studentID = $_POST["studentID"];
$staffID = $_POST["staffID"];
$password = crypt($_POST["password"]); 
$name = $_POST["name"];
$email = $_POST["email"];
$qualification = $_POST["qualification"];
$expertise = $_POST["expertise"];
$address = $_POST["address"];
$birth = $_POST["birth"];
$phone = $_POST["phone"];



if ($studentID == "") {
    $insert = "INSERT INTO `assignmentstaff`(`staff_id`, `password`, `name`, `email`, `qualification`, `expertise`, `phone`) VALUES ('$staffID', '$password', '$name', '$email', '$qualification', '$expertise', '$phone')";
    $mysqli->query($insert);
    if ($mysqli) {
        echo "<script>alert(\"Congratulations! You just registered a staff account!\");location.href='../index.php';</script>";
    } else {
        echo "<script>alert(\"Sorry, something wrong with the system, please contact us!\");location.href='../index.php';</script>";
    }
} else if ($staffID == "") {
    $insert = "INSERT INTO `assignmentstudent`(`student_id`, `password`, `name`, `email`, `address`, `birth`, `phone`) VALUES ('$studentID', '$password', '$name', '$email', '$address', '$birth', '$phone')";
    $mysqli->query($insert);
    if ($mysqli) {
        echo "<script>alert(\"Congratulations! You just registered a student account!\");location.href='../index.php';</script>";
    } else {
        echo "<script>alert(\"Sorry, something wrong with the system, please contact us!\");location.href='../index.php';</script>";
    }
}
$mysqli->close();
