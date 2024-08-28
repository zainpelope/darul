<?php
include 'koneksi.php';

$vendorQuery = "SELECT DISTINCT vendor FROM pengadaan_aset";
$vendorResult = $conn->query($vendorQuery);


$selectedVendor = isset($_POST['vendor']) ? $_POST['vendor'] : '';


$sql = "SELECT p.id_pengadaan, p.tanggal_pengadaan, p.vendor, p.jumlah, p.status, k.deskripsi_kebutuhan
        FROM pengadaan_aset p
        LEFT JOIN kebutuhan_aset k ON p.id_kebutuhan = k.id_kebutuhan
        WHERE 1=1";

if ($selectedVendor !== '') {
    $sql .= " AND p.vendor = '$selectedVendor'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pengadaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Laporan Pengadaan Aset</h2>
        <form action="index.php?page=laporan_pengadaan" method="post">
            <div class="mb-3">
                <label for="vendor" class="form-label">Filter Vendor</label>
                <select class="form-control" id="vendor" name="vendor">
                    <option value="">Semua Vendor</option>
                    <?php
                    if ($vendorResult->num_rows > 0) {
                        while ($row = $vendorResult->fetch_assoc()) {
                            $selected = ($row['vendor'] == $selectedVendor) ? 'selected' : '';
                            echo '<option value="' . $row['vendor'] . '" ' . $selected . '>' . $row['vendor'] . '</option>';
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
            echo '<thead><tr><th>No</th><th>Aset</th><th>Vendor</th><th>Jumlah</th><th>Status</th><th>Tanggal Pengadaan</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . $row['deskripsi_kebutuhan'] . '</td>';

                echo '<td>' . $row['vendor'] . '</td>';
                echo '<td>' . $row['jumlah'] . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '<td>' . date('d-m-Y', strtotime($row['tanggal_pengadaan'])) . '</td>';

                echo '</tr>';
            }
            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning mt-3">Tidak ada data pengadaan aset untuk vendor yang dipilih.</div>';
        }

        $conn->close();
        ?>

        <div class="d-grid gap-2 mt-3">
            <form action="laporan/pengadaan/generate_pdf.php" method="get">
                <input type="hidden" name="vendor" value="<?php echo htmlspecialchars($selectedVendor); ?>">
                <button type="submit" class="btn btn-success">Save PDF</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-jLw8T8N7G9Zw0uSOZZmFEpK6UHg0LZjLQ0lLCzzj3D7KCr6dzjX2/92e8wG5tx9O2" crossorigin="anonymous"></script>
</body>

</html>