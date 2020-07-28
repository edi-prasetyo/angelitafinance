<a href="" class="text-primary" data-toggle="modal" data-target="#Edit<?php echo $pemasukan->id; ?>">
    <i class="fa fa-eye"></i> 
</a>

<div class="modal modal-default fade" id="Edit<?php echo $pemasukan->id; ?>">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pemasukan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">

                <div class="col-md-12">
            <h4><b> Customer Information</b></h4>
            <hr>
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
            </div>


            

</div>
        
<div class="col-md-6">
       
            
          
<div class="form-group">
              <label for="example-text-input" class="col-form-label">Nomor Handphone </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-phone"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->user_phone;?>" readonly>
              </div>
            </div>
     
        
</div>

<div class="row">
          
          <div class="col-md-12">
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
        
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Start Date </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->start_date;?>" readonly>
              </div>
            </div>
        

         
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">End Date</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->end_date;?>" readonly>
              </div>
            </div>
       

    
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
        

         
            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Lama Sewa </label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fas fa-user-slash"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->long_term;?>" readonly>
              </div>
            </div>

            <div class="form-group">
              <label for="example-text-input" class="col-form-label">Alamat <span class="text-success">( Optional )</span></label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text"><i class="fa fa-map-marker-alt"></i></div>
                </div>
                <input class="form-control" type="text" value="<?php echo $pemasukan->user_address;?>" readonly>
              </div>
            </div>
      

     
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

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary pull-right" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>

            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->