<?php
session_start();

//if the user didn't sign in, the application should know it
if (!$_SESSION["user"] || $_SESSION["user"]==""){
    echo "<script>alert('You did not sign in!');location.href='../index.php';</script>";
}
else{
session_destroy();
echo "<script>alert('You have already sign out!');location.href='../index.php';</script>";
}

?>