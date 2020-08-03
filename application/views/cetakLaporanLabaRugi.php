<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba / Rugi Bulanan</title>
</head>

<body>
    <h2 style="text-align: center;">Laporan <?= ucfirst($jenis) ?> Bulanan</h2>
    <h3 style="text-align: center;">Bulan <?= $bulan ?> Tahun 2020</h3>
    <hr />

    <table border="0" width="100%" style="text-align:left;">
        <tr>
            <td>Pengeluaran</td>
        </tr>

        <tr>
            <td width="25%"></td>
            <td width="50%">
                Jumlah Item Dibeli
            </td>
            <td width="25%">
                : <?= ($dataOutput['item_pembelian'] > 0) ? $dataOutput['item_pembelian'] : "0"; ?> pcs
            </td>
        </tr>

        <tr>
            <td width="25%"></td>
            <td width="50%">
                Total Pengeluaran
            </td>
            <td width="25%">
                : Rp.<?= number_format($dataOutput['total_pembelian'], 0, ',', '.') ?>
            </td>
        </tr>

        <tr>
            <td>Pemasukan</td>
        </tr>

        <tr>
            <td width="25%"></td>
            <td width="50%">
                Jumlah Item Terjual
            </td>
            <td width="25%">
                : <?= ($dataOutput['item_penjualan'] > 0) ? $dataOutput['item_penjualan'] : "0"; ?> pcs
            </td>
        </tr>

        <tr>
            <td width="25%"></td>
            <td width="50%">
                Total Pemasukan
            </td>
            <td width="25%">
                : Rp.<?= number_format($dataOutput['total_penjualan'], 0, ',', '.') ?>
            </td>
        </tr>

        <tr>
            <td>Laba / Rugi</td>
        </tr>
        <tr>
        <td width="25%"></td>
            <td width="50%">
                Laba Bersih
            </td>
            <td width="25%">
                : Rp.<?= number_format($dataOutput['total_penjualan'] - $dataOutput['total_pembelian'],0,',','.') ?>
            </td>
        </tr>

    </table>

</body>

</html>