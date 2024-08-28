<?php
include '../koneksi.php';

$sql = "SELECT p.id_pengadaan, p.tanggal_pengadaan, p.vendor, p.jumlah, p.status, k.deskripsi_kebutuhan 
        FROM pengadaan_aset p
        JOIN kebutuhan_aset k ON p.id_kebutuhan = k.id_kebutuhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengadaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Pengadaan Aset</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Aset</th>
                    <th>Vendor</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Tanggal Pengadaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        $backgroundColor = ($row['status'] == 'Diterima') ? '#28a745' : '#dc3545';
                        $textColor = '#ffffff';
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . htmlspecialchars($row['deskripsi_kebutuhan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['vendor']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                        echo '<td><span style="background-color: ' . $backgroundColor . '; color: ' . $textColor . '; padding: 2px 6px; border-radius: 4px; font-style: italic;">' . htmlspecialchars($row['status']) . '</span></td>';
                        echo "<td>" . date('d-m-Y', strtotime($row['tanggal_pengadaan'])) . "</td>";
                        echo "<td>";
                        echo "<a href='pengadaan_aset/pengadaan/detail_pengadaan.php?id=" . $row['id_pengadaan'] . "' class='btn btn-info btn-sm'>Detail</a> ";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php $conn->close(); ?>