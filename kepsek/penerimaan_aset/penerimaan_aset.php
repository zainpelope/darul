<?php
include '../koneksi.php';

$sql = "SELECT p.id_penerimaan, pa.id_pengadaan, u.nama_pengguna, p.tanggal_penerimaan, p.kondisi, k.deskripsi_kebutuhan
        FROM penerimaan_aset p
        JOIN pengadaan_aset pa ON p.id_pengadaan = pa.id_pengadaan
        JOIN kebutuhan_aset k ON pa.id_kebutuhan = k.id_kebutuhan
        JOIN pengguna u ON p.id_pengguna = u.id_pengguna";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penerimaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Penerimaan Aset</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Aset</th>
                    <th>Tanggal Penerimaan</th>
                    <th>Kondisi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_pengguna']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['deskripsi_kebutuhan']) . "</td>";

                        echo "<td>" . date('d-m-Y', strtotime($row['tanggal_penerimaan'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['kondisi']) . "</td>";

                        echo "<td>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php $conn->close(); ?>