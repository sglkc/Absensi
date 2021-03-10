<?php
$adminName = "password";
$user = "root";
$pass = "";
$server = "localhost";
$database = "absensi";
$dbTable = "siswa";
$mysqli = new mysqli($server, $user, $pass, $database);

if(!$mysqli) die("Fail:<br>" . mysqli_connect_error());
?>