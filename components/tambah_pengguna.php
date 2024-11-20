<?php
include '../koneksi.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_role = $_POST['id_role'];
    $nama_pengguna = $_POST['nama_pengguna'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Simpan password mentah

    // Insert data ke tabel pengguna
    $sql = "INSERT INTO pengguna (id_role, nama_pengguna, email, password) 
            VALUES ('$id_role', '$nama_pengguna', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pengguna berhasil ditambahkan!'); window.location='../components/kelola_pengguna.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data hak akses untuk dropdown
$roles = $conn->query("SELECT * FROM hak_akses");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="h3 mb-4">Tambah Pengguna Baru</h1>
        <form method="POST" action="">
            <!-- Pilih Hak Akses -->
            <div class="mb-3">
                <label for="id_role" class="form-label">Hak Akses</label>
                <select name="id_role" id="id_role" class="form-select" required>
                    <option value="" disabled selected>Pilih Hak Akses</option>
                    <?php while ($row = $roles->fetch_assoc()): ?>
                        <option value="<?= $row['id_role'] ?>"><?= $row['nama_role'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- Nama Pengguna -->
            <div class="mb-3">
                <label for="nama_pengguna" class="form-label">Nama Pengguna</label>
                <input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="../components/kelola_pengguna.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>

</html>