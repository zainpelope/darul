<?php
include '../../koneksi.php';

$id_perbaikan = $_POST['id_perbaikan'];
$id_aset = $_POST['id_aset'];
$tanggal_perbaikan = $_POST['tanggal_perbaikan'];
$deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
$biaya = $_POST['biaya'];
$status = $_POST['status'];

$sql = "UPDATE perbaikan_aset SET id_aset = '$id_aset', tanggal_perbaikan = '$tanggal_perbaikan', 
        deksripsi_kegiatan = '$deskripsi_kegiatan', biaya = '$biaya', status = '$status' 
        WHERE id_perbaikan = $id_perbaikan";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../components/notifications.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
