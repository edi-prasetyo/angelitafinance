<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
?>

<!-- Progress Table start -->
<div class="col-12 mt-5">
  <div class="card">
    <div class="card-body">
      <?php
      //Notifikasi
      if ($this->session->flashdata('message')) {
        echo '<div class="alert alert-success alert-dismissable fade show">';
        echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
        echo $this->session->flashdata('message');
        echo '</div>';
      }
      echo validation_errors('<div class="alert alert-warning">', '</div>');

      ?>
      <div class="form-row d-flex justify-content-between align-items-center ">
        <?php echo form_open('admin/pemasukan');?>

        <div class="col-sm-12 my-1 row">

          <div class="col-6">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-search"></i></div>
              </div>
              <input type="text" class="form-control" name="keyword" placeholder="Cari Pelanggan">
            </div>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary">Submit</button>

          </div>

        </div>
        <?php echo form_close();?>


        <a href="<?php echo base_url('admin/transaksi/create');?>" class="btn btn-primary"><i class="ti-plus"></i> Add New</a>

      </div>

      <hr>
      <div class="single-table">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="text-uppercase">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Kode</th>
                <th scope="col">Nama</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Mobil</th>
                <th scope="col">Driver</th>
                <th scope="col">Tujuan</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($transaksi as $transaksi) :?>

                <tr>
                  <th scope="row"><?php echo $no;?></th>
                  <td><?php echo $transaksi->kode_transaksi;?></td>
                  <td><?php echo $transaksi->user_name;?></td>
                  <td><?php echo $transaksi->start_date;?></td>
                  <td><?php echo $transaksi->end_date;?></td>
                  <td><?php echo $transaksi->car_name;?></td>
                  <td><?php echo $transaksi->driver_name;?></td>
                  <td><?php echo $transaksi->user_address;?></td>
                  <td>
                    <a href="<?php echo base_url('admin/transaksi/view/' .$transaksi->id);?>" class="text-primary"><i class="fas fa-edit"></i></a>
                  <?php if ($user->role_id == 1) : ?>
                    <?php include "delete_transaksi.php";?>
                  <?php else:?>
                  <?php endif;?>

                  </td>
                </tr>

                <?php $no++; endforeach;  ?>

              </tbody>
            </table>
          </div>

          <div class="pagination ml-3">
            <?php if (isset($pagination)) {
              echo $pagination;
            } ?>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Progress Table end -->
