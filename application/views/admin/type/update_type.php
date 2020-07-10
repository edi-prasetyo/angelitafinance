<div class="col-9 mt-5 mx-auto">
    <div class="card">
        <div class="card-body">
        <?php echo form_open('admin/type/update/' .$type->id);?>
            <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                                            <label class="col-form-label">Merek</label>
                                            <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-check"></i></div>
                                                        </div>
                                            <select class="custom-select" name="brand_id">
                                            <?php foreach ($brand as $brand) : ?>
                                                <option value="<?php echo $brand->id ?>" <?php if ($type->brand_id == $brand->id) {
                                                                        echo "selected";
                                                                    } ?>><?php echo $brand->brand_name ?></option>
                                            <?php endforeach;?>
                                            </select>
                                            </div>
                                        </div>
                </div>
               
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Nama Mobil <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-car"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="type_name" value="<?php echo $type->type_name;?>">
                    </div>
                  
                    </div>
                </div>

                

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Penumpang <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="passenger" value="<?php echo $type->passenger;?>">
                    </div>
                   
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Bagasi <span class="text-danger">*</span></label>
                        <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-briefcase"></i></div>
                                                        </div>
                        <input class="form-control" type="text" name="luggage" value="<?php echo $type->luggage;?>">
                    </div>
                    
                    </div>
                </div>

                

                

                <div class="col-md-6">
                    <div class="form-group">
                        
                        <input class="btn btn-primary" type="submit" value="Simpan Mobil">
                    
                    </div>
                </div>

                

            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>