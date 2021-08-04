<?php
session_start();
include("./component/db_conn.php");

if (!$_SESSION["user"] || $_SESSION["user"]["id"] == "") {
    echo "<script>alert('Please log in first, thanks');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else if ($_SESSION['user']["level"] != "DC" && $_SESSION['user']["level"] != "UC") {
    echo "<script>alert('Only DC and UC have access to this page, but you are a " . $_SESSION['user']["level"] . "');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Unit Management Allocate Staff</title>


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

        <div class="container table text-center mt-5">
            <h2>Tutorial Allocation</h2>
            <?php
            $unitQuery = "select * from assignmentunit order by id asc";
            $unitResult = $mysqli->query($unitQuery);
            ?>

            <table class="table table-hover table-striped">
                <thead>
                    <th>Unit</th>
                    <th>UC</th>
                    <th class="d-none">Lecturer ID</th>
                    <th>Lecturer</th>
                    <th>Lec. Time</th>
                    <th>Duration</th>
                    <th>Allocate</th>
                    <th colspan="2">Edit/Add/Remove</th>
                    <th></th>

                </thead>
                <tbody id="allocatingTable">
                    <?php
                    while ($unitRow = $unitResult->fetch_array(MYSQLI_ASSOC)) {
                        switch ($unitRow["start_week"]) {
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
                            <td><?php echo $unitRow["unit_code"] ?></td>
                            <td><?php echo $unitRow["unit_coordinator"] ?></td>
                            <td class="d-none"><?php echo $unitRow["lecturer_id"] ?></td>
                            <td><?php echo $unitRow["lecturer"] ?></td>
                            <td><?php echo $week . "-" . $unitRow["start_time"] ?></td>
                            <td><?php echo $unitRow["duration"] . " hrs" ?></td>
                            <td><button type="button" class="btn btn-primary lecturer" data-toggle="modal" data-target="#allocateLecturerModal">Lecturer</button></td>
                            <td><button type="button" class="btn btn-warning tutorial" data-toggle="modal" data-target="#allocateTutorialModal">Tutorials</button></td>
                            <td><button type="button" class="btn btn-info consultation" data-toggle="modal" data-target="#allocateConsultationModal">Consultations</button></td>
                        </tr>
                    <?php
                    }
                    echo '</tbody></table>';

                    mysqli_free_result($unitResult);
                    $mysqli->close();
                    ?>

        </div>
    </div>


    <!--Allocate lecturer Modal -->
    <div class="modal fade" id="allocateLecturerModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lecturerAllocationTitle">Allocate a Lecturer for&nbsp;</h5>
                    <h5 class="modal-title" id="lecturerAllocateUnitCode"></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick='$("#unitID").removeAttr("id")'>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>StaffID</th>
                                <th>Name</th>
                                <th>Allocate</th>
                            </tr>
                        </thead>
                        <tbody id="lecturerAllocation">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick='$("#unitID").removeAttr("id")'>Close</button>

                </div>
            </div>
        </div>
    </div>


    <!--Allocate tutorial Modal -->
    <div class="modal fade" id="allocateTutorialModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tutorialAllocationTitle">Allocate Tutorials for&nbsp;</h5>
                    <h5 class="modal-title" id="allocateTutorial"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body text-center">
                    <div class="text-left">
                        <button type="button" class="btn btn-secondary" id="addNewTutorial">Add a New Tutorial</button>
                    </div>
                    <table class="table table-striped tutorialTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Unit</th>
                                <th class="d-none">Tutor ID</th>
                                <th>Tutor</th>
                                <th>Tutorial Day</th>
                                <th>Tutorial Time</th>
                                <th>Duration</th>
                                <th>Location</th>
                                <th>Allocate</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="tutorialAllocationList">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>

                </div>
            </div>
        </div>
    </div>

    <!--Allocate consultation Modal -->
    <div class="modal fade" id="allocateConsultationModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="consultationAllocationTitle">Allocate Consultations for&nbsp;</h5>
                    <h5 class="modal-title" id="allocateConsultation"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <div class="modal-body text-center">
                    <div class="text-left">
                        <button type="button" class="btn btn-secondary" id="addNewConsultation">Add a New Tutorial</button>
                    </div>
                    <table class="table table-striped consultationTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Unit</th>
                                <th>Consultation Day</th>
                                <th>Consultation Time</th>
                                <th>Duration</th>
                                <th>Location</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="consultationAllocationList">
                        
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>

                </div>
            </div>
        </div>
    </div>

    <!--Allocate tutorial tutor Modal -->
    <div class="modal fade" id="allocateTutorialTutorModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tutorialTutorAllocationTitle">Allocate a Tutor for&nbsp;</h5>
                    <h5 class="modal-title" id="tutorialTutorAllocateUnitCode"></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>StaffID</th>
                                <th>Name</th>
                                <th>Allocate</th>
                            </tr>
                        </thead>
                        <tbody id="tutorialTutorAllocationList">

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
        <span class="text-muted"><b>Notice!!! Only lecturer and UC can be allocated to lecture, and tutor can only be allocated to corresponding tutorial.</b></span>
        
    </nav>

    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--jquery ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--my own javascript-->
    <script type="text/javascript" src="./js/unitManagementAllocateJs.js"></script>
    

</body>

</html>