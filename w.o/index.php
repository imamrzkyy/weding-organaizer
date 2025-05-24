<?php
    include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wedding Organizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 65px 0 150px 0;
    }

    /* Hero Section */
    .hero {
        background-image: url('assets/img/bg_login.jpg');
        /* Ganti dengan background emas kamu */
        background-size: auto;
        background-position: center;
        padding: 150px 0;
        color: #4a2e2e;
        text-align: center;
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .hero p {
        font-size: 1.8rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    /* Why Us Section */
    .why-us {
        background-color: #4a0101;
        color: white;
        padding: 80px 0;
        text-align: center;
    }

    .why-us h2 {
        font-size: 2rem;
        font-weight: bold;
        color: #f3c623;
        border-bottom: 2px solid #f3c623;
        display: inline-block;
        padding-bottom: 5px;
        margin-bottom: 20px;
    }

    .why-us p {
        max-width: 800px;
        margin: 0 auto 30px;
        font-size: 1rem;
    }

    .btn-maroon {
        background-color: #4b0000 !important;
        color: white;
    }

    .btn-maroon:hover {
        background-color: #750000 !important;
        color: #F3C623;
    }

    .btn-outline-gold {
        border: 1px solid #f3c623 !important;
        color: #fff !important;
        background-color: transparent;
        padding: 10px 25px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 10px;
    }

    .btn-outline-gold:hover {
        background-color: #f3c623 !important;
        color: #000 !important;
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

    @media (max-width: 576px) {
        .hero h1 {
            font-size: 2rem;
        }

        .wa-button img {
            width: 120px;
        }
    }

    .portfolio-img-wrapper {
        height: 300px;
        overflow: hidden;
        position: relative;
    }

    .portfolio-img-wrapper img {
        transition: transform 0.5s ease;
    }

    .portfolio-img-wrapper:hover img {
        transform: scale(1.1);
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        background: rgba(75, 0, 0, 0.6);
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .portfolio-img-wrapper:hover .overlay {
        opacity: 1;
    }

    .overlay h5 {
        color: #F3C623;
        font-weight: bold;
    }

    .bg-maroon {
        background-color: #4b0000;
    }

    .text-maroon {
        color: #800000;
    }
    </style>
</head>

<body>
    <?php
    include 'header.php';
?>

    <!-- Hero Section -->
    <section class="hero">
        <h1>ART PRODUCTION</h1>
        <p>Because it’s your wedding, every detail matters.</p>
    </section>

    <!-- WHY US Section -->
    <section class="why-us">
        <h2>WHY US?</h2>
        <h1>Because it’s your wedding, every detail matters.</h1>
        <p>Art Wedding Organizer memiliki team dengan individu-individu profesional, memiliki pengalaman bertahun-tahun
            dalam sukses melaksanakan acara pernikahan.
        </p>
        <div>
            <a href="#" class="btn btn-outline-gold" data-bs-toggle="modal" data-bs-target="#orderModal">Orders Packet
                →</a>
            <a href="pricelist.php" class="btn btn-outline-gold">Price List →</a>
        </div>
    </section>
    <!-- Modal Pemesanan -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header bg-maroon text-white">
                    <h5 class="modal-title fw-bold" id="orderModalLabel">Form Pemesanan Wedding Organizer</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="" method="post" id="formPesanan">
                        <!-- Simulasi session -->
                        <input type="hidden" name="idPelanggan" value="USR001">

                        <div class="mb-3">
                            <label for="namaPelanggan" class="form-label">Nama Pelanggan</label>
                            <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan" required>
                        </div>

                        <!-- Input ID Paket -->
                        <div class="mb-3">
                            <label for="idPaket" class="form-label">Pilih Paket</label>
                            <select class="form-select" name="idPaket" id="idPaket" required>
                                <option selected disabled value="">Pilih salah satu</option>
                                <option value="paket1" data-harga="5000000">Paket Silver - Rp 5.000.000</option>
                                <option value="paket2" data-harga="8000000">Paket Gold - Rp 8.000.000</option>
                                <option value="paket3" data-harga="12000000">Paket Platinum - Rp 12.000.000</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggalPesan" class="form-label">Tanggal Acara</label>
                            <input type="date" class="form-control" name="tanggalPesan" required>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="mb-3">
                            <label for="metodePembayaran" class="form-label">Metode Pembayaran</label>
                            <select class="form-select" name="metodePembayaran" id="metodePembayaran" required>
                                <option value="DP">DP (50%)</option>
                                <option value="Lunas">Lunas (100%)</option>
                            </select>
                        </div>

                        <!-- Input Tersembunyi -->
                        <input type="hidden" name="jumlahPembayaran" id="jumlahPembayaran">

                        <!-- Harga yang ditampilkan -->
                        <div class="mb-3 text-end">
                            <strong>Total Pembayaran: <span id="hargaTampil">Rp 0</span></strong>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-end">
                            <button id="pay-button" class="btn btn-maroon text-white">Bayar Sekarang</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BLUyugD7t0NiNWmy">
    </script>
    <script>
    const form = document.getElementById("formPesanan")
    const paketSelect = document.getElementById("idPaket");
    const metodeSelect = document.getElementById("metodePembayaran");
    const jumlahPembayaranInput = document.getElementById("jumlahPembayaran");
    const hargaTampil = document.getElementById("hargaTampil");
    const payButton = document.getElementById("pay-button")

    payButton.addEventListener("click", async (e) => {
        e.preventDefault()

        const formData = new FormData(form)

        await fetch('checkout-process.php', {
                method: 'POST',
                body: formData
            })
            .then(async (response) => {
                const data = await response.json()

                snap.pay(data.token, {
                    // Optional
                    onSuccess: function(result) {
                          // Kirim data ke server untuk disimpan
                          const formData = new FormData(form);

                          formData.append("transactionId", result.transaction_id);
                          formData.append("statusPembayaran", result.transaction_status);

                          fetch('simpan_pesanan.php', {
                              method: 'POST',
                              body: formData
                          })
                          .then(res => res.json())
                          .then(data => {
                              if (data.status === "success") {
                                  alert("Pesanan berhasil disimpan!");
                                  window.location.href = "keranjang.php";
                              } else {
                                  alert("Gagal menyimpan pesanan: " + data.message);
                              }
                          })
                          .catch(err => {
                              console.error("Error saat simpan:", err);
                              alert("Terjadi kesalahan saat menyimpan pesanan.");
                          });
                      },

                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(
                                result, null, 2);
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        document.getElementById('result-json').innerHTML += JSON
                            .stringify(
                                result, null, 2);
                    }
                });
            })
            .catch(() => {

            })


    })

    function updateHarga() {
        const selectedOption = paketSelect.options[paketSelect.selectedIndex];
        const harga = parseFloat(selectedOption.getAttribute("data-harga")) || 0;
        const metode = metodeSelect.value;
        let total = harga;

        if (metode === "DP") {
            total = harga * 0.5;
        }

        jumlahPembayaranInput.value = total;
        hargaTampil.textContent = "Rp " + total.toLocaleString("id-ID");
    }



    paketSelect.addEventListener("change", updateHarga);
    metodeSelect.addEventListener("change", updateHarga);
    </script>



    <section class="py-5 bg-white" id="portfolio">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-uppercase" style="color: #4b0000;">Portofolio Kami</h2>
                <p class="text-muted">Kami telah menangani berbagai konsep pernikahan impian dengan
                    profesionalisme dan
                    sentuhan personal.</p>
            </div>

            <div class="row g-4">
                <!-- Portfolio Card -->
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg overflow-hidden rounded-4" data-bs-toggle="modal"
                        data-bs-target="#portfolioModal1">
                        <div class="portfolio-img-wrapper position-relative">
                            <img src="assets/img/photo-8.jpg" class="w-100 h-100 object-fit-cover" alt="Wedding 1">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <h5 class="text-white text-center">Guntur & Caca<br><small>Adat Jawa
                                        Modern</small></h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg overflow-hidden rounded-4" data-bs-toggle="modal"
                        data-bs-target="#portfolioModal2">
                        <div class="portfolio-img-wrapper position-relative">
                            <img src="assets/img/photo-8.jpg" class="w-100 h-100 object-fit-cover" alt="Wedding 2">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <h5 class="text-white text-center">Agung & Shyntia<br><small>Garden Party
                                        Rustic</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg overflow-hidden rounded-4" data-bs-toggle="modal"
                        data-bs-target="#portfolioModal3">
                        <div class="portfolio-img-wrapper position-relative">
                            <img src="assets/img/photo-8.jpg" class="w-100 h-100 object-fit-cover" alt="Wedding 3">
                            <div class="overlay d-flex align-items-center justify-content-center">
                                <h5 class="text-white text-center">Dito & Kia<br><small>Elegant Ballroom</small>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal 1 -->
    <div class="modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1Label"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-maroon text-white border-0">
                    <h5 class="modal-title fw-bold" id="portfolioModal1Label">Pernikahan Guntur & Caca</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <!-- Gambar dengan Carousel dan Padding -->
                        <div class="col-md-6">
                            <div class="p-3">
                                <!-- Padding semua sisi -->
                                <div id="portfolioCarousel1" class="carousel slide rounded" data-bs-ride="carousel">
                                    <div class="carousel-inner rounded-3">
                                        <div class="carousel-item active">
                                            <img src="assets/img/photo-8.jpg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 1">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/bg_login.jpg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 2">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="assets/img/photo-8.jpg" class="d-block w-100"
                                                style="max-height: 300px; object-fit: cover;" alt="Slide 3">
                                        </div>
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#portfolioCarousel1" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#portfolioCarousel1" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-md-6 d-flex flex-column justify-content-center p-4">
                            <div>
                                <h4 class="fw-bold">Adat Jawa Modern</h4>
                                <p class="text-muted">
                                    Diselenggarakan di Balai Krakatau, acara ini memadukan adat Jawa klasik dengan
                                    sentuhan
                                    modern minimalis. Kami menangani semua aspek mulai dari dekorasi, tata rias,
                                    hingga
                                    pengaturan kursi VIP.
                                </p>
                                <ul class="list-unstyled text-muted">
                                    <li><i class="bi bi-calendar-event"></i> 18 November 2024</li>
                                    <li><i class="bi bi-geo-alt"></i> Gedung Balai Krakatau, Bandar Lampung</li>
                                    <li><i class="bi bi-people-fill"></i> 500 Tamu Undangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal 2 -->
    <div class="modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-maroon text-white">
                    <h5 class="modal-title">Andre & Sheila</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <img src="assets/img/portfolio2.jpg" class="img-fluid w-100" alt="">
                    <div class="p-4">
                        <p class="text-muted">Garden party intimate dengan tema rustic pastel di pinggir pantai
                            Bali.
                            Suasana romantis dengan lampu gantung dan bunga segar.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal 3 -->
    <div class="modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3Label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-maroon text-white">
                    <h5 class="modal-title">Kevin & Lina</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <img src="assets/img/portfolio3.jpg" class="img-fluid w-100" alt="">
                    <div class="p-4">
                        <p class="text-muted">Konsep internasional klasik elegan di ballroom hotel Jakarta
                            dengan tata
                            cahaya glamor dan orkestra mewah.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section id="testimoni" class="py-5" style="background: linear-gradient(to bottom right, #fff5e6, #f3c623);">
        <div class="container">
            <h2 class="text-center fw-bold mb-5 text-maroon">Apa Kata Klien Kami</h2>

            <div class="row g-4 mb-5">
                <!-- Testimoni 1 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body bg-white rounded-4">
                            <p class="fst-italic mb-4">"Acara pernikahan kami sangat berkesan. Pelayanan yang
                                luar biasa
                                dari awal hingga akhir. Terima kasih banyak!"</p>
                            <hr>
                            <h6 class="fw-bold mb-0 text-maroon">Anita & Riko</h6>
                            <small class="text-muted">Jakarta, 2024</small>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body bg-white rounded-4">
                            <p class="fst-italic mb-4">"Konsep dan dekorasi sangat sesuai dengan impian kami.
                                Semua tamu
                                pun sangat puas. Highly recommended!"</p>
                            <hr>
                            <h6 class="fw-bold mb-0 text-maroon">Dewi & Ardi</h6>
                            <small class="text-muted">Bandung, 2024</small>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body bg-white rounded-4">
                            <p class="fst-italic mb-4">"Tim WO sangat ramah dan profesional. Tidak ada yang
                                perlu
                                dikhawatirkan di hari H. Semua berjalan sempurna!"</p>
                            <hr>
                            <h6 class="fw-bold mb-0 text-maroon">Sarah & Dimas</h6>
                            <small class="text-muted">Surabaya, 2025</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Tambah Testimoni -->
            <div class="bg-white p-4 rounded-4 shadow-sm">
                <h5 class="text-maroon mb-3">Buat Testimoni</h5>
                <form action="proses_testimoni.php" method="POST">
                    <div class="mb-3">
                        <label for="idPelanggan" class="form-label">ID Pelanggan</label>
                        <input type="text" class="form-control" id="idPelanggan" name="idPelanggan" required>
                    </div>
                    <div class="mb-3">
                        <label for="isiTestimoni" class="form-label">Isi Testimoni</label>
                        <textarea class="form-control" id="isiTestimoni" name="isiTestimoni" rows="3"
                            required></textarea>
                    </div>
                    <button type="submit" class="btn btn-maroon ">Kirim Testimoni</button>
                </form>
            </div>

        </div>
    </section>





    <!-- WhatsApp Button -->
    <div class="wa-button">
        <a href="https://wa.me/6289506112503" target="_blank">
            <img src="assets/img/whatsapp-icon.png" alt="Hubungi Kami via WhatsApp">
        </a>
    </div>
</body>

</html>

<?php
include "footer.php"
?>