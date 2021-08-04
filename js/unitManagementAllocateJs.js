$(".lecturer").click(function() {
    var unitCode = $(this).closest("tr").find("td").eq(0).text();
    $(this).closest("tr").find("td").eq(0).attr("id", "unitID");
    $("#lecturerAllocation").empty();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            unitCode: unitCode,
            action: "allocateLecturerList"
        },
        dataType: "JSON",
        success: function(data) {
            for (let index = 0; index < data["count"]; index++) {

                $("#lecturerAllocation").append("<tr>" + data["staff_id"][index] + data["name"][index] + data["button"][index] + "</tr>");
                $("#lecturerAllocateUnitCode").text(data["unit_code"]);

            }
        }
    });
});


function allocateLecturer(e) {
    var staffID = $(e).closest("tr").find("td").eq(0).text();
    var staffName = $(e).closest("tr").find("td").eq(1).text();
    var unitCode = $("#lecturerAllocateUnitCode").text();
    var button = $(e).closest("tr").find("td").eq(2);
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            staffID: staffID,
            unitCode: unitCode,
            staffName: staffName,
            action: "allocateLecturer"
        },
        success: function(data) {
            alert(data);
            $("#unitID").closest("tr").find("td").eq(2).text(staffID);
            $("#unitID").closest("tr").find("td").eq(3).text(staffName);
        }
    });
    $(e).closest("tbody").find("button").attr("class", "btn btn-primary");
    $(e).closest("tbody").find("button").text("Allocate");

    $(e).closest("tbody").find("button").attr("onclick", "allocateLecturer(this)");
    button.empty();
    button.append("<button type='button' class='btn btn-success' onclick='undoAllocateLecturer(this)'>Undo</button>");

}

function undoAllocateLecturer(e) {
    var staffID = $(e).closest("tr").find("td").eq(0).text();
    var staffName = $(e).closest("tr").find("td").eq(1).text();
    var unitCode = $("#lecturerAllocateUnitCode").text();
    var button = $(e).closest("tr").find("td").eq(2);
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            staffID: staffID,
            unitCode: unitCode,
            staffName: staffName,
            action: "undoAllocateLecturer"
        },
        success: function(data) {
            alert(data);
            $("#unitID").closest("tr").find("td").eq(2).text("");
            $("#unitID").closest("tr").find("td").eq(3).text("");
        }
    });
    $(e).closest("tbody").find("button").attr("class", "btn btn-primary");
    $(e).closest("tbody").find("button").text("Allocate");
    $(e).closest("tbody").find("button").attr("onclick", "allocateLecturer(this)");


}

$(".tutorial").click(function() {
    var unitCode = $(this).closest("tr").find("td").eq(0).text();
    $("#tutorialAllocationList").empty();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            unitCode: unitCode,
            action: "allocateTutorialList"
        },
        dataType: "JSON",
        success: function(data) {

            for (let index = 0; index < data["count"]; index++) {

                $("#tutorialAllocationList").append("<tr>" + data["timetable_id"][index] +
                    data["unit_code"][index] +
                    data["tutor_id"][index] +
                    data["tutor"][index] +
                    data["start_week"][index] +
                    data["start_time"][index] +
                    data["duration"][index] +
                    data["location"][index] +
                    data["button_allocate"][index] +
                    data["button_edit"][index] +
                    data["button_delete"][index] + "</tr>");
            }
            $("#allocateTutorial").text(unitCode);
        }
    });

});

function tutor(e) {
    var timetableID = $(e).closest("tr").find("td").eq(0).text();
    $(e).closest("tr").find("td").eq(0).attr("id", "timetableID");
    var unitCode = $("#allocateTutorial").text();
    $("#tutorialTutorAllocationList").empty();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            timetableID: timetableID,
            unitCode: unitCode,
            action: "allocateTutorList"
        },
        dataType: "JSON",
        success: function(data) {

            for (let index = 0; index < data["count"]; index++) {
                $("#tutorialTutorAllocationList").append("<tr>" + data["staff_id"][index] + data["name"][index] + data["button"][index] + "</tr>");
                $("#tutorialTutorAllocateUnitCode").text(timetableID);
            }
        }
    });

}

function allocateTutor(e) {
    var staffID = $(e).closest("tr").find("td").eq(0).text();
    var staffName = $(e).closest("tr").find("td").eq(1).text();
    var timetableID = $("#tutorialTutorAllocateUnitCode").text();
    var button = $(e).closest("tr").find("td").eq(2);
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            staffID: staffID,
            timetableID: timetableID,
            staffName: staffName,
            action: "allocateTutor"
        },
        success: function(data) {
            alert(data);
            $("#timetableID").closest("tr").find("td").eq(2).text(staffID);
            $("#timetableID").closest("tr").find("td").eq(3).text(staffName);

        }
    });
    $(e).closest("tbody").find("button").attr("class", "btn btn-primary");
    $(e).closest("tbody").find("button").text("Allocate");

    $(e).closest("tbody").find("button").attr("onclick", "allocateTutor(this)");
    button.empty();
    button.append("<button type='button' class='btn btn-success' onclick='undoAllocateTutor(this)'>Undo</button>");
}

function undoAllocateTutor(e) {
    var staffID = $(e).closest("tr").find("td").eq(0).text();
    var staffName = $(e).closest("tr").find("td").eq(1).text();
    var timetableID = $("#tutorialTutorAllocateUnitCode").text();
    var button = $(e).closest("tr").find("td").eq(2);
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            staffID: staffID,
            timetableID: timetableID,
            staffName: staffName,
            action: "undoAllocateTutor"
        },
        success: function(data) {
            alert(data);
            $("#unitID").closest("tr").find("td").eq(2).text("");
            $("#timetableID").closest("tr").find("td").eq(3).text("");

        }
    });
    $(e).closest("tbody").find("button").attr("class", "btn btn-primary");
    $(e).closest("tbody").find("button").text("Allocate");
    $(e).closest("tbody").find("button").attr("onclick", "allocateTutor(this)");

}

function editTutorial(e) {
    var timetableID = $(e).closest("tr").find("td").eq(0).text();
    var startWeek = $(e).closest("tr").find("input").eq(0).val();
    var startTime = $(e).closest("tr").find("input").eq(1).val();
    var duration = $(e).closest("tr").find("input").eq(2).val();
    var location = $(e).closest("tr").find("input").eq(3).val();
    var button = $(e);
    if (button.text() == "Edit") {
        button.closest("tr").find("input").removeAttr("disabled");
        button.text("Complete");
    } else {
        $.ajax({
            type: "post",
            url: "./component/unitManagementAllocation.php",
            data: {
                timetableID: timetableID,
                startWeek: startWeek,
                startTime: startTime,
                duration: duration,
                location: location,
                action: "editTutorial"
            },
            success: function(data) {
                alert(data);
                button.closest("tr").find("input").attr("disabled", "disabled");
                button.text("Edit");
            }
        });
    }
}
$("#addNewTutorial").click(function() {
    var unitCode = $("#allocateTutorial").text();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            unitCode: unitCode,
            action: "addNewTutorial"
        },
        success: function(data) {
            $("#tutorialAllocationList").append("<tr><td>" + data + "</td><td>" + unitCode + "</td><td></td><td><input class='editContent' disabled='disabled' value='Not Set' /></td><td><input type='time' class='editContent' disabled='disabled' value='00:00:00' /></td><td><input class='editContent' disabled='disabled' value='0' /></td><td><input class='editContent' disabled='disabled' value='' /></td><td><button class='btn btn-primary' data-toggle='modal' data-target='#allocateTutorialTutorModal' onclick='tutor(this)'>Tutor</button></td><td><button class='btn btn-warning' onclick='editTutorial(this)'>Edit</button></td><td><button class='btn btn-danger' onclick='deleteTutorial(this)'>Delete</button></td></tr>");
        }
    });
});

function deleteTutorial(e) {
    var timetableID = $(e).closest("tr").find("td").eq(0).text();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            timetableID: timetableID,

            action: "deleteTutorial"
        },
        success: function(data) {

        }
    });

    $(e).closest("tr").remove();
}

$(".consultation").click(function() {
    var unitCode = $(this).closest("tr").find("td").eq(0).text();
    $("#consultationAllocationList").empty();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            unitCode: unitCode,
            action: "allocateConsultation"
        },
        dataType: "JSON",
        success: function(data) {

            for (let index = 0; index < data["count"]; index++) {

                $("#consultationAllocationList").append("<tr>" + data["consultation_id"][index] +
                    data["unit_code"][index] +
                    data["start_week"][index] +
                    data["start_time"][index] +
                    data["duration"][index] +
                    data["location"][index] +
                    data["button_edit"][index] +
                    data["button_delete"][index] + "</tr>");
            }
            $("#allocateConsultation").text(unitCode);
        }
    });

});

function editConsultation(e) {
    var consultationID = $(e).closest("tr").find("td").eq(0).text();
    var startWeek = $(e).closest("tr").find("input").eq(0).val();
    var startTime = $(e).closest("tr").find("input").eq(1).val();
    var duration = $(e).closest("tr").find("input").eq(2).val();
    var location = $(e).closest("tr").find("input").eq(3).val();
    var button = $(e);
    if (button.text() == "Edit") {
        button.closest("tr").find("input").removeAttr("disabled");
        button.text("Complete");
    } else {
        $.ajax({
            type: "post",
            url: "./component/unitManagementAllocation.php",
            data: {
                consultationID: consultationID,
                startWeek: startWeek,
                startTime: startTime,
                duration: duration,
                location: location,
                action: "editConsultation"
            },
            success: function(data) {
                alert(data);
                button.closest("tr").find("input").attr("disabled", "disabled");
                button.text("Edit");
            }
        });
    }
}
$("#addNewConsultation").click(function() {
    var unitCode = $("#allocateConsultation").text();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            unitCode: unitCode,
            action: "addNewConsultation"
        },
        success: function(data) {
            $("#consultationAllocationList").append("<tr><td>" + data + "</td><td>" + unitCode + "</td><td><input class='editContent' disabled='disabled' value='Not Set' /></td><td><input type='time' class='editContent' disabled='disabled' value='00:00:00' /></td><td><input class='editContent' disabled='disabled' value='0' /></td><td><input class='editContent' disabled='disabled' value='' /></td><td><button class='btn btn-warning' onclick='editTutorial(this)'>Edit</button></td><td><button class='btn btn-danger' onclick='deleteTutorial(this)'>Delete</button></td></tr>");
        }
    });
});

function deleteConsultation(e) {
    var consultationID = $(e).closest("tr").find("td").eq(0).text();
    $.ajax({
        type: "post",
        url: "./component/unitManagementAllocation.php",
        data: {
            consultationID: consultationID,

            action: "deleteConsultation"
        },
        success: function(data) {

        }
    });

    $(e).closest("tr").remove();
}