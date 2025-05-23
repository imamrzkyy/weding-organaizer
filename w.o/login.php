<?php
include 'config.php';
session_start();

if (isset($_POST['btnLogin'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Cek admin
    $sql_admin = "SELECT * FROM admin WHERE email_admin='$email' AND password_admin='$password'";
    $query_admin = mysqli_query($conn, $sql_admin);

    // Cek user
    // $sql_user = "SELECT * FROM users WHERE email='$email' AND password_user='$password'";
    // $query_user = mysqli_query($conn, $sql_user);

    // Cek pelanggan
    $sql_pelanggan = "SELECT * FROM pelanggan WHERE email='$email' AND password='$password'";
    $query_pelanggan = mysqli_query($conn, $sql_pelanggan);

    if (mysqli_num_rows($query_admin) == 1) {
        $data = mysqli_fetch_assoc($query_admin);
        $_SESSION["ses_id"] = $data["id_admin"];
        $_SESSION["ses_nama"] = $data["nama_admin"];
        $_SESSION["ses_email"] = $data["email_admin"];
        $_SESSION["ses_level"] = "admin";

        echo "<script>
            alert('Login Berhasil sebagai Admin!');
            window.location.href = 'dashbordadm.php';
        </script>";
        exit();
    } elseif (mysqli_num_rows($query_pelanggan) == 1) {
        $data = mysqli_fetch_assoc($query_pelanggan);
        $_SESSION["ses_id"] = $data["idPelanggan"];
        $_SESSION["ses_nama"] = $data["nama"];
        $_SESSION["ses_email"] = $data["email"];
        $_SESSION["ses_level"] = $data["ses_level"];

        echo "<script>
            alert('Selamat Datang {$data['nama']}!');
            window.location.href = 'index.php';
        </script>";
        exit();
    } else {
        $error_message = "Email atau Password salah!";
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Wedding Organizer</title>
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
        overflow: hidden;
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
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Kata Sandi</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="••••••••" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="btnLogin" class="btn btn-orange">Masuk</button>
                        </div>
                    </form>
                    <div class="mt-3 text-center">
                        <small>Belum punya akun? <a href="register.php">Daftar</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php if (!empty($error_message)): ?>
<div class="alert alert-danger text-center">
    <?= $error_message ?>
</div>
<?php endif; ?>

</html>
