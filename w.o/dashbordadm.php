<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin - Wedding Organizer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      min-height: 100vh;
      background-color: #800000;
      color: white;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
    }
    .sidebar a:hover {
      background-color: #a52a2a;
    }
    .navbar-maroon {
      background-color: #800000;
    }
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <nav class="col-md-2 d-none d-md-block sidebar">
      <div class="pt-4">
        <h5 class="text-center fw-bold">Admin Panel</h5>
        <hr>
        <a href="#paket">Kelola Paket Pernikahan</a>
        <a href="#pelanggan">Kelola Data Pelanggan</a>
        <a href="#pesanan">Kelola Pesanan</a>
        <a href="#jadwal">Kelola Jadwal Acara</a>
        <a href="#laporan">Laporan Transaksi</a>
        <hr>
        <a href="#">Logout</a>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="col-md-10 ms-sm-auto px-md-4 py-4">
      <h2 class="mb-4">Selamat Datang, Admin!</h2>

      <!-- Section: Kelola Paket -->
      <section id="paket" class="mb-5">
        <div class="card shadow-sm">
          <div class="card-header bg-maroon text-white">
            <h5>Kelola Paket Pernikahan</h5>
          </div>
          <div class="card-body">
            <button class="btn btn-sm btn-success mb-2">+ Tambah Paket</button>
            <!-- Table Paket -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID Paket</th>
                  <th>Nama</th>
                  <th>Deskripsi</th>
                  <th>Harga</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <!-- Data dari PHP/DB -->
                <tr>
                  <td>PKT001</td>
                  <td>Silver</td>
                  <td>Paket sederhana untuk pernikahan kecil</td>
                  <td>Rp 5.000.000</td>
                  <td>
                    <button class="btn btn-warning btn-sm">Edit</button>
                    <button class="btn btn-danger btn-sm">Hapus</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Section: Kelola Pelanggan -->
      <section id="pelanggan" class="mb-5">
        <div class="card shadow-sm">
          <div class="card-header bg-maroon text-white">
            <h5>Kelola Data Pelanggan</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Telepon</th>
                  <th>Alamat</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>PLG001</td>
                  <td>Rina Andini</td>
                  <td>rina@mail.com</td>
                  <td>08123456789</td>
                  <td>Jakarta</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Section: Kelola Pesanan -->
      <section id="pesanan" class="mb-5">
        <div class="card shadow-sm">
          <div class="card-header bg-maroon text-white">
            <h5>Kelola Pesanan</h5>
          </div>
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID Pesanan</th>
                  <th>Pelanggan</th>
                  <th>Paket</th>
                  <th>Status</th>
                  <th>Pembayaran</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>PSN001</td>
                  <td>Rina</td>
                  <td>Silver</td>
                  <td>Menunggu</td>
                  <td>Belum Bayar</td>
                  <td>
                    <button class="btn btn-sm btn-primary">Update</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>

      <!-- Section: Kelola Jadwal -->
      <section id="jadwal" class="mb-5">
        <div class="card shadow-sm">
          <div class="card-header bg-maroon text-white">
            <h5>Kelola Jadwal Acara</h5>
          </div>
          <div class="card-body">
            <p><i>Fitur penjadwalan bisa diisi di sini (misal tanggal acara, vendor, dll)</i></p>
          </div>
        </div>
      </section>

      <!-- Section: Laporan Transaksi -->
      <section id="laporan">
        <div class="card shadow-sm">
          <div class="card-header bg-maroon text-white">
            <h5>Laporan Transaksi</h5>
          </div>
          <div class="card-body">
            <p><i>Tampilkan laporan pemasukan per bulan/tahun di sini.</i></p>
          </div>
        </div>
      </section>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
