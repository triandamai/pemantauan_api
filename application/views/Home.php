

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?= $pagetitle; ?>
      </h1>
      <ol class="breadcrumb">
        <li class="active"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
      <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              
            <?php if($query->detail_jumlah == null) { ?>
              <h3>0</h3>
            <?php }else {?>
              <h3><?= $query->detail_jumlah; ?></h3>
            <?php } ?>
              <p>Penjualan Obat Hari Ini</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php if($query1->detail_jumlah == null) { ?>
              <h3>0</h3>
            <?php }else {?>
              <h3><?= $query1->detail_jumlah; ?></h3>
            <?php } ?>

              <p>Pembelian Obat Hari Ini</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
