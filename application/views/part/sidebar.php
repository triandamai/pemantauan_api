<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url();?>assets/img/<?= $this->session->userdata('foto'); ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama'); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li><a href="<?=base_url('obat'); ?>"><i class="fa fa-book"></i> <span>Obat</span></a></li>
        <li><a href="<?=base_url('stok'); ?>"><i class="fa fa-book"></i> <span>Stok Obat</span></a></li>
        <li><a href="<?=base_url('supplier'); ?>"><i class="fa fa-book"></i> <span>Supplier</span></a></li>
        <li><a href="<?=base_url('pembelian'); ?>"><i class="fa fa-book"></i> <span>Pembelian</span></a></li>
        <li><a href="<?=base_url('Penjualan'); ?>"><i class="fa fa-book"></i> <span>Penjualan</span></a></li>
        <li><a href="<?=base_url('Laporan'); ?>"><i class="fa fa-book"></i> <span>Laporan</span></a></li>
        <li><a href="<?=base_url('Pemberitahuan'); ?>"><i class="fa fa-book"></i> <span>Notifikasi</span></a></li>
        <li><a href="<?=base_url('Pengaturan'); ?>"><i class="fa fa-book"></i> <span>Pengaturan</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>