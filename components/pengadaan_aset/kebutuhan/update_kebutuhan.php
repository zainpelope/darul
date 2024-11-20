<?php
include '../../../koneksi.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id_kebutuhan = $_GET['id'];
    $status = $_GET['status'];

    $sql = "UPDATE kebutuhan_aset SET status = ? WHERE id_kebutuhan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $id_kebutuhan);

    if ($stmt->execute()) {
        header('Location: ../../../components/pengadaan_aset/kebutuhan/kebutuhan_aset.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
