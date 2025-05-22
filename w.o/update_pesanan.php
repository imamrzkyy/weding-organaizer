<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json; charset=utf-8');

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wo_web");
if ($koneksi->connect_errno) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal koneksi: ' . $koneksi->connect_error
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Metode request tidak diizinkan'
    ]);
    exit;
}

// Debug - log received data
$logData = "Data received: " . print_r($_POST, true);
error_log($logData);

// Ambil data dari POST
$id = $_POST['id'] ?? '';
// $idPelanggan = $_POST['idPelanggan'] ?? '';
// $namaPelanggan = $_POST['namaPelanggan'] ?? '';
// $idPaket = $_POST['idPaket'] ?? '';
// $tanggalPesan = $_POST['tanggalPesan'] ?? '';
// $metodePembayaran = $_POST['metodePembayaran'] ?? '';
$jumlahPembayaran = $_POST['jumlahPembayaran'] ?? '';
// $transactionId = $_POST['transactionId'] ?? null;
// $statusPembayaran = $_POST['statusPembayaran'] ?? 'pending'; // Default value

// Validasi data
// if (
//     empty($idPelanggan) || empty($namaPelanggan) ||
//     empty($idPaket) || empty($tanggalPesan) || 
//     empty($metodePembayaran) || empty($jumlahPembayaran)
// ) {
//     http_response_code(400);
//     echo json_encode([
//         'status' => 'error',
//         'message' => 'Data tidak lengkap'
//     ]);
//     exit;
// }
try {
    $metode = 'Lunas';
    $jumlah = (int)$jumlahPembayaran * 2;
    $id = (int)$id;
    $sql2 = 'UPDATE pesanan set jumlahPembayaran = ? , metodePembayaran = ? where id = ?';
    $stmt2 = $koneksi->prepare($sql2);
    $stmt2->bind_param("isi", $jumlah, $metode, $id);

    if (!$stmt2) {
        throw new Exception('Prepare statement gagal: ' . $koneksi->error);
    }

    if (!$stmt2->execute()) {
        throw new Exception('Execute statement gagal: ' . $stmt->error);
    }
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Data pesanan berhasil dilunasi'
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal menyimpan data: ' . $e->getMessage()
    ]);
    // Log error for debugging
    error_log('Error in simpan_pesanan.php: ' . $e->getMessage());
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    $koneksi->close();
}
?>