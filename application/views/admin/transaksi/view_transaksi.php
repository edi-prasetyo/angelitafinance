<?php $meta = $this->meta_model->get_meta();?>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">

        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row">
            <div class="col-12">
              <h4>
                <b>ANGELITA RENTCAR.</b><br>
                <span style="font-size:14px;"><?php echo $meta->link;?></span>
                <small class="float-right">Jakarta, <?php echo date('d F Y', $transaksi->date_created); ?></small>
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info">
            <div class="col-sm-6 invoice-col">
              From
              <address>
                <strong>Pool Angelita Rentcar.</strong><br>
                <?php echo $meta->alamat;?>
                Phone: <?php echo $meta->telepon;?><br>
                Email: <?php echo $meta->email;?>
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              Customer
              <address>
                <strong><?php echo $transaksi->user_name;?></strong><br>
                <?php echo $transaksi->user_address;?><br>

                Phone:   <?php echo $transaksi->user_phone;?><br>

              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-2 invoice-col text-right">

              <br>
              <b>Order ID:</b> #<?php echo $transaksi->kode_transaksi;?><br>
              <b>Driver:</b> <?php echo $transaksi->driver_name;?><br>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Lama Sewa</th>
                    <th>Kendaraan</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $transaksi->long_term;?> Hari</td>
                    <td><?php echo $transaksi->car_name;?></td>
                    <td><?php echo $transaksi->start_date;?></td>
                    <td><?php echo $transaksi->end_date;?></td>
                    <td>IDR. <?php echo number_format($transaksi->kas_masuk,'0',',','.');?></td>

                  </tr>
                  <tr>
                    <td><td><td><td><td>
                  </tr>

                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-8">
              <span style="font-size:14px;"><?php echo $transaksi->paket_term;?></span>
            </p>
          </div>
          <!-- /.col -->
          <div class="col-4">

            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>IDR. <?php echo number_format($transaksi->kas_masuk,'0',',','.');?></td>
                </tr>
                <tr>
                  <th>DP</th>
                  <td>0</td>
                </tr>

                <tr>
                  <th>Total:</th>
                  <td>IDR. <?php echo number_format($transaksi->kas_masuk,'0',',','.');?></td>
                </tr>
              </table>


            </div>
          </div>

            <div class="col-md-4">
              <img class="img-fluid" width="60%" src="<?php echo base_url('assets/img/logo/' .$meta->logo);?>">

            </div>

            <div class="col-md-4 text-center">
              <br><br>
              (  <?php echo $transaksi->user_name;?>   )
              <br>Pelanggan
            </div>
            <div class="col-md-4 text-center">
              <br><br>
              (      <?php echo $meta->description;?>     )
              <br>Direktur
            </div>


          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
          <div class="col-12">
            <a href="<?php echo base_url('admin/transaksi/print/' .$transaksi->id);?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>

          </div>
        </div>
      </div>
      <!-- /.invoice -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
</section>
