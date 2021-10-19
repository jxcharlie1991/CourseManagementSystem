<?php
session_start();
include("./component/db_conn.php");
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>My Account Page </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>


<body>

    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");
    ?>
    <!--Registration form-->
    <div class="container mt-5 mx-auto unavailablePage">
        <div class="col-sm-12 pt-3 ">

            <div class="mx-auto text-center">
                <h2>My Account</h2>
            </div>
            <div class="text-left">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#newPasswordModal">New password</button>
            </div>
            <form role="form" id="editAccountForm">
                <?php
                if ($_SESSION["user"]["level"] == "student") {
                    $studentQuery = "select * from assignmentstudent where student_id = '" . $_SESSION["user"]["id"] . "'";
                    $studentResult = $mysqli->query($studentQuery);
                    $studentRow = $studentResult->fetch_array(MYSQLI_ASSOC);
                ?>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Student ID</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="editStudentID" disabled="disabled" value="<?php echo $_SESSION["user"]["id"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="editName" disabled="disabled" value="<?php echo $_SESSION["user"]["name"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">E-mail address</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="email" id="editStudentEmail" name="editStudentEmail" disabled="disabled" value="<?php echo $studentRow["email"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Address</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="text" id="editStudentAddress" name="editStudentAddress" disabled="disabled" value="<?php echo $studentRow["address"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Date of birth</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="date" id="editStudentBirth" name="editStudentBirth" disabled="disabled" value="<?php echo $studentRow["birth"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Phone number</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="text" id="editStudentPhone" name="editStudentPhone" disabled="disabled" value="<?php echo $studentRow["phone"]; ?>" />
                        </div>
                    </div>

                <?php
                } else {
                    $staffQuery = "select * from assignmentstaff where staff_id = '" . $_SESSION["user"]["id"] . "'";
                    $staffResult = $mysqli->query($staffQuery);
                    $staffRow = $staffResult->fetch_array(MYSQLI_ASSOC);
                ?>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Staff ID</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="editStaffID" disabled="disabled" value="<?php echo $_SESSION["user"]["id"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Name</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" id="editName" disabled="disabled" value="<?php echo $_SESSION["user"]["name"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">E-mail address</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="email" id="editStaffEmail" name="editStaffEmail" disabled="disabled" value="<?php echo $staffRow["email"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Qualification</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="text" id="editStaffQualification" name="editStaffQualification" disabled="disabled" value="<?php echo $staffRow["qualification"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Expertise</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="text" id="editStaffExpertise" name="editStaffExpertise" disabled="disabled" value="<?php echo $staffRow["expertise"]; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Phone number</label>
                        <div class="col-sm-8">
                            <input class="form-control editAccount" type="text" id="editStaffPhone" name="editStaffPhone" disabled="disabled" value="<?php echo $staffRow["phone"]; ?>" />
                        </div>
                    </div>


                <?php
                }
                ?>

                <div class="form-group row pb-3">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-4">
                        <button id="editEdit" type="button">Edit</button>
                    </div>
                    <div class="col-sm-4">
                        <button id="editSave" type="button">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    if ($_SESSION["user"]["level"] == "student") {
    ?>
        <div>

            <div class="container table text-center mb-5">
                <h2>Enrolled Class Timetable</h2>
                <?php
                $studentID = $_SESSION["user"]["id"];
                $enrolQuery = "select * from assignmentenrolment where student_id = '$studentID'";
                $enrolResult = $mysqli->query($enrolQuery);
                while ($enrolRow = $enrolResult->fetch_array(MYSQLI_ASSOC)) {

                    $timetableQuery = "select * from assignmentimetable where unit_code = '" . $enrolRow["unit_code"] . "'";
                    $timetableResult = $mysqli->query($timetableQuery);
                    while ($timetableRow = $timetableResult->fetch_array(MYSQLI_ASSOC)) {
                        $checkTimeArea = (float) date("H.i", strtotime($timetableRow["start_time"]));
                        $col = $timetableRow["start_week"] - 1;
                        if ($checkTimeArea % 1 == 0) {
                            $row = $checkTimeArea * 2 - 18;
                        } else {
                            $row = $checkTimeArea * -17;
                        };

                        $arrayTutorial[$row][$col]["start_time"] = "Tutorial <br/>" . $timetableRow["unit_code"];
                        $arrayTutorial[$row][$col]["duration"] = $timetableRow["duration"] * 2;
                        if ($arrayTutorial[$row][$col]["duration"] > 1) {
                            for ($k = 1; $k < $arrayTutorial[$row][$col]["duration"]; $k++) {
                                $arrayTutorial[$row + $k][$col]["start_time"] = "empty";
                            }
                        }
                    }

                    $unitCode = $enrolRow["unit_code"];
                    $unitQuery = "select * from assignmentunit where unit_code = '$unitCode'";
                    $unitResult = $mysqli->query($unitQuery);
                    while ($uniteRow = $unitResult->fetch_array(MYSQLI_ASSOC)) {
                        $checkTimeArea = (float) date("H.i", strtotime($uniteRow["start_time"]));
                        $col = $uniteRow["start_week"] - 1;
                        if ($checkTimeArea % 1 == 0) {
                            $row = $checkTimeArea * 2 - 18;
                        } else {
                            $row = $checkTimeArea * -17;
                        };

                        $arrayTutorial[$row][$col]["start_time"] = "Lecturer <br/>" . $uniteRow["unit_code"];
                        $arrayTutorial[$row][$col]["duration"] = $uniteRow["duration"] * 2;
                        if ($arrayTutorial[$row][$col]["duration"] > 1) {
                            for ($k = 1; $k < $arrayTutorial[$row][$col]["duration"]; $k++) {
                                $arrayTutorial[$row + $k][$col]["start_time"] = "empty";
                            }
                        }
                    }
                }
                ?>
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Time</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                    </thead>
                    <tbody>

                        <?php


                        for ($i = 0; $i < 16; $i++) {

                        ?>
                            <tr>
                                <th>
                                    <?php
                                    if ($i % 2 == 0) {
                                        echo (9 + $i / 2) . ":00 - " . (9 + $i / 2) . ":30";
                                    } else {
                                        echo (9 + ($i - 1) / 2) . ":30 - " . (10 + ($i - 1) / 2) . ":00";
                                    }
                                    ?>
                                </th>
                                <?php
                                for ($j = 0; $j < 5; $j++) {
                                    if (!isset($arrayTutorial[$i][$j]) || !$arrayTutorial[$i][$j]) {
                                ?>
                                        <td>
                                        </td>
                                    <?php
                                    } else if ($arrayTutorial[$i][$j]["start_time"] == "empty") {
                                    } else {
                                    ?>
                                        <td class="table-bordered" rowspan="<?php echo $arrayTutorial[$i][$j]["duration"] ?>">
                                            <?php echo $arrayTutorial[$i][$j]["start_time"]; ?>
                                        </td>
                                <?php
                                    }
                                }
                                ?>
                            <?php
                        }
                            ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!--footer design-->
        <nav class="navbar fixed-bottom justify-content-center bg-light">
            <span class="text-muted">Remember to press Save, after you edit your information. Please go to <a href="./myTimetable.php">My Timetable</a> to view your lectures and tutorials time.</span>
        </nav>
    <?php
    } else {
    ?>

        <div class="container table text-center unavailablePage">
            <h2>Unavailable Setting</h2>

            <table class="table table-striped mb-5" id="unavailableTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Unavailable Start From</th>
                        <th>Unavailable End To</th>
                        <th>Available</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    $availableQuery = "select * from assignmentavailable where staff_id = '" . $_SESSION["user"]["id"] . "' ";
                    $availableResult = $mysqli->query($availableQuery);
                    $availableRow = $availableResult->fetch_array(MYSQLI_ASSOC);

                    ?>
                    <tr>
                        <td><?php echo $_SESSION["user"]["name"]; ?></td>
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
                        <td><button type="button" class="btn btn-info" id="availableButton">Available</button></td>
                        </td>
                    </tr>
                    <?php

                    $mysqli->close();
                    ?>
                </tbody>
            </table>

        </div>
        </div>
        <!--footer design-->
        <nav class="navbar fixed-bottom justify-content-center bg-light">
            <span class="text-muted">Remember to press Save, after you edit your information. Only DC can the unavailable time.</span>
        </nav>

    <?php
    }
    ?>

    <!-- New Password Modal, use bootstrap-->
    <div class="modal fade" id="newPasswordModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="newPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newPasswordLabel">New Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="formerPassword">Former Password</label>
                            <input type="password" class="form-control" id="formerPassword" aria-describedby="formerPasswordHelp" name="formerPassword" />
                            <small id="idHelp" class="form-text text-muted">Please input your former password.</small>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" aria-describedby="newPasswordHelp" name="newPassword" />
                            <small id="newPasswordHelp" class="form-text text-muted">Please input your new password.</small>
                        </div>
                        <div class="form-group">
                            <label for="confirmNewPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmNewPassword" aria-describedby="newPasswordHelp" name="newPassword" />
                            <small id="confirmNewPasswordHelp" class="form-text text-muted">Please confirm your new password.</small>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" id="updatePassword">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!--jquery ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--tabledit lib-->
    <script src="./js/jquery.tabledit.js"></script>
    <!--my own javascript-->
    <script type="text/javascript" src="./js/myAccountJs.js"></script>
    <!--Script for validating-->
    <script>
        $("#editSave").click(function() {
            var regExpE = /\w+(\.\w+)*@[A-z0-9]+(\.[A-z]){1,2}/;

            if ("<?php echo $_SESSION["user"]["level"]; ?>" == "student") {

                if (regExpE.test($("#editStudentEmail").val()) == false) {
                    alert("Please enter your valid email address.");
                } else {
                    $.ajax({
                        type: "post",
                        url: "./component/editAccount.php",
                        data: $('#editAccountForm').serialize(),
                        done: function(data) {
                            alert(data);
                        }
                    });
                    $(".editAccount").attr("disabled", "disabled");
                    $("#editEdit").text("Edit");
                }
            } else {
                if (regExpE.test($("#editStaffEmail").val()) == false) {
                    alert("Please enter your valid e-mail address.");

                } else if ($("#editStaffQualification").val() == "") {
                    alert("Please enter your qualification.");

                } else if ($("#editStaffExpertise").val() == "") {
                    alert("Please enter your expertise.");

                } else if ($("#editStaffPhone").val() == "") {
                    alert("Please enter your phone number.");

                } else {
                    $.ajax({
                        type: "post",
                        url: "./component/editAccount.php",
                        data: $('#editAccountForm').serialize(),
                        done: function(data) {
                            alert(data);
                        }
                    });
                    $(".editAccount").attr("disabled", "disabled");
                    $("#editEdit").text("Edit");
                }
            }
        });
    </script>
</body>

</html>