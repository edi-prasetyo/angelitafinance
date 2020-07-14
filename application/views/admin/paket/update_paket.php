<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $paket->id; ?>">
    <i class="fa fa-edit"></i> Edit
</button>

<div class="modal modal-default fade" id="Edit<?php echo $paket->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Paket</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <?php
                //Error warning
                echo validation_errors('<div class="alert alert-warning">', '</div>');

                echo form_open(base_url('admin/paket/update/' . $paket->id));

                ?>

                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" class="form-control" name="paket_name" value="<?php echo $paket->paket_name ?>">
                </div>

                <div class="form-group">
                    <label>Ketentuan paket</label>
                    <textarea class="textarea" id="summernote" name="paket_term" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"value="<?php echo $paket->paket_term ?>"></textarea>
                </div>

                

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="submit" value="Update Data">
                </div>


                <?php
                //Form Close
                echo form_close();
                ?>


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