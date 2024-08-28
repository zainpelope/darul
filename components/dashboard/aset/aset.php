<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengadaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Pengadaan Aset</h2>

        <a href="pengadaan_aset/pengadaan/add_aset.php" class="btn btn-success mb-3">Tambah Pengadaan Aset</a>
        <?php

        $sql = "SELECT a.id_aset, a.nama_aset, k.nama_kategori, l.nama_lokasi, a.status
                FROM aset a
                LEFT JOIN kategori_aset k ON a.id_kategori = k.id_kategori
                LEFT JOIN lokasi l ON a.id_lokasi = l.id_lokasi";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>No</th><th>Nama Aset</th><th>Kategori</th><th>Lokasi</th><th>Status</th><th>Aksi</th></tr></thead>';
            echo '<tbody>';

            $no = 1;
            while ($row = $result->fetch_assoc()) {
                $backgroundColor = ($row['status'] == 'Aktif') ? '#28a745' : '#dc3545';
                $textColor = '#ffffff';
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . $row['nama_aset'] . '</td>';
                echo '<td>' . $row['nama_kategori'] . '</td>';
                echo '<td>' . $row['nama_lokasi'] . '</td>';
                echo '<td><span style="background-color: ' . $backgroundColor . '; color: ' . $textColor . '; padding: 2px 6px; border-radius: 4px; font-style: italic;">' . htmlspecialchars($row['status']) . '</span></td>';
                echo '<td>
                        <a href="pengadaan_aset/pengadaan/view_aset.php?id=' . $row['id_aset'] . '" class="btn btn-info">View</a>
                        <a href="pengadaan_aset/pengadaan/edit_aset.php?id=' . $row['id_aset'] . '" class="btn btn-primary">Edit</a> 
                       
                      </td>';
                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning">Tidak ada data.</div>';
        }

        $conn->close();
        ?>
    </div>
</body>

</html>


<!-- <a href="pengadaan_aset/pengadaan/hapus_aset.php?id=' . $row['id_aset'] . '" class="btn btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus aset ini?\')">Hapus</a>  -->