<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if (!isset($_SESSION['ses_id'])) {
  echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
  exit;
}

$idPelanggan = $_SESSION['ses_id'];

// Pastikan idPelanggan adalah angka (untuk keamanan)

$query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE idPelanggan = '$idPelanggan'");

if ($query && mysqli_num_rows($query) > 0) {
  $data = mysqli_fetch_assoc($query);
} else {
  echo "<script>alert('Data pelanggan tidak ditemukan.'); window.location='logout.php';</script>";
  exit;
}

// Pastikan semua key ada untuk menghindari undefined key
$nama = $data['nama'] ?? 'Tidak diketahui';
$email = $data['email'] ?? 'Belum diisi';
$telepon = $data['telepon'] ?? '-';
$alamat = $data['alamat'] ?? '-';

// Avatar logic
$avatarPath = 'assets/img/user_photos/' . $data['idPelanggan'] . '.jpg';
if (file_exists($avatarPath) && !empty($data['foto'])) {
  $avatar = "<img src='$avatarPath' alt='Avatar' class='profile-avatar' />";
} else {
  $initial = strtoupper(substr($nama, 0, 1));
  $avatar = "<div class='profile-avatar-initial'>{$initial}</div>";
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profil Pelanggan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background: linear-gradient(135deg, #f7f1e3, #d1ccc0);
      min-height: 100vh;
      padding: 100px 30px 30px; /* agar tidak tertutup navbar */
    }
    .profile-card {
      max-width: 600px;
      margin: 30px auto;
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
      overflow: hidden;
      padding: 30px 40px;
    }
    .profile-header {
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 30px;
    }
    .profile-avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #d81b60;
      box-shadow: 0 0 8px #d81b60aa;
    }
    .profile-avatar-initial {
      width: 100px;
      height: 100px;
      background-color: #d81b60;
      color: white;
      font-size: 50px;
      font-weight: 700;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      user-select: none;
      box-shadow: 0 0 8px #d81b60aa;
      text-transform: uppercase;
    }
    .profile-name {
      font-size: 1.9rem;
      font-weight: 700;
      color: #d81b60;
      margin-bottom: 5px;
    }
    .profile-email {
      font-size: 1rem;
      color: #777;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .profile-info th {
      width: 140px;
      font-weight: 600;
      color: #444;
      padding: 12px 0;
    }
    .profile-info td {
      color: #555;
      padding: 12px 0;
    }
    .profile-info tr:not(:last-child) td, 
    .profile-info tr:not(:last-child) th {
      border-bottom: 1px solid #eee;
    }
    .btn-group {
      margin-top: 30px;
      display: flex;
      justify-content: flex-end;
      gap: 15px;
    }
    .btn-warning {
      background-color: #f3c623;
      border-color: #f3c623;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }
    .btn-warning:hover {
      background-color: #d4a700;
      border-color: #d4a700;
    }
    .btn-danger {
      font-weight: 600;
    }
  </style>
</head>
<body>

  <?php include 'header.php'; ?>

  <div class="profile-card shadow">
    <div class="profile-header">
      <?= $avatar ?>
      <div>
        <h1 class="profile-name"><?= htmlspecialchars($data['nama']) ?></h1>
        <div class="profile-email">
          <i class="bi bi-envelope-fill"></i>
          <span><?= htmlspecialchars($email) ?></span>
        </div>
      </div>
    </div>

    <table class="profile-info w-100">
      <tbody>
        <tr>
          <th><i class="bi bi-person-badge-fill me-2"></i>ID Pelanggan</th>
          <td><?= htmlspecialchars($idPelanggan) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-telephone-fill me-2"></i>No. Telepon</th>
          <td><?= htmlspecialchars($telepon) ?></td>
        </tr>
        <tr>
          <th><i class="bi bi-geo-alt-fill me-2"></i>Alamat</th>
          <td style="white-space: pre-line;"><?= htmlspecialchars($alamat) ?></td>
        </tr>
      </tbody>
    </table>

    <div class="btn-group">
      <a href="edit_profil.php" class="btn btn-warning">
        <i class="bi bi-pencil-square me-1"></i> Edit Profil
      </a>
      <a href="login.php" class="btn btn-danger">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </a>
    </div>
  </div>

  <?php include "footer.php"; ?>

</body>
</html>