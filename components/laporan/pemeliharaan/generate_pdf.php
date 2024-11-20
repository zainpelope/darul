<?php
require '../../../vendor/autoload.php';

use Mpdf\Mpdf;

include '../../../koneksi.php';

date_default_timezone_set('Asia/Jakarta');


$selectedAset = isset($_GET['aset']) ? $conn->real_escape_string($_GET['aset']) : '';


$namaAsetQuery = "SELECT nama_aset FROM aset WHERE id_aset = '$selectedAset'";
$namaAsetResult = $conn->query($namaAsetQuery);
$namaAset = '';
if ($namaAsetResult->num_rows > 0) {
    $namaAsetRow = $namaAsetResult->fetch_assoc();
    $namaAset = $namaAsetRow['nama_aset'];
}


$sql = "SELECT pa.id_perbaikan, pa.tanggal_perbaikan, a.nama_aset, pa.deksripsi_kegiatan, pa.biaya, pa.status, pa.bukti_perbaikan
        FROM perbaikan_aset pa
        LEFT JOIN aset a ON pa.id_aset = a.id_aset
        WHERE 1=1";

if ($selectedAset !== '') {
    $sql .= " AND pa.id_aset = '$selectedAset'";
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

<h2 style="text-align: center;">Laporan Pemeliharaan Aset</h2>
<p>Aset: ' . ($namaAset ?: 'Semua Aset') . '</p>

<table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Pemeliharaan</th>
            <th>Nama Aset</th>
            <th>Deskripsi Pemeliharaan</th>
            <th>Bukti Perbaikan</th>
            <th>Biaya</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>';

$no = 1;
$totalBiaya = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalBiaya += $row['biaya'];

        // Check if bukti_perbaikan exists and prepare link to the file (image, PDF, etc.)
        // Check if bukti_perbaikan exists and is an image file
        if ($row['bukti_perbaikan']) {
            $filePath = '../../../uploads/' . $row['bukti_perbaikan'];
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp'])) {
                // Display image if the file is an image
                $buktiPerbaikan = '<img src="' . $filePath . '" alt="Bukti Perbaikan" style="width: 100px; height: auto;">';
            } else {
                // Display link if the file is not an image
                $buktiPerbaikan = '<a href="' . $filePath . '" target="_blank">Lihat Bukti</a>';
            }
        } else {
            $buktiPerbaikan = 'Tidak ada bukti';
        }


        $html .= '<tr>
                    <td style="text-align: center;">' . $no++ . '</td>
                    <td>' . date('d-m-Y', strtotime($row['tanggal_perbaikan'])) . '</td>
                    <td>' . $row['nama_aset'] . '</td>
                    <td>' . $row['deksripsi_kegiatan'] . '</td>
                    <td>' . $buktiPerbaikan . '</td>
                    <td style="text-align: right;">' . number_format($row['biaya'], 2, ',', '.') . '</td>
                    <td>' . $row['status'] . '</td>
                  </tr>';
    }
} else {
    $html .= '<tr>
                <td colspan="7" style="text-align: center;">Tidak ada data perbaikan aset untuk aset yang dipilih.</td>
              </tr>';
}

$html .= '</tbody>
</table>';

$html .= '
<p style="text-align: right; font-weight: bold; margin-top: 20px;">
    Total Biaya: Rp ' . number_format($totalBiaya, 2, ',', '.') . '
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
$mpdf->Output('Laporan_Pemeliharaan_Aset.pdf', 'D');
exit;
