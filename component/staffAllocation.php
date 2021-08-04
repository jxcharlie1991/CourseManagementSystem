<?php
include("./db_conn.php");

$staffID = $_POST["staffID"];
$action=$_POST["action"];
$unavailableCount = 0;
$searchAvailableQuery = "SELECT * FROM assignmentavailable WHERE staff_id = '$staffID'";
$searchAvailableResult = $mysqli->query($searchAvailableQuery);
while ($searchAvailableRow = $searchAvailableResult->fetch_array(MYSQLI_ASSOC)) {
    $unavailableCount++;
}

if ($action == "remove") {
    if ($unavailableCount != 0) {
        $deleteAvailableQuery = "DELETE FROM assignmentavailable WHERE `staff_id`='$staffID'";
        $mysqli->query($deleteAvailableQuery);
    }

    // $searchUnitQuery = "SELECT * FROM assignmentunit WHERE staff_id = '$staffID'";
    // $searchUnitResult = $mysqli->query($searchUnitQuery);
    // while ($searchUnitRow = $searchUnitResult->fetch_array(MYSQLI_ASSOC)) {
        $deleteUnitQuery="UPDATE `assignmentunit` SET `lecturer_id`='', `lecturer`='' WHERE `lecturer_id` = '$staffID'";
        $deleteUnitResult=$mysqli->query($deleteUnitQuery);
    // }

    // $searchTimetableQuery = "SELECT * FROM assignmentimetable WHERE staff_id = '$staffID'";
    // $searchTimetableResult = $mysqli->query($searchTimetableQuery);
    // while ($searchUnitRow = $searchUnitResult->fetch_array(MYSQLI_ASSOC)) {
        $deleteUnitQuery="UPDATE `assignmentimetable` SET `tutor_id`='', `tutor`='' WHERE `tutor_id` = '$staffID'";
        $deleteUnitResult=$mysqli->query($deleteUnitQuery);
    // }

    $deleteStaffQuery = "DELETE FROM assignmentstaff WHERE `staff_id`='$staffID'";
    $mysqli->query($deleteStaffQuery);
}
$mysqli->close();

?>
