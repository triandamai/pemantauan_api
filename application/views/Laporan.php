<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?= $pagetitle; ?>
        </h1>
        <ol class="breadcrumb">
            <li class="active"><?= $pagetitle; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        if ($this->session->flashdata('stat') == 'sukses') {
        ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                Sukses
            </div>
        <?php
        }
        ?>
        <div class="box">
            <form class="form-horizontal" method="post" action="<?= base_url('laporan/index'); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bulan</label>

                        <div class="col-sm-8">
                            <select class="form-control" name="bulan" required>
                                <option value="">Pilih Bulan</option>
                                <?php
                                $id = 1;
                                foreach ($bulan as $key => $val) { ?>
                                    <option value="<?= $id; ?>" <?php if (!empty($inBulan) && $inBulan == $id) {
                                                                    echo "selected";
                                                                } ?>><?= $val; ?></option>
                                <?php
                                    $id++;
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Laporan </label>

                        <div class="col-sm-8">
                            <select class="form-control" name="jenis" required>
                                <option value="">Pilih Jenis Laporan</option>
                                <?php
                                $id = 1;
                                foreach ($laporan as $key => $val) { ?>
                                    <option value="<?= $id; ?>" <?php if (!empty($inJenis) && $inJenis == $id) {
                                                                    echo "selected";
                                                                } ?>><?= $val; ?></option>
                                <?php
                                    $id++;
                                } ?>
                            </select>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-sm-10">
                        <input type="submit" class="btn btn-info pull-right" name="submit" />
                    </div>
                </div>

                <!-- /.box-footer -->
            </form>
            <!-- /.box-body -->
        </div>
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-lg-12">
                        <?php if (!empty($dataOutput)) { ?>
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                Export <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('laporan/export?type=xlsx&m=' . $inBulan . '&j=' . $inJenis) ?>">Excel (xlsx)</a></li>
                                <li><a href="<?= base_url('laporan/export?type=pdf&m=' . $inBulan . '&j=' . $inJenis) ?>" target="_blank">PDF</a></li>
                            </ul>
                        <?php } ?>
                    </div>
                    <div class="col-lg-12" style="margin-top:10px">
                        <?php if (!empty($inJenis) && $inJenis != 3 ) { ?>
                            <table id="table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($dataOutput)) {
                                        foreach ($dataOutput as $key => $val) {
                                    ?>
                                            <tr>
                                                <td><?php echo $val[$jenis . '_id_transaksi'] ?></td>
                                                <td><?php echo $val[$jenis . '_tanggal'] ?></<td>
                                                <td><?php echo $val[$jenis . '_subtotal'] ?></td>
                                                <td><a href="<?= base_url($jenis . '/detail/'); ?><?php echo $val[$jenis . '_id'] ?>" class="btn btn-info">Detail</a></td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Data Kosong</b></td>
                                        </tr>
                                    <?php } ?>
                            </table>
                        <?php } else if (!empty($inJenis) && $inJenis == 3) { ?>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-2">

                                    </div>
                                    <div class="col-lg-2">
                                        <b>Total Harga Penjualan</b>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="Rp. <?= number_format($dataOutput['total_penjualan'], 0, ',', '.') ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 20px;">
                                <div class="row">
                                    <div class="col-lg-2">

                                    </div>
                                    <div class="col-lg-2">
                                        <b>Total Harga Pembelian</b>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="Rp. <?= number_format($dataOutput['total_pembelian'], 0, ',', '.') ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="margin-top: 50px;">
                                <div class="row">
                                    <div class="col-lg-2">

                                    </div>
                                    <div class="col-lg-2">
                                        <b>Laba / Rugi</b>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" class="form-control" value="Rp. <?= number_format($dataOutput['total_penjualan'] - $dataOutput['total_pembelian'], 0, ',', '.') ?>" disabled>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>