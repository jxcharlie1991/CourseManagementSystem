<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Home Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>


<body>
    <!--nav and log in modal-->
    <?php
    include("./component/nav.php");
    ?>

    <!--index content-->
     <div class="grid_system" style=" padding:50px; text-align:center;">
        <div class="row">
            <div class="col-lg-4">
                <div class="container imgBox">
                    <img src="./img/indexPic1.png" class="imgPic"/>
                    <p class="lead">The Master of Information Technology and Systems (MITS) provides a wide breadth of knowledge of varying aspects of information technology (IT) and information systems (IS). The MITS provides students with a previous tertiary qualification in any discipline area with the knowledge, understanding and skills to enable them to deal effectively with advanced issues involving IT and IS.</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="container imgBox">
                    <img src="./img/indexPic2.png" class="imgPic"/>
                    <p class="lead">The MITS is an effective means of opening up new career possibilities in a broad range of ICT fields. Graduates of the MITS will have the knowledge and skills to solve complex social, economic and technical problems within the context of information and communication technology. </p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="container imgBox">
                    <img src="./img/indexPic3.png" class="imgPic"/>
                    <p class="lead">The MITS has full, professional-level accreditation from the Australian Computer Society (ACS). This endorsement recognises that the degree, which was recently redeveloped in consultation with the ACS, is responsive to the current and future needs of the ICT industry. Graduates of the MITS are eligible for membership of the ACS.</p>
                </div>
            </div>
        </div>
    </div>

    
    <!--footer design-->
    <nav class="navbar fixed-bottom justify-content-center bg-light">       
            <span class="text-muted">This website is coded by Li Chai.</span>        
    </nav>


    <!--bootstrap-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!--jquery ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>

</html>
