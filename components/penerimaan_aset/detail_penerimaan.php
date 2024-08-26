<?php
include '../../koneksi.php';

$id = $_GET['id'] ?? 0;

$sql = "SELECT p.id_penerimaan, pa.id_pengadaan, u.nama_pengguna, p.tanggal_penerimaan, p.kondisi
        FROM penerimaan_aset p
        JOIN pengadaan_aset pa ON p.id_pengadaan = pa.id_pengadaan
        JOIN pengguna u ON p.id_pengguna = u.id_pengguna
        WHERE p.id_penerimaan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Penerimaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Detail Penerimaan Aset</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID Penerimaan</th>
                <td><?php echo htmlspecialchars($row['id_penerimaan']); ?></td>
            </tr>
            <tr>
                <th>ID Pengadaan</th>
                <td><?php echo htmlspecialchars($row['id_pengadaan']); ?></td>
            </tr>
            <tr>
                <th>Nama Pengguna</th>
                <td><?php echo htmlspecialchars($row['nama_pengguna']); ?></td>
            </tr>
            <tr>
                <th>Tanggal Penerimaan</th>
                <td><?php echo date('d-m-Y', strtotime($row['tanggal_penerimaan'])); ?></td>
            </tr>
            <tr>
                <th>Kondisi</th>
                <td><?php echo htmlspecialchars($row['kondisi']); ?></td>
            </tr>
        </table>
        <a href="../../components/panels.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>

<?php $conn->close(); ?>