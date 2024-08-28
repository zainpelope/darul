<?php
include '../../koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID tidak valid.";
    exit;
}

$id_penyusutan = $_GET['id'];

$sql = "SELECT p.id_penyusutan, a.nama_aset, p.nilai_penyusutan, p.tanggal_penyusutan 
        FROM penyusutan_aset p
        JOIN aset a ON p.id_aset = a.id_aset
        WHERE p.id_penyusutan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_penyusutan);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo "Data tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penyusutan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Detail Penyusutan Aset</h2>
        <table class="table table-bordered">
            <tr>
                <th>Nama Aset</th>
                <td><?php echo htmlspecialchars($row['nama_aset']); ?></td>
            </tr>
            <tr>
                <th>Nilai Penyusutan</th>
                <td><?php echo number_format($row['nilai_penyusutan'], 2); ?></td>
            </tr>
            <tr>
                <th>Tanggal Penyusutan</th>
                <td><?php echo date('d-m-Y', strtotime($row['tanggal_penyusutan'])); ?></td>
            </tr>
        </table>
        <a href="../index.php?page=penyusutan" class="btn btn-danger">Kembali</a>
    </div>
</body>

</html>

<?php $conn->close(); ?>