<?php
include 'config.php'; // Sesuaikan path jika berada di folder berbeda

// Ambil data dari form
$namaPelanggan = mysqli_real_escape_string($conn, $_POST['namaPelanggan']);
$isiTestimoni = mysqli_real_escape_string($conn, $_POST['isiTestimoni']);
$tanggal = date('Y-m-d');

// Buat ID Testimoni otomatis
$idTestimoni = uniqid('TST');

// Cek apakah namaPelanggan ada di tabel pelanggan
    $sql = "INSERT INTO testimoni (idTestimoni, namaPelanggan, isiTestimoni, tanggalTestimoni) 
            VALUES ('$idTestimoni', '$namaPelanggan', '$isiTestimoni', '$tanggal')";
$result = mysqli_query($conn, $sql);

mysqli_close($conn);

$redirectURL = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header('Location: ' . $redirectURL);
exit();
?>