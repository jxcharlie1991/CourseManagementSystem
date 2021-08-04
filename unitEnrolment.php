<?php
session_start();
include("./component/db_conn.php");

if (!$_SESSION["user"] || $_SESSION["user"]["id"] == "") {
    echo "<script>alert('Please log in first, thanks');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else if ($_SESSION['user']["level"] != "student") {
    echo "<script>alert('Only student has access to this page, but you are a " . $_SESSION['user']["level"] . "');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Unit Enrolment Page</title>

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
            <h2>Unit Enrolment</h2>
            <?php
            $query = "select * from assignmentunit order by id asc";
            $result = $mysqli->query($query);


            echo '<table class="table table-hover table-striped">
    <thead>
        <th>Unit</th>
        <th>UC</th>
        <th>Lecturer</th>
        <th>Brief description of the unit</th>
        <th>Semester</th>
        <th>Campus</th>
        <th>Status</th>
    </thead>
    <tbody>';
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $unitCode = $row["unit_code"];

                $enrolQuery = "select * from assignmentenrolment where unit_code like '$unitCode'";

                $enrolResult = $mysqli->query($enrolQuery);
                $status = "Unenrolled";
                while ($enrolRow = $enrolResult->fetch_array(MYSQLI_ASSOC)) {

                    if ($enrolRow["student_id"] == $_SESSION["user"]["id"]) {
                        $status = "Enrolled";

                        break;
                    }
                }

                mysqli_free_result($enrolResult);
                if ($status=="Unenrolled"){
                echo '<tr>
        <td>' . $row["unit_code"] . '</td>
        <td>' . $row["unit_coordinator"] . '</td>
        <td>' . $row["lecturer"] . '</td>  
        <td>' . $row["description"] . '</td>
        <td>' . $row["semester"] . '</td>
        <td>' . $row["campus"] . '</td>
        <td><button type="button" class="enrol btn btn-primary">' . $status . '</button></td>
        
    </tr>';}else {
        echo '<tr>
        <td>' . $row["unit_code"] . '</td>
        <td>' . $row["unit_coordinator"] . '</td>
        <td>' . $row["lecturer"] . '</td>  
        <td>' . $row["description"] . '</td>
        <td>' . $row["semester"] . '</td>
        <td>' . $row["campus"] . '</td>
        <td><button type="button" class="enrol btn btn-success">' . $status . '</button></td>
        
    </tr>';
    }
            }
            echo '</tbody></table>';

            mysqli_free_result($result);
            $mysqli->close();
            ?>

        </div>
    </div>



    <!--footer design-->
    <nav class="navbar fixed-bottom justify-content-center bg-light">
        <span class="text-muted">After enrolled, please go to <a href="./myTimetable.php">My Timetable</a> to view your lecturer time, or go to <a href="./tutorialAllocation.php">Tutorial Allocation System</a> to allocate tutorials.</span>
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