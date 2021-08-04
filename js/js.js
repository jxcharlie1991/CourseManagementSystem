//registration.php load and check format of data
$("document").ready(function() {
    $("div.staff").hide();

});

$(".form-check").click(
    function hideInput() {
        if ($("#studentSelect").is(":checked")) {
            $(".staff input").val("");
            $(".staff").hide();
            $(".student").show();
        } else {
            $(".student input").val("");
            $(".student").hide();
            $(".staff").show();
        }
    });

$("#submit").click(function() {
    var regExpI = /^\d{6}$/;
    var regExpU = /[A-Z]/;
    var regExpL = /[a-z]/;
    var regExpN = /[0-9]/;
    var regExpC = /.{6,12}/;
    var regExpE = /\w+(\.\w+)*@[A-z0-9]+(\.[A-z]){1,2}/;
    var regExpS = /!|@|#|\$|%|\^/
    var pw = $("#password").val();
    var validatePw = regExpU.test(pw) && regExpL.test(pw) && regExpN.test(pw) && regExpC.test(pw) && regExpS.test(pw);


    if ($("#studentSelect").is(":checked")) {
        if ($("#studentID").val() == "") {
            alert("Please enter your student ID.");
            return false;
        } else if (regExpI.test($("#studentID").val()) == false) {
            alert("Student ID has to be 6 digital numbers.");
            return false;
        } else if (validatePw == false) {
            alert("Password must contain at least one number, one uppercase and lowercase letter, one of following special characters (! @ # $ % ^) and 6-12 characters.");
            return false;
        } else if ($("#confirmPassword").val() != $("#password").val()) {
            alert("Please re-type the password.");
            return false;
        } else if ($("#name").val() == "") {
            alert("Please enter your name.");
            return false;
        } else if (regExpE.test($("#email").val()) == false) {
            alert("Please enter your valid email address.");
            return false;
        } else if (!($("#agree").is(":checked"))) {
            alert("You must agree to the terms and conditions.");
            return false;
        } else {

            return true;

        }
    } else {
        if ($("#staffID").val() == "") {
            alert("Please enter your staff ID.");
            return false;
        } else if (regExpI.test($("#staffID").val()) == false) {
            alert("Staff ID has to be 6 digital numbers.");
            return false;
        } else if (validatePw == false) {
            alert("Password must contain at least one number, one uppercase and lowercase letter, one of following special characters (! @ # $ % ^) and 6-12 characters.");
            return false;
        } else if ($("#confirmPassword").val() != $("#password").val()) {
            alert("Please re-type the password.");
            return false;
        } else if ($("#name").val() == "") {
            alert("Please enter your name.");
            return false;
        } else if (regExpE.test($("#email").val()) == false) {
            alert("Please enter your valid e-mail address.");
            return false;
        } else if ($("#qualification").val() == "") {
            alert("Please enter your qualification.");
            return false;
        } else if ($("#expertise").val() == "") {
            alert("Please enter your expertise.");
            return false;
        } else if ($("#phone").val() == "") {
            alert("Please enter your phone number.");
            return false;
        } else if (!($("#agree").is(":checked"))) {
            alert("You must agree to the terms and conditions.");
            return false;
        } else {

            return true;

        }
    }
});



//unitEnrolment javascript
$(".enrol").click(function() {
    var enrolCode = $(this).closest("tr").find("td").eq(0).text();
    if ($(this).text() == "Unenrolled") {


        $(this).text("Enrolled");
        $(this).attr("class", "enrol btn btn-success")
        $.ajax({
            type: "post",
            url: "./component/enrol.php",
            data: {
                enrolCode: enrolCode,
                action: "insert"
            },
            success: function(data) {
                alert(data);
            },
            error: function(data) {
                alert(data);
                window.location.reload();
            }
        });





    } else {
        $(this).text("Unenrolled");
        $(this).attr("class", "enrol btn btn-primary")
        $.ajax({
            type: "post",
            url: "./component/enrol.php",
            data: {
                enrolCode: enrolCode,
                action: "delete"
            },
            success: function(data) {
                alert(data);
            },
            error: function(data) {
                alert(data);
                window.location.reload();
            }
        })

    }
});


//masterListAcademicStaff javascript

$("#addAcademicStaffButton").click(function() {
    $.ajax({
        type: "post",
        url: "./component/insertStaff.php",
        data: $('#formAddAcademicStaff').serialize(),
        success: function(data) {
            alert(data);
            if (data == "Add a new staff successfully, its default password would be Aa@12345") {
                window.location.reload();
            }
        },
        error: function(data) {
            alert(data);

        }
    });


});

$(".lecturerButton").click(function() {
    var staffID = $(this).closest("tr").find("td").eq(0).text();
    var staffName = $(this).closest("tr").find("td").eq(1).text();
    var button = $(this).closest("tr").find("td").eq(5).find("button");
    if (button.text() == "Allocate") {
        $.ajax({
            type: "post",
            url: "./component/insertStaff.php",
            data: {
                staffID: staffID,
                action: "allocateLecturer",
                staffName: staffName
            },
            success: function(data) {
                alert(data);
                button.text("Undo");
            }

        });
    } else {
        $.ajax({
            type: "post",
            url: "./component/insertStaff.php",
            data: {
                staffID: staffID,
                action: "undoLecturer",
                staffName: staffName
            },
            dataType: 'JSON',
            success: function(data) {
                if (data["check"] == "fail") {
                    alert(data["res"]);
                } else {
                    alert(data["res"]);
                    button.text("Allocate");
                }
            }

        });
    }


});



$(".tutorButton").click(function(e) {
    var staffID = $(this).closest("tr").find("td").eq(0).text();
    var staffName = $(this).closest("tr").find("td").eq(1).text();
    var tutorAllocationID = $("#tutorAllocationID");
    var tutorAllocationName = $("#tutorAllocationName");
    var table = $("#tutorTable");
    table.empty();
    $.ajax({
        type: "post",
        url: "./component/insertStaff.php",
        data: {
            staffID: staffID,
            action: "jsonTutor",
            staffName: staffName
        },
        dataType: 'JSON',
        success: function(data) {
            for (let index = 0; index < data["count"]; index++) {
                table.append("<tr>" + data["unit_code"][index] + data["unit_name"][index] + data["button"][index] + "</tr>");

            }
            tutorAllocationID.text(staffID);
            tutorAllocationName.text(staffName);
        }
    });


});

function allocateTutor(e) {
    var staffID = $("#tutorAllocationID").text();
    var staffName = $("#tutorAllocationName").text();
    var unitCode = $(e).closest("tr").find("td").eq(0).text();
    var button = $(e);
    $.ajax({
        type: "post",
        url: "./component/insertStaff.php",
        data: {
            staffID: staffID,
            unitCode: unitCode,
            action: "allocateTutor",
            staffName: staffName
        },
        success: function(data) {
            alert(data);
            button.attr("onclick", "undoAllocateTutor(this)");
            button.text("Undo");
        }
    });
}

function undoAllocateTutor(e) {
    var staffID = $("#tutorAllocationID").text();
    var staffName = $("#tutorAllocationName").text();
    var unitCode = $(e).closest("tr").find("td").eq(0).text();
    var button = $(e);
    $.ajax({
        type: "post",
        url: "./component/insertStaff.php",
        data: {
            staffID: staffID,
            unitCode: unitCode,
            action: "undoAllocateTutor",
            staffName: staffName
        },
        dataType: 'JSON',
        success: function(data) {
            if (data["check"] == "fail") {
                alert(data["res"]);


            } else {
                alert(data["res"]);
                button.attr("onclick", "allocateTutor(this)");
                button.text("Allocate");
            }
        }
    });
}



$(".removeButton").click(function() {
    var staffID = $(this).closest("tr").find("td").eq(0).text();

    $.ajax({
        type: "post",
        url: "./component/staffAllocation.php",
        data: {
            staffID: staffID,
            action: "remove"
        },
        success: function(data) {

        }
    });

    $(this).closest("tr").remove();
});



//tutorialAllocation Javascript

$(".notAllocate").click(function() {
    var choose_id = $(this).closest("tr").find("td").eq(0).text();
    var choose_unit = $(this).closest("tr").find("td").eq(1).text();
    $.ajax({
        type: "post",
        url: "./component/allocate.php",
        data: {
            choose_id: choose_id,
            choose_unit: choose_unit,
            action: "allocate"
        },
        success: function(data) {
            alert(data);
            window.location.reload();
        },
        error: function(data) {
            alert(data);

        }
    });
});

$(".successAllocate").click(function() {
    var choose_id = $(this).closest("tr").find("td").eq(0).text();
    var choose_unit = $(this).closest("tr").find("td").eq(1).text();
    $.ajax({
        type: "post",
        url: "./component/allocate.php",
        data: {
            choose_id: choose_id,
            choose_unit: choose_unit,
            action: "undo"
        },
        success: function(data) {
            alert(data);
            window.location.reload();
        },
        error: function(data) {
            alert(data);

        }
    });
});