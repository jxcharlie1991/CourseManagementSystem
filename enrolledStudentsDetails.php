<?php
session_start();
include("./component/db_conn.php");
if (!$_SESSION["user"] || $_SESSION["user"]["id"]==""){
    echo "<script>alert('Please log in first, thanks');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}
else if($_SESSION['user']["level"]!="DC" && $_SESSION['user']["level"] !="UC" && $_SESSION['user']["level"] !="Lecturer"&& $_SESSION['user']["level"] !="Tutor"){
    echo "<script>alert('Only DC, UC, lecturer, and tutor have access to this page, but you are a ".$_SESSION['user']["level"]."');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Enrolled Students Details Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>


    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");


    ?>
    <div>

        <div class="container table text-center mt-5 mb-5">
            <h2>Enrolled Students Details</h2>
            <div class="text-left">

            </div>
            <table class="table table-striped" id="unitTable">
                <thead>
                    <tr>
                        <th>Class ID</th>
                        <th>Unit</th>
                        <th>Tutor</th>
                        <th>Tutorial Start Time</th>
                        <th>Duration</th>
                        <th>Capacity</th>
                        <th>Enrolled Students</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $timetableQuery = "select * from assignmentimetable order by unit_code, timetable_id asc";
                    $timetableResult = $mysqli->query($timetableQuery);
                    while ($timetableRow = $timetableResult->fetch_array(MYSQLI_ASSOC)) {
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
                        $enrolQuery = "select * from assignmentenrolment where timetable_id = '" . $timetableRow["timetable_id"] . "'";
                        $enrolResult = $mysqli->query($enrolQuery);
                        while ($enrolRow = $enrolResult->fetch_array(MYSQLI_ASSOC)) {
                            $studentQuery = "select * from assignmentstudent where student_id ='" . $enrolRow["student_id"] . "'";
                            $studentResult = $mysqli->query($studentQuery);
                            $studentRow = $studentResult->fetch_array(MYSQLI_ASSOC);
                    ?>
                            <tr>
                                <td><?php echo $timetableRow["timetable_id"]; ?></td>
                                <td><?php echo $timetableRow["unit_code"]; ?></td>
                                <td><?php echo $timetableRow["tutor"]; ?></td>
                                <td><?php echo $week . "-" . $timetableRow["start_time"]; ?></td>
                                <td><?php echo $timetableRow["duration"] . " hrs"; ?></td>
                                <td><?php echo $timetableRow["max_student"] ?></td>
                                <td>ID: <?php echo $enrolRow["student_id"] . " Name: " . $studentRow["name"] ?></td>

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
        <span class="text-muted">If there is any mistakes in the table, please contact DC to fix it.</span>
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