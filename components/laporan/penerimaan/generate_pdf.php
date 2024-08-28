a<?php
    require '../../../vendor/autoload.php';

    use Mpdf\Mpdf;

    include '../../../koneksi.php';

    $selectedPengadaan = isset($_GET['pengadaan']) ? $_GET['pengadaan'] : '';

    $sql = "SELECT pa.id_penerimaan, pa.tanggal_penerimaan, p.vendor, pa.kondisi, k.deskripsi_kebutuhan
        FROM penerimaan_aset pa
        LEFT JOIN pengadaan_aset p ON pa.id_pengadaan = p.id_pengadaan
        LEFT JOIN kebutuhan_aset k ON p.id_kebutuhan = k.id_kebutuhan
        WHERE 1=1";

    if ($selectedPengadaan !== '') {
        $sql .= " AND pa.id_pengadaan = '$selectedPengadaan'";
    }

    $result = $conn->query($sql);

    $mpdf = new Mpdf();

    $html = '
<div style="text-align: center; margin-bottom: 20px;">
    <p style="margin: 0;">YAYASAN AL-ASYARIYAH</p>
    <h2 style="margin: 0;">MADRASAH IBTIDAIYAAH DARUL ULUMM</h2>
    <p style="margin: 0;">Jln. Simpang tiga Kp Duuman Desa Waru Timur Kec. Waru Kab. Pmekasan</p>
    <p style="margin: 0;">Hp : 085236961226 | Email : misdarululum@gmail.com</p>
    <hr style="margin-top: 20px; border: 1px solid #000;">
</div>

<h2 style="text-align: center;">Laporan Penerimaan Aset</h2>';

    if ($selectedPengadaan !== '') {
        $html .= '<p><strong>Filter:</strong> Pengadaan ID: ' . htmlspecialchars($selectedPengadaan) . '</p>';
    } else {
        $html .= '<p><strong>Filter:</strong> Semua Pengadaan</p>';
    }

    $html .= '
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; font-size: 12px;">
    <thead>
        <tr>
            <th style="background-color: #f8f9fa; text-align: center;">No</th>
            <th style="background-color: #f8f9fa; text-align: center;">Aset</th>
            <th style="background-color: #f8f9fa; text-align: center;">Vendor</th>
            <th style="background-color: #f8f9fa; text-align: center;">Kondisi</th>
            <th style="background-color: #f8f9fa; text-align: center;">Tanggal Penerimaan</th>
        </tr>
    </thead>
    <tbody>';

    $no = 1;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>
                    <td style="text-align: center;">' . $no++ . '</td>
                    <td>' . htmlspecialchars($row['deskripsi_kebutuhan']) . '</td>
                    <td>' . htmlspecialchars($row['vendor']) . '</td>
                    <td>' . htmlspecialchars($row['kondisi']) . '</td>
                    <td style="text-align: center;">' . date('d-m-Y', strtotime($row['tanggal_penerimaan'])) . '</td>
                  </tr>';
        }
    } else {
        $html .= '<tr>
                <td colspan="5" style="text-align: center;">Tidak ada data penerimaan aset untuk pengadaan yang dipilih.</td>
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
        <p>Pamekasan, ' . date('d-m-Y') . '</p>
        <p>Tata Usaha</p>
        <br><br><br><br>
        <p>Mohammad Halil, S.Pd</p>
        <p>NUPTK : 7441758659200023</p>
    </div>
    <div style="clear: both;"></div>
</div>';

    $mpdf->WriteHTML($html);

    $mpdf->Output('Laporan_Penerimaan_Aset.pdf', 'D');
    exit;
