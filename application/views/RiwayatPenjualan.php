

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$pagetitle; ?>
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
		foreach($penjualans as $penjualan){ 
		?>
		<tr>
			<td><?php echo $penjualan->penjualan_id_transaksi ?></td>
            <td><?php echo $penjualan->penjualan_tanggal ?></<td>
            <td><?php echo $penjualan->penjualan_subtotal ?></td>
            <td><a href="<?= base_url('penjualan/detail/'); ?><?php echo $penjualan->penjualan_id ?>" class="btn btn-info">Detail</a></td>
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
