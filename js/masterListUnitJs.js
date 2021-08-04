//Table of masterListUnit
$(document).ready(function() {

    $('#unitTable').Tabledit({
        url: "./component/unitAction.php",

        columns: {
            identifier: [0, 'unit_code'],
            editable: [

                [1, 'unit_name'],
                [2, 'semester', '{"Semester 1": "Semester 1 ", "Semester 2": "Semester 2", "Winter School": "Winter School", "Spring School": "Spring School"}'],
                [3, 'campus', '{"Pandora": "Pandora ", "Rivendell": "Rivendell", "Neverland": "Neverland"}'],
                [4, 'description']
            ]
        },
        restoreButton: false,
        onSuccess: function(data, textStatus, jqXHR) {
            if (data.action == 'delete') {
                $('#' + data.unit_code).remove();
            }
        }
    });
});

$("#addUnitButton").click(function() {
    $.ajax({
        type: "post",
        url: "./component/insert.php",
        data: $('#formAddUnit').serialize(),
        success: function(data) {
            alert(data);
            if (data == "Add a new unit success!") {
                window.location.reload();
            }

        },
        error: function(data) {
            alert(data);

        }
    });
});