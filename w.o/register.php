<?php
    include "config.php";
    session_start();

    if (isset($_POST['btnRegister'])) {
      $nama = mysqli_real_escape_string($conn, $_POST['nama']);
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
      $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
  
      // Cek apakah email sudah digunakan
      $check_user = mysqli_query($conn, "SELECT * FROM pelanggan WHERE email='$email'");
      if (mysqli_num_rows($check_user) > 0) {
          $error_message = "Email sudah digunakan!";
      } else {
          // Ambil ID terakhir
          $query = mysqli_query($conn, "SELECT idPelanggan FROM pelanggan ORDER BY idPelanggan DESC LIMIT 1");
          $last_id = mysqli_fetch_assoc($query);
          $last_id_pelanggan = $last_id ? $last_id['idPelanggan'] : 'P000';
  
          // Ambil angka dari ID terakhir dan tambahkan 1
          $last_num = intval(substr($last_id_pelanggan, 1)) + 1;
          $new_id = 'P' . str_pad($last_num, 3, '0', STR_PAD_LEFT);
  
          // Simpan user baru
          $insert = mysqli_query($conn, "INSERT INTO pelanggan (idPelanggan, nama, email, password, alamat, telepon) 
              VALUES ('$new_id', '$nama', '$email', '$password', '$alamat', '$telepon')");
              
          if ($insert) {
              echo "<script>
                  alert('Registrasi berhasil! Silakan login.');
                  window.location.href = 'login.php';
              </script>";
              exit();
          } else {
              $error_message = "Gagal mendaftar. Coba lagi.";
          }
      }
  }
  
  
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Wedding Organizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
    body {
        background-image: url('assets/img/bg_login.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .brand-logo {
        font-size: 2rem;
        font-weight: bold;
        color: #d81b60;
    }

    .form-control:focus {
        border-color: #d81b60;
        box-shadow: 0 0 0 0.2rem rgba(216, 27, 96, 0.25);
    }

    .btn-orange {
        background-color: #F3C623;
        color: white;
    }

    .btn-orange:hover {
        background-color: rgb(237, 210, 152);
    }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card p-4">
                    <div class="text-center mb-4">
                        <div class="text-center mb-4">
                            <img src="assets/img/STIKER ARTPRO.png" alt="Logo Wedding Organizer" class="img-fluid"
                                style="max-width: 250px;">
                        </div>

                    </div>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="nama" placeholder="Enter Full Name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="you@gmail.com"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="••••••••" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Jl. ----"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="telepon" name="telepon"
                                placeholder="081234567890" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="btnRegister" class="btn btn-orange">Daftar</button>
                        </div>
                        <div class="mt-3 text-center">
                            <small>Belum punya akun? <a href="login.php">Login</a></small>
                        </div>
                    </form>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>