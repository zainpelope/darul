<?php
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM aset WHERE id_aset='$id'";

    if ($conn->query($query) === TRUE) {
        header("Location: ../../index.php?page=pengadaan_aset");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
