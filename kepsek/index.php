<?php

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

include 'menu.php';

switch ($page) {
    case 'dashboard':
        include '../kepsek/dashboard/dashboard.php';
        break;

    case 'kebutuhan_aset':
        include '../kepsek/pengadaan_aset/kebutuhan/kebutuhan_aset.php';
        break;
    case 'pengadaan_aset':
        include '../kepsek/pengadaan_aset/pengadaan/pengadaan_aset.php';
        break;
    case 'penerimaan_aset':
        include '../kepsek/penerimaan_aset/penerimaan_aset.php';
        break;
    case 'pemeliharaan_aset':
        include '../kepsek/pemeliharaan_aset/pemeliharaan_aset.php';
        break;
    case 'penyusutan':
        include '../kepsek/penyusutan/penyusutan.php';
        break;
    case 'pengguna':
        include '../kepsek/pengaturan/profile.php';
        break;
    default:
        include '../kepsek/dashboard/dashboard.php';
        break;
}

include '../footer/footer.php';
