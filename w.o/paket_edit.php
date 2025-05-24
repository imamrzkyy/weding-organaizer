<?php
include 'config.php'; // pastikan koneksi.php ini benar path-nya

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM paketpernikahan WHERE idPaket = '$id'")->fetch_assoc();

if (isset($_POST['update'])) {
    $nama = $_POST['namaPaket'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $query = "UPDATE paketpernikahan SET 
                namaPaket = '$nama', 
                deskripsi = '$deskripsi', 
                harga = '$harga' 
              WHERE idPaket = '$id'";

    if ($conn->query($query)) {
        header("Location: paket_admin.php");
        exit;
    } else {
        echo "Gagal update: " . $conn->error;
    }
}
?>

<!-- Form Edit -->
<form method="POST">
    <input type="text" name="namaPaket" value="<?= $data['namaPaket'] ?>" required>
    <input type="text" name="deskripsi" value="<?= $data['deskripsi'] ?>" required>
    <input type="number" name="harga" value="<?= $data['harga'] ?>" required>
    <button type="submit" name="update">Simpan</button>
</form>
