<?php
include '../koneksi.php';

$id_pengadaan = $_GET['id'];

$sql = "SELECT p.*, k.deskripsi_kebutuhan 
        FROM pengadaan_aset p
        JOIN kebutuhan_aset k ON p.id_kebutuhan = k.id_kebutuhan
        WHERE p.id_pengadaan='$id_pengadaan'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengadaan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Detail Pengadaan Aset</h2>
        <table class="table table-bordered">
            <tr>
                <th>Kebutuhan</th>
                <td><?php echo htmlspecialchars($row['deskripsi_kebutuhan']); ?></td>
            </tr>
            <tr>
                <th>Tanggal Pengadaan</th>
                <td><?php echo date('d-m-Y', strtotime($row['tanggal_pengadaan'])); ?></td>
            </tr>
            <tr>
                <th>Vendor</th>
                <td><?php echo htmlspecialchars($row['vendor']); ?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td><?php echo htmlspecialchars($row['jumlah']); ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo htmlspecialchars($row['status']); ?></td>
            </tr>
        </table>
        <a href="../kepsek/pengadaan_aset.php" class="btn btn-secondary">Kembali</a>
    </div>
</body>

</html>

<?php $conn->close(); ?>