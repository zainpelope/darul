<?php
include '../koneksi.php';
$id_pengguna = $_GET['id'];
$sql = "SELECT * FROM pengguna WHERE id_pengguna = $id_pengguna";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Ambil daftar role
$roles = $conn->query("SELECT * FROM hak_akses");

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pengguna = $_POST['nama_pengguna'];
    $email = $_POST['email'];
    $id_role = $_POST['id_role'];
    $password = $_POST['password'];

    // Jika password diisi, langsung simpan password baru (tanpa di-hash)
    $password_sql = '';
    if (!empty($password)) {
        $password_sql = ", password='$password'";  // Simpan password langsung tanpa enkripsi
    }

    $update_sql = "UPDATE pengguna 
                   SET nama_pengguna='$nama_pengguna', email='$email', id_role=$id_role $password_sql 
                   WHERE id_pengguna=$id_pengguna";

    if ($conn->query($update_sql)) {
        header("Location: ../components/kelola_pengguna.php");
        exit();
    } else {
        echo "Gagal memperbarui data: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="h3 mb-4">Edit Pengguna</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna"
                    value="<?= htmlspecialchars($user['nama_pengguna']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="id_role" class="form-label">Jabatan</label>
                <select class="form-control" id="id_role" name="id_role" required>
                    <?php while ($role = $roles->fetch_assoc()): ?>
                        <option value="<?= $role['id_role'] ?>" <?= $user['id_role'] == $role['id_role'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($role['nama_role']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru (Opsional)</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password baru jika ingin mengubah">
            </div>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
            <a href="../components/kelola_pengguna.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</body>

</html>