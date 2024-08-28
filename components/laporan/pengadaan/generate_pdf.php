<?php
require '../../../vendor/autoload.php';

use Mpdf\Mpdf;

include '../../../koneksi.php';

date_default_timezone_set('Asia/Jakarta');

$selectedVendor = isset($_GET['vendor']) ? $conn->real_escape_string($_GET['vendor']) : '';


$sql = "SELECT p.id_pengadaan, p.tanggal_pengadaan, p.vendor, p.jumlah, p.status, k.deskripsi_kebutuhan
        FROM pengadaan_aset p
        LEFT JOIN kebutuhan_aset k ON p.id_kebutuhan = k.id_kebutuhan
        WHERE 1=1";

if ($selectedVendor !== '') {
    $sql .= " AND p.vendor = '$selectedVendor'";
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

<h2 style="text-align: center;">Laporan Pengadaan Aset</h2>
<p>Vendor: ' . ($selectedVendor ?: 'Semua Vendor') . '</p>
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
        <tr>
            <th>No</th>
               <th>Aset</th>
      
            <th>Vendor</th>
            <th>Jumlah</th>
            <th>Status</th>     
             <th>Tanggal Pengadaan</th>
         
        </tr>
    </thead>
    <tbody>';

$no = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
                    <td>' . $no++ . '</td>
                 <td>' . $row['deskripsi_kebutuhan'] . '</td>
                    <td>' . $row['vendor'] . '</td>
                    <td>' . $row['jumlah'] . '</td>
                    <td>' . $row['status'] . '</td>
                 
                          <td>' . date('d-m-Y', strtotime($row['tanggal_pengadaan'])) . '</td>
                  </tr>';
    }
} else {
    $html .= '<tr>
                <td colspan="6" style="text-align: center;">Tidak ada data pengadaan aset.</td>
              </tr>';
}

$html .= '</tbody>
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
$mpdf->Output('Laporan_Pengadaan_Aset.pdf', 'D');
exit;
