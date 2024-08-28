<?php
include '../koneksi.php';

$sql = "SELECT p.id_perbaikan, a.nama_aset, p.status, p.biaya, p.tanggal_perbaikan 
        FROM perbaikan_aset p
        JOIN aset a ON p.id_aset = a.id_aset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pemeliharaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Pemeliharaan Aset</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Aset</th>
                    <th>Status</th>
                    <th>Biaya</th>
                    <th>Tanggal Pemeliharaan</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        $backgroundColor = ($row['status'] == 'Selesai') ? '#28a745' : '#dc3545';
                        $textColor = '#ffffff';
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_aset']) . "</td>";
                        echo '<td><span style="background-color: ' . $backgroundColor . '; color: ' . $textColor . '; padding: 2px 6px; border-radius: 4px; font-style: italic;">' . htmlspecialchars($row['status']) . '</span></td>';
                        echo "<td>" . number_format($row['biaya'], 2) . "</td>";
                        echo "<td>" . date('d-m-Y', strtotime($row['tanggal_perbaikan'])) . "</td>";
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