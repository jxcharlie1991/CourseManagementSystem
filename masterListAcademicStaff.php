<?php
session_start();
include("./component/db_conn.php");

if (!$_SESSION["user"] || $_SESSION["user"]["id"] == "") {
    echo "<script>alert('Please log in first, thanks');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else if ($_SESSION['user']["level"] != "DC") {
    echo "<script>alert('Only DC has access to this page, but you are a " . $_SESSION['user']["level"] . "');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Master List for Academic Staff</title>


    <!--bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--my own css-->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>


    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");


    ?>
    <div>

        <div class="container table text-center mt-5 mb-5">
            <h2>Academic Staff Details (Without DC)</h2>
            <div class="text-left">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addAcademicStaffModal">Add a New Academic Staff</button>
            </div>
            <table class="table table-striped" id="academicStaffTable">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>Staff Name</th>
                        <th>Staff Email</th>
                        <th>Unavailable Start From</th>
                        <th>Unavailable End To</th>
                        <th>Allocate Lecturer</th>
                        <th>Allocate Tutor</th>
                        <th>Remove Staff</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    $staffQuery = "select * from assignmentstaff where level = '' or level = 'uc' or level = 'lecturer' or level = 'tutor'";
                    $staffResult = $mysqli->query($staffQuery);
                    while ($staffRow = $staffResult->fetch_array(MYSQLI_ASSOC)) {
                        $availableQuery = "select * from assignmentavailable where staff_id = '" . $staffRow["staff_id"] . "'";
                        $availableResult = $mysqli->query($availableQuery);
                        $availableRow = $availableResult->fetch_array(MYSQLI_ASSOC);

                    ?>
                        <tr>
                            <td><?php echo $staffRow["staff_id"]; ?></td>
                            <td><?php echo $staffRow["name"]; ?></td>
                            <td><?php echo $staffRow["email"]; ?></td>

                            <?php
                            if ($availableRow["unavailable_start_date"] == "" || $availableRow["unavailable_start_date"] == "0000-00-00") {
                            ?>
                                <td>Available</td>
                                <td>Available</td>
                            <?php
                            } else {
                            ?>

                                <td><?php echo $availableRow["unavailable_start_date"]; ?></td>
                                <td><?php echo $availableRow["unavailable_end_date"]; ?></td>

                            <?php

                            }
                            ?>
                            <td><button type="button" class="btn btn-info lecturerButton"><?php if ($staffRow["lecturer"] == 0) {
                                                                                                echo "Allocate";
                                                                                            } else {
                                                                                                echo "Undo";
                                                                                            } ?></button></td>
                            <td><button type="button" class="btn btn-warning tutorButton" data-toggle="modal" data-target="#tutorModal">Tutor</button></td>
                            <td><button type="button" class="btn btn-danger removeButton">Remove</button></td>
                        </tr>
                    <?php
                    }
                    $mysqli->close();
                    ?>
                </tbody>
            </table>

        </div>
    </div>
    <!-- Add staff modal window-->
    <div class="modal fade" id="addAcademicStaffModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add a New Academic Staff</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formAddAcademicStaff">
                        <div class="form-group">
                            <label for="addStaffID" class="col-form-label">Staff ID</label>
                            <input type="text" class="form-control" id="addStaffID" name="addStaffID">
                        </div>
                        <div class="form-group">
                            <label for="addName" class="col-form-label">Name</label>
                            <input type="text" class="form-control" id="addName" name="addName"></input>
                        </div>
                        <div class="form-group">
                            <label for="addEmail" class="col-form-label">Email</label>
                            <input type="email" class="form-control" id="addEmail" name="addEmail"></input>
                        </div>

                        <small class="form-text text-muted">New staff's password would be Aa@12345, please let this staff change his password and fill with other information in my account .</small>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addAcademicStaffButton">Save</button>
                </div>

            </div>
        </div>
    </div>




    <!--Allocate tutor Modal -->
    <div class="modal fade" id="tutorModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Allocate <span class="modal-title" id="tutorAllocationName"></span> to a unit</h5>
                    <h5 class="d-none" id="tutorAllocationID"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th>Unit</th>
                                <th>Unit Name</th>
                                <th>Allocate</th>

                            </tr>
                        </thead>
                        <tbody id="tutorTable">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--footer design-->
    <nav class="navbar fixed-bottom justify-content-center bg-light">
        <span class="text-muted"><b>Notice!!! If a tutor or a lecturer has already been allocated to a unit or a tutorial, you cannot undo his allocation here, you need to cancel his tutorial or lecture first in <a href='./unitManagementAllocate.php'>Unit Management Allocating</a>.</b></span>

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