<?php

// Simulasi session idPelanggan


include 'header.php';
$koneksi = new mysqli("localhost", "root", "", "wo_web");
$idPelanggan = $_SESSION['ses_id'];
$query = "SELECT * FROM pesanan WHERE idPelanggan = '$idPelanggan' ORDER BY tanggalPesan DESC";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript"
    src="https://app.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-BLUyugD7t0NiNWmy"></script>

</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Keranjang Pemesanan Anda</h2>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID Pesanan</th>
                    <th>Nama</th>
                    <th>Paket</th>
                    <th>Tanggal Acara</th>
                    <th>Metode</th>
                    <th>Status Pembayaran</th>
                    <th>Jumlah Dibayar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= isset($row['id']) ? htmlspecialchars($row['id']) : '-' ?></td>
                    <td><?= isset($row['namaPelanggan']) ? htmlspecialchars($row['namaPelanggan']) : '-' ?></td>
                    <td><?= isset($row['idPaket']) ? htmlspecialchars($row['idPaket']) : '-' ?></td>
                    <td><?= isset($row['tanggalPesan']) ? htmlspecialchars($row['tanggalPesan']) : '-' ?></td>
                    <td><?= isset($row['metodePembayaran']) ? htmlspecialchars($row['metodePembayaran']) : '-' ?></td>
                    <td>
                         <?php
                            $totalHarga = isset($row['totalHarga']) ? $row['totalHarga'] : 0;
                            $jumlahDibayar = isset($row['jumlahPembayaran']) ? $row['jumlahPembayaran'] : 0;
                            $sisaPembayaran = $totalHarga - $jumlahDibayar;

                            if ($row['metodePembayaran'] != 'Lunas') {
                                if ($sisaPembayaran > 0) {
                                    echo '<span class="badge bg-warning"></span>';
                                } else {
                                    echo '<span class="badge bg-success">Belum Lunas</span>';
                                }
                            } elseif ($row['metodePembayaran'] == 'DP') {
                                echo '<span class="badge bg-success">Belum Lunas</span>';
                            } else {
                                echo '<span class="badge bg-warning">Lunas</span>';
                            }
                        ?>


                    </td>
                    <td onclick="">Rp <?= number_format($jumlahDibayar, 0, ',', '.') ?></td>
                    <td>
                    <?php
                    if($row['statusPesanan'] == 'selesai' && $row['metodePembayaran'] == 'Lunas') {
                        echo '<span class="text-muted">Pesanan Selesai</span>';
                    } else if($row['statusPesanan'] == 'diproses' && $row['metodePembayaran'] == 'Lunas') 
                    { 
                        echo '<span class="text-primary">Pesanan Diproses</span>';
                    } else {
                        echo '<div class="text-success me-2">Menunggu Pembayaran</div>';
                        echo '<form method="post" class="d-inline formPesanan" >';
                        echo '<input type="hidden" name="idPesanan" value="' . htmlspecialchars($row['id']) . '">';
                        echo '<input type="hidden" name="jumlahPembayaran" id="sisaPembayaran" value="' . htmlspecialchars($row['jumlahPembayaran']) . '">';
                        echo '<button type="button"  class="pay-button btn btn-sm btn-primary">Bayar Sisa Rp ' . number_format($row['jumlahPembayaran'], 0, ',', '.') . '</button>';
                        echo '</form>';
                    }
                    ?>

                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Belum ada pesanan.</div>
    <?php endif; ?>
    
    
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BLUyugD7t0NiNWmy">
    </script>
<script>
    const payButton = document.querySelectorAll('.pay-button')
    const form = document.getElementsByClassName("formPesanan")
    const sisaPembayaran = document.getElementById("sisaPembayaran");
    const idPesanan = document.getElementById("idPesanan");

payButton.forEach(async(item, index) => {
    item.addEventListener("click", async (e) => {
        const formData = new FormData(form[index])


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
                          const formDataUpdate = new FormData();

                          formDataUpdate.append("id", formData.get('idPesanan'));
                          formDataUpdate.append("jumlahPembayaran", Number(formData.get('jumlahPembayaran')));


                          fetch('update_pesanan.php', {
                              method: 'POST',
                              body: formDataUpdate
                          })
                          .then(res => res.json())
                          .then(async data => {
                              if (data.status === "success") {


                                alert(data.message)
                                 window.location.href = "keranjang.php";
                                return;
                                  // After successful update, check if full payment is done
                                  const idPesanan = formData.get('idPesanan');
                                  const jumlahDibayar = Number(formData.get('jumlahPembayaran'));

                                  // Fetch totalHarga for this order
                                  const response = await fetch(`get_total_harga.php?id=${idPesanan}`);
                                  const result = await response.json();

                                  if (result.totalHarga !== undefined && jumlahDibayar >= result.totalHarga) {
                                      // Update statusPembayaran to 'Lunas'
                                      await fetch('update_status_pembayaran.php', {
                                          method: 'POST',
                                          headers: { 'Content-Type': 'application/json' },
                                          body: JSON.stringify({ id: idPesanan, status: 'Lunas' })
                                      });
                                  }

                                  alert("Pesanan berhasil disimpan!");
                                  window.location.href = "keranjang.php";
                              } else {
                                  alert("Gagal menyimpan pesanan: " + data.message);
                              }
                          })
                          .catch(err => {
                              console.log("Error saat simpan:", err);
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

    })
</script>

<?php
include 'footer.php'
?>
</body>
</html>
