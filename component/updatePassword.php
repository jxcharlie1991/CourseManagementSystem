<?php
session_start();
include("./db_conn.php");

$formerPassword = $_POST["formerPassword"];
$newPassword = $_POST["newPassword"];
$confirmNewPassword = $_POST["confirmNewPassword"];


if ($_SESSION["user"]["level"] == "student") {
    $studentQuery = "select * from assignmentstudent where student_id = '" . $_SESSION["user"]["id"] . "'";
    $studentResult = $mysqli->query($studentQuery);
    $studentRow = $studentResult->fetch_array(MYSQLI_ASSOC);
    if (!hash_equals($studentRow["password"],crypt($formerPassword,$studentRow["password"]))) {

        echo "Please check your former password.";
    } else if ($newPassword != $confirmNewPassword) {

        echo "Confirm password is not the same as new password.";
    } else {
        $cryptPassword=crypt($newPassword);
        $studentQuery = "update assignmentstudent set password = '$cryptPassword' where student_id = '" . $_SESSION["user"]["id"] . "'";
        $mysqli->query($studentQuery);
        echo "Update your password successfully!";
    }
} else {
    $staffQuery = "select * from assignmentstaff where staff_id = '" . $_SESSION["user"]["id"] . "'";
    $staffResult = $mysqli->query($staffQuery);
    $staffRow = $staffResult->fetch_array(MYSQLI_ASSOC);
    if (!hash_equals($staffRow["password"],crypt($formerPassword,$staffRow["password"]))) {

        echo "Please check your former password.";
    } else if ($newPassword != $confirmNewPassword) {

        echo "Confirm password is not the same as new password.";
    } else {
        $cryptPassword=crypt($newPassword);
        $staffQuery = "update assignmentstaff set password = '$cryptPassword' where staff_id = '" . $_SESSION["user"]["id"] . "'";
        $mysqli->query($staffQuery);
        echo "Update your password successfully!";
    }
}
$mysqli->close();
?>