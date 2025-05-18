<?php
include 'header.php'
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Paket Gold - Wedding Organizer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(to bottom right, #fffaf0, #f3c623);
        font-family: 'Segoe UI', sans-serif;
    }

    .back-btn {
        margin-top: 30px;
        display: inline-block;
        background-color: #4b0000;
        color: #fff;
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .back-btn:hover {
        background-color: #7b0000;
    }

    .detail-title {
        color: #4b0000;
        font-size: 2.5rem;
        font-weight: bold;
    }

    .price-tag {
        font-size: 1.8rem;
        color: #d90000;
        font-weight: bold;
        margin-top: 15px;
    }

    .package-img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
    }

    .package-features li {
        margin-bottom: 10px;
        font-size: 1.1rem;
        color: #4b0000;
    }

    .btn-cs {
        background-color: #4b0000;
        color: #fff;
        padding: 12px 24px;
        border-radius: 30px;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        transition: background-color 0.3s ease;
    }

    .btn-cs:hover {
        background-color: #7b0000;
    }
    </style>
</head>

<body>

    <div class="container pt-md-4 pt-5 pb-5">
        <a href="pricelist.php" class="back-btn">← Kembali ke Daftar Paket</a>

        <div class="row mt-4 align-items-center">
            <!-- Gambar Paket -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="assets/img/photo-8.jpg" alt="Paket Silver" class="package-img">
            </div>

            <!-- Detail Paket -->
            <div class="col-md-6 d-flex flex-column justify-content-center"
                style="min-height: 100%; margin-top: -140px;">
                <h1 class="detail-title">Paket Gold</h1>
                <p class="text-muted">Solusi lengkap untuk pernikahan berkelas.</p>

                <ul class="package-features">
                    <li>✨ Dekorasi pelaminan sederhana & elegan</li>
                    <li>💄 Rias pengantin (akad & resepsi)</li>
                    <li>🎤 MC & Wedding Organizer (4 orang)</li>
                    <li>📸 Dokumentasi foto (2 fotografer)</li>
                    <li>🎂 Kue Pernikahan & Buku Tamu</li>
                    <li>💌 Undangan digital</li>
                    <li>📅 Konsultasi perencanaan + 1 kali meeting</li>
                </ul>

                <div class="price-tag">Rp 25.000.000</div>

                <a href="https://wa.me/62xxxxxxxxxx" target="_blank" class="btn-cs">💬 Konsultasi via WhatsApp</a>
            </div>
        </div>
    </div>

</body>

</html>