<div class="row">
  <div class="col-8">
    <div class="card">
      <div class="card-body">
        <?php
        $kode_transaksi = date('dmY') . strtoupper(random_string('alnum', 5));
        echo form_open('admin/transaksi/create');?>
        <h4><b> Cusotmer Information</b></h4>
        <hr>
        <!-- Input Hidden data produk -->
        <input type="hidden" name="kode_transaksi" value="<?php echo $kode_transaksi ?>">
        <input type="hidden" name="kas_tanggal" value="<?php echo date("d/m/Y") ?>">

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Nomor Handphone <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-phone"></i></div>
                </div>
                <input class="form-control" type="text" name="user_phone" id="user_phone" placeholder="0812..">
              </div>
              <?php echo form_error('nomor_hp', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Nama Pelanggan <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input class="form-control" type="text" name="user_name" placeholder="Carlos Rath">
              </div>
              <?php echo form_error('user_name', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Alamat <span class="text-success">( Optional )</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-map-marker-alt"></i></div>
                </div>
                <input class="form-control" type="text" name="user_address" placeholder="Jl. ...">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <br>
            <h4><b> Order Information</b></h4>
            <hr>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Pilih Mobil</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-car"></i></div>
                </div>
                <select class="custom-select" name="car_name">
                  <?php foreach ($car as $car) : ?>
                    <option value="<?php echo $car->type_name ?> - <?php echo $car->car_number ?>"><?php echo $car->type_name ?> <?php echo $car->car_number ?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Pilih Paket</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-cube"></i></div>
                </div>
                <select class="custom-select" name="paket_id">
                  <?php foreach ($paket as $paket) : ?>
                    <option value="<?php echo $paket->id ?>"><?php echo $paket->paket_name ?> </option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
          </div>



          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Start Date</label>
              <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#datetimepicker1"/>
                <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">End Date</label>
              <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#datetimepicker2"/>
                <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label">Pilih Driver</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-slash"></i></div>
                </div>
                <select class="custom-select" name="driver_id">
                  <?php foreach ($driver as $driver) : ?>
                    <option value="<?php echo $driver->id ?>"><?php echo $driver->driver_name ?> </option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
          </div>



          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label"> Metode Pembayaran</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-wallet"></i></div>
                </div>
                <select class="custom-select" name="payment_method">
                  <option value="Cash">Cash</option>
                  <option value="Transfer">Transfer</option>
                </select>
              </div>
            </div>
          </div>


          <div class="col-md-6">
            <div class="form-group">
              <label class="col-form-label"> Status Pembayaran</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-thumbs-up"></i></div>
                </div>
                <select class="custom-select" name="payment_status">
                  <option value="Hutang">Hutang</option>
                  <option value="Proses">Proses</option>
                  <option value="Lunas">Lunas</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Lama Sewa <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-hourglass-start"></i></div>
                </div>
                <input class="form-control" type="text" name="long_term" placeholder="1 ..">
              </div>
              <?php echo form_error('long_term', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Harga Sewa <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
                </div>
                <input class="form-control" type="text" name="harga" placeholder="Rp. ..">
              </div>
              <?php echo form_error('harga', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">DP Sewa <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
                </div>
                <input class="form-control" type="text" name="down_payment" placeholder="Rp. ..">
              </div>
              <?php echo form_error('down_payment', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Uang Makan <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
                </div>
                <input class="form-control" type="text" name="uang_makan_inv" placeholder="Rp. ..">
              </div>
              <?php echo form_error('uang_makan_inv', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Uang Inap <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-credit-card"></i></div>
                </div>
                <input class="form-control" type="text" name="uang_inap_inv" placeholder="Rp. ..">
              </div>
              <?php echo form_error('uang_inap_inv', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>




          <div class="col-md-12">
            <div class="form-group">

              <input class="btn btn-primary" type="submit" value="Simpan Transaksi">

            </div>
          </div>

          <?php echo form_close();?>

        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h4><b> Pelanggan baru</b></h4>
        <hr>

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

        <?php echo form_open('admin/pelanggan/add');?>
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Nomor Handphone <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-phone"></i></div>
                </div>
                <input class="form-control" type="text" name="user_phone" id="user_phone2" placeholder="0812..">
              </div>
              <?php echo form_error('user_phone', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Nama Pelanggan <span class="text-danger">*</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="ti-user"></i></div>
                </div>
                <input class="form-control" type="text" name="user_name" placeholder="Carlos Rath">
              </div>
              <?php echo form_error('user_name', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Alamat <span class="text-success">( Optional )</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-map-marker-alt"></i></div>
                </div>
                <input class="form-control" type="text" name="user_address" placeholder="Jl. ...">
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">

              <input class="btn btn-primary" type="submit" value="Simpan Pelanggan">

            </div>
          </div>

        </div>
        <?php echo form_close();?>


      </div>
    </div>

  </div>

</div>
