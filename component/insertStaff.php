<?php
session_start();
include("./db_conn.php");
$addStaffID = $_POST["addStaffID"];
$addPassword = crypt("Aa@12345");
$addName = $_POST["addName"];
$addEmail = $_POST["addEmail"];
$action = $_POST["action"];
$staffID = $_POST["staffID"];
$staffName = $_POST["staffName"];
$unitCode = $_POST["unitCode"];
if ($action == "allocateLecturer") {
    $lecturerStaffQuery = "update assignmentstaff set lecturer=1 where staff_id='$staffID'";
    $mysqli->query($lecturerStaffQuery);
    echo "Allocate '$staffName' to be a lecturer successfully.";
    $mysqli->close();
} else if ($action == "undoLecturer") {
    $unitQuery = "select * from assignmentunit where lecturer_id = '$staffID'";
    $unitResult = $mysqli->query($unitQuery);
    $count = 0;
    while ($unitRow = $unitResult->fetch_array(MYSQLI_ASSOC)) {
        $count++;
    }
    if ($count > 0) {
        $output["res"] = "$staffName is already a lecture's lecturer now, please undo it first";
        $output["check"] = "fail";
        echo json_encode($output);
    } else {

        $lecturerStaffQuery = "update assignmentstaff set lecturer=0 where staff_id='$staffID'";
        $mysqli->query($lecturerStaffQuery);
        $output["res"] = "'$staffName' is not a lecturer anymore.";
        $output["check"] = "success";
        echo json_encode($output);
    }
    $mysqli->close();
} else if ($action == "jsonTutor") {
    $unitQuery = "select * from assignmentunit";
    $unitResult = $mysqli->query($unitQuery);
    $count = 0;
    while ($unitRow = $unitResult->fetch_array(MYSQLI_ASSOC)) {
        $tutorQuery = "select * from assignmentutor where staff_id = '$staffID' and unit_code ='" . $unitRow["unit_code"] . "'";
        $tutorResult = $mysqli->query($tutorQuery);
        $tutorRow = $tutorResult->fetch_array(MYSQLI_ASSOC);
        $jsonTutor["unit_code"][$count] = "<td>" . $unitRow["unit_code"] . "</td>";
        $jsonTutor["unit_name"][$count] = "<td>" . $unitRow["unit_name"] . "</td>";
        if ($tutorRow["staff_id"] == $staffID) {
            $jsonTutor["button"][$count] = "<td><button type='button' class='btn btn-info'  onclick='undoAllocateTutor(this)'>Undo</button></td>";
        } else {
            $jsonTutor["button"][$count] = "<td><button type='button' class='btn btn-info' onclick='allocateTutor(this)'>Allocate</button></td>";
        }
        $count++;
        $jsonTutor["count"] = $count;
    }
    $jsonTutor["staff_id"] = $staffID;
    $jsonTutor["staff_name"] = $staffName;
    echo json_encode($jsonTutor);
    $mysqli->close();
} else if ($action == "allocateTutor") {
    $tutorQuery = "insert into assignmentutor (staff_id, unit_code) values ('$staffID', '$unitCode')";
    $mysqli->query($tutorQuery);
    echo "Allocate '$staffName' to '$unitCode' successfully.";
} else if ($action == "undoAllocateTutor") {
    $timetableQuery = "select * from assignmentimetable where tutor_id = '$staffID' and unit_code= '$unitCode'";
    $timetableResult = $mysqli->query($timetableQuery);
    $count = 0;
    while ($timetableRow = $timetableResult->fetch_array(MYSQLI_ASSOC)) {
        $count++;
    }
    if ($count > 0) {
        $output["res"] = "$staffName is already a tutorial's tutor now, please undo it first";
        $output["check"] = "fail";
        echo json_encode($output);
    } else {
        $tutorQuery = "delete from assignmentutor where staff_id='$staffID' and unit_code= '$unitCode'";
        $mysqli->query($tutorQuery);
        $output["res"] = "Undo allocate '$staffName' to '$unitCode' successfully.";
        $output["check"] = "success";
        echo json_encode($output);
    }
    $mysqli->close();
} else if ($action == "") {
    if ($addStaffID == "" || $addName == "" || $addEmail == "") {
        $mysqli->query($staffQuery);
        echo "Please input staff ID, Name and Email.";
    } else {
        $staffQuery = "INSERT INTO `assignmentstaff`(`staff_id`, `password`, `name`, `email`) VALUES ('$addStaffID', '$addPassword', '$addName', '$addEmail')";
        $mysqli->query($staffQuery);

        echo "Add a new staff successfully, its default password would be Aa@12345";
    }
}
