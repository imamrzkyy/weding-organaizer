<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

include 'config.php';

// Ambil jumlah keranjang
$jumlah_pesanan = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

// Ambil data nama pelanggan dari session dan database
$namaUser = "User";
if (isset($_SESSION['ses_id'])) {
    $idPelanggan = $_SESSION['ses_id'];
    $query = mysqli_query($conn, "SELECT nama FROM pelanggan WHERE idPelanggan = '$idPelanggan'");
    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        $namaUser = $data['nama'];
    }
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-maroon py-3">
    <div class="container">

        <!-- Menu kiri -->
        <ul class="navbar-nav me-auto d-flex flex-row gap-4">
            <li class="nav-item"><a class="nav-link" href="index.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link" href="about.php">ABOUT</a></li>
            <li class="nav-item"><a class="nav-link" href="pricelist.php">PRICE LIST</a></li>
        </ul>

        <!-- Logo tengah -->
        <a class="navbar-brand mx-auto d-none d-lg-block" href="index.php">
            <img src="assets/img/STIKER ARTPRO.png" alt="Logo Sanggar Liza" style="max-height: 50px;" />
        </a>

        <!-- Menu kanan -->
        <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-3">

            <!-- Keranjang -->
            <li class="nav-item">
                <a class="nav-link text-white position-relative" href="keranjang.php">
                    <i class="bi bi-cart cart-icon"></i>
                    <?php if ($jumlah_pesanan > 0): ?>
                    <span class="cart-badge position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">
                        <?= $jumlah_pesanan ?>
                    </span>
                    <?php endif; ?>
                </a>
            </li>

            <!-- Dropdown Hai, Nama -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Hai, <strong><?= htmlspecialchars($namaUser) ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="profil.php"><i class="bi bi-person-circle me-2"></i>Profil</a></li>
                </ul>
            </li>

            <!-- Tombol Logout -->
            <li class="nav-item">
                <a href="login.php" class="btn btn-warning text-dark fw-semibold px-3 py-1">Log Out</a>
            </li>
        </ul>

    </div>
</nav>

<style>
.bg-maroon {
    background-color: #4b0000;
}
.cart-icon {
    font-size: 1.2rem;
    color: #F3C623;
}
.cart-badge {
    font-size: 0.75rem;
    font-weight: bold;
}
.navbar-nav .nav-link:hover {
    color: #F3C623 !important;
}
</style>

