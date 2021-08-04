<?php
session_start();
include("./db_conn.php");

$staffID = $_SESSION["user"]["id"];
$unavailableStart = $_POST["unavailable_start_date"];
$unavailableEnd = $_POST["unavailable_end_date"];
$unavailableCount = 0;
$searchAvailableQuery = "SELECT * FROM assignmentavailable WHERE staff_id = '$staffID'";
$searchAvailableResult = $mysqli->query($searchAvailableQuery);
while ($searchAvailableRow = $searchAvailableResult->fetch_array(MYSQLI_ASSOC)) {
    $unavailableCount++;
}
if ($_POST["action"] == 'edit') {

    if ($unavailableCount == 0) {

        $insertAvailableQuery = "INSERT INTO `assignmentavailable` (`staff_id`, `unavailable_start_date`, `unavailable_end_date`) VALUES ('$staffID', '$unavailableStart', '$unavailableEnd')";
        $mysqli->query($insertAvailableQuery);
        
    } else {
        $editAvailableQuery = "UPDATE `assignmentavailable` SET `unavailable_start_date`='$unavailableStart',`unavailable_end_date`='$unavailableEnd' WHERE `staff_id`='$staffID'";
        $mysqli->query($editAvailableQuery);
       
    }
    echo "success";
} else if ($_POST["action"] == 'available'){
    $deleteAvailableQuery = "DELETE FROM assignmentavailable WHERE `staff_id`='$staffID'";
    $mysqli->query($deleteAvailableQuery);
}
$mysqli->close();

?>
