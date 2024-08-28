<?php
include '../../../koneksi.php';

$id_pengadaan = $_GET['id'];

$sql = "DELETE FROM pengadaan_aset WHERE id_pengadaan='$id_pengadaan'";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../../components/pengadaan_aset/pengadaan/pengadaan_aset.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
