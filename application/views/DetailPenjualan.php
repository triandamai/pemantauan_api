

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$pagetitle; ?>
        <a href="<?= base_url('penjualan/print/'.$id.'/'.$penjualans->penjualan_id_transaksi); ?>" class="btn btn-info">Print</a>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><?=$pagetitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-body">
            <h3>ID Transaksi : <?=$penjualans->penjualan_id_transaksi; ?></h3>
            <h3>Tanggal : <?=$penjualans->penjualan_tanggal; ?></h3>
        <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Obat</th>
                  <th>Jumlah</th>
                  <th>Subtotal</th>
                </tr>
                </thead>
                <tbody>
                <?php 
		foreach($details as $detail){ 
		?>
		<tr>
			<td><?php echo $detail->obat_nama ?></td>
      <td><?php echo $detail->detail_jumlah ?></td>
      <td><?php echo $detail->detail_harga ?></td>
		</tr>
        <?php } ?>
        </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
