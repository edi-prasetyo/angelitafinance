<a href="" class="text-danger" data-toggle="modal" data-target="#Delete<?php
                                                                                            echo $transaksi->id ?>">
    <i class="far fa-trash-alt"></i>
</a>

<div class="modal modal-danger fade" id="Delete<?php echo $transaksi->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Menghapus Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda Yakin Ingin Menghapus Data  <b><?php echo $transaksi->kas_tanggal; ?></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                <a href="<?php echo base_url('admin/paket/delete/' . $transaksi->id) ?>" class="btn btn-danger pull-right"><i class="fa fa-trash-o"></i> Ya, Hapus data ini</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
