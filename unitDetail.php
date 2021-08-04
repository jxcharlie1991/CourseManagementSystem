<?php
session_start();
include("./component/db_conn.php");


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Unit Detail Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>

    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");
    ?>
    <!--Main Detail table-->
    <div>

        <div class="container table text-center mt-5 mb-5">
            <h2>Unit Details</h2>
            <?php
            $unitQuery = "select * from assignmentunit order by id asc";
            $unitResult = $mysqli->query($unitQuery);
            echo '';

            echo '<table class="table table-hover table-striped">
            <thead>
                <th>Unit</th>
                <th>UC</th>
                <th>Lecturer</th>
                <th>Lec. Time</th>
                <th>Duration</th>
                <th>Brief Description of the Unit</th>
                <th>Semester</th>
                <th>Campus</th>
            </thead>
            <tbody>';
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

                echo '<tr>
                <td>' . $unitRow["unit_code"] . '</td>
                <td>' . $unitRow["unit_coordinator"] . '</td>
                <td>' . $unitRow["lecturer"] . '</td>   
                <td>' . $week . "-" . $unitRow["start_time"] . '</td>
                <td>' . $unitRow["duration"] . " hrs" . '</td>        
                <td>' . $unitRow["description"] . '</td>
                <td>' . $unitRow["semester"] . '</td>
                <td>' . $unitRow["campus"] . '</td>
            </tr>';
            }
            echo '</tbody></table>';

            mysqli_free_result($unitResult);
            $mysqli->close();
            ?>

        </div>
    </div>


    <!--footer design-->
    <nav class="navbar fixed-bottom justify-content-center bg-light">
        <span class="text-muted">If you prefer to enrol one of these units, please go to <a href="./unitEnrolment.php">Unit Enrolment</a>.</span>
    </nav>
    
   
    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--jquery ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>