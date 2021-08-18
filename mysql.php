<?php
// Nama untuk hapus data
$adminPassword = "password";

// Database
$user = "root";
$pass = "";
$server = "localhost";
$database = "absensi"; // Nama database
$dbTable = "siswa"; // Nama tabel
$mysqli = new mysqli($server, $user, $pass, $database);

if (!$mysqli) die("Error:<br>" . mysqli_connect_error());
?>
