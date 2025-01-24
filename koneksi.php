<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uli";

// Membuat koneksi
$skon = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($skon->connect_error) {
    die("<div class='alert alert-danger'>Koneksi Gagal : </div>" . $skon->connect_error);
}
echo "<div class='alert alert-success'>Database Terkoneksi</div>";
?>
