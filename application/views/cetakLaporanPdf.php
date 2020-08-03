<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan <?= ucfirst($jenis) ?></title>
</head>

<body>
    <h2 style="text-align: center;">Laporan <?= ucfirst($jenis) ?> Bulanan</h2>
    <h3 style="text-align: center;">Bulan <?= $bulan ?> Tahun 2020</h3>
    <hr />
    <table border="0.5" width="100%" style="text-align:center;">
        <tr>
            <th>No</th>
            <!-- <th>Tanggal</th>
            <th>ID Transaksi</th> -->
            <th>Nama Obat</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $no = 1;
        $total = 0;
        $totObat = 0;
        foreach ($dataOutput as $key => $val) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
               
              
                <td><?= $val["obat_nama"] ?></td>
                <td><?= $val["detail_jumlah"] ?></td>
                <td>Rp.<?= number_format($val["detail_harga"],0,',','.') ?></td>
                <td>Rp.<?= number_format($val[$jenis . "_subtotal"],0,',','.') ?></td>
            </tr>
        <?php
            $totObat += $val['detail_jumlah'];
            $total += $val[$jenis . "_subtotal"];
        }
        ?>
    </table>

    <table width="100%" style="margin-top: 10px;">
        <tr>
            <td style="width: 75%;text-align: right;">Total Jumlah Obat:</td>
            <td style="width: 25%;text-align: right;"><?= number_format($totObat, 0, ',', '.') ?></td>
        </tr>
        <tr>
            <td style="width: 75%;text-align: right;">Total <?=ucfirst($jenis)?>:</td>
            <td style="width: 25%;text-align: right;">Rp. <?= number_format($total, 0, ',', '.') ?></td>
        </tr>
    </table>
    <hr />
</body>

</html>