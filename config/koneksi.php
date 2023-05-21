<?php
// Konfigurasi koneksi database
$host = "localhost";
$username = "root";
$password = "";
$database = "flower_db";

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>