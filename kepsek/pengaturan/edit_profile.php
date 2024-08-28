<?php
session_start();
include '../../koneksi.php';


if (!isset($_SESSION['id_pengguna'])) {
    header("Location: ../kepsek/index.php?page=pengguna");
    exit();
}

$id_pengguna = $_SESSION['id_pengguna'];
$query = "SELECT * FROM pengguna WHERE id_pengguna = '$id_pengguna'";
$result = mysqli_query($conn, $query);


if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Data pengguna tidak ditemukan.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_pengguna = $_POST['nama_pengguna'];
    $password = $_POST['password'];

    $update_query = "UPDATE pengguna SET nama_pengguna='$nama_pengguna', password='$password' WHERE id_pengguna='$id_pengguna'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profil berhasil diperbarui'); window.location='../index.php?page=pengguna';</script>";
    } else {
        echo "Terjadi kesalahan saat memperbarui profil: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 20px;
        }

        .form-control:disabled {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Edit Profil</h1>
        <form action="edit_profile.php" method="POST">
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">Nama Pengguna:</label>
                <input type="text" name="nama_pengguna" id="nama_pengguna" class="form-control" value="<?php echo htmlspecialchars($row['nama_pengguna']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email (tidak dapat diubah):</label>
                <input type="text" id="email" class="form-control" value="<?php echo htmlspecialchars($row['email']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" value="<?php echo htmlspecialchars($row['password']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="../index.php?page=pengguna" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-5nU7OnHkC5B6MdRzyM5GQOGz6K0N0yyh2ObcEj5TC5P7u5T1bR1X1pBL+0xUqM1U5" crossorigin="anonymous"></script>
</body>

</html>