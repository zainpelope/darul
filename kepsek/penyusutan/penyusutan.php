<?php
include '../koneksi.php';

// Ambil data penyusutan dari database
$sql = "SELECT p.id_penyusutan, a.nama_aset, p.nilai_penyusutan, p.tanggal_penyusutan 
        FROM penyusutan_aset p
        JOIN aset a ON p.id_aset = a.id_aset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penyusutan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Data Penyusutan Aset</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Aset</th>
                    <th>Nilai Penyusutan</th>
                    <th>Tanggal Penyusutan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_aset']) . "</td>";
                        echo "<td>" . number_format($row['nilai_penyusutan'], 2) . "</td>";
                        echo "<td>" . date('d-m-Y', strtotime($row['tanggal_penyusutan'])) . "</td>";
                        echo "<td>";
                        echo "<a href='penyusutan/detail_penyusutan.php?id=" . $row['id_penyusutan'] . "' class='btn btn-info btn-sm'>Detail</a> ";

                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php $conn->close(); ?>