<?php
session_start();
include("./component/db_conn.php");

if (!$_SESSION["user"] || $_SESSION["user"]["id"]==""){
    echo "<script>alert('Please log in first, thanks');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}
else if($_SESSION['user']["level"]!="student"){
    echo "<script>alert('Only student has access to this page, but you are a ".$_SESSION['user']["level"]."');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Tutorial Allocation</title>


    <!--bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--my own css-->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <!--icon for tabledit-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>


    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");


    ?>
    <div>

        <div class="container table text-center mt-5 mb-5">
            <h2>Tutorial Allocation</h2>
            <div class="text-left">

            </div>
            <table class="table table-striped" id="unitTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Unit</th>
                        <th>Lecturer</th>
                        <th>Tutor</th>
                        <th>Tutorial Start Time</th>
                        <th>Duration</th>
                        <th>Capacity</th>
                        <th>Allocate</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $enrolmentQuery = "select * from assignmentenrolment where student_id = '" . $_SESSION["user"]["id"] . "'order by unit_code asc";
                    $enrolmentResult = $mysqli->query($enrolmentQuery);

                    while ($enrolmentRow = $enrolmentResult->fetch_array(MYSQLI_ASSOC)) {
                        
                        $unitQuery = "select lecturer from assignmentunit where unit_code = '" . $enrolmentRow["unit_code"] . "'";
                        $unitResult = $mysqli->query($unitQuery);
                        $unitRow = $unitResult->fetch_array(MYSQLI_ASSOC);


                        $timetableQuery = "select * from assignmentimetable where unit_code = '" . $enrolmentRow["unit_code"] . "'";
                        $timetableResult = $mysqli->query($timetableQuery);

                        while ($timetableRow = $timetableResult->fetch_array(MYSQLI_ASSOC)) {
                            $allocateEnrolmentQuery="select timetable_id from assignmentenrolment where student_id = '".$_SESSION["user"]["id"]."' and unit_code = '".$enrolmentRow["unit_code"]."'";
                            $allocateEnrolmentResult=$mysqli->query($allocateEnrolmentQuery);
                            $allocateEnrolmentRow=$allocateEnrolmentResult->fetch_array(MYSQLI_ASSOC);
                            if ($allocateEnrolmentRow["timetable_id"]==0){
                                $allocate="class='btn btn-primary notAllocate'>Choose";
                            }else if ($timetableRow["timetable_id"]==$allocateEnrolmentRow["timetable_id"]){
                                $allocate="class='btn btn-success successAllocate'>Success";
                            }else{
                                $allocate="class='btn btn-primary notAllocate'>Choose";
                            }
                            $enrolmentCountQuery="select * from assignmentenrolment where timetable_id = '" . $timetableRow["timetable_id"] . "'";
                            $enrolmentCountResult=$mysqli->query($enrolmentCountQuery);
                            $enrolmentCount=0;
                            while($enrolmentCountRow=$enrolmentCountResult->fetch_array(MYSQLI_ASSOC)){
                                $enrolmentCount=$enrolmentCount+1;
                            }
                            switch ($timetableRow["start_week"]) {
                                case 0:
                                    $week = "Not Set";
                                    break;
                                case 1:
                                    $week = "Monday";
                                    break;
                                case 2:
                                    $week = "Tuesday";
                                    break;
                                case 3:
                                    $week = "Wednesday";
                                    break;
                                case 4:
                                    $week = "Thursday";
                                    break;
                                case 5:
                                    $week = "Friday";
                                    break;
                            }
                    ?>
                            <tr>
                                <td><?php echo$timetableRow["timetable_id"]; ?></td>
                                <td><?php echo $enrolmentRow["unit_code"]; ?></td>

                                <td><?php echo $unitRow["lecturer"]; ?></td>


                                <td><?php echo $timetableRow["tutor"]; ?></td>
                                <td><?php echo $week . "-" . $timetableRow["start_time"]; ?></td>
                                <td><?php echo $timetableRow["duration"] . " hrs"; ?></td>
                                <td><?php echo $enrolmentCount."/".$timetableRow["max_student"]?></td>
                                <td><button type="button" <?php echo $allocate; ?></button></td>
                            </tr>
                    <?php
                        }
                   
                    }
                    ?>

                </tbody>
            </table>
            <?php
            //mysqli_free_result($unitResult);
            $mysqli->close();
            ?>
        </div>
    </div>
    <!-- Add modal window-->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add a New Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formAddUnit">
                        <div class="form-group">
                            <label for="addUnitCode" class="col-form-label">Unit Code</label>
                            <input type="text" class="form-control" id="addUnitCode" name="addUnitCode">
                        </div>
                        <div class="form-group">
                            <label for="addUnitName" class="col-form-label">Unit Name</label>
                            <input type="text" class="form-control" id="addUnitName" name="addUnitName"></input>
                        </div>
                        <div class="form-group">
                            <label for="addSemester" class="col-form-label">Semester</label>
                            <input type="text" class="form-control" id="addSemester" name="addSemester"></input>
                        </div>
                        <div class="form-group">
                            <label for="addCampus" class="col-form-label">Campus</label>
                            <input type="text" class="form-control" id="addCampus" name="addCampus"></input>
                        </div>
                        <div class="form-group">
                            <label for="addDescription" class="col-form-label">Description</label>
                            <textarea class="form-control" id="addDescription" name="addDescription"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addUnitButton">Save</button>
                </div>

            </div>
        </div>
    </div>

   <!--footer design-->
   <nav class="navbar fixed-bottom justify-content-center bg-light">
        <span class="text-muted">You can go to <a href="./myAccount.php">My Account</a> to view all tutorials in a timetable. After allocated, please go to <a href="./myTimetable.php">My Timetable</a> to view your lecturers and tutorials time.</span>
    </nav>
    
    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--jquery ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!--my own javascript-->
    <script type="text/javascript" src="./js/js.js"></script>
   
</body>

</html>