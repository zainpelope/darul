<?php
include '../../koneksi.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "ID tidak valid.";
    exit;
}

$id_penyusutan = $_GET['id'];


$sql = "DELETE FROM penyusutan_aset WHERE id_penyusutan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id_penyusutan);

if ($stmt->execute()) {
    header("Location: ../../components/penyusutan_aset.php");
} else {
    echo "<script>alert('Gagal menghapus data: " . $conn->error . "'); window.location.href='penyusutan.php';</script>";
}
?>

<?php $conn->close(); ?>
