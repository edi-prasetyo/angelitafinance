<div class="col-9 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
        <?php echo form_open('admin/pelanggan/update/'.$pelanggan->id);?>
            <div class="row">

               

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Nomor Handphone <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="user_phone" id="user_phone" value="<?php echo $pelanggan->user_phone;?>">
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
                        <input class="form-control" type="text" name="user_name" value="<?php echo $pelanggan->user_name;?>">
                    </div>
                    <?php echo form_error('user_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Alamat <span class="text-success">( Optional )</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-home"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="user_address" value="<?php echo $pelanggan->user_address;?>">
                    </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        
                        <input class="btn btn-primary" type="submit" value="Update Pelanggan">
                    
                    </div>
                </div>

                

            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>