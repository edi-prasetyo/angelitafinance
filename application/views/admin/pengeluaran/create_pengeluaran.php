<div class="text-center">
    <?php
    echo $this->session->flashdata('message');
    if (isset($error_upload)) {
        echo '<div class="alert alert-warning alert-dismissable"><button class="close" data-dismiss="alert" aria-label="Close">×</button>' . $error_upload . '</div>';
    }
    ?>
</div>
<div class="card">
    <div class="card-header">
        <?php echo $title; ?>
    </div>



    <div class="card-body">
        <?php
        echo form_open_multipart('admin/pengeluaran/create');
        ?>



            <div class="form-group row">
            <label class="col-lg-3 col-form-label">Tanggal</label>
            <div class="col-lg-6">
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="kas_tanggal" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
            </div>
</div>
          


        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Kategori <span class="text-danger">*</span>
            </label>
            <div class="col-lg-6">
                <select name="category_id" class="form-control custom-select">
                    <option></option>
                    <?php foreach ($category as $category) { ?>
                        <option value="<?php echo $category->id ?>">
                            <?php echo $category->category_name ?>
                        </option>
                    <?php } ?>
                </select>
                <?php echo form_error('category_id', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Nominal Rp. <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <input type="text" name="kas_keluar" class="form-control" placeholder="Nominal" value="<?php echo set_value('kas_keluar'); ?>">
                <?php echo form_error('kas_keluar', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>

        

        <div class="form-group row">
            <label class="col-lg-3 col-form-label">Keterangan <span class="text-danger"> *</span>
            </label>
            <div class="col-lg-6">
                <textarea class="form-control" id="summernote" name="kas_description"><?php echo set_value('kas_description'); ?></textarea>
                <?php echo form_error('kas_description', '<small class="text-danger">', '</small>'); ?>
            </div>
        </div>



        <div class="form-group row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Simpan
                </button>
            </div>
        </div>

        <?php echo form_close() ?>


    </div>
</div>