<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];


$query = "SELECT * FROM pengguna WHERE email='$email' AND password='$password' AND id_role='$role'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    $_SESSION['id_pengguna'] = $row['id_pengguna'];
    $_SESSION['nama_pengguna'] = $row['nama_pengguna'];
    $_SESSION['id_role'] = $row['id_role'];

    // Redirect sesuai role
    if ($row['id_role'] == 1) {
        header("Location: index.php"); // Tata Usaha
    } elseif ($row['id_role'] == 2) {
        header("Location: kepsek.php"); // Kepala Sekolah
    } elseif ($row['id_role'] == 3) {
        header("Location: kepsek.php"); // Guru
    }
    exit;
} else {
    echo "<script>alert('Email, password, atau role salah. Silakan coba lagi.');window.location='login.php';</script>";
}
