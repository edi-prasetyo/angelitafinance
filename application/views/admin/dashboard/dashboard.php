
<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
?>

<div class="row">

  <!-- seo fact area start -->
  <div class="col-lg-12">
    <div class="row">


    <!-- Akses SuperAdmin -->
    
    <?php if ($user->role_id == 1) : ?>

      <div class="col-lg-4">
        <!-- small card -->
        <div class="small-box bg-gradient-success">
          <div class="inner">
            <h3><?php echo count($pelanggan);?></h3>

            <p>Pelanggan</p>
          </div>
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <a href="<?php echo base_url('admin/pelanggan');?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- small card -->
        <div class="small-box bg-gradient-danger">
          <div class="inner">
            <h3><?php echo count($transaksi);?></h3>

            <p>Order</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <a href="<?php echo base_url('admin/transaksi');?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- small card -->
        <div class="small-box bg-gradient-info">
          <div class="inner">
            <h3><?php echo count($driver);?></h3>

            <p>Driver</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-slash"></i>
          </div>
          <a href="<?php echo base_url('admin/driver');?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>


      <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="fas fa-download"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pemasukan</span>
                <span class="info-box-number">Rp. <?php echo number_format($total_pemasukan,'0',',','.');?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>



      <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-danger">
              <span class="info-box-icon"><i class="fas fa-upload"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengeluaran</span>
                <span class="info-box-number">Rp. <?php echo number_format($total_pengeluaran,'0',',','.');?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
              <span class="info-box-icon"><i class="fas fa-trophy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number">
                <?php $saldo =  $total_pemasukan-$total_pengeluaran;?> 
                Rp. <?php echo number_format($saldo,'0',',','.');?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <!-- End Akses SuperAdmin -->



          <!-- Akses Admin -->
          <?php elseif ($user->role_id == 2) : ?>

            <div class="col-lg-4">
        <!-- small card -->
        <div class="small-box bg-gradient-success">
          <div class="inner">
            <h3><?php echo count($pelanggan);?></h3>

            <p>Pelanggan</p>
          </div>
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <a href="<?php echo base_url('admin/pelanggan');?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- small card -->
        <div class="small-box bg-gradient-danger">
          <div class="inner">
            <h3><?php echo count($transaksi);?></h3>

            <p>Order</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <a href="<?php echo base_url('admin/transaksi');?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-4">
        <!-- small card -->
        <div class="small-box bg-gradient-info">
          <div class="inner">
            <h3><?php echo count($driver);?></h3>

            <p>Driver</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-slash"></i>
          </div>
          <a href="<?php echo base_url('admin/driver');?>" class="small-box-footer">
            More info <i class="fas fa-arrow-circle-right"></i>
          </a>
        </div>
      </div>

          <!-- End Akses Admin -->


          <!-- Akses Finance -->
          <?php elseif ($user->role_id == 3) : ?>


            <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-success">
              <span class="info-box-icon"><i class="fas fa-download"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pemasukan</span>
                <span class="info-box-number">Rp. <?php echo number_format($total_pemasukan,'0',',','.');?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>



            <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-danger">
              <span class="info-box-icon"><i class="fas fa-upload"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pengeluaran</span>
                <span class="info-box-number">Rp. <?php echo number_format($total_pengeluaran,'0',',','.');?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
              <span class="info-box-icon"><i class="fas fa-trophy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Saldo</span>
                <span class="info-box-number">
                <?php $saldo =  $total_pemasukan-$total_pengeluaran;?> 
                Rp. <?php echo number_format($saldo,'0',',','.');?></span>

                <div class="progress">
                  <div class="progress-bar" style="width: 70%"></div>
                </div>
                
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <!-- End Akses Finance -->
          <?php endif;?>
      
      
      
      
    </div>
  </div>
  

</div>
