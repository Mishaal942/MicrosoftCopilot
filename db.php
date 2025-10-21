<?php
$servername = "localhost"; 
$username   = "uppbmi0whibtc";
$password   = "bjgew6ykgu1v";
$dbname     = "db61s3bmv3mamy";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("❌ DB Connection Failed: " . $conn->connect_error);
}
?>
