

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
      <form class="form-horizontal" method="post" action="<?=base_url('supplier/update'); ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama Supplier</label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Nama Supplier" name="namasupplier" value="<?= $supplier->supplier_nama ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Alamat</label>

                  <div class="col-sm-8">
                    <textarea name="alamatsupplier" id="" cols="30" rows="10" class="form-control"><?= $supplier->supplier_alamat ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">No Telpon </label>

                  <div class="col-sm-8">
                    <input type="tel" class="form-control" placeholder="No Telpon" name="telpsupplier" value="<?= $supplier->supplier_telp ?>" required>
                  </div>
                </div>
                <input type="hidden"name="id" value="<?=$supplier->supplier_id; ?>">
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
