

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
                  <th>Supplier</th>
                  <th>Faktur</th>
                  <th>Subtotal</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
		foreach($pembelians as $pembelian){ 
		?>
		<tr>
			<td><?php echo $pembelian->pembelian_id_transaksi ?></td>
            <td><?php echo $pembelian->pembelian_tanggal ?></<td>
            <td><?php echo $pembelian->supplier_nama ?></td>
            <td><?php echo $pembelian->pembelian_faktur ?></td>
            <td><?php echo $pembelian->pembelian_subtotal ?></td>
            <td><a href="<?= base_url('pembelian/detail/'); ?><?php echo $pembelian->pembelian_id ?>" class="btn btn-info">Detail</a></td>
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
