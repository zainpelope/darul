<?php
include '../../koneksi.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM kategori_aset WHERE id_kategori = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../../components/kategori.php?page=kategori&status=deleted");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
