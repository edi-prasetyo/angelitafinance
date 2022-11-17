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

    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
            </div>
            <div class="col-md-3">
            </div>

            <div class="col-md-3">
                <a class="m-0 float-right btn btn-primary bg-gradient-primary btn-block" href="<?php echo base_url('admin/hutang/filter_alhutang'); ?>">Filter Data Per tanggal <i class="fa fa-calendar ml-3"></i></a>
            </div>
        </div>
    </div>

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
                <th scope="col">Jumlah</th>
                <th scope="col">action</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($hutang as $hutang) :?>
                <tr>
                  <th scope="row"><?php echo $no;?></th>
                  <td><?php echo $hutang->kas_tanggal;?></td>
                  <td><?php echo $hutang->user_name;?></td>
                  <td><?php echo $hutang->car_name;?></td>
                  <td>
                    <?php if ($hutang->payment_status == 'Hutang') :?>
                      <a href="<?php echo base_url('admin/hutang/lunas/');?>" class="btn btn-danger btn-sm"><?php echo $hutang->payment_status;?></a>
                    <?php elseif ($hutang->payment_status == 'Proses') :?>
                      <span class="badge badge-warning"><?php echo $hutang->payment_status;?></span>
                    <?php else :?>
                      <span class="badge badge-success"><?php echo $hutang->payment_status;?></span>
                    <?php endif;?>
                  </td>

                  <td>
                    Rp. <?php echo number_format($hutang->kas_masuk,'0',',','.');?></td>
                  <td>
                    <?php include "view_hutang.php";?>
                    <a href="<?php echo base_url('admin/pemasukan/update/' .$hutang->id);?>" class="text-primary"><i class="fas fa-edit"></i></a>
                    <?php if ($hutang->status_update == 0 ) :?>
                      <i class="fas fa-dot-circle text-danger"></i>
                    <?php else:?>
                      <i class="fas fa-dot-circle text-success"></i>
                    <?php endif;?>
                  </td>
                </tr>
                <!-- <tr>
                  <td colspan="7">
                    <p>
                      BBM : <?php echo $hutang->bbm;?>, TOLL : <?php echo $hutang->toll;?>,
                      Parkir : <?php echo $hutang->parkir;?>,
                    Uang Makan : <?php echo $hutang->uang_makan;?>
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
                  <th style="font-size: 30px;">Rp. <?php echo number_format($total_hutang, '0', ',', '.'); ?></th>
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
