

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
          
            <div class="box-title">
            <h4>Data Apotek</h4>
            </div>
            
              <div class="box-body">
              <form class="form-horizontal" method="post" action="<?=base_url('pengaturan/simpan_data_apotek'); ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Apotek</label>
                  <div class="col-sm-8">
                  <input class="form-control" name="nama_apotek" value="<?= $pengaturan->nama_apotek?>" placeholder="Value">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-8">
                  <input class="form-control" name="alamat_apotek" value="<?= $pengaturan->alamat_apotek?>" placeholder="Value">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-10">
                
                    <input type="submit" class="btn btn-info"  name="submit"/>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
        <!-- /.box-body -->
      </div>
      <!--  -->
      <div class="box">
          
            <div class="box-title">
            <h4>Notifikasi</h4>
            </div>
              <div class="box-body">
              <form class="form-horizontal" method="post" action="<?=base_url('pengaturan/simpan_notifikasi'); ?>">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Expired Date</label>
                  <div class="col-sm-8">
                   <input class="form-control" name="expired" value="<?= $pengaturan->notifikasi_expired?>" placeholder="Value">
                   Hari sebelum Expired
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Stok Minimal</label>

                  <div class="col-sm-8">
                  <input class="form-control" name="minimal_stok" value="<?= $pengaturan->stok_minimal?>" placeholder="Value">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-10">
               
                    <input type="submit" class="btn btn-info"  name="submit"/>
                </div>
              </div>
              <!-- /.box-footer -->
              </form>
        <!-- /.box-body -->
      </div>
      
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
