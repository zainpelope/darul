<?php
include '../../koneksi.php';

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM lokasi WHERE id_lokasi = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../../components/lokasi.php?page=lokasi_aset&status=deleted");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
