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
    <title>My Timetable Page</title>
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
            <h2>My Timetable</h2>
            <?php
            $studentID = $_SESSION["user"]["id"];
            $enrolQuery = "select * from assignmentenrolment where student_id = '$studentID'";
            $enrolResult = $mysqli->query($enrolQuery);
            while ($enrolRow = $enrolResult->fetch_array(MYSQLI_ASSOC)) {
                $timetableId = $enrolRow["timetable_id"];
                $timetableQuery = "select * from assignmentimetable where timetable_id = '$timetableId'";
                $timetableResult = $mysqli->query($timetableQuery);
                while ($timetableRow = $timetableResult->fetch_array(MYSQLI_ASSOC)) {
                    $checkTimeArea = (float) date("H.i", strtotime($timetableRow["start_time"]));
                    $col = $timetableRow["start_week"] - 1;
                    if ($checkTimeArea % 1 == 0) {
                        $row = $checkTimeArea * 2 - 18;
                    } else {
                        $row = $checkTimeArea * -17;
                    };

                    $arrayTutorial[$row][$col]["start_time"] = "Tutorial <br/>" .$timetableRow["unit_code"];
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

                    $arrayTutorial[$row][$col]["start_time"] = "Lecturer <br/>" .$uniteRow["unit_code"];
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
        <span class="text-muted">If you want to change tutorial time, you can go to <a href="./tutorialAllocation.php">Tutorial Allocation System</a> to allocate a new tutorial.</span>
    </nav>
    
    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--jquery ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>