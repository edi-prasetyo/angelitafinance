<div class="col-9 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
        <?php echo form_open('admin/car/create');?>
            <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                                            <label class="col-form-label">Pilih Mobil</label>
                                            <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-check"></i></div>
                                                        </div>
                                            <select class="custom-select" name="type_id">
                                            <?php foreach ($type as $type) : ?>
                                                <option value="<?php echo $type->id ?>"><?php echo $type->type_name ?></option>
                                            <?php endforeach;?>
                                            </select>
                                            </div>
                                        </div>
                </div>

               
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Plat Nomor <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-user"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="car_number" placeholder="B 3344 VSA">
                    </div>
                    <?php echo form_error('car_number', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Warna Mobil <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fa fa-tint"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="car_color" placeholder="Hijau..">
                    </div>
                    <?php echo form_error('car_color', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

              

                <div class="col-md-6">
                <div class="form-group">
                                            <label class="col-form-label"> Status Mobil</label>
                                            <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-check-box"></i></div>
                                                        </div>
                                            <select class="custom-select" name="car_status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                            </div>
                                        </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        
                        <input class="btn btn-primary" type="submit" value="Simpan Kendaraan">
                    
                    </div>
                </div>

                

            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>