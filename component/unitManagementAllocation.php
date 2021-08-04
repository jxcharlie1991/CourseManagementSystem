<?php
// include("./db_conn.php");

// $unitCode = $_POST["unitCode"];
// $staffID = $_POST["staffID"];

// $action = $_POST["action"];
// $consultationID = $_POST["consultationID"];
// $timetableID = $_POST["timetableID"];
// $startWeek = $_POST["startWeek"];
// $startTime = $_POST["startTime"];
// $duration = $_POST["duration"];
// $maxStudent = $_POST["maxStudent"];


// if ($action == "lecturer") {


//     echo $unitCode;
// } else if ($action == "allocateLecturer") {
//     $staffQuery = "select * from assignmentstaff where staff_id = '$staffID'";
//     $staffResult = $mysqli->query($staffQuery);
//     $staffRow = $staffResult->fetch_array(MYSQLI_ASSOC);
//     $unitQuery = "update assignmentunit set lecturer_id ='$staffID', lecturer = '" . $staffRow["name"] . "' where unit_code ='$unitCode'";
//     $mysqli->query($unitQuery);
// } else if ($action == "deleteLecturer") {
//     $unitQuery = "update assignmentunit set lecturer_id ='', lecturer = '' where unit_code ='$unitCode'";
//     $mysqli->query($unitQuery);
//     echo "Successfully unallocated the lecturer of the unit.";
// } else if ($action == "tutorial") {

//     $timetableQuery = "select * from assignmentimetable where unit_code ='$unitCode'";
//     $timetableResult = $mysqli->query($timetableQuery);
//     $tutorial = "";
//     while ($timetableRow = $timetableResult->fetch_array(MYSQLI_ASSOC)) {
//         switch ($timetableRow["start_week"]) {
//             case 0:
//                 $week = "Not Set";
//                 break;
//             case 1:
//                 $week = "Monday";
//                 break;
//             case 2:
//                 $week = "Tuesday";
//                 break;
//             case 3:
//                 $week = "Wednesday";
//                 break;
//             case 4:
//                 $week = "Thursday";
//                 break;
//             case 5:
//                 $week = "Friday";
//                 break;
//         }

//         $tutorial = $tutorial . "<tr><td>" . $timetableRow["timetable_id"] . "</td><td>" . $timetableRow["unit_code"] . "</td><td class='d-none'>" . $timetableRow["tutor_id"] . "</td><td>" . $timetableRow["tutor"]
//             . "</td><td><input class='editContent' type='text' disabled='disabled' value='" . $week . "' /></td><td><input class='editContent' type='time' disabled='disabled' value='" . $timetableRow["start_time"]
//             . "' /></td><td><input class='editContent' type='text' disabled='disabled' value='" . $timetableRow["duration"] . "' /></td><td><input class='editContent' type='text' disabled='disabled' value='" . $timetableRow["max_student"]
//             . "' /></td><td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#allocateTutorialTutorModal' onclick='tutorialTutorAllocate(this)'>Tutor</button></td><td><button type='button' class='btn btn-warning' onclick='editRow(this)'>Edit</button></td><td><button type='button' class='btn btn-danger' onclick='deleteRow(this)'>Delete</button></td></tr>";
//     }
//     echo json_encode(array($tutorial, $unitCode));
// } else if ($action == "editRow") {
//     switch (strtolower($startWeek)) {
//         case "monday":
//             $week = 1;
//             break;
//         case "tuesday":
//             $week = 2;
//             break;
//         case "wednesday":
//             $week = 3;
//             break;
//         case "thursday":
//             $week = 4;
//             break;
//         case "friday":
//             $week = 5;
//             break;
//         default:
//             $week = 0;
//             break;
//     }
//     if (date('i', strtotime($startTime)) != 0 && date('i', strtotime($startTime)) != 30) {
//         echo "Tutorial time must start on the hour or halfhour. i.e. a tutorial can start at 9:00, 9:30, 10:00, 10:30, or so on.";
//     } else if ($week == 0) {
//         echo "Unidentified Tutorial Day.";
//     } else {
//         $insertTimetableQuery = "UPDATE `assignmentimetable` SET `start_week`='$week',`start_time`='$startTime',`duration`='$duration',`max_student`='$maxStudent' WHERE `timetable_id`='$timetableID'";
//         $insertTimetableResult = $mysqli->query($insertTimetableQuery);
//         echo "Success";
//     }
// } else if ($action == "deleteRow") {
//     $deleteTimetableQuery = "DELETE FROM `assignmentimetable` WHERE `timetable_id` = '$timetableID'";
//     $deleteTimetableResult = $mysqli->query($deleteTimetableQuery);
// } else if ($action == "addRow") {
//     $addTimetableQuery = "INSERT INTO `assignmentimetable`(`timetable_id`, `unit_code`) VALUES ('$timetableID', '$unitCode')";
//     $addTimetableResult = $mysqli->query($addTimetableQuery);

//     echo $mysqli->insert_id;
// } else if ($action == "consultation") {



//     $consultationQuery = "select * from assignmentconsultation where unit_code ='$unitCode'";
//     $consultationResult = $mysqli->query($consultationQuery);
//     $consultation = "";
//     while ($consultationRow = $consultationResult->fetch_array(MYSQLI_ASSOC)) {
//         switch ($consultationRow["start_week"]) {
//             case 0:
//                 $week = "Not Set";
//                 break;
//             case 1:
//                 $week = "Monday";
//                 break;
//             case 2:
//                 $week = "Tuesday";
//                 break;
//             case 3:
//                 $week = "Wednesday";
//                 break;
//             case 4:
//                 $week = "Thursday";
//                 break;
//             case 5:
//                 $week = "Friday";
//                 break;
//         }

//         $consultation = $consultation . "<tr><td>" . $consultationRow["consultation_id"] . "</td><td>" . $consultationRow["unit_code"] . "</td><td><input class='editContent' type='text' disabled='disabled' value='" . $week . "' /></td><td><input class='editContent' type='time' disabled='disabled' value='" . $consultationRow["start_time"]
//             . "' /></td><td><input class='editContent' type='text' disabled='disabled' value='" . $consultationRow["duration"]
//             . "' /></td><td><button type='button' class='btn btn-warning' onclick='editConsultationRow(this)'>Edit</button></td><td><button type='button' class='btn btn-danger' onclick='deleteConsultationRow(this)'>Delete</button></td></tr>";
//     }
//     echo json_encode(array($consultation, $unitCode));
// } else if ($action == "editConsultationRow") {
//     switch (strtolower($startWeek)) {
//         case "monday":
//             $week = 1;
//             break;
//         case "tuesday":
//             $week = 2;
//             break;
//         case "wednesday":
//             $week = 3;
//             break;
//         case "thursday":
//             $week = 4;
//             break;
//         case "friday":
//             $week = 5;
//             break;
//         default:
//             $week = 0;
//             break;
//     }
//     if (date('i', strtotime($startTime)) != 0 && date('i', strtotime($startTime)) != 30) {

//         echo "Tutorial time must start on the hour or halfhour. i.e. a tutorial can start at 9:00, 9:30, 10:00, 10:30, or so on.";
//     } else if ($week == 0) {
//         echo "Unidentified Tutorial Day.";
//     } else {
//         $insertConsultationQuery = "UPDATE `assignmentconsultation` SET `start_week`='$week',`start_time`='$startTime',`duration`='$duration' WHERE `consultation_id`='$consultationID'";
//         $insertConsultationResult = $mysqli->query($insertConsultationQuery);
//         echo "Success";
//     }
// } else if ($action == "deleteConsultationRow") {
//     $deleteConsultationQuery = "DELETE FROM `assignmentconsultation` WHERE `consultation_id` = '$consultationID'";
//     $deleteConsultationResult = $mysqli->query($deleteConsultationQuery);
// } else if ($action == "addConsultationRow") {
//     $addConsultationQuery = "INSERT INTO `assignmentconsultation`(`consultation_id`, `unit_code`) VALUES ('$consultationID', '$unitCode')";
//     $addConsultationResult = $mysqli->query($addConsultationQuery);


//     echo $mysqli->insert_id;
// } else if ($action == "tutorialTutorAllocate") {
//     echo $timetableID;
// } else if ($action == "allocateTutorialTutor") {
//     $staffQuery = "select * from assignmentstaff where staff_id = '$staffID'";
//     $staffResult = $mysqli->query($staffQuery);
//     $staffRow = $staffResult->fetch_array(MYSQLI_ASSOC);
//     $timetableQuery = "update assignmentimetable set tutor_id ='$staffID', tutor = '" . $staffRow["name"] . "' where timetable_id ='$timetableID'";
//     $mysqli->query($timetableQuery);
//     if ($staffRow["level"] != "UC" && $staffRow["level"] != "DC" && $staffID["level"] != "lecturer") {

//         $changeStaffQuery = "update assignmentstaff set level = 'tutor' where staff_id = '$staffID'";
//         $mysqli->query($changeStaffQuery);
//     }
// } else if ($action == "deleteTutorialTutor") {
//     $timetableQuery = "update assignmentimetable set tutor_id ='', tutor = '' where timetable_id ='$timetableID'";
//     $mysqli->query($timetableQuery);
//     $count = 0;
//     $searchUnitQuery = "select * from assignmentimetable where tutor_id ='$staffID'";
//     $searchUnitResult = $mysqli->query($searchUnitQuery);
//     $staffQuery = "select * from assignmentstaff where staff_id = '$staffID'";
//     $staffResult = $mysqli->query($staffQuery);
//     $staffRow = $staffResult->fetch_array(MYSQLI_ASSOC);
//     while ($searchUnitRow = $searchUnitResult->fetch_array(MYSQLI_ASSOC)) {
//         $count++;
//     }
//     if ($staffRow["level"] != "DC" && $staffRow["level"] != "UC" && $staffRow["level"] != "lecturer" && $count == 0) {
//         $changeStaffQuery = "update assignmentstaff set level = '' where staff_id = '$staffID'";
//         $mysqli->query($changeStaffQuery);
//     }
// } else if ($action == "consultationTutorAllocate") {
//     echo $consultationID;
// } 
// $mysqli->close();

include("./db_conn.php");
$unitCode = $_POST["unitCode"];
$action = $_POST["action"];
$staffID = $_POST["staffID"];
$staffName = $_POST["staffName"];
$timetableID = $_POST["timetableID"];
$startWeek = $_POST["startWeek"];
$startTime = $_POST["startTime"];
$duration = $_POST["duration"];
$location = $_POST["location"];
$consultationID = $_POST["consultationID"];

if ($action == "allocateLecturerList") {
    $unitQuery = "select * from assignmentunit where unit_code = '$unitCode'";
    $unitResult = $mysqli->query($unitQuery);
    $unitRow = $unitResult->fetch_array(MYSQLI_ASSOC);

    $staffQuery = "select * from assignmentstaff where level = 'uc' or lecturer =1";
    $staffResult = $mysqli->query($staffQuery);
    $count = 0;
    while ($staffRow = $staffResult->fetch_array(MYSQLI_ASSOC)) {
        $Output["staff_id"][$count] = "<td>" . $staffRow["staff_id"] . "</td>";
        $Output["name"][$count] = "<td>" . $staffRow["name"] . "</td>";
        if ($unitRow["lecturer_id"] == $staffRow["staff_id"]) {
            $Output["button"][$count] = "<td><button type='button' class='btn btn-success' onclick='undoAllocateLecturer(this)'>Undo</button></td>";
        } else {
            $Output["button"][$count] = "<td><button type='button' class='btn btn-primary' onclick='allocateLecturer(this)'>Allocate</button></td>";
        }
        $count++;
        $Output["count"] = $count;
    }
    $Output["lecturer_id"] = $unitRow["lecturer_id"];
    $Output["unit_code"] = $unitCode;
    echo json_encode($Output);
} else if ($action == "allocateLecturer") {
    $unitQuery = "update assignmentunit set lecturer_id ='$staffID', lecturer ='$staffName' where unit_code='$unitCode'";
    $mysqli->query($unitQuery);
    echo "Successfully allocated a new lecturer";
} else if ($action == "undoAllocateLecturer") {
    $unitQuery = "update assignmentunit set lecturer_id ='', lecturer ='' where unit_code='$unitCode'";
    $mysqli->query($unitQuery);
    echo "Successfully unallocated the lecturer";
} else if ($action == "allocateTutorialList") {
    $timetableQuery = "select * from assignmentimetable where unit_code = '$unitCode'";
    $timetableResult = $mysqli->query($timetableQuery);
    $count = 0;
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
        $Output["timetable_id"][$count] = "<td>" . $timetableRow["timetable_id"] . "</td>";
        $Output["unit_code"][$count] = "<td>" . $timetableRow["unit_code"] . "</td>";
        $Output["tutor_id"][$count] = "<td class='d-none'>" . $timetableRow["tutor_id"] . "</td>";
        $Output["tutor"][$count] = "<td>" . $timetableRow["tutor"] . "</td>";
        $Output["start_week"][$count] = "<td><input class='editContent' disabled='disabled' value='" . $week . "' /></td>";
        $Output["start_time"][$count] = "<td><input type='time' class='editContent' disabled='disabled' value='" . $timetableRow["start_time"] . "' /></td>";
        $Output["duration"][$count] = "<td><input class='editContent' disabled='disabled' value='" . $timetableRow["duration"] . "' /></td>";
        $Output["location"][$count] = "<td><input class='editContent' disabled='disabled' value='" . $timetableRow["location"] . "' /></td>";
        $Output["button_allocate"][$count] = "<td><button class='btn btn-primary' data-toggle='modal' data-target='#allocateTutorialTutorModal' onclick='tutor(this)'>Tutor</button></td>";
        $Output["button_edit"][$count] = "<td><button class='btn btn-warning' onclick='editTutorial(this)'>Edit</button></td>";
        $Output["button_delete"][$count] = "<td><button class='btn btn-danger' onclick='deleteTutorial(this)'>Delete</button></td>";
        $count++;
        $Output["count"] = $count;
    }

    echo json_encode($Output);
} else if ($action == "allocateTutorList") {
    $timetableQuery = "select * from assignmentimetable where timetable_id = '$timetableID'";
    $timetableResult = $mysqli->query($timetableQuery);
    $timetableRow = $timetableResult->fetch_array(MYSQLI_ASSOC);

    $tutorQuery = "select * from assignmentutor where unit_code='$unitCode'";
    $tutorResult = $mysqli->query($tutorQuery);
    $count = 0;
    while ($tutorRow = $tutorResult->fetch_array(MYSQLI_ASSOC)) {
        $Output["staff_id"][$count] = "<td>" . $tutorRow["staff_id"] . "</td>";
        $staffQuery = "select * from assignmentstaff where staff_id ='" . $tutorRow["staff_id"] . "'";
        $staffResult = $mysqli->query($staffQuery);
        $staffRow = $staffResult->fetch_array(MYSQLI_ASSOC);
        $Output["name"][$count] = "<td>" . $staffRow["name"] . "</td>";
        if ($timetableRow["tutor_id"] == $tutorRow["staff_id"]) {
            $Output["button"][$count] = "<td><button type='button' class='btn btn-success' onclick='undoAllocateTutor(this)'>Undo</button></td>";
        } else {
            $Output["button"][$count] = "<td><button type='button' class='btn btn-primary' onclick='allocateTutor(this)'>Allocate</button></td>";
        }
        $count++;
        $Output["count"] = $count;
    }
    $Output["timetable_id"] = $unitRow["timetable_id"];
    $Output["unit_code"] = $unitCode;
    echo json_encode($Output);
} else if ($action == "allocateTutor") {
    $timetableQuery = "update assignmentimetable set tutor_id ='$staffID', tutor ='$staffName' where timetable_id='$timetableID'";
    $mysqli->query($timetableQuery);
    echo "Successfully allocated a new tutor.";
} else if ($action == "undoAllocateTutor") {
    $timetableQuery = "update assignmentimetable set tutor_id ='', tutor ='' where timetable_id='$timetableID'";
    $mysqli->query($timetableQuery);
    echo "Successfully unallocated the tutor.";
} else if ($action == "editTutorial") {
    switch (strtolower($startWeek)) {
        case "monday":
            $week = 1;
            break;
        case "tuesday":
            $week = 2;
            break;
        case "wednesday":
            $week = 3;
            break;
        case "thursday":
            $week = 4;
            break;
        case "friday":
            $week = 5;
            break;
        default:
            $week = 0;
            break;
    }
    if (date('i', strtotime($startTime)) != 0 && date('i', strtotime($startTime)) != 30) {
        echo "Tutorial time must start on the hour or halfhour. i.e. a tutorial can start at 9:00, 9:30, 10:00, 10:30, or so on.";
    } else if ($week == 0) {
        echo "Unidentified Tutorial Day.";
    } else {
        $insertTimetableQuery = "UPDATE `assignmentimetable` SET `start_week`='$week',`start_time`='$startTime',`duration`='$duration',`location`='$location' WHERE `timetable_id`='$timetableID'";
        $insertTimetableResult = $mysqli->query($insertTimetableQuery);
        echo "Success";
    }
} else if ($action == "addNewTutorial") {

    $addTimetableQuery = "INSERT INTO `assignmentimetable`(`unit_code`) VALUES ('$unitCode')";
    $addTimetableResult = $mysqli->query($addTimetableQuery);

    echo $mysqli->insert_id;
} else if ($action == "deleteTutorial") {
    $deleteTimetableQuery = "DELETE FROM `assignmentimetable` WHERE `timetable_id` = '$timetableID'";
    $deleteTimetableResult = $mysqli->query($deleteTimetableQuery);
} else if ($action == "allocateConsultation") {
    $consultationQuery = "select * from assignmentconsultation where unit_code = '$unitCode'";
    $consultationResult = $mysqli->query($consultationQuery);
    $count = 0;
    while ($consultationRow = $consultationResult->fetch_array(MYSQLI_ASSOC)) {
        switch ($consultationRow["start_week"]) {
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
        $Output["consultation_id"][$count] = "<td>" . $consultationRow["consultation_id"] . "</td>";
        $Output["unit_code"][$count] = "<td>" . $consultationRow["unit_code"] . "</td>";
        $Output["start_week"][$count] = "<td><input class='editContent' disabled='disabled' value='" . $week . "' /></td>";
        $Output["start_time"][$count] = "<td><input type='time' class='editContent' disabled='disabled' value='" . $consultationRow["start_time"] . "' /></td>";
        $Output["duration"][$count] = "<td><input class='editContent' disabled='disabled' value='" . $consultationRow["duration"] . "' /></td>";
        $Output["location"][$count] = "<td><input class='editContent' disabled='disabled' value='" . $consultationRow["location"] . "' /></td>";
        $Output["button_edit"][$count] = "<td><button class='btn btn-warning' onclick='editConsultation(this)'>Edit</button></td>";
        $Output["button_delete"][$count] = "<td><button class='btn btn-danger' onclick='deleteConsultation(this)'>Delete</button></td>";
        $count++;
        $Output["count"] = $count;
    }

    echo json_encode($Output);
} else if ($action == "editConsultation") {
    switch (strtolower($startWeek)) {
        case "monday":
            $week = 1;
            break;
        case "tuesday":
            $week = 2;
            break;
        case "wednesday":
            $week = 3;
            break;
        case "thursday":
            $week = 4;
            break;
        case "friday":
            $week = 5;
            break;
        default:
            $week = 0;
            break;
    }
    if (date('i', strtotime($startTime)) != 0 && date('i', strtotime($startTime)) != 30) {
        echo "Consultation time must start on the hour or halfhour. i.e. a tutorial can start at 9:00, 9:30, 10:00, 10:30, or so on.";
    } else if ($week == 0) {
        echo "Unidentified Tutorial Day.";
    } else {
        $insertConsultationQuery = "UPDATE `assignmentconsultation` SET `start_week`='$week',`start_time`='$startTime',`duration`='$duration',`location`='$location' WHERE `consultation_id`='$consultationID'";
        $insertConsultationResult = $mysqli->query($insertConsultationQuery);
        echo "Success";
    }
} else if ($action == "addNewConsultation") {

    $addConsultationQuery = "INSERT INTO `assignmentconsultation`(`unit_code`) VALUES ('$unitCode')";
    $addConsultationResult = $mysqli->query($addConsultationQuery);

    echo $mysqli->insert_id;
}else if ($action == "deleteConsultation") {
    $deleteConsultationQuery = "DELETE FROM `assignmentconsultation` WHERE `consultation_id` = '$consultationID'";
    $deleteConsultationResult = $mysqli->query($deleteConsultationQuery);
}

