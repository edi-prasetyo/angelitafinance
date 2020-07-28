<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
$count_pemasukan = $this->transaksi_model->count_pemasukan();
?>

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
    <span class="brand-text font-weight-light">Admin</span>
  </a>
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?php echo base_url('admin/myaccount');?>" class="d-block"><?php echo $user->user_name; ?></a>
        <span class="text-success"><?php echo $user->role;?></span>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <!-- <div class="form-inline">
    <div class="input-group" data-widget="sidebar-search">
    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
    <div class="input-group-append">
    <button class="btn btn-sidebar">
    <i class="fas fa-search fa-fw"></i>
  </button>
</div>
</div>
</div> -->

<!-- Sidebar Menu -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->
    <?php if ($user->role_id == 1) : ?>
      <li class="nav-item menu-open">
        <a href="<?php echo base_url('admin/transaksi/create');?>" class="nav-link">
          <i class="nav-icon fas fa-receipt"></i>
          <p>
            Buat Invoice

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/dashboard');?>" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>
      <li class="nav-header">MASTER</li>
      <li class="nav-item has-treeview">
        <a href="<?php echo base_url('admin/car');?>" class="nav-link">
          <i class="nav-icon fas fa-car"></i>
          <p>
            Kendaraan
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo base_url('admin/car');?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Kendaraan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/type');?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/brand');?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Merek</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/driver');?>" class="nav-link">
          <i class="nav-icon fas fa-id-badge"></i>
          <p>
            Driver
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/paket');?>" class="nav-link">
          <i class="nav-icon fas fa-cube"></i>
          <p>
            Paket Sewa
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/pelanggan');?>" class="nav-link">
          <i class="nav-icon fas fa-user"></i>
          <p>
            Pelanggan

          </p>
        </a>
      </li>
      <li class="nav-header">TRANSAKSI</li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/transaksi');?>" class="nav-link">
          <i class="nav-icon fas fa-shopping-bag"></i>
          <p>
            Transaksi
           
          </p>
        </a>
      </li>

      <li class="nav-header">FINANCE</li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/pemasukan');?>" class="nav-link">
          <i class="nav-icon far fa-arrow-alt-circle-right"></i>
          <p>
            Pemasukan
            <span class="badge badge-danger right"><?php echo $count_pemasukan;?></span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/pengeluaran');?>" class="nav-link">
          <i class="nav-icon far fa-arrow-alt-circle-left"></i>
          <p>
            Pengeluaran
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/kas');?>" class="nav-link">
          <i class="nav-icon fas fa-coins"></i>
          <p>
            Kas
          </p>
        </a>
      </li>

    <?php endif;?>
<!-- Menu Role ID Admin -->
    <?php if ($user->role_id == 2) : ?>
      <li class="nav-item menu-open">
        <a href="<?php echo base_url('admin/transaksi/create');?>" class="nav-link">
          <i class="nav-icon fas fa-receipt"></i>
          <p>
            Buat Invoice

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/dashboard');?>" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
            <span class="right badge badge-danger">New</span>
          </p>
        </a>
      </li>
      <li class="nav-header">MASTER</li>
      <li class="nav-item has-treeview">
        <a href="<?php echo base_url('admin/car');?>" class="nav-link">
          <i class="nav-icon fas fa-car"></i>
          <p>
            Kendaraan
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="<?php echo base_url('admin/car');?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Kendaraan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/type');?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Type</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('admin/brand');?>" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Merek</p>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/driver');?>" class="nav-link">
          <i class="nav-icon fas fa-id-badge"></i>
          <p>
            Driver
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/paket');?>" class="nav-link">
          <i class="nav-icon fas fa-cube"></i>
          <p>
            Paket Sewa
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/pelanggan');?>" class="nav-link">
          <i class="nav-icon fas fa-user"></i>
          <p>
            Pelanggan

          </p>
        </a>
      </li>
      <li class="nav-header">TRANSAKSI</li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/transaksi');?>" class="nav-link">
          <i class="nav-icon fas fa-shopping-bag"></i>
          <p>
            Transaksi
            <span class="right badge badge-danger">10</span>
          </p>
        </a>
      </li>

    <?php endif;?>
<!-- Menu Role Finance -->
    <?php if ($user->role_id == 3) : ?>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/dashboard');?>" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
            <!-- <span class="right badge badge-danger">New</span> -->
          </p>
        </a>
      </li>

      <li class="nav-header">FINANCE</li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/pemasukan');?>" class="nav-link">
          <i class="nav-icon far fa-arrow-alt-circle-right"></i>
          <p>
            Pemasukan
            <span class="badge badge-danger right"><?php echo $count_pemasukan;?></span>
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="<?php echo base_url('admin/pengeluaran');?>" class="nav-link">
          <i class="nav-icon far fa-arrow-alt-circle-left"></i>
          <p>
            Pengeluaran
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="<?php echo base_url('admin/kas');?>" class="nav-link">
          <i class="nav-icon fas fa-coins"></i>
          <p>
            Kas
          </p>
        </a>
      </li>

    <?php endif;?>

  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?></h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard');?>">Home</a></li>
            <li class="breadcrumb-item active"><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
