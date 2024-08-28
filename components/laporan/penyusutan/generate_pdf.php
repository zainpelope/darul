<?php
require '../../../vendor/autoload.php';

use Mpdf\Mpdf;

include '../../../koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$selectedAset = isset($_GET['aset']) ? $conn->real_escape_string($_GET['aset']) : '';

$sql = "SELECT ps.id_penyusutan, ps.tanggal_penyusutan, a.nama_aset, ps.nilai_penyusutan
        FROM penyusutan_aset ps
        LEFT JOIN aset a ON ps.id_aset = a.id_aset
        WHERE 1=1";

if ($selectedAset !== '') {
    $sql .= " AND ps.id_aset = '$selectedAset'";
}

$namaAsetQuery = "SELECT nama_aset FROM aset WHERE id_aset = '$selectedAset'";
$namaAsetResult = $conn->query($namaAsetQuery);
$namaAset = '';
if ($namaAsetResult->num_rows > 0) {
    $namaAsetRow = $namaAsetResult->fetch_assoc();
    $namaAset = $namaAsetRow['nama_aset'];
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


$html = '
<div style="text-align: center; margin-bottom: 20px;">
<p style="margin: 0;">YAYASAN AL-ASYARIYAH</p>
    <h2 style="margin: 0;">MADRASAH IBTIDAIYAAH DARUL ULUMM</h2>
    <p style="margin: 0;">Jln. Simpang tiga Kp Duuman Desa Waru Timur Kec. Waru Kab. Pmekasan</p>
    <p style="margin: 0;">Hp : 085236961226 | Email : misdarululum@gmail.com</p>
    <hr style="margin-top: 20px; border: 1px solid #000;">
</div>

<h2 style="text-align: center;">Laporan Penyusutan Aset</h2>
<p>Aset: ' . ($namaAset ?: 'Semua Aset') . '</p>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Penyusutan</th>
            <th>Nama Aset</th>
            <th>Nilai Penyusutan</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
$totalPenyusutan = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalPenyusutan += $row['nilai_penyusutan'];
        $html .= '<tr>
                    <td>' . $no++ . '</td>
                    <td>' . date('d-m-Y', strtotime($row['tanggal_penyusutan'])) . '</td>
                    <td>' . $row['nama_aset'] . '</td>
                    <td>' . number_format($row['nilai_penyusutan'], 2, ',', '.') . '</td>
                  </tr>';
    }
} else {
    $html .= '<tr>
                <td colspan="4" style="text-align: center;">Tidak ada data penyusutan aset untuk aset yang dipilih.</td>
              </tr>';
}

$html .= '</tbody>
</table>';


$html .= '
<p style="text-align: right; font-weight: bold; margin-top: 20px;">
    Total Penyusutan: Rp ' . number_format($totalPenyusutan, 2, ',', '.') . '
</p>';

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
$mpdf->Output('Laporan_Penyusutan_Aset.pdf', 'D');
exit;
