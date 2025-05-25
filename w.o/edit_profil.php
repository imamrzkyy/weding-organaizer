<?php
session_start();
include 'config.php';

if (!isset($_SESSION['ses_id'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
  exit;
}

$idPelanggan = $_SESSION['ses_id'];

// Ambil data pelanggan saat ini
$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE idPelanggan = '$idPelanggan'");
if (!$query || mysqli_num_rows($query) == 0) {
  echo "<script>alert('Data pelanggan tidak ditemukan.'); window.location='logout.php';</script>";
  exit;
}
$data = mysqli_fetch_assoc($query);

$error = '';
$success = '';

// Proses form submit
if (isset($_POST['submit'])) {
  // Ambil data dari form dengan aman
  $nama = mysqli_real_escape_string($conn, trim($_POST['nama']));
  $email = mysqli_real_escape_string($conn, trim($_POST['email']));
  $telepon = mysqli_real_escape_string($conn, trim($_POST['telepon']));
  $alamat = mysqli_real_escape_string($conn, trim($_POST['alamat']));

  // Validasi sederhana
  if (empty($nama) || empty($email)) {
    $error = 'Nama dan Email wajib diisi.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = 'Format email tidak valid.';
  } else {
    // Update data ke database
    $sql_update = "UPDATE pelanggan SET 
      nama = '$nama',
      email = '$email',
      telepon = '$telepon',
      alamat = '$alamat'
      WHERE idPelanggan = '$idPelanggan'";

    if (mysqli_query($conn, $sql_update)) {
      $success = "Profil berhasil diperbarui.";
      // Update data lokal agar form terisi ulang dengan data terbaru
      $data['nama'] = $nama;
      $data['email'] = $email;
      $data['telepon'] = $telepon;
      $data['alamat'] = $alamat;
    } else {
      $error = "Terjadi kesalahan: " . mysqli_error($conn);
    }
  }
} else {
  // Jika belum submit, isi variabel untuk form dari data DB
  $nama = $data['nama'];
  $email = $data['email'];
  $telepon = $data['telepon'];
  $alamat = $data['alamat'];
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Profil</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
       background: linear-gradient(135deg, #f7f1e3, #d1ccc0);
      min-height: 100vh;
      padding: 100px 30px 30px;
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }
    .edit-card {
      max-width: 600px;
      width: 100%;
      margin: 30px auto;
      background: white;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
      padding: 30px 40px;
    }
    .btn-primary {
      background-color: #d81b60;
      border-color: #d81b60;
    }
    .btn-primary:hover {
      background-color: #b3174d;
      border-color: #b3174d;
    }
  </style>
</head>
<body>

  <div class="edit-card">
    <h2 class="mb-4 text-center text-danger">Edit Profil Saya</h2>

    <?php if ($success): ?>
      <div class="alert alert-success text-center mb-4"><?= htmlspecialchars($success) ?></div>
      <div class="text-center">
        <a href="profil.php" class="btn btn-primary">Kembali ke Profil</a>
      </div>
    <?php else: ?>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" class="form-control" required
            value="<?= htmlspecialchars($nama) ?>" />
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Alamat Email</label>
          <input type="email" id="email" name="email" class="form-control" required
            value="<?= htmlspecialchars($email) ?>" />
        </div>
        <div class="mb-3">
          <label for="telepon" class="form-label">No. Telepon</label>
          <input type="text" id="telepon" name="telepon" class="form-control"
            value="<?= htmlspecialchars($telepon) ?>" />
        </div>
        <div class="mb-3">
          <label for="alamat" class="form-label">Alamat</label>
          <textarea id="alamat" name="alamat" class="form-control" rows="3"><?= htmlspecialchars($alamat) ?></textarea>
        </div>
        <div class="d-flex justify-content-between">
          <a href="profil.php" class="btn btn-secondary">Batal</a>
          <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    <?php endif; ?>
  </div>

<?php include 'footer.php'; ?>

</body>
</html>