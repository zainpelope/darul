<?php
require '../../../vendor/autoload.php';

use Mpdf\Mpdf;

include '../../../koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$selectedDate = isset($_GET['tanggal_penghapusan']) ? $conn->real_escape_string($_GET['tanggal_penghapusan']) : '';

$sql = "SELECT pa.id_penghapusan, pa.tanggal_penghapusan, a.nama_aset, pa.alasan_penghapusan, pa.nilai_penghapusan, pa.status
        FROM penghapusan_aset pa
        LEFT JOIN aset a ON pa.id_aset = a.id_aset
        WHERE pa.tanggal_penghapusan = '$selectedDate'";

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

<h2 style="text-align: center;">Laporan Penghapusan Aset</h2>
<p>Tanggal Penghapusan: ' . date('d-m-Y', strtotime($selectedDate)) . '</p>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Penghapusan</th>
            <th>Nama Aset</th>
            <th>Alasan Penghapusan</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
$totalNilaiPenghapusan = 0;

while ($row = $result->fetch_assoc()) {
    $totalNilaiPenghapusan += $row['nilai_penghapusan'];
    $html .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . date('d-m-Y', strtotime($row['tanggal_penghapusan'])) . '</td>
            <td>' . $row['nama_aset'] . '</td>
            <td>' . $row['alasan_penghapusan'] . '</td>
            <td>' . number_format($row['nilai_penghapusan'], 0, ',', '.') . '</td>
            <td>' . $row['status'] . '</td>
        </tr>';
}

$html .= '
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
$mpdf->Output('Laporan_Penghapusan_Aset.pdf', 'D');

$conn->close();
