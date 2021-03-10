<?php
// Nama untuk hapus data
$adminName = "password";

// Database
$user = "root";
$pass = "";
$server = "localhost";
$database = "absensi"; // Nama database
$dbTable = "siswa"; // Nama tabel
$mysqli = new mysqli($server, $user, $pass, $database);

if(!$mysqli) die("Fail:<br>" . mysqli_connect_error());
?>
