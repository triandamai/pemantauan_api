

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
                  <th>Obat</th>
                  <th>Tanggal Expired</th>
                  <th>Supplier</th>
                  <th>Faktur</th>
                  <th>Stok</th>
                  
                </tr>
                </thead>
                <tbody>
                <?php 
		foreach($obats as $obat){ 
		?>
		<tr>
			<td><?php echo $obat->obat_nama ?></td>
            <td><?php echo $obat->detail_expired ?></<td>
            <td><?php echo $obat->supplier_nama?></td>
            <td><?php echo $obat->pembelian_faktur ?></td>
            <td><?php echo $obat->detail_jumlah ?></td>
            
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
