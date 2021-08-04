$("#editEdit").click(function() {
    if ($("#editEdit").text() == "Edit") {
        $(".editAccount").removeAttr("disabled");
        $("#editEdit").text("Cancel")
    } else {
        window.location.reload();
    }
});



$(document).ready(function() {

    $('#unavailableTable').Tabledit({
        url: "./component/unavailableAction.php",
        deleteButton: false,
        autoFocus: false,
        columns: {
            identifier: [0, 'name'],
            editable: [

                [1, 'unavailable_start_date'],
                [2, 'unavailable_end_date']
            ]
        },
        restoreButton: false,
        deleteButton: false,
        onSuccess: function(data, textStatus, jqXHR) {

        },
        onDraw: function() {
            $('table tr td:nth-child(2) input').each(function() {
                $(this).attr('type', 'date');
            });
            $('table tr td:nth-child(3) input').each(function() {
                $(this).attr('type', 'date');
            });
        }
    });
});

$("#availableButton").click(function() {
    $.ajax({
        type: "post",
        url: "./component/unavailableAction.php",
        data: {
            action: "available"
        },
        done: function(data) {

        }

    });
    $(this).closest("tr").find("td").eq(1).text("Available");
    $(this).closest("tr").find("td").eq(2).text("Available");
});


$("#updatePassword").click(function() {
    var formerPassword = $("#formerPassword").val();
    var newPassword = $("#newPassword").val();
    var confirmNewPassword = $("#confirmNewPassword").val();

    var regExpI = /^\d{6}$/;
    var regExpU = /[A-Z]/;
    var regExpL = /[a-z]/;
    var regExpN = /[0-9]/;
    var regExpC = /.{6,12}/;
    var regExpS = /!|@|#|\$|%|\^/
    var pw = $("#newPassword").val();
    var validatePw = regExpU.test(pw) && regExpL.test(pw) && regExpN.test(pw) && regExpC.test(pw) && regExpS.test(pw);
    if (validatePw == false) {
        alert("Password must contain at least one number, one uppercase and lowercase letter, one of following special characters (! @ # $ % ^) and 6-12 characters.");
    } else {
        $.ajax({
            type: "post",
            url: "./component/updatePassword.php",
            data: {
                formerPassword: formerPassword,
                newPassword: newPassword,
                confirmNewPassword: confirmNewPassword
            },
            success: function(data) {
                alert(data);
                if (data == "Update your password successfully!") {
                    window.location.reload();
                }
            },
            error: function(data) {
                alert(data);
            }

        });
    }

});