

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
      <form class="form-horizontal" method="post" action="<?=base_url('obat/update'); ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Obat</label>

                  <div class="col-sm-8">
                  <input type="hidden"name="id" value="<?=$obats->obat_id; ?>">
                    <input type="text" class="form-control" placeholder="Nama Obat" name="namaobat" value="<?=$obats->obat_nama; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Stok</label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Stok" name="stokobat" value="<?=$obats->obat_stok; ?>" required>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="col-sm-2 control-label">Harga Beli (Rp) </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="Harga Beli" name="hargabeli" value="<?=$obats->obat_beli; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Harga Jual (Rp) </label>

                  <div class="col-sm-8">
                    <input type="number" class="form-control" placeholder="harga jual" name="hargajual" value="<?=$obats->obat_jual; ?>"required>
                  </div>
                </div> -->
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-info pull-right">Submit </button>
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
