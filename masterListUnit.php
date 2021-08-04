<?php
session_start();
include("./component/db_conn.php");

if (!$_SESSION["user"] || $_SESSION["user"]["id"] == "") {
    echo "<script>alert('Please log in first, thanks');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
} else if ($_SESSION['user']["level"] != "DC") {
    echo "<script>alert('Only DC has access to this page, but you are a " . $_SESSION['user']["level"] . "');location.href='" . $_SERVER["HTTP_REFERER"] . "';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Master List for Unit</title>


    <!--bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--my own css-->
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
    <!--icon for tabledit-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>

<body>


    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");


    ?>
    <div>

        <div class="container table text-center mt-5 mb-5">
            <h2>Unit Details</h2>
            <div class="text-left">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addModal">Add a new unit</button>
            </div>
            <table class="table table-striped" id="unitTable">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Semester</th>
                        <th>Campus</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $unitQuery = "select * from assignmentunit order by id asc";
                    $unitResult = $mysqli->query($unitQuery);

                    while ($unitRow = $unitResult->fetch_array(MYSQLI_ASSOC)) {
                    ?>
                        <tr>
                            <td><?php echo $unitRow["unit_code"]; ?></td>
                            <td><?php echo $unitRow["unit_name"]; ?></td>
                            <td><?php echo $unitRow["semester"]; ?></td>
                            <td><?php echo $unitRow["campus"]; ?></td>
                            <td><?php echo $unitRow["description"]; ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
            <?php
            mysqli_free_result($unitResult);
            $mysqli->close();
            ?>
        </div>
    </div>
    <!-- Add modal window-->
    <div class="modal fade" id="addModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add a New Unit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="formAddUnit">
                        <div class="form-group">
                            <label for="addUnitCode" class="col-form-label">Unit Code</label>
                            <input type="text" class="form-control" id="addUnitCode" name="addUnitCode">
                        </div>
                        <div class="form-group">
                            <label for="addUnitName" class="col-form-label">Unit Name</label>
                            <input type="text" class="form-control" id="addUnitName" name="addUnitName"></input>
                        </div>
                        <div class="form-group">
                            <label for="addSemester" class="col-form-label">Semester</label>
                            <select class="custom-select" id="addSemester" name="addSemester">
                                <option selected>Choose a semester</option>
                                <option value="Semester 1">Semester 1</option>
                                <option value="Semester 2">Semester 2</option>
                                <option value="Winter School">Winter School</option>
                                <option value="Spring School">Spring School</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="addCampus" class="col-form-label">Campus</label>
                            <select class="custom-select" id="addCampus" name="addCampus">
                                <option selected>Choose a campus</option>
                                <option value="Rivendell">Rivendell</option>
                                <option value="Rivendell">Pandora</option>
                                <option value="Rivendell">Neverland</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="addDescription" class="col-form-label">Description</label>
                            <textarea class="form-control" id="addDescription" name="addDescription"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addUnitButton">Save</button>
                </div>

            </div>
        </div>
    </div>


    <!--footer design-->
    <nav class="navbar fixed-bottom justify-content-center bg-light">
        <span class="text-muted">After add, delete or edit a unit, you can view <a href="./unitDetail.php">Unit Detail</a> for a double check.</span>
    </nav>

    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--jquery ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--tabledit lib-->
    <script src="./js/jquery.tabledit.js"></script>
    <!--my own javascript-->
    <script type="text/javascript" src="./js/js.js"></script>
    <!--tabledit of this page-->
    <script type="text/javascript" src="./js/masterListUnitJs.js"></script>
</body>

</html>