<?php
session_start();
include '../../koneksi.php';

if (!isset($_SESSION['id_pengguna'])) {
    header("Location: ../../components/profile.php");
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
        echo "<script>alert('Profil berhasil diperbarui'); window.location='../../components/profile.php';</script>";
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

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="profile-edit-card card shadow-lg">
            <div class="card-header text-center">
                <h5 class="card-title mb-0">Edit Profil</h5>
            </div>
            <div class="card-body">
                <form action="edit_profile.php" method="POST">
                    <div class="mb-3">
                        <label for="nama_pengguna" class="form-label">Nama Pengguna:</label>
                        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna" value="<?php echo htmlspecialchars($row['nama_pengguna']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email (tidak dapat diubah):</label>
                        <input type="text" class="form-control" id="email" value="<?php echo htmlspecialchars($row['email']); ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" value="<?php echo htmlspecialchars($row['password']); ?>" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
                <a href="../../components/profile.php" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-w8fX8IIKjtzrdXnBzm0FKNbq8ZIeD3dyxOQzyb1X8n/rE5Q2h8I/AGmG1tFfGKw/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {

            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            togglePassword.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });
    </script>
</body>

</html>