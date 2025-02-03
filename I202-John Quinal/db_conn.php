<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutor";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Connection Failed" . mysqli_connect_error());

}
//echo "connected successfully";