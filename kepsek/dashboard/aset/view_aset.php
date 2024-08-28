<?php
include '../../../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT aset.*, lokasi.nama_lokasi, kategori_aset.nama_kategori, 
                     penerimaan_aset.tanggal_penerimaan, penerimaan_aset.kondisi
              FROM aset 
              JOIN lokasi ON aset.id_lokasi = lokasi.id_lokasi 
              JOIN kategori_aset ON aset.id_kategori = kategori_aset.id_kategori
              LEFT JOIN penerimaan_aset ON aset.id_aset = penerimaan_aset.id_pengadaan
              WHERE aset.id_aset='$id'";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $aset = $result->fetch_assoc();
    } else {
        echo "Aset tidak ditemukan!";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Detail Aset</h2>
        <table class="table table-striped">
            <tr>
                <th>QR Code</th>
                <td>
                    <?php if ($aset['kode_qr']): ?>
                        <img src="images/qr_codes/<?php echo $aset['kode_qr']; ?>.png" alt="QR Code" style="width: 150px; height: 150px;">
                    <?php else: ?>
                        Tidak tersedia
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Nama Aset</th>
                <td><?php echo $aset['nama_aset']; ?></td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td><?php echo $aset['deskripsi']; ?></td>
            </tr>
            <tr>
                <th>Nilai Awal</th>
                <td><?php echo $aset['nilai_awal']; ?></td>
            </tr>
            <tr>
                <th>Nilai Sekarang</th>
                <td><?php echo $aset['nilai_sekarang']; ?></td>
            </tr>
            <tr>
                <th>Nomor Seri</th>
                <td><?php echo $aset['nomor_seri']; ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $aset['status']; ?></td>
            </tr>
            <tr>
                <th>Lokasi</th>
                <td><?php echo $aset['nama_lokasi']; ?></td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td><?php echo $aset['nama_kategori']; ?></td>
            </tr>

        </table>
        <a href="../../index.php?page=dashboard" class="btn btn-danger mt-3 w-100">Kembali</a>
    </div>
</body>

</html>