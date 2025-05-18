<?php

header('Content-Type : application/json; charset=utf-8');

$koneksi = new mysqli("localhost", "root", "", "wo_web");

if ($koneksi->connect_errno) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'gagal koneksi', $koneksi->connect_error
    ]);
    exit;
}

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'metode request tidak diizinkan'
    ]);
    exit;
}

$idPelanggan = $_POST['idPelanggan'] ?? '';
$namaPelanggan = $_POST['namaPelanggan'] ?? '';
$idPaket = $_POST['idPaket'] ?? '';
$tanggalPesan = $_POST['tanggalPesan'] ?? '';
$metodePembayaran = $_POST['metodePembayaran'] ?? '';
$jumlahPembayaran = $_POST['jumlahPembayaran'] ?? '';

if (empty($idPelanggan) || empty($namaPelanggan) || empty($idPaket) || empty($tanggalPesan)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Data tidak lengkap'
    ]);
    exit;
}


$sql = 'INSERT INTO pesanan (idPelanggan, namaPelanggan, idPaket, tanggalPesan, metodePembayaran, jumlahPembayaran)
VALUES (?, ?, ?, ?, ?, ?)';

$stmt = $koneksi->prepare($sql);

if (!$stmt) {
   http_response_code(500);
   encho json_encode([
        'status' => 'error',
        'message' => 'Prepare statement gagal: ' .$koneksi->
   ])
}
?>