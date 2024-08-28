<?php
include '../../koneksi.php';

$id = $_GET['id'] ?? 0;

$sql = "DELETE FROM penerimaan_aset WHERE id_penerimaan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../../components/penerimaan_aset.php");
exit();
