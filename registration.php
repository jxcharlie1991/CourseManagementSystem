<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Registration Page </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>


<body>

    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");
    ?>
    <!--Registration form-->
    <div class="container mt-2 mx-auto mb-5" id="registration">
        <div class="col-sm-12 pt-1">
            <div>
                <h5 id="back"><a href="#" onclick="javascript:history.back(-1)" ;>Back</a></h5>
            </div>
            <div class="mx-auto col-sm-5">
                <h2>Registration</h2>
            </div>
            <form role="form" method="post" action="./component/register.php">
                <div class="form-group row">
                    <div class="form-check col-sm-2">

                    </div>
                    <div class="form-check col-sm-5">
                        <input type="radio" id="studentSelect" class="form-check-input" name="identity" checked="checked" />
                        <label class="form-check-label">I am a student</label>
                    </div>
                    <div class=" form-check col-sm-5">
                        <input type="radio" id="staffSelect" class="form-check-input" name="identity" />
                        <label class="form-check-label">I am a staff</label>
                    </div>
                </div>
                <div class="form-group row student">
                    <label class="col-sm-4 col-form-label">Student ID</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="studentID" name="studentID" placeholder="Student ID" />
                    </div>
                </div>
                <div class="form-group row staff">
                    <label class="col-sm-4 col-form-label">Staff ID</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="staffID" name="staffID" placeholder="Staff ID" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input class="form-control" autocomplete="new-password" type="password" id="password" name="password" placeholder="Password" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Confirm password</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Name</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="name" name="name" placeholder="Name" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">E-mail address</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="email" id="email" name="email" placeholder="E-mail address" />
                    </div>
                </div>
                <div class="form-group row staff">
                    <label class="col-sm-4 col-form-label">Qualification</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="qualification" name="qualification" placeholder="Qualification" />
                    </div>
                </div>
                <div class="form-group row staff">
                    <label class="col-sm-4 col-form-label">Expertise</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="expertise" name="expertise" placeholder="Expertise" />
                    </div>
                </div>
                <div class="form-group row student">
                    <label class="col-sm-4 col-form-label">Address</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="address" name="address" placeholder="Address" />
                    </div>
                </div>
                <div class="form-group row student">
                    <label class="col-sm-4 col-form-label">Date of birth</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="birth" name="birth" placeholder="Date of birth" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Phone number</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" id="phone" name="phone" placeholder="Phone number" />
                    </div>
                </div>
                <div class="form-group row">
                    <div class="form-check col-sm-2"></div>
                    <label id="agreeLabel" class="form-check col-sm-10">I agree to the terms and conditions
                        <input type="checkbox" id="agree" name="agree" /></label>
                </div>
                <div class="form-group row pb-1">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-4">
                        <button id="submit" type="submit">
                            Submit
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <button id="reset" type="reset">
                            Reset
                        </button>
                    </div>
                </div>
            </form>


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
    <!--my own javascript-->
    <script type="text/javascript" src="./js/js.js"></script>
</body>

</html>