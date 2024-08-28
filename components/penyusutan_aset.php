<?php
include '../koneksi.php';

$sql = "SELECT p.id_penyusutan, a.nama_aset, p.nilai_penyusutan, p.tanggal_penyusutan 
        FROM penyusutan_aset p
        JOIN aset a ON p.id_aset = a.id_aset";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Typography - Kaiadmin Bootstrap 5 Admin Dashboard</title>
  <meta
    content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
    name="viewport" />
  <link
    rel="icon"
    href="../assets/img/kaiadmin/favicon.ico"
    type="image/x-icon" />

  <!-- Fonts and icons -->
  <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
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
        urls: ["../assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="../assets/css/plugins.min.css" />
  <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="../assets/css/demo.css" />
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="../index.php" class="logo">
            <img
              src="../assets/img/kaiadmin/logo_light.svg"
              alt="navbar brand"
              class="navbar-brand"
              height="20" />
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
            <li class="nav-item">
              <a href="../index.php" class="collapsed" aria-expanded="false">
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
                    <a href="components/avatars.html">
                      <span class="sub-item">Kebutuhan Aset</span>
                    </a>
                  </li>
                  <li>
                    <a href="components/buttons.html">
                      <span class="sub-item">Pengadaan Aset</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>

            <li class="nav-item">
              <a href="../index.php">
                <i class="fas fa-th-list"></i>
                <p>Penerimaan Aset</p>
              </a>
            </li>
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Pemeliharaan Aset</p>
              </a>
            </li>
            <li class="nav-item active">
              <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Penyusutan Aset</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#sidebarLayouts">
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
                    <a href="#">
                      <span class="sub-item">Laporan Aset</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="sub-item">Laporan Pengadaan</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="sub-item">Laporan Penerimaan</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="sub-item">Laporan Pemelihraan</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="sub-item">Laporan Penyusutan</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
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
                    <a href="#">
                      <span class="sub-item">Kategori Aset</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <span class="sub-item">Lokasi Aset</span>
                    </a>
                  </li>
                  <li>
                    <a href="#">
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
            <a href="../index.php" class="logo">
              <img
                src="../assets/img/kaiadmin/logo_light.svg"
                alt="navbar brand"
                class="navbar-brand"
                height="20" />
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
            <nav
              class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
              <div class="input-group">
                <div class="input-group-prepend">
                  <button type="submit" class="btn btn-search pe-1">
                    <i class="fa fa-search search-icon"></i>
                  </button>
                </div>
                <input
                  type="text"
                  placeholder="Search ..."
                  class="form-control" />
              </div>
            </nav>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">



              <li class="nav-item topbar-user dropdown hidden-caret">
                <a
                  class="dropdown-toggle profile-pic"
                  data-bs-toggle="dropdown"
                  href="#"
                  aria-expanded="false">
                  <div class="avatar-sm">
                    <img
                      src="../assets/img/profile.jpg"
                      alt="..."
                      class="avatar-img rounded-circle" />
                  </div>
                  <span class="profile-username">
                    <span class="op-7">Hi,</span>
                    <span class="fw-bold">Hizrian</span>
                  </span>
                </a>
                <ul class="dropdown-menu dropdown-user animated fadeIn">
                  <div class="dropdown-user-scroll scrollbar-outer">

                    <li>

                      <a class="dropdown-item" href="#">Logout</a>
                    </li>
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
          <div class="page-header">
            <h3 class="fw-bold mb-3">Penyusutan Aset</h3>
            <ul class="breadcrumbs mb-3">
              <li class="nav-home">
                <a href="#">
                  <i class="icon-home"></i>
                </a>
              </li>
              <li class="separator">
                <i class="icon-arrow-right"></i>
              </li>
              <li class="nav-item">
                <a href="#">Penyusutan Aset</a>
              </li>

            </ul>
          </div>
          <h2>Penyusutan Aset</h2>
          <a href="../components/penyusutan/tambah_penyusutan.php" class="btn btn-primary mb-3">Tambah Penyusutan</a>
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nama Aset</th>
                <th>Nilai Penyusutan</th>
                <th>Tanggal Penyusutan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $no . "</td>";
                  echo "<td>" . htmlspecialchars($row['nama_aset']) . "</td>";
                  echo "<td>" . number_format($row['nilai_penyusutan'], 2) . "</td>";
                  echo "<td>" . date('d-m-Y', strtotime($row['tanggal_penyusutan'])) . "</td>";
                  echo "<td>";
                  echo "<a href='penyusutan/detail_penyusutan.php?id=" . $row['id_penyusutan'] . "' class='btn btn-info btn-sm'>Detail</a> ";
                  echo "<a href='penyusutan/edit_penyusutan.php?id=" . $row['id_penyusutan'] . "' class='btn btn-warning btn-sm'>Edit</a> ";
                  echo "<a href='penyusutan/hapus_penyusutan.php?id=" . $row['id_penyusutan'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Delete</a>";
                  echo "</td>";
                  echo "</tr>";
                  $no++;
                }
              } else {
                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
              }
              ?>
            </tbody>
          </table>
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
  <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Moment JS -->
  <script src="../assets/js/plugin/moment/moment.min.js"></script>

  <!-- Chart JS -->
  <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

  <!-- jQuery Sparkline -->
  <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

  <!-- Chart Circle -->
  <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

  <!-- Datatables -->
  <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

  <!-- Bootstrap Notify -->
  <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="../assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Sweet Alert -->
  <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="../assets/js/kaiadmin.min.js"></script>

  <!-- Kaiadmin DEMO methods, don't include it in your project! -->
  <script src="../assets/js/setting-demo2.js"></script>
</body>

</html>