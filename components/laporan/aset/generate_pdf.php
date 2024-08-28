<?php
require '../../../vendor/autoload.php';

use Mpdf\Mpdf;

include '../../../koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$selectedLokasi = isset($_GET['id_lokasi']) && $_GET['id_lokasi'] !== '' ? intval($_GET['id_lokasi']) : null;


$sql = "SELECT a.id_aset, a.nama_aset, k.nama_kategori, l.nama_lokasi, a.nilai_sekarang, a.kode_qr, a.deskripsi
        FROM aset a
        LEFT JOIN kategori_aset k ON a.id_kategori = k.id_kategori
        LEFT JOIN lokasi l ON a.id_lokasi = l.id_lokasi
        WHERE a.status = 'Aktif'";

if ($selectedLokasi !== null) {
    $sql .= " AND a.id_lokasi = $selectedLokasi";
}

$result = $conn->query($sql);


function bulanIndonesia($tanggal)
{
    $bulanInggris = [
        'January' => 'Januari',
        'February' => 'Februari',
        'March' => 'Maret',
        'April' => 'April',
        'May' => 'Mei',
        'June' => 'Juni',
        'July' => 'Juli',
        'August' => 'Agustus',
        'September' => 'September',
        'October' => 'Oktober',
        'November' => 'November',
        'December' => 'Desember'
    ];

    return strtr($tanggal, $bulanInggris);
}

$dateInternational = date('d F Y');
$dateIndonesia = bulanIndonesia($dateInternational);

$mpdf = new Mpdf();
$totalNilai = 0;

$html = '
<div style="text-align: center; margin-bottom: 20px;">
<p style="margin: 0;">YAYASAN AL-ASYARIYAH</p>
    <h2 style="margin: 0;">MADRASAH IBTIDAIYAAH DARUL ULUMM</h2>
    <p style="margin: 0;">Jln. Simpang tiga Kp Duuman Desa Waru Timur Kec. Waru Kab. Pmekasan</p>
    <p style="margin: 0;">Hp : 085236961226 | Email : misdarululum@gmail.com</p>
    <hr style="margin-top: 20px; border: 1px solid #000;">
</div>

<h2 style="text-align: center;">Laporan Aset</h2>';

if ($selectedLokasi === null) {
    $html .= '<p style="text-align: center;">Lokasi: Semua Lokasi</p>';
} else {
    $lokasiResult = $conn->query("SELECT nama_lokasi FROM lokasi WHERE id_lokasi = $selectedLokasi");
    $lokasiRow = $lokasiResult->fetch_assoc();
    $namaLokasi = $lokasiRow['nama_lokasi'];

    $html .= '<p style="text-align: center;">Lokasi: ' . htmlspecialchars($namaLokasi) . '</p>';
}

$html .= '
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Aset</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Deskripsi</th>
            <th>Kode QR</th>
            <th>Nilai Sekarang</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nilaiSekarang = $row['nilai_sekarang'];
        $totalNilai += $nilaiSekarang;


        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?data=' . urlencode($row['kode_qr']) . '&size=100x100';

        $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . htmlspecialchars($row['nama_aset']) . '</td>
                    <td>' . htmlspecialchars($row['nama_kategori']) . '</td>
                    <td>' . htmlspecialchars($row['nama_lokasi']) . '</td>
                    <td>' . htmlspecialchars($row['deskripsi']) . '</td>
                    <td><img src="' . $qrCodeUrl . '" alt="QR Code" style="width: 100px; height: auto;"></td>
                    <td>Rp. ' . number_format($nilaiSekarang, 2, ',', '.') . '</td>
                  </tr>';
    }
} else {
    $html .= '<tr>
                <td colspan="7" style="text-align: center;">Tidak ada data aset aktif.</td>
              </tr>';
}

$html .= '
    <tr>
        <td colspan="6" style="text-align: right; font-weight: bold;">Total</td>
        <td style="font-weight: bold;">Rp. ' . number_format($totalNilai, 2, ',', '.') . '</td>
    </tr>
    </tbody>
</table>';

$html .= '
<div style="margin-top: 50px;">
    <div style="width: 50%; float: left; text-align: left;">
        <p>Mengetahui,</p>
        <p>Kepala Sekolah</p>
        <br><br><br><br>
        <p>Mahfud, S.pd.I</p>
        <p>NUPTK : 1135758667200003</p>
    </div>
    <div style="width: 50%; float: right; text-align: right;">
        <p>Pamekasan, ' . htmlspecialchars($dateIndonesia) . '</p>
        <p>Tata Usaha</p>
        <br><br><br><br>
        <p>Mohammad Halil, S.Pd</p>
        <p>NUPTK : 7441758659200023</p>
    </div>
    <div style="clear: both;"></div>
</div>';

$mpdf->WriteHTML($html);
$mpdf->Output('Laporan_Aset.pdf', 'D');
exit;

    // <img src="../../../path/to/logo.png" alt="Logo Lembaga" style="width: 100px; height: auto;">