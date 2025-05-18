<?php
$host = "localhost";      // Nama host database
$user = "root";           // Username database (default: root)
$password = "";           // Password database
$database = "wo_web";  // Ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $database);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika berhasil
// echo "Koneksi berhasil";
?>