<?php
//connect database
$mysqli = new mysqli('localhost', 'root', '', 'chail'); 
//check connection
if (mysqli_connect_errno())  
{ 
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit(); 
}


?>