<?php
    include 'header.php';
    include 'config.php';
    $paket = $conn->query("SELECT * FROM paketpernikahan");
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Paket - Wedding Organizer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to bottom right, #fff5e6, #f3c623);
        font-family: 'Segoe UI', sans-serif;
    }

    .section-title {
        text-align: center;
        margin-bottom: 2rem;
        font-weight: bold;
        color: #4b0000;
        font-size: 2.5rem;
    }

    .card-package {
        border: none;
        border-radius: 20px !important;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .card-package:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        height: 250px;
        object-fit: cover;
    }

    .card-body {
        text-align: center;
        padding: 1.5rem;
    }

    .card-title {
        font-size: 1.6rem;
        font-weight: 600;
        color: #4b0000;
    }

    .card-text {
        font-size: 1rem;
        color: #6c757d;
        margin-bottom: 1rem;
    }

    .price-tag {
        font-size: 1.3rem;
        font-weight: bold;
        color: #d90000;
        margin-bottom: 1rem;
    }

    .btn-detail {
        background-color: #4b0000 !important;
        color: #fff !important;
        border-radius: 25px !important;
        padding: 0.5rem 1.5rem;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .btn-detail:hover {
        background-color: #7b0000 !important;
        color: #fff;
    }

    /* WhatsApp Floating Button */
    .wa-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 999;
    }

    .wa-button img {
        width: 160px;
    }
    </style>
</head>

<body>

<div class="container py-5">
    <h2 class="section-title">Pilihan Paket Wedding Organizer</h2>
    <div class="row g-4">
        <?php
        include 'config.php';
        $paket = $conn->query("SELECT * FROM paketpernikahan ORDER BY idPaket ASC");
        while ($p = $paket->fetch_assoc()):
            $filename = strtolower(str_replace(' ', '', $p['namaPaket'])) . '.php';
        ?>
        <div class="col-md-4">
            <div class="card card-package h-100">
                <img src="assets/img/photo-8.jpg" class="card-img-top" alt="<?= htmlspecialchars($p['namaPaket']) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($p['namaPaket']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($p['deskripsi']) ?></p>
                    <div class="price-tag">Rp <?= number_format($p['harga'], 0, ',', '.') ?></div>
                    <?php
                      // mapping manual ID ke file detail
                      $map = [
                        'paket1' => 'paketsilver.php',
                        'paket2' => 'paketgold.php',
                        'paket3' => 'paketplatinum.php',
                        'paket4' => 'paketdiamon.php'
                      ];
                    ?>
                    <a href="<?= $map[$p['idPaket']] ?? '#' ?>" class="btn btn-detail">Lihat Detail</a>

                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>


    <!-- WhatsApp Button -->
    <div class="wa-button" style="position: fixed; bottom: 20px; right: 20px;">
        <a href="https://wa.me/6289506112503" target="_blank">
            <img src="assets/img/whatsapp-icon.png" alt="Hubungi Kami via WhatsApp" style="height: 60px;">
        </a>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>