<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebutuhan Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Kebutuhan Aset</h2>
        <?php

        $sql = "SELECT id_kebutuhan, deskripsi_kebutuhan, tanggal_dibuat, status FROM kebutuhan_aset";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="table table-striped">';
            echo '<thead><tr><th>No</th><th>Deskripsi</th><th>Tanggal</th><th>Status</th></tr></thead>';
            echo '<tbody>';

            $no = 1;
            while ($row = $result->fetch_assoc()) {

                $backgroundColor = ($row['status'] == 'Diterima') ? '#28a745' : '#dc3545';
                $textColor = '#ffffff';
                echo '<tr>';
                echo '<td>' . $no++ . '</td>';
                echo '<td>' . htmlspecialchars($row['deskripsi_kebutuhan']) . '</td>';
                echo '<td>' . htmlspecialchars(date('d-m-Y', strtotime($row['tanggal_dibuat']))) . '</td>';
                echo '<td><span style="background-color: ' . $backgroundColor . '; color: ' . $textColor . '; padding: 2px 6px; border-radius: 4px; font-style: italic;">' . htmlspecialchars($row['status']) . '</span></td>';

                echo '</tr>';
            }

            echo '</tbody></table>';
        } else {
            echo '<div class="alert alert-warning">Tidak ada data kebutuhan aset.</div>';
        }

        $conn->close();
        ?>
    </div>
</body>

</html>