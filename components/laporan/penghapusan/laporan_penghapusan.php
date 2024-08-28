<?php
include 'koneksi.php';


$tanggalQuery = "SELECT DISTINCT tanggal_penghapusan FROM penghapusan_aset ORDER BY tanggal_penghapusan";
$tanggalResult = $conn->query($tanggalQuery);


$selectedDate = isset($_POST['tanggal_penghapusan']) ? $conn->real_escape_string($_POST['tanggal_penghapusan']) : '';


$sql = "SELECT pa.id_penghapusan, pa.tanggal_penghapusan, a.nama_aset, pa.alasan_penghapusan, pa.nilai_penghapusan, pa.status
        FROM penghapusan_aset pa
        LEFT JOIN aset a ON pa.id_aset = a.id_aset
        WHERE pa.tanggal_penghapusan = '$selectedDate'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penghapusan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Laporan Penghapusan Aset</h2>
        <form action="index.php?page=laporan_penghapusan" method="post">
            <div class="mb-3">
                <label for="tanggal_penghapusan" class="form-label">Tanggal Penghapusan</label>
                <select class="form-select" id="tanggal_penghapusan" name="tanggal_penghapusan">
                    <option value="">-- Pilih Tanggal --</option>
                    <?php while ($row = $tanggalResult->fetch_assoc()) { ?>
                        <option value="<?php echo htmlspecialchars($row['tanggal_penghapusan']); ?>" <?php echo ($selectedDate == $row['tanggal_penghapusan']) ? 'selected' : ''; ?>>
                            <?php echo date('d-m-Y', strtotime($row['tanggal_penghapusan'])); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>

        <?php
        $no = 1;


        if ($result->num_rows > 0) {
            echo '<table class="table table-striped mt-3">';
            echo '<thead><tr><th>No</th><th>Tanggal Penghapusan</th><th>Nama Aset</th><th>Alasan Penghapusan</th><th>Jumlah</th><th>Status</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {

                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . date('d-m-Y', strtotime($row['tanggal_penghapusan'])) . '</td>';
                echo '<td>' . $row['nama_aset'] . '</td>';
                echo '<td>' . $row['alasan_penghapusan'] . '</td>';
                echo '<td>' . number_format($row['nilai_penghapusan'], 0, ',', '.') . '</td>';
                echo '<td>' . $row['status'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '<tfoot>';

            echo '</tfoot>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning mt-3">Tidak ada data penghapusan aset untuk tanggal yang dipilih.</div>';
        }

        $conn->close();
        ?>

        <div class="d-grid gap-2 mt-3">
            <form action="laporan/penghapusan/generate_pdf.php" method="get">
                <input type="hidden" name="tanggal_penghapusan" value="<?php echo htmlspecialchars($selectedDate); ?>">
                <button type="submit" class="btn btn-success">Download PDF</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-jLw8T8N7G9Zw0uSOZZmFEpK6UHg0LZjLQ0lLCzzj3D7KCr6dzjX2/92e8wG5tx9O2" crossorigin="anonymous"></script>
</body>

</html>