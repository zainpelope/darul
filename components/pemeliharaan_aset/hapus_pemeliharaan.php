<?php
include '../koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM perbaikan_aset WHERE id_perbaikan = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../components/pemeliharaan_aset.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
