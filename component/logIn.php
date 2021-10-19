<?php
session_start();

include("./db_conn.php");
$id = $_POST["id"];
$password = $_POST["password"];
$queryCheckStudent = "SELECT * FROM assignmentstudent WHERE student_id='$id'";
$queryCheckStaff = "SELECT * FROM assignmentstaff WHERE staff_id='$id'";
$rowStudent = ($mysqli->query($queryCheckStudent))->fetch_array(MYSQLI_ASSOC);
$rowStaff = ($mysqli->query($queryCheckStaff))->fetch_array(MYSQLI_ASSOC);

if ((($rowStudent["student_id"] != $id) && ($rowStaff["staff_id"] != $id)) || $id == "") {
    $mysqli->close();
    echo "<script>alert('Please check your student ID or Staff ID!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else if($rowStudent["student_id"]==$id){
    if (hash_equals($rowStudent['password'],crypt($password,$rowStudent['password']))) {
        $_SESSION["user"]["name"] = $rowStudent["name"];
        $_SESSION["user"]["level"] = "student";
        $_SESSION["user"]["id"]=$rowStudent["student_id"];
    
        $mysqli->close();
        echo "<script>alert(\"Hi, student " . $_SESSION["user"]["name"] . "!\");location.href='../index.php';</script>";
    } else {
        $mysqli->close();
        echo "<script>alert('Please check your password!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
    }
   
}else if($rowStaff["staff_id"]==$id){

    if (hash_equals($rowStaff['password'],crypt($password,$rowStaff['password']))) {
        $_SESSION["user"]["name"] = $rowStaff["name"];
        $_SESSION["user"]["id"]=$rowStaff["staff_id"];
        $searchQuery="select * from assignmentutor where staff_id ='".$rowStaff["staff_id"]."'";
        $searchResult=$mysqli->query($searchQuery);
        $count=0;
        while($searchRow=$searchResult->fetch_array(MYSQLI_ASSOC)){
            $count++;
        }
        if ($rowStaff["level"] == "" && $count==0 && $rowStaff["lecturer"]==0 ) {
            $_SESSION["user"]["level"] = "staff";
            $mysqli->close();
            echo "<script>alert(\"Hi, " . $_SESSION["user"]["level"] . " " . $_SESSION["user"]["name"] . "!\");location.href='../index.php';</script>";
        } else if($rowStaff["level"] == "" && $rowStaff["lecturer"]==1) {
            $_SESSION["user"]["level"] = "lecturer";
            $mysqli->close();
            echo "<script>alert(\"Hi, " . $_SESSION["user"]["level"] . " " . $_SESSION["user"]["name"] . "!\");location.href='../index.php';</script>";
        }else if($rowStaff["level"] == "" && $rowStaff["lecturer"]==0 && $count>0) {
            $_SESSION["user"]["level"] = "tutor";
            $mysqli->close();
            echo "<script>alert(\"Hi, " . $_SESSION["user"]["level"] . " " . $_SESSION["user"]["name"] . "!\");location.href='../index.php';</script>";
        }else if($rowStaff["level"] != "" ) {
            $_SESSION["user"]["level"] = $rowStaff["level"];
            $mysqli->close();
            echo "<script>alert(\"Hi, " . $_SESSION["user"]["level"] . " " . $_SESSION["user"]["name"] . "!\");location.href='../index.php';</script>";
        }
    }else{
        $mysqli->close();
        echo "<script>alert('Please check your password!');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
    }

}
?>
