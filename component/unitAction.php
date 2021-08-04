<?php
include("./db_conn.php");


$unit_code=$_POST["unit_code"];
$unit_name=$_POST["unit_name"];
$semester=$_POST["semester"];
$campus=$_POST["campus"];
$description=$_POST["description"];
if($_POST["action"]=='edit'){
 
   $editQuery="UPDATE `assignmentunit` SET `unit_name`='$unit_name',`semester`='$semester',`campus`='$campus',`description`='$description' WHERE `unit_code`='$unit_code'"; 
    $mysqli->query($editQuery);  
}
else if($_POST["action"]=="delete"){
    $deleteQuery="DELETE FROM assignmentunit where unit_code = '".$unit_code."'";
    $mysqli->query($deleteQuery);
}
$mysqli->close();

echo json_encode($_POST);
?>