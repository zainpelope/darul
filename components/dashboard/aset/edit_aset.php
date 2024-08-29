<?php
include 'phpqrcode/qrlib.php';
include '../../../koneksi.php';


$id_aset = $_GET['id'];
$query = "SELECT * FROM aset WHERE id_aset = '$id_aset'";
$result = $conn->query($query);
$aset = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_aset = $_POST['nama_aset'];
    $deskripsi = $_POST['deskripsi'];
    $nilai_awal = $_POST['nilai_awal'];
    $nilai_sekarang = $_POST['nilai_sekarang'];
    $nomor_seri = $_POST['nomor_seri'];
    $status = $_POST['status'];
    $id_lokasi = $_POST['id_lokasi'];
    $id_kategori = $_POST['id_kategori'];
    $id_penerimaan = !empty($_POST['id_penerimaan']) ? $_POST['id_penerimaan'] : null;
    $generate_qr = isset($_POST['generate_qr']);
    $kode_qr = $aset['kode_qr'];


    if ($generate_qr) {
        $kode_qr = 'QR-' . uniqid();
        $qrCodeDir = __DIR__ . '/images/qr_codes/';
        $qrCodeFile = $qrCodeDir . $kode_qr . '.png';

        if (!file_exists($qrCodeDir)) {
            mkdir($qrCodeDir, 0755, true);
        }

        QRcode::png($kode_qr, $qrCodeFile);
    }


    $sql = "UPDATE aset SET 
                nama_aset = '$nama_aset', 
                deskripsi = '$deskripsi', 
                nilai_awal = '$nilai_awal', 
                nilai_sekarang = '$nilai_sekarang', 
                nomor_seri = '$nomor_seri', 
                status = '$status', 
                id_lokasi = '$id_lokasi', 
                id_kategori = '$id_kategori', 
                id_penerimaan = " . ($id_penerimaan ? "'$id_penerimaan'" : "NULL") . ", 
                kode_qr = '$kode_qr' 
            WHERE id_aset = '$id_aset'";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../../../index.php");
        exit();
    } else {
        echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
    }

    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Panels - Kaiadmin Bootstrap 5 Admin Dashboard</title>
    <meta
        content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
        name="viewport" />
    <link
        rel="icon"
        href="../../../assets/img/kaiadmin/favicon.ico"
        type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="../../../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["../../../assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../../../assets/css/kaiadmin.min.css" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="../../../assets/css/demo.css" />
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="../../../index.php" class="logo">
                        <h2 style="color: white; font-weight: bold;">SIM ASET</h2>

                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item active">
                            <a href="../../../index.php" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group"></i>
                                <p>Pengadaan Aset</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="../../../components/pengadaan_aset/kebutuhan/kebutuhan_aset.php">
                                            <span class="sub-item">Kebutuhan Aset</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/pengadaan_aset/pengadaan/pengadaan_aset.php">
                                            <span class="sub-item">Pengadaan Aset</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a href="../../../components/penerimaan_aset.php">
                                <i class="fas fa-th-list"></i>
                                <p>Penerimaan Aset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../../components/pemeliharaan_aset.php">
                                <i class="fas fa-th-list"></i>
                                <p>Pemeliharaan Aset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../../components/penyusutan_aset.php">
                                <i class="fas fa-th-list"></i>
                                <p>Penyusutan Aset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../../../components/penghapusan_aset.php">
                                <i class="fas fa-th-list"></i>
                                <p>Penghapusan Aset</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#forms">
                                <i class="fas fa-pen-square"></i>
                                <p>Laporan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="forms">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="../../../components/laporan_aset.php">
                                            <span class="sub-item">Laporan Aset</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/laporan_pengdaan.php">
                                            <span class="sub-item">Laporan Pengadaan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/laporan_peneriman.php">
                                            <span class="sub-item">Laporan Penerimaan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/laporan_pemelihraan.php">
                                            <span class="sub-item">Laporan Pemelihraan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/laporan_penyusutan.php">
                                            <span class="sub-item">Laporan Penyusutan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/laporan_penghapusan.php">
                                            <span class="sub-item">Laporan Penghapusan</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#pengaturan">
                                <i class="fas fa-pen-square"></i>
                                <p>Pengaturan</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="pengaturan">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="../../../components/kategori.php">
                                            <span class="sub-item">Kategori Aset</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/lokasi.php">
                                            <span class="sub-item">Lokasi Aset</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="../../../components/profile.php">
                                            <span class="sub-item">Pengguna</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="../../../index.php" class="logo">
                            <h2 style="color: white; font-weight: bold;">SIM ASET</h2>

                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav
                    class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li
                                class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                                <a
                                    class="nav-link dropdown-toggle"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    role="button"
                                    aria-expanded="false"
                                    aria-haspopup="true">
                                    <i class="fa fa-search"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-search animated fadeIn">
                                    <form class="navbar-left navbar-form nav-search">
                                        <div class="input-group">
                                            <input
                                                type="text"
                                                placeholder="Search ..."
                                                class="form-control" />
                                        </div>
                                    </form>
                                </ul>
                            </li>



                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a
                                    class="dropdown-toggle profile-pic"
                                    data-bs-toggle="dropdown"
                                    href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img
                                            src="../../../assets/img/profile.jpg"
                                            alt="..."
                                            class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Hi,</span>
                                        <span class="fw-bold">Mohamamad Halil</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">


                                        <a class="dropdown-item" href="#">Logout</a>

                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <div class="container">
                <div class="page-inner">
                    <h2>Edit Aset</h2>
                    <form action="edit_aset.php?id=<?php echo $id_aset; ?>" method="post">
                        <div class="mb-3">
                            <label for="nama_aset" class="form-label">Nama Aset</label>
                            <input type="text" class="form-control" id="nama_aset" name="nama_aset" value="<?php echo $aset['nama_aset']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $aset['deskripsi']; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_awal" class="form-label">Nilai Awal</label>
                            <input type="number" class="form-control" id="nilai_awal" name="nilai_awal" step="0.01" value="<?php echo $aset['nilai_awal']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nilai_sekarang" class="form-label">Nilai Sekarang</label>
                            <input type="number" class="form-control" id="nilai_sekarang" name="nilai_sekarang" step="0.01" value="<?php echo $aset['nilai_sekarang']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_seri" class="form-label">Nomor Seri</label>
                            <input type="text" class="form-control" id="nomor_seri" name="nomor_seri" value="<?php echo $aset['nomor_seri']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Aktif" <?php echo ($aset['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                <option value="Tidak Aktif" <?php echo ($aset['status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_lokasi" class="form-label">Lokasi</label>
                            <select class="form-control" id="id_lokasi" name="id_lokasi" required>
                                <option value="">Silakan pilih lokasi</option>
                                <?php
                                $lokasiQuery = "SELECT id_lokasi, nama_lokasi FROM lokasi";
                                $lokasiResult = $conn->query($lokasiQuery);
                                while ($row = $lokasiResult->fetch_assoc()) {
                                    $selected = ($aset['id_lokasi'] == $row['id_lokasi']) ? 'selected' : '';
                                    echo '<option value="' . $row['id_lokasi'] . '" ' . $selected . '>' . $row['nama_lokasi'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label">Kategori</label>
                            <select class="form-control" id="id_kategori" name="id_kategori" required>
                                <option value="">Silakan pilih kategori aset</option>
                                <?php
                                $kategoriQuery = "SELECT id_kategori, nama_kategori FROM kategori_aset";
                                $kategoriResult = $conn->query($kategoriQuery);
                                while ($row = $kategoriResult->fetch_assoc()) {
                                    $selected = ($aset['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
                                    echo '<option value="' . $row['id_kategori'] . '" ' . $selected . '>' . $row['nama_kategori'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_penerimaan" class="form-label">Penerimaan</label>
                            <select class="form-control" id="id_penerimaan" name="id_penerimaan">
                                <option value="">Tidak ada</option>
                                <?php
                                $penerimaanQuery = "SELECT id_penerimaan, DATE_FORMAT(tanggal_penerimaan, '%d-%m-%Y') AS tanggal_penerimaan FROM penerimaan_aset";
                                $penerimaanResult = $conn->query($penerimaanQuery);
                                while ($row = $penerimaanResult->fetch_assoc()) {
                                    $selected = ($aset['id_penerimaan'] == $row['id_penerimaan']) ? 'selected' : '';
                                    echo '<option value="' . $row['id_penerimaan'] . '" ' . $selected . '>' . $row['tanggal_penerimaan'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="generate_qr" name="generate_qr">
                                <label class="form-check-label" for="generate_qr">
                                    Generate QR Code
                                </label>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="../../../index.php" class="btn btn-danger">Batal</a>
                        </div>
                    </form>
                </div>


            </div>
            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="copyright">
                        Copyright @ 2024
                        <a href="#">MI Darul Ulum</a>. All rights reserved
                    </div>

                    <div>Version 1.0</div>
                </div>
            </footer>
        </div>

    </div>

    <!-- Custom template | don't include it in your project! -->
    <div class="custom-template">
        <div class="title">Settings</div>
        <div class="custom-content">
            <div class="switcher">
                <div class="switch-block">
                    <h4>Logo Header</h4>
                    <div class="btnSwitch">
                        <button
                            type="button"
                            class="selected changeLogoHeaderColor"
                            data-color="dark"></button>
                        <button
                            type="button"
                            class="selected changeLogoHeaderColor"
                            data-color="blue"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="purple"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="light-blue"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="green"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="orange"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="red"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="white"></button>
                        <br />
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="dark2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="blue2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="purple2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="light-blue2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="green2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="orange2"></button>
                        <button
                            type="button"
                            class="changeLogoHeaderColor"
                            data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Navbar Header</h4>
                    <div class="btnSwitch">
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="dark"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="blue"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="purple"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="light-blue"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="green"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="orange"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="red"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="white"></button>
                        <br />
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="dark2"></button>
                        <button
                            type="button"
                            class="selected changeTopBarColor"
                            data-color="blue2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="purple2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="light-blue2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="green2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="orange2"></button>
                        <button
                            type="button"
                            class="changeTopBarColor"
                            data-color="red2"></button>
                    </div>
                </div>
                <div class="switch-block">
                    <h4>Sidebar</h4>
                    <div class="btnSwitch">
                        <button
                            type="button"
                            class="selected changeSideBarColor"
                            data-color="white"></button>
                        <button
                            type="button"
                            class="changeSideBarColor"
                            data-color="dark"></button>
                        <button
                            type="button"
                            class="changeSideBarColor"
                            data-color="dark2"></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="custom-toggle">
            <i class="icon-settings"></i>
        </div>
    </div>
    <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    <script src="../../../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../../../assets/js/core/popper.min.js"></script>
    <script src="../../../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Moment JS -->
    <script src="../../../assets/js/plugin/moment/moment.min.js"></script>

    <!-- Chart JS -->
    <script src="../../../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../../../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../../../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../../../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../../../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../../../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../../../assets/js/kaiadmin.min.js"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="../../../assets/js/setting-demo2.js"></script>
</body>

</html>