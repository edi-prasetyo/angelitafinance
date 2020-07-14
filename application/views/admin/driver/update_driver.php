<div class="col-9 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
        <?php echo form_open('admin/driver/update/' .$driver->id);?>
            <div class="row">

               
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Nama Driver <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-user"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="driver_name" value="<?php echo $driver->driver_name;?>">
                    </div>
                    <?php echo form_error('driver_name', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Nomor Handphone <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-phone"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="driver_phone" value="<?php echo $driver->driver_phone;?>">
                    </div>
                    <?php echo form_error('driver_phone', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Driver Age <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-wheelchair"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="driver_age" value="<?php echo $driver->driver_age;?>">
                    </div>
                    <?php echo form_error('driver_age', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                                            <label class="col-form-label">Driver Status</label>
                                            <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-check-box"></i></div>
                                                        </div>
                                            <select class="custom-select" name="driver_status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive" <?php if ($driver->driver_status == "Inactive") {
                                                echo "selected";
                                            } ?>>Inactive</option>
                                            </select>
                                            </div>
                                        </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        
                        <input class="btn btn-primary" type="submit" value="Simpan Driver">
                    
                    </div>
                </div>

                

            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>