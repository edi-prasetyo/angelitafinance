<div class="row">

  <div class="col-md-8">
    <div class="card">
      <div class="card-body">
        <h4><b> Update Data Pemasukan</b></h4>
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

        <?php echo form_open('admin/pemasukan/update/' .$pemasukan->id);?>


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

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">SPJ <span class="text-danger">*</span></label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-user-slash"></i></div>
            </div>
            <input class="form-control" type="text" name="spj" value="<?php echo $pemasukan->spj;?>">
          </div>
          <?php echo form_error('spj', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">BBM </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-gas-pump"></i></div>
            </div>
            <input class="form-control" type="text" name="bbm" value="<?php echo $pemasukan->bbm;?>">
          </div>

        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">Toll </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-road"></i></div>
            </div>
            <input class="form-control" type="text" name="toll" value="<?php echo $pemasukan->toll;?>">
          </div>
          <?php echo form_error('toll', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">Parkir</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-ticket-alt"></i></div>
            </div>
            <input class="form-control" type="text" name="parkir" value="<?php echo $pemasukan->parkir;?>">
          </div>
          <?php echo form_error('parkir', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">Uang Makan</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-utensils"></i></div>
            </div>
            <input class="form-control" type="text" name="uang_makan" value="<?php echo $pemasukan->uang_makan;?>">
          </div>
          <?php echo form_error('uang_makan', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">Uang Inap </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-bed"></i></div>
            </div>
            <input class="form-control" type="text" name="uang_inap" value="<?php echo $pemasukan->uang_inap;?>">
          </div>
          <?php echo form_error('uang_inap', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">PPn </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
            </div>
            <input class="form-control" type="text" name="ppn" value="<?php echo $pemasukan->ppn;?>">
          </div>
          <?php echo form_error('ppn', '<small class="text-file-signature">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">PPh </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
            </div>
            <input class="form-control" type="text" name="pph" value="<?php echo $pemasukan->pph;?>">
          </div>
          <?php echo form_error('pph', '<small class="text-danger">', '</small>'); ?>
        </div>

        <div class="form-group">
          <label for="example-text-input" class="col-form-label">Fee </label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text"><i class="fas fa-file-signature"></i></div>
            </div>
            <input class="form-control" type="text" name="fee" value="<?php echo $pemasukan->fee;?>">
          </div>
          <?php echo form_error('fee', '<small class="text-danger">', '</small>'); ?>
        </div>



        <div class="form-group">
          <input class="btn btn-primary" type="submit" value="Update Data">

        </div>

        <?php echo form_close();?>

      </div>
    </div>
  </div>


  <div class="col-md-4">


    <div class="card">
      <div class="card-body">


        <h4><b> Cusotmer Information</b></h4>
        <hr>
        <!-- Input Hidden data produk -->

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Nomor Handphone </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-phone"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->user_phone;?>" readonly>
              </div>
              <?php echo form_error('nomor_hp', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Nama Pelanggan </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-user"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->user_name;?>" readonly>
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
                <input class="form-control" type="text" value="<?php echo $pemasukan->user_address;?>" readonly>
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
              <label for="example-text-input" class="col-form-label">Mobil</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-car"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->car_name;?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Paket </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-car"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->paket_name;?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Start Date </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->start_date;?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">End Date</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->end_date;?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Driver</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-slash"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->driver_name;?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Metode Pembayaran </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-slash"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->payment_method;?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Lama Sewa </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-slash"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->long_term;?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Harga Sewa </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-slash"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo number_format($pemasukan->harga,'0',',','.');?>" readonly>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
