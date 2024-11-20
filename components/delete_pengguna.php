
<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "root", "darul_ulum");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID pengguna
$id_pengguna = $_GET['id'];

// Hapus data pengguna berdasarkan ID
$sql = "DELETE FROM pengguna WHERE id_pengguna = $id_pengguna";

if ($conn->query($sql)) {
    header("Location: ../components/kelola_pengguna.php");
    exit();
} else {
    echo "Gagal menghapus data: " . $conn->error;
}
