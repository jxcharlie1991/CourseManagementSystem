 <?php
 session_start();
include("./db_conn.php");
$editStudentEmail=$_POST["editStudentEmail"];
$editStudentAddress=$_POST["editStudentAddress"];
$editStudentBirth=$_POST["editStudentBirth"];
$editStudentPhone=$_POST["editStudentPhone"];

$editStaffEmail=$_POST["editStaffEmail"];
$editStaffQualification=$_POST["editStaffQualification"];
$editStaffExpertise=$_POST["editStaffExpertise"];
$editStaffPhone=$_POST["editStaffPhone"];
if($_SESSION["user"]["level"]=="student"){
    $updateQuery="update assignmentstudent set email = '$editStudentEmail', address='$editStudentAddress', birth='$editStudentBirth', phone ='$editStudentPhone' where student_id = '".$_SESSION["user"]["id"]."'";
    $mysqli->query($updateQuery);
}else{
    $updateQuery="update assignmentstaff set email = '$editStaffEmail', qualification='$editStaffQualification', expertise='$editStaffExpertise', phone ='$editStaffPhone'  where staff_id = '".$_SESSION["user"]["id"]."'";
    $mysqli->query($updateQuery);
}
$mysqli->close();
//echo "<script>alert(\"Save successfully!\");location.href='../myAccount.php';</script>";
?>