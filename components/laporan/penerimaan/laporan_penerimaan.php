<?php
include 'koneksi.php';

$pengadaanQuery = "SELECT DISTINCT pa.id_pengadaan, k.deskripsi_kebutuhan, p.tanggal_pengadaan
                   FROM penerimaan_aset pa
                   LEFT JOIN pengadaan_aset p ON pa.id_pengadaan = p.id_pengadaan
                   LEFT JOIN kebutuhan_aset k ON p.id_kebutuhan = k.id_kebutuhan";
$pengadaanResult = $conn->query($pengadaanQuery);

$selectedPengadaan = isset($_POST['pengadaan']) ? $_POST['pengadaan'] : '';

$sql = "SELECT pa.id_penerimaan, pa.tanggal_penerimaan, p.vendor, pa.kondisi, k.deskripsi_kebutuhan
        FROM penerimaan_aset pa
        LEFT JOIN pengadaan_aset p ON pa.id_pengadaan = p.id_pengadaan
        LEFT JOIN kebutuhan_aset k ON p.id_kebutuhan = k.id_kebutuhan
        WHERE 1=1";

if ($selectedPengadaan !== '') {
    $sql .= " AND pa.id_pengadaan = '$selectedPengadaan'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penerimaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Laporan Penerimaan Aset</h2>
        <form action="index.php?page=laporan_penerimaan" method="post">
            <div class="mb-3">
                <label for="pengadaan" class="form-label">Filter Penerimaan</label>
                <select class="form-control" id="pengadaan" name="pengadaan">
                    <option value="">Semua Penerimaan</option>
                    <?php
                    if ($pengadaanResult->num_rows > 0) {
                        while ($row = $pengadaanResult->fetch_assoc()) {
                            $selected = ($row['id_pengadaan'] == $selectedPengadaan) ? 'selected' : '';
                            echo '<option value="' . $row['id_pengadaan'] . '" ' . $selected . '>'  . ' ' . $row['All'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>

        <?php
        $no = 1;

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped mt-3">';
            echo '<thead><tr><th>No</th><th>Aset</th><th>Vendor</th><th>Kondisi</th><th>Tanggal Penerimaan</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . htmlspecialchars($row['deskripsi_kebutuhan']) . '</td>';

                echo '<td>' . $row['vendor'] . '</td>';
                echo '<td>' . $row['kondisi'] . '</td>';
                echo '<td>' . date('d-m-Y', strtotime($row['tanggal_penerimaan'])) . '</td>';

                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning mt-3">Tidak ada data penerimaan aset untuk pengadaan yang dipilih.</div>';
        }

        $conn->close();
        ?>

        <div class="d-grid gap-2 mt-3">
            <form action="laporan/penerimaan/generate_pdf.php" method="get">
                <input type="hidden" name="pengadaan" value="<?php echo htmlspecialchars($selectedPengadaan); ?>">
                <button type="submit" class="btn btn-success">Save PDF</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-jLw8T8N7G9Zw0uSOZZmFEpK6UHg0LZjLQ0lLCzzj3D7KCr6dzjX2/92e8wG5tx9O2" crossorigin="anonymous"></script>
</body>

</html>