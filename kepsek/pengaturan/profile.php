<?php
session_start();
include '../koneksi.php';


if (!isset($_SESSION['id_pengguna'])) {
    header("Location: ../login.php");
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .profile-info {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .btn-logout {
            margin-top: 10px;
        }
    </style>
    <script>
        function confirmLogout(event) {
            if (!confirm("Apakah Anda yakin ingin keluar?")) {
                event.preventDefault();
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="profile-info">
            <h1 class="mb-4">Profil Pengguna</h1>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($row['nama_pengguna']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
            <p><strong>Role:</strong>
                <?php
                if ($row['id_role'] == 1) {
                    echo "Tata Usaha";
                } elseif ($row['id_role'] == 2) {
                    echo "Kepala Sekolah";
                }
                ?>
            </p>
            <a href="pengaturan/edit_profile.php" class="btn btn-primary">Edit Profil</a>
            <a href="../login.php" class="btn btn-danger btn-logout" onclick="confirmLogout(event)">Logout</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-5nU7OnHkC5B6MdRzyM5GQOGz6K0N0yyh2ObcEj5TC5P7u5T1bR1X1pBL+0xUqM1U5" crossorigin="anonymous"></script>
</body>

</html>