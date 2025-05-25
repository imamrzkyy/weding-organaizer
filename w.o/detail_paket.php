<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $paket = $conn->query("SELECT * FROM paketpernikahan WHERE idPaket = '$id'")->fetch_assoc();

    if (!$paket) {
        echo "Paket tidak ditemukan.";
        exit;
    }
} else {
    echo "ID paket tidak diberikan.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($paket['namaPaket']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="container py-5">
    <h2><?= htmlspecialchars($paket['namaPaket']) ?></h2>
    <p><?= $paket['deskripsi'] ?? "Deskripsi belum tersedia." ?></p>
    <div class="price-tag">Rp <?= number_format($paket['harga'], 0, ',', '.') ?></div>
    <a href="pricelist.php" class="btn btn-secondary mt-3">Kembali ke Daftar Paket</a>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
