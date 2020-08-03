

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
      <form class="form-horizontal" method="post" action="<?=base_url('auth/update'); ?>" enctype="multipart/form-data">
      <input type="hidden" name="user_id" value="<?=$profile->user_id; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Nama </label>

                  <div class="col-sm-8">
                    <input type="text" class="form-control" placeholder="Nama " name="user_nama" value="<?=$profile->user_nama; ?>" required>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Foto</label>

                  <div class="col-sm-8">
                        <input type="file" class="form-control" name="user_foto">
                  </div>
                </div>
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
