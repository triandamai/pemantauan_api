

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$pagetitle; ?>
        <a href="<?= base_url('penjualan/daftar'); ?>" class="btn btn-info">Riwayat Penjualan</a>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><?=$pagetitle; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <?php
    if ($this->session->flashdata('stat') == 'sukses') {
      ?>
      <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               Sukses, Stok Terupdate!
              </div>
      <?php
    }
    ?>
     
    <div class="box">
      <form class="form-horizontal" method="post" action="<?=base_url('penjualan/save_temp'); ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Obat</label>

                  <div class="col-sm-8">
                  <select class="form-control" name="nama_obat">
                  <?php foreach($obats as $obat){ ?>
                    <option value="<?= $obat->obat_nama; ?>"><?= $obat->obat_nama; ?></option>
                  <?php } ?>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Jumlah Jual" name="jumlah" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-info pull-right" name="submit"/>
                </div>
              </div>

              <!-- /.box-footer -->
            </form>
        <!-- /.box-body -->
      </div>
      <?php  $totalharga = 0;
      ?>
    <div class="box">
        <div class="box-body">
        <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Obat</th>
                  <th>Jumlah</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
		foreach($temp as $tmp){ 
		?>
		<tr>
			<td><?php echo $tmp->temp_nama ?></td>
            <td><?php echo $tmp->temp_jumlah ?></td>
            <td><?php echo $tmp->temp_totalharga ?></td>
            <td><a href="<?= base_url('penjualan/delete_temp/'); ?><?php echo $tmp->temp_id ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        <?php
         $totalharga += $tmp->temp_totalharga;
     } ?>
        </table>
        <?php if($temp != null ) { ?>
          <h4 class="pull-right">Total : <?= "Rp " . number_format($totalharga,2,',','.'); ?></h4>
        <form action="<?= base_url('penjualan/save'); ?>" method="post">

        <input type="hidden" name="subtotal" value= "<?= $totalharga; ?>">
        <div class="col-sm-10">
                    <input type="submit" class="btn btn-info pull-left" name="submit"/>
                    <a href="<?= base_url('penjualan/deleted'); ?>" class="btn btn-danger">Delete All!</a>
        </div>
    </form>
        <?php } ?>
        </div>
        <!-- /.box-body -->
      </div>
               

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
