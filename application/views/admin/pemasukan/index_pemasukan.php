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
<!-- Progress Table start -->
<div class="col-12">
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
      </div>

      <hr>
      <div class="single-table">
        <div class="table-responsive">
          <table class="table">
            <thead class="text-uppercase">
              <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal</th>
                <th scope="col">User</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Status</th>
                <th scope="col">Pemasukan</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($pemasukan as $pemasukan) :?>
                <tr>
                  <th scope="row"><?php echo $no;?></th>
                  <td><?php echo $pemasukan->start_date;?></td>
                  <td><?php echo $pemasukan->user_name;?></td>
                  <td><?php echo $pemasukan->car_name;?></td>
                  <td>
                    <?php if ($pemasukan->payment_status == 'Hutang') :?>
                      <span class="badge badge-danger"><?php echo $pemasukan->payment_status;?></span>
                    <?php elseif ($pemasukan->payment_status == 'Proses') :?>
                      <span class="badge badge-warning"><?php echo $pemasukan->payment_status;?></span>
                    <?php else :?>
                      <span class="badge badge-success"><?php echo $pemasukan->payment_status;?></span>
                    <?php endif;?>
                  </td>

                  <td>
                    Rp. <?php echo number_format($pemasukan->kas_masuk,'0',',','.');?></td>
                  <td>
                    <?php include "view_pemasukan.php";?>
                    <a href="<?php echo base_url('admin/pemasukan/update/' .$pemasukan->id);?>" class="text-primary"><i class="fas fa-edit"></i></a>
                    <?php if ($pemasukan->status_update == 0 ) :?>
                      <i class="fas fa-dot-circle text-danger"></i>
                    <?php else:?>
                      <i class="fas fa-dot-circle text-success"></i>
                    <?php endif;?>
                  </td>
                </tr>
                <!-- <tr>
                  <td colspan="7">
                    <p>
                      BBM : <?php echo $pemasukan->bbm;?>, TOLL : <?php echo $pemasukan->toll;?>,
                      Parkir : <?php echo $pemasukan->parkir;?>,
                    Uang Makan : <?php echo $pemasukan->uang_makan;?>
                  </p>
                  </td>
                </tr> -->


                <?php $no++; endforeach;  ?>

              </tbody>
              <tfoot>
                <tr>
                  <th width="5%"></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th style="font-size: 30px;">Jumlah</th>
                  <th style="font-size: 30px;">Rp. <?php echo number_format($total_pemasukan, '0', ',', '.'); ?></th>
                  <th width="22%"></th>
                </tr>
              </tfoot>
            </table>


          </div>

          <div class="pagination col-md-12 text-center mt-3">
            <?php if (isset($pagination)) {
              echo $pagination;
            } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
