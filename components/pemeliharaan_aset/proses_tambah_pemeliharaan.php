<?php
include '../../koneksi.php';

$id_aset = $_POST['id_aset'];
$tanggal_perbaikan = $_POST['tanggal_perbaikan'];
$deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
$biaya = $_POST['biaya'];
$status = $_POST['status'];

$sql = "INSERT INTO perbaikan_aset (id_aset, tanggal_perbaikan, deksripsi_kegiatan, biaya, status) 
        VALUES ('$id_aset', '$tanggal_perbaikan', '$deskripsi_kegiatan', '$biaya', '$status')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../components/notifications.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
