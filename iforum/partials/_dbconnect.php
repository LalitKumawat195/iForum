<?php
date_default_timezone_set('Asia/Kolkata');
$conn=mysqli_connect("localhost","root","","iForum");
if(!$conn){
    die("Error Detected".mysqli_connect_error());
}
?>