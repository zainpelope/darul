<?php
include '../../../koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM kebutuhan_aset WHERE id_kebutuhan=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    header("Location:  ../../../components/pengadaan_aset/kebutuhan/kebutuhan_aset.php");
    exit;
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
