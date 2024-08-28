<?php
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id_penghapusan = $_GET['id'];


    $sql_get_aset = "SELECT id_aset FROM penghapusan_aset WHERE id_penghapusan = ?";
    $stmt_get_aset = $conn->prepare($sql_get_aset);
    $stmt_get_aset->bind_param("i", $id_penghapusan);
    $stmt_get_aset->execute();
    $result = $stmt_get_aset->get_result();
    $row = $result->fetch_assoc();
    $id_aset = $row['id_aset'];

    $sql_penghapusan = "DELETE FROM penghapusan_aset WHERE id_penghapusan = ?";
    $stmt = $conn->prepare($sql_penghapusan);
    $stmt->bind_param("i", $id_penghapusan);
    $stmt->execute();


    $sql_aset = "DELETE FROM aset WHERE id_aset = ?";
    $stmt_aset = $conn->prepare($sql_aset);
    $stmt_aset->bind_param("i", $id_aset);
    $stmt_aset->execute();

    if ($stmt_aset->affected_rows > 0) {
        echo "<script>alert('Data aset berhasil dihapus.');window.location.href='../../components/penghapusan_aset.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data aset .');window.location.href='../../index.php';</script>";
    }

    $stmt->close();
    $stmt_aset->close();
}

$conn->close();
