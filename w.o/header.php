<?php
    include 'config.php';

    // Hitung jumlah pesanan di keranjang
    $jumlah_pesanan = 0;
    if (isset($_SESSION['cart'])) {
        $jumlah_pesanan = count($_SESSION['cart']);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Paket - Wedding Organizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
    .navbar {
        overflow: hidden;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
    }

    .bg-maroon {
        background-color: #4b0000;
    }

    .navbar-nav .nav-link {
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .navbar .navbar-brand {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1;
    }

    .navbar-brand img {
        max-height: 50px;
    }

    .nav-link.text-warning {
        color: #F3C623 !important;
    }

    .nav-link:hover {
        color: #F3C623 !important;
    }

    .cart-icon {
        font-size: 1.2rem;
        color: #F3C623;
        display: flex;
        align-items: center;
        position: relative;
    }

    .cart-badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background-color: #F3C623;
        color: #4b0000;
        border-radius: 50%;
        padding: 2px 6px;
        font-size: 0.75rem;
        font-weight: bold;
    }

    .navbar-nav .nav-item {
        display: flex;
        align-items: center;
    }

    .navbar-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-maroon py-3">
            <div class="container">

                <!-- Kiri -->
                <ul class="navbar-nav me-auto d-flex flex-row gap-4">
                    <li class="nav-item"><a class="nav-link text-white" href="index.php">HOME</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="about.php">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="pricelist.php">Price list</a></li>
                </ul>

                <!-- Logo Tengah -->
                <a class="navbar-brand mx-auto d-none d-lg-block">
                    <img src="assets/img/STIKER ARTPRO.png" alt="Sanggar Liza Logo">
                </a>

                <!-- Kanan -->
                <ul class="navbar-nav ms-auto d-flex flex-row gap-4">
                    <!-- Keranjang Belanja -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="keranjang.php">
                            <i class="bi bi-cart cart-icon"></i>
                            <span class="cart-badge"><?php echo $jumlah_pesanan; ?></span>
                        </a>
                    </li>

                    <!-- Log Out -->
                    <li class="nav-item"><a class="nav-link text-white" href="login.php">Log Out</a></li>
                </ul>

            </div>
        </nav>
    </header>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>