<?php
include 'koneksi.php';


$asetQuery = "SELECT DISTINCT a.id_aset, a.nama_aset
              FROM penyusutan_aset ps
              LEFT JOIN aset a ON ps.id_aset = a.id_aset";
$asetResult = $conn->query($asetQuery);


$selectedAset = isset($_POST['aset']) ? $conn->real_escape_string($_POST['aset']) : '';

$sql = "SELECT ps.id_penyusutan, ps.tanggal_penyusutan, a.nama_aset, ps.nilai_penyusutan
        FROM penyusutan_aset ps
        LEFT JOIN aset a ON ps.id_aset = a.id_aset
        WHERE 1=1";

if ($selectedAset !== '') {
    $sql .= " AND ps.id_aset = '$selectedAset'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penyusutan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Laporan Penyusutan Aset</h2>
        <form action="index.php?page=laporan_penyusutan" method="post">
            <div class="mb-3">
                <label for="aset" class="form-label">Filter Aset</label>
                <select class="form-control" id="aset" name="aset">
                    <option value="">Semua Aset</option>
                    <?php
                    if ($asetResult->num_rows > 0) {
                        while ($row = $asetResult->fetch_assoc()) {
                            $selected = ($row['id_aset'] == $selectedAset) ? 'selected' : '';
                            echo '<option value="' . $row['id_aset'] . '" ' . $selected . '>' . $row['nama_aset'] .  '</option>';
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
            echo '<thead><tr><th>No</th><th>Tanggal Penyusutan</th><th>Nama Aset</th><th>Nilai Penyusutan</th></tr></thead>';
            echo '<tbody>';
            while ($row = $result->fetch_assoc()) {

                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . date('d-m-Y', strtotime($row['tanggal_penyusutan'])) . '</td>';
                echo '<td>' . $row['nama_aset'] . '</td>';
                echo '<td>Rp ' . number_format($row['nilai_penyusutan'], 2, ',', '.') . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '<tfoot>';


            echo '</tfoot>';
            echo '</table>';
        } else {
            echo '<div class="alert alert-warning mt-3">Tidak ada data penyusutan aset untuk aset yang dipilih.</div>';
        }

        $conn->close();
        ?>

        <div class="d-grid gap-2 mt-3">
            <form action="laporan/penyusutan/generate_pdf.php" method="get">
                <input type="hidden" name="aset" value="<?php echo htmlspecialchars($selectedAset); ?>">
                <button type="submit" class="btn btn-success">Download PDF</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-jLw8T8N7G9Zw0uSOZZmFEpK6UHg0LZjLQ0lLCzzj3D7KCr6dzjX2/92e8wG5tx9O2" crossorigin="anonymous"></script>
</body>

</html>