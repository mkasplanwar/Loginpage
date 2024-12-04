<?php
$host = 'localhost';  // Ganti dengan host database Anda
$dbname = 'loginpage';  // Ganti dengan nama database Anda
$username = 'root';  // Ganti dengan username database Anda
$password = '';  // Ganti dengan password database Anda

// Buat koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
