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
$idPelanggan = $_POST['idPelanggan'] ?? '';
$namaPelanggan = $_POST['namaPelanggan'] ?? '';
$idPaket = $_POST['idPaket'] ?? '';
$tanggalPesan = $_POST['tanggalPesan'] ?? '';
$metodePembayaran = $_POST['metodePembayaran'] ?? '';
$jumlahPembayaran = $_POST['jumlahPembayaran'] ?? '';
$transactionId = $_POST['transactionId'] ?? null;
$statusPembayaran = $_POST['statusPembayaran'] ?? 'pending'; // Default value

// Validasi data
if (
    empty($idPelanggan) || empty($namaPelanggan) ||
    empty($idPaket) || empty($tanggalPesan) || 
    empty($metodePembayaran) || empty($jumlahPembayaran)
) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Data tidak lengkap'
    ]);
    exit;
}

try {
    // Siapkan query
    $sql = 'INSERT INTO pesanan (
                idPelanggan,
                namaPelanggan,
                idPaket,
                tanggalPesan,
                metodePembayaran,
                jumlahPembayaran,
                transactionId,
                statusPembayaran
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
    
    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        throw new Exception('Prepare statement gagal: ' . $koneksi->error);
    }
    
    // Pastikan jumlahPembayaran berupa float
    $jumlahPembayaran = floatval($jumlahPembayaran);
    
    // Bind parameter
    $stmt->bind_param(
        'sssssdss',
        $idPelanggan,
        $namaPelanggan,
        $idPaket,
        $tanggalPesan,
        $metodePembayaran,
        $jumlahPembayaran,
        $transactionId,
        $statusPembayaran
    );
    
    // Eksekusi
    if (!$stmt->execute()) {
        throw new Exception('Execute statement gagal: ' . $stmt->error);
    }
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Data pesanan berhasil disimpan'
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