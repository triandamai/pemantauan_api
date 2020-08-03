

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?=$pagetitle; ?>
        <a href="<?= base_url('pembelian/daftar'); ?>" class="btn btn-info">Riwayat Pembelian</a>
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
      <!-- Default box -->
      <div class="box">
      <form class="form-horizontal" method="post" action="<?=base_url('pembelian/index'); ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Pilih Supplier</label>

                  <div class="col-sm-8">
                  <select class="form-control" name="nama_supplier" <?php
                  if ($asd != null || $this->session->flashdata('id_supplier') != "") { 
                      echo "disabled";
                    }?>>
                  <?php foreach($suppliers as $supplier){ ?>
                    <option value="<?= $supplier->supplier_id; ?>">
                    <?php 
                    if ($asd != null ) { 
                      echo  $asd;
                    }elseif($this->session->flashdata('id_supplier') != ""){
                      echo $this->session->flashdata('id_supplier');
                    }else{
                      echo $supplier->supplier_nama; 
                      } ?>
                      </option>
                  <?php } ?>
                  </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-10">
                <a href="<?= base_url('pembelian/deleted'); ?>" class="btn btn-danger pull-right">Delete!</a>
                    <input type="submit" class="btn btn-info" <?php 
                   if ($asd != null || $this->session->flashdata('id_supplier') != "") { echo "disabled";}?> name="submit"/>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <!-- Default box -->
    <?php
   if ($asd != null || $this->session->flashdata('id_supplier') != "") {
      ?>
      
    <div class="box">
      <form class="form-horizontal" method="post" action="<?=base_url('pembelian/save_temp'); ?>">
              <div class="box-body">
               <!--  -->
               <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Obat</label>

                  <div class="col-sm-8">
                  <select class="form-control" name="nama_obat">
                  <?php foreach($obats as $obat){ ?>
                    <option value="<?= $obat->obat_id; ?>"><?= $obat->obat_nama; ?></option>
                    
                  <?php } ?>
                  </select>
                  </div>
                </div>
                <!--  -->
              <!--  -->
              <div class="form-group">
                  <label class="col-sm-2 control-label">No Faktur </label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="No Faktur" name="no_faktur" required>
                  </div>
                </div>
                 <!--  -->
                  <!--  -->
                  <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Faktur</label>

                  <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Jumlah Beli" name="tanggal_faktur" required>
                  </div>
                </div>
                <!--  -->
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Tanggal Masuk </label>

                  <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Jumlah Beli" name="tanggal_masuk" required>
                  </div>
                </div>
                <!--  -->
                <!-- Box, ampul, fles, vial, pcs, tab, btl, ktk -->
              <div class="form-group">
                  <label class="col-sm-2 control-label">Satuan Beli</label>

                  <div class="col-sm-8">
                  <select class="form-control" name="satuan_beli">
  
                    <option value="BOX">BOX</option>
                    <option value="ampul">ampul</option>
                    <option value="fles">fles</option>
                    <option value="vial">vial</option>
                    <option value="pcs">pcs</option>
                    <option value="tab">tab</option>
                    <option value="ktk">btl</option>
                  </select>
                  </div>
                </div>
                 <!--  -->
               
                <!--  -->
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Satuan Beli </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Satuan Beli" name="satuan_beli" required>
                  </div>
                </div> -->
                <!--  -->
                 <!--  -->
                 <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Satuan Jual </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Satuan Jual" name="satuan_jual" required>
                  </div>
                </div> -->
                <!--  -->
                <!--  -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Harga Beli </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Harga beli" name="harga_beli" required>
                  </div>
                </div>
                <!--  -->
                                <!--  -->
                                <div class="form-group">
                  <label class="col-sm-2 control-label">Harga Jual</label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Harga Jual" name="harga_jual" required>
                  </div>
                </div>
                <!--  -->
                 <!--  -->
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Expired </label>

                  <div class="col-sm-8">
                    <input type="date" class="form-control" placeholder="Kadaluarsa" name="expired" required>
                  </div>
                </div>
                <!--  -->
                 <!--  -->
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Diskon(%) </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Diskon" name="diskon" required>
                  </div>
                </div>
                <!--  -->
                <!--  -->
                <div class="form-group">
                  <label class="col-sm-2 control-label">Jumlah </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Jumlah Beli" name="jumlah" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-info pull-right" name="submit"/>
                </div>
              </div>
              <input type="hidden" name="ids" value="<?php if($asd != null) {
                echo $asd;
            }else{
            echo $this->session->flashdata('id_supplier'); 
            }
            ?>">
              <!-- /.box-footer -->
            </form>
        <!-- /.box-body -->
      </div>
                  <?php } ?>
      <!-- /.box -->
      <?php
    if ($asd != null || $this->session->flashdata('id_supplier') != "") {
        $totalharga = 0;
      ?>
    <div class="box">
        <div class="box-body">
        <table id="table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama Obat</th>
                  <th>No Faktur</th>
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
			<td><?php echo $tmp->obat_nama ?></td>
      <td><?php echo $tmp->temp_faktur ?></td>
            <td><?php echo $tmp->temp_jumlah ?></td>
            <td><?php echo $tmp->temp_totalharga ?></td>
            <td><a href="<?= base_url('pembelian/delete_temp/'); ?><?php echo $tmp->temp_id ?>/<?php if($asd != null) {
                echo $asd;
            }else{
            echo $this->session->flashdata('id_supplier'); 
            }
            ?>" class="btn btn-danger">Delete</a></td>
        </tr>
        
        <?php
        $totalharga += $tmp->temp_totalharga;
     } ?>
        </table>
        <?php if($temp != null ) { ?>
          <h4 class="pull-right">Total : <?= "Rp " . number_format($totalharga,2,',','.'); ?></h4>
        <form action="<?= base_url('pembelian/save'); ?>" method="post">
      <input type="hidden" name="supplier" value= "<?php if($id != null) {
                echo $id;
            }else{
            echo $this->session->flashdata('id_supplier'); 
            }
            ?>">
        <input type="hidden" name="subtotal" value= "<?= $totalharga; ?>">
        <input type="hidden" name="faktur" value= "<?=  $tmp->temp_faktur; ?>">

            <?php 
            if(isset($_SESSION['tgglmasuk'])){?>
              <input type="hidden" name="tanggal_faktur" value= "<?=  $_SESSION['tgglfaktur'];?>">
              <input type="hidden" name="tanggal_masuk" value= "<?=  $_SESSION['tgglmasuk']; ?>">
              <?php
          }
            ?>
        
        <div class="col-sm-10">
                    <input type="submit" class="btn btn-info pull-left" name="submit"/>
        </div>
    </form>
        <?php } ?>
        </div>
        <!-- /.box-body -->
      </div>
                  <?php } ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
