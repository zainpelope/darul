<?php
include '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_perbaikan = $_POST['id_perbaikan'];
    $bukti = $_FILES['bukti_perbaikan']['name'];
    $target_dir = "../../uploads/";
    $target_file = $target_dir . basename($bukti);
    $upload_ok = true;

    // Validasi file
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (!in_array($file_type, ['jpg', 'jpeg', 'png', 'pdf'])) {
        echo "Hanya file JPG, JPEG, PNG, atau PDF yang diperbolehkan.";
        $upload_ok = false;
    }

    if ($upload_ok && move_uploaded_file($_FILES['bukti_perbaikan']['tmp_name'], $target_file)) {
        // Update database dengan file bukti dan ubah status
        $sql = "UPDATE perbaikan_aset SET bukti_perbaikan = '$bukti', status = 'Selesai' WHERE id_perbaikan = '$id_perbaikan'";
        if ($conn->query($sql) === TRUE) {
            header("Location: ../../components/pemeliharaan_aset.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah file.";
    }

    $conn->close();
} else {
    $id_perbaikan = $_GET['id'];
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload Bukti Perbaikan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <h2>Upload Bukti Perbaikan</h2>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_perbaikan" value="<?php echo $id_perbaikan; ?>">
                <div class="mb-3">
                    <label for="bukti_perbaikan" class="form-label">File Bukti Perbaikan</label>
                    <input type="file" class="form-control" name="bukti_perbaikan" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </body>

    </html>
<?php
}
?>