<?php
session_start();
include("./db_conn.php");

$unitCode = $_POST["addUnitCode"];
$unitName = $_POST["addUnitName"];
$semester = $_POST["addSemester"];
$campus = $_POST["addCampus"];
$description = $_POST["addDescription"];

if ($unitCode != "" && $unitName != "" && $semester != "" && $campus != "" && $description != "") {
    $insertQuery = "INSERT INTO assignmentunit (`unit_code`, `unit_name`, `uc_id`, `unit_coordinator`, `start_week`, `start_time`, `duration`, `semester`, `campus`, `description`) VALUES ('$unitCode', '$unitName', '202002', 'Riseul Ryu', '4', '11:00:00', '2', '$semester', '$campus', '$description')";
    
    
    $insertResult = $mysqli->query($insertQuery);

    echo "Add a new unit success!";
} else {
    echo "Please fill in each textbox!";
}
$mysqli->close();

?>
