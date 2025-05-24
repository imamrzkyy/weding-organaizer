<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "wo_web");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Tambah Paket
if (isset($_POST['tambah_paket'])) {
    $id = $_POST['idPaket'];
    $nama = $_POST['namaPaket'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $koneksi->query("INSERT INTO paketpernikahan (namaPaket, deskripsi, harga) VALUES ('$nama', '$deskripsi', '$harga')");
    header("Location: dashbordadm.php#paket");
    exit;
}

// Edit Paket
if (isset($_POST['edit_paket'])) {
  $id = $_POST['idPaket'];
  $nama = $_POST['namaPaket'];
  $deskripsi = $_POST['deskripsi'];
  $harga = $_POST['harga'];

  $koneksi->query("UPDATE paketpernikahan SET namaPaket='$nama', deskripsi='$deskripsi', harga='$harga' WHERE idPaket='$id'");
  
  // Redirect supaya tidak mengulang submit saat refresh
  header("Location: dashbordadm.php");
  exit;
}



// Hapus Paket
if (isset($_GET['hapus_paket'])) {
    $id = $_GET['hapus_paket'];
    $koneksi->query("DELETE FROM paketpernikahan WHERE idPaket='$id'");
    header("Location: dashbordadm.php#paket");
}

// Update Pesanan Manual (opsional)
if (isset($_POST['update_pesanan'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $pembayaran = $_POST['jumlahPembayaran'];
    $koneksi->query("UPDATE pesanan SET statusPembayaran='$status', jumlahPembayaran='$pembayaran' WHERE id='$id'");
    header("Location: dashbordadm.php#pesanan");
}

// Hapus Pesanan
if (isset($_GET['hapus_pesanan'])) {
    $id = $_GET['hapus_pesanan'];
    $koneksi->query("DELETE FROM pesanan WHERE id='$id'");
    header("Location: dashbordadm.php#pesanan");
    exit;
}


if (isset($_GET['selesai_pesanan'])) {
  $id = $_GET['selesai_pesanan'];

  // Ambil data pesanan sebelum update
  $result = $koneksi->query("
      SELECT p.*, pl.nama AS namaPelanggan, pk.namaPaket
      FROM pesanan p
      LEFT JOIN pelanggan pl ON p.idPelanggan = pl.idPelanggan
      LEFT JOIN paketpernikahan pk ON p.idPaket = pk.idPaket
      WHERE p.id = '$id'
  ");

  $data = $result->fetch_assoc();
  $nama = $data['namaPelanggan'];
  $paket = $data['namaPaket'];
  $jumlah = $data['jumlahPembayaran'];
  $tanggal = date('Y-m-d');

  // Update pesanan ke selesai dan status pembayaran ke Lunas TANPA ubah jumlah
  $koneksi->query("UPDATE pesanan SET statusPesanan='selesai', statusPembayaran='Lunas' WHERE id='$id'");

  // Insert ke laporan transaksi
  $koneksi->query("
      INSERT INTO laporantransaksi (namaPelanggan, namaPaket, jumlah, tanggal)
      VALUES ('$nama', '$paket', '$jumlah', '$tanggal')
  ");

  // Redirect ke laporan
  $bulan = date('m');
  $tahun = date('Y');
  header("Location: dashbordadm.php#laporan&bulan=$bulan&tahun=$tahun");
  exit;

  
}

// Ambil Data
$paket = $koneksi->query("SELECT * FROM paketpernikahan");
$pelanggan = $koneksi->query("SELECT * FROM pelanggan");
$pesanan = $koneksi->query("SELECT * FROM pesanan");

// Ambil data laporan berdasarkan bulan dan tahun jika ada
$bulanFilter = $_GET['bulan'] ?? date('m');
$tahunFilter = $_GET['tahun'] ?? date('Y');
$laporan = $koneksi->query("SELECT * FROM pesanan WHERE MONTH(tanggalPesan) = '$bulanFilter' AND YEAR(tanggalPesan) = '$tahunFilter'");
?>

<!DOCTYPE html>
<html>
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>

<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { background: #800000; color: #fff; min-height: 100vh; padding-top: 20px; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; }
        .sidebar a:hover { background-color: #a52a2a; }
        .bg-maroon { background-color: #800000; color: white; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <h5 class="text-center">Admin Panel</h5>
            <a href="#paket">Kelola Paket Pernikahan</a>
            <a href="#pelanggan">Kelola Data Pelanggan</a>
            <a href="#pesanan">Kelola Pesanan</a>
            <a href="#jadwal">Kelola Jadwal Acara</a>
            <a href="#laporan">Laporan Transaksi</a>
            <a href="login.php">Logout</a>
        </div>
        <div class="col-md-10 p-4">
            <h2>Selamat Datang, Admin!</h2>

            <!-- Paket -->
            <section id="paket">
                <div class="card mb-4">
                    <div class="card-header bg-maroon">Kelola Paket Pernikahan</div>
                    <div class="card-body">
                        <form method="post" class="mb-3">
                            <div class="row g-2">
                                <div class="col-md-3"><input name="namaPaket " class="form-control" placeholder="Nama Paket" required></div>
                                <div class="col-md-4"><input name="deskripsi" class="form-control" placeholder="Deskripsi" required></div>
                                <div class="col-md-3"><input name="harga" class="form-control" type="number" placeholder="Harga" required></div>
                                <div class="col-md-2"><button name="tambah_paket" class="btn btn-success w-100">+ Tambah</button></div>
                            </div>
                        </form>
                        <table class="table table-bordered">
                            <thead><tr><th>ID</th><th>Nama Paket</th><th>Deskripsi</th><th>Harga</th><th>Aksi</th></tr></thead>
                            <tbody>

                            <?php while($p = $paket->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $p['idPaket'] ?></td>
                                    <td><?= $p['namaPaket'] ?></td>
                                    <td><?= $p['deskripsi'] ?></td>
                                    <td>Rp <?= number_format($p['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <form method="post" class="d-inline">
                                            <input type="hidden" name="idPaket" value="<?= $p['idPaket'] ?>">
                                            <input type="hidden" name="namaPaket" value="<?= $p['namaPaket'] ?>">
                                            <input type="hidden" name="deskripsi" value="<?= $p['deskripsi'] ?>">
                                            <a href="?edit_paket=<?= $p['idPaket'] ?>" class="btn btn-warning btn-sm">Edit</a>

                                        </form>
                                        <a href="?hapus_paket=<?= $p['idPaket'] ?>" onclick="return confirm('Hapus paket ini?')" class="btn btn-danger btn-sm">Hapus</a>
                                        
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </section>

            <!-- Pelanggan -->
            <section id="pelanggan">
                <div class="card mb-4">
                    <div class="card-header bg-maroon">Kelola Data Pelanggan</div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Alamat</th></tr></thead>
                            <tbody>
                            <?php while($pl = $pelanggan->fetch_assoc()): ?>
                                <tr><td><?= $pl['idPelanggan'] ?></td><td><?= $pl['nama'] ?></td><td><?= $pl['email'] ?></td><td><?= $pl['alamat'] ?></td></tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- Pesanan -->
            <section id="pesanan">
        <div class="card mb-4">
            <div class="card-header bg-maroon">Kelola Pesanan</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Status Pembayaran</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($ps = $pesanan->fetch_assoc()): ?>
                    <tr>
                        <td><?= $ps['id'] ?></td>
                        <td><?= $ps['namaPelanggan'] ?? $ps['idPelanggan'] ?></td>
                        <td><?= $ps['paketpernikahan'] ?? $ps['idPaket'] ?></td>
                        <td>
                            <?php
                              $status = strtolower(trim($ps['statusPembayaran']));
                              if (in_array($status, ['lunas', 'settlement', 'success'])) {
                                  echo '<span class="badge bg-warning text-dark">Lunas</span>';
                              } elseif (in_array($status, ['belum lunas', 'pending', 'unpaid'])) {
                                  echo '<span class="badge bg-success text-white">Belum Lunas</span>';
                              } else {
                                  echo '<span class="badge bg-secondary text-white">' . htmlspecialchars($ps['statusPembayaran']) . '</span>';
                              }
                            ?>
                        </td>
                        <td><?= $ps['jumlahPembayaran'] ?></td>
                        <td>
                            <?php if ($ps['statusPesanan'] === 'selesai'): ?>
                                <span class="badge bg-secondary">Pesanan Selesai</span>
                                <a href="?hapus_pesanan=<?= $ps['id'] ?>" onclick="return confirm('Hapus pesanan ini?')" class="btn btn-danger btn-sm mt-1">Hapus</a>
                            <?php else: ?>
                                <a href="?selesai_pesanan=<?= $ps['id'] ?>" onclick="return confirm('Tandai pesanan ini sebagai selesai?')" class="btn btn-success btn-sm mb-1">Selesai</a>
                                <a href="?hapus_pesanan=<?= $ps['id'] ?>" onclick="return confirm('Hapus pesanan ini?')" class="btn btn-danger btn-sm">Hapus</a>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
            <!-- Kelola Jadwal Acara -->
<section id="jadwal">
    <div class="card mb-4">
        <div class="card-header bg-maroon">Kelola Jadwal Acara</div>
        <div class="card-body">
            <div id="calendar"></div>
            <div class="mt-3">
                <h5>Keterangan Pesanan:</h5>
                <ul>
                    <?php
                    // Ambil data pesanan lengkap untuk jadwal acara
                    $jadwalPesanan = $koneksi->query("
                        SELECT p.id, p.tanggalPesan, pl.nama AS namaPelanggan, pk.namaPaket
                        FROM pesanan p
                        LEFT JOIN pelanggan pl ON p.idPelanggan = pl.idPelanggan
                        LEFT JOIN paketpernikahan pk ON p.idPaket = pk.idPaket
                        ORDER BY p.tanggalPesan ASC
                    ");
                    $events = [];
                    while ($j = $jadwalPesanan->fetch_assoc()):
                        $tanggal = $j['tanggalPesan'];
                        $judul = $j['namaPelanggan'] . " - " . $j['namaPaket'];
                        $events[] = [
                            'title' => $judul,
                            'start' => $tanggal,
                        ];
                    ?>
                        <li><?= date('d M Y', strtotime($tanggal)) ?>: <strong><?= $j['namaPelanggan'] ?></strong> memesan <em><?= $j['namaPaket'] ?></em></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- FullCalendar Script -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 500,
        events: <?= json_encode($events) ?>
    });
    calendar.render();
});
</script>

<!-- Laporan Transaksi -->
<section id="laporan">
    <div class="card mb-4">
        <div class="card-header bg-maroon">Laporan Transaksi Bulan <?= date('F Y') ?></div>
        <div class="card-body">
            <?php
            // Ambil bulan dan tahun sekarang
            $bulan = date('m');
            $tahun = date('Y');

            // Query data transaksi selesai pada bulan dan tahun sekarang
            $laporan = $koneksi->query("
                SELECT p.id, p.namaPelanggan, pk.namaPaket, p.jumlahPembayaran, p.statusPembayaran, p.tanggalPesan
                FROM pesanan p
                LEFT JOIN paketpernikahan pk ON p.idPaket = pk.idPaket
                WHERE p.statusPembayaran IN ('Lunas', 'Sudah Bayar')
                AND MONTH(p.tanggalPesan) = '$bulan'
                AND YEAR(p.tanggalPesan) = '$tahun'
                ORDER BY p.tanggalPesan DESC
            ");
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Nama</th>
                        <th>Paket</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Status</th>
                        <th>Tanggal Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($laporan && $laporan->num_rows > 0): ?>
                        <?php while($row = $laporan->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['namaPelanggan']) ?></td>
                                <td><?= htmlspecialchars($row['namaPaket']) ?></td>
                                <td>Rp <?= number_format($row['jumlahPembayaran'], 0, ',', '.') ?></td>
                                <td><?= htmlspecialchars($row['statusPembayaran']) ?></td>
                                <td><?= date('d M Y', strtotime($row['tanggalPesan'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="text-center">Belum ada transaksi bulan ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>



        </div>
    </div>
</div>
</body>
</html>
