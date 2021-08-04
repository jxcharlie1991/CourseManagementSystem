<?php
include("./db_conn.php");

$staffID = $_POST["availableStaffID"];

$deleteAvailableQuery = "DELETE FROM assignmentavailable WHERE `staff_id`='$staffID'";
$mysqli->query($deleteAvailableQuery);
?>