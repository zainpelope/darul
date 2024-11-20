<?php
include '../koneksi.php';


$lokasiQuery = "SELECT id_lokasi, nama_lokasi FROM lokasi";
$lokasiResult = $conn->query($lokasiQuery);

$selectedLokasi = isset($_POST['id_lokasi']) ? $_POST['id_lokasi'] : '';


$sql = "SELECT a.id_aset, a.nama_aset, a.deskripsi, a.nilai_awal, a.nilai_sekarang, a.nomor_seri, a.kode_qr, a.status, k.nama_kategori, l.nama_lokasi
        FROM aset a
        LEFT JOIN kategori_aset k ON a.id_kategori = k.id_kategori
        LEFT JOIN lokasi l ON a.id_lokasi = l.id_lokasi
        WHERE a.status = 'Aktif'";


if ($selectedLokasi !== '') {
	$sql .= " AND a.id_lokasi = $selectedLokasi";
}


$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>SIM ASET</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Public Sans:300,400,500,600,700"]
			},
			custom: {
				"families": ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
				urls: ['../assets/css/fonts.min.css']
			},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/plugins.min.css">
	<link rel="stylesheet" href="../assets/css/kaiadmin.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<!-- Sidebar -->
		<div class="sidebar" data-background-color="dark">
			<div class="sidebar-logo">
				<!-- Logo Header -->
				<div class="logo-header" data-background-color="dark">

					<a href="../index.php" class="logo">
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
						<li class="nav-item">
							<a href="../index.php" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">

							<a data-bs-toggle="collapse" href="#pengadaan">
								<i class="fas fa-pen-square"></i>
								<p>Pengaadaan Aset</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="pengadaan">
								<ul class="nav nav-collapse">
									<li>
										<a href="../components/pengadaan_aset/kebutuhan/kebutuhan_aset.php">
											<span class="sub-item">Kebutuhan Aset</span>
										</a>
									</li>
									<li>
										<a href="../components/pengadaan_aset/pengadaan/pengadaan_aset.php">
											<span class="sub-item">Pengadaan Aset</span>
										</a>
									</li>

								</ul>
							</div>
						</li>

						<li class="nav-item">
							<a href="../components/penerimaan_aset.php">
								<i class="fas fa-th-list"></i>
								<p>Penerimaan Aset</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../components/pemeliharaan_aset.php">
								<i class="fas fa-th-list"></i>
								<p>Pemeliharaan Aset</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../components/penyusutan_aset.php">
								<i class="fas fa-th-list"></i>
								<p>Penyusutan Aset</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="../components/penghapusan_aset.php">
								<i class="fas fa-th-list"></i>
								<p>Penghapusan Aset</p>
							</a>
						</li>

						<li class="nav-item active submenu">
							<a data-bs-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Laporan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse show" id="base">
								<ul class="nav nav-collapse">
									<li class="active">
										<a href="../components/laporan_aset.php">
											<span class="sub-item">Laporan Aset</span>
										</a>
									</li>
									<li>
										<a href="../components/laporan_pengadaan.php">
											<span class="sub-item">Laporan Pengadaan</span>
										</a>
									</li>
									<li>
										<a href="../components/laporan_penerimaan.php">
											<span class="sub-item">Laporan Penerimaan</span>
										</a>
									</li>
									<li>
										<a href="../components/laporan_pemeliharaan.php">
											<span class="sub-item">Laporan Pemeliharaan</span>
										</a>
									</li>
									<li>
										<a href="../components/laporan_penyusutan.php">
											<span class="sub-item">Laporan Penyusutan</span>
										</a>
									</li>
									<li>
										<a href="../components/laporan_penghapusan.php">
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
										<a href="../components/kategori.php">
											<span class="sub-item">Kategori Aset</span>
										</a>
									</li>
									<li>
										<a href="../components/lokasi.php">
											<span class="sub-item">Lokasi Aset</span>
										</a>
									</li>
									<li>
										<a href="../components/profile.php">
											<span class="sub-item">Pengguna</span>
										</a>
									</li>
									<li>
										<a href="../components/kelola_pengguna.php">
											<span class="sub-item">Kelola Pengguna</span>
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
				<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

					<div class="container-fluid">
						<nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pe-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</nav>

						<ul class="navbar-nav topbar-nav ms-md-auto align-items-center">


							<li class="nav-item topbar-user dropdown hidden-caret">
								<a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
									<div class="avatar-sm">
										<img src="../assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
									</div>
									<span class="profile-username">
										<span class="op-7">Hi,</span> <span class="fw-bold">Mohammad Halil</span>
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
						<h3 class="fw-bold mb-3">Laporan</h3>
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
								<a href="#">Laporan Aset</a>
							</li>

						</ul>
					</div>

					<h2>Laporan Aset</h2>
					<form action="../components/laporan_aset.php" method="post">
						<div class="mb-3">
							<label for="id_lokasi" class="form-label">Filter Lokasi</label>
							<select class="form-control" id="id_lokasi" name="id_lokasi">
								<option value="">Semua Lokasi</option>
								<?php
								if ($lokasiResult->num_rows > 0) {
									while ($row = $lokasiResult->fetch_assoc()) {
										$selected = ($row['id_lokasi'] == $selectedLokasi) ? 'selected' : '';
										echo '<option value="' . $row['id_lokasi'] . '" ' . $selected . '>' . $row['nama_lokasi'] . '</option>';
									}
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-primary">Tampilkan</button>
					</form>

					<?php

					$no = 1;

					if ($result->num_rows > 0) {
						echo '<table class="table table-striped mt-3">';
						echo '<thead><tr><th>No</th><th>Nama Aset</th><th>Deskripsi</th><th>Nilai Awal</th><th>Nilai Sekarang</th><th>Nomor Seri</th><th>Kode QR</th><th>Kategori</th><th>Lokasi</th><th>Status</th></tr></thead>';
						echo '<tbody>';
						while ($row = $result->fetch_assoc()) {
							$qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($row['kode_qr']) . '&size=100x100';
							echo '<tr>';
							echo '<td>' . $no++ . '</td>';
							echo '<td>' . $row['nama_aset'] . '</td>';
							echo '<td>' . $row['deskripsi'] . '</td>';
							echo '<td>' . number_format($row['nilai_awal'], 2) . '</td>';
							echo '<td>' . number_format($row['nilai_sekarang'], 2) . '</td>';
							echo '<td>' . $row['nomor_seri'] . '</td>';
							echo '<td><img src="' . $qrCodeUrl . '" alt="QR Code"></td>';
							echo '<td>' . $row['nama_kategori'] . '</td>';
							echo '<td>' . $row['nama_lokasi'] . '</td>';
							echo '<td>' . $row['status'] . '</td>';
							echo '</tr>';
						}
						echo '</tbody></table>';
					} else {
						echo '<div class="alert alert-warning mt-3">Tidak ada data aset aktif.</div>';
					}

					$conn->close();
					?>

					<div class="d-grid gap-2 mt-3">
						<form action="laporan/aset/generate_pdf.php" method="get">
							<input type="hidden" name="id_lokasi" value="<?php echo htmlspecialchars($selectedLokasi); ?>">
							<button type="submit" class="btn btn-success">Save PDF</button>
						</form>
					</div>
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
							<button type="button" class=" selected changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br />
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="changeTopBarColor" data-color="white"></button>
							<br />
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="selected changeSideBarColor" data-color="white"></button>
							<button type="button" class="changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
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