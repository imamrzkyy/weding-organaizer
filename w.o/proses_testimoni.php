<?php
include 'config.php'; // Sesuaikan path jika berada di folder berbeda

// Ambil data dari form
$idPelanggan = mysqli_real_escape_string($conn, $_POST['idPelanggan']);
$isiTestimoni = mysqli_real_escape_string($conn, $_POST['isiTestimoni']);
$tanggal = date('Y-m-d');

// Buat ID Testimoni otomatis
$idTestimoni = uniqid('TST');

// Cek apakah idPelanggan ada di tabel pelanggan
$cekPelanggan = "SELECT 1 FROM pelanggan WHERE idPelanggan = '$idPelanggan'";
$result = mysqli_query($conn, $cekPelanggan);

if (mysqli_num_rows($result) > 0) {
    // Jika idPelanggan valid, lakukan insert
    $sql = "INSERT INTO testimoni (idTestimoni, idPelanggan, isiTestimoni, tanggalTestimoni) 
            VALUES ('$idTestimoni', '$idPelanggan', '$isiTestimoni', '$tanggal')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Testimoni berhasil dikirim!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "<script>alert('ID Pelanggan tidak ditemukan.'); window.location.href='index.php';</script>";
}

mysqli_close($conn);
?>