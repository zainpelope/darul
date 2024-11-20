<?php
include '../../koneksi.php';


$id_aset = $_POST['id_aset'];
$tanggal_perbaikan = $_POST['tanggal_perbaikan'];
$deskripsi_kegiatan = $_POST['deskripsi_kegiatan'];
$biaya = $_POST['biaya'];
$status = $_POST['status'];

// Handle file upload (optional)
$bukti_perbaikan = NULL; // Default jika tidak ada file yang diupload
if (isset($_FILES['bukti_perbaikan']) && $_FILES['bukti_perbaikan']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "../uploads/"; // Folder penyimpanan file
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Buat folder jika belum ada
    }

    $file_name = time() . '_' . basename($_FILES["bukti_perbaikan"]["name"]); // Tambahkan timestamp untuk menghindari duplikat nama file
    $target_file = $target_dir . $file_name;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file
    if (in_array($file_type, ['jpg', 'jpeg', 'png', 'pdf'])) {
        if (move_uploaded_file($_FILES["bukti_perbaikan"]["tmp_name"], $target_file)) {
            $bukti_perbaikan = $file_name;
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
            exit;
        }
    } else {
        echo "Hanya file JPG, JPEG, PNG, atau PDF yang diperbolehkan.";
        exit;
    }
}

// Insert data ke database
$sql = "INSERT INTO perbaikan_aset (id_aset, tanggal_perbaikan, deskripsi_kegiatan, biaya, status, bukti_perbaikan) 
        VALUES ('$id_aset', '$tanggal_perbaikan', '$deskripsi_kegiatan', '$biaya', '$status', '$bukti_perbaikan')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../../components/pemeliharaan_aset.php");
    exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
