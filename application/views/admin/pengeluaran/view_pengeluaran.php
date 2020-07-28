<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#Edit<?php echo $pengeluaran->id; ?>">
    <i class="ti-eye"></i> Lihat
</button>

<div class="modal modal-default fade" id="Edit<?php echo $pengeluaran->id ?>">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail pemasukan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">


                <div class="row">
                    <label class="col-md-4">Tanggal</label>
                    <div class="col-md-8">
                        : <b><?php echo $pengeluaran->kas_tanggal; ?></b>
                    </div>
                </div>
                
                <div class="row">
                    <label class="col-md-4">Kategory</label>
                    <div class="col-md-8">
                        : <b><?php echo $pengeluaran->category_name ?></b>
                    </div>
                </div>

                <div class="row">
                    <label class="col-md-4">Nominal</label>
                    <div class="col-md-8">
                        : <b>
                            
                                Rp. <?php echo number_format($pengeluaran->kas_keluar, '0', ',', '.') ?>
                         

                        </b>
                    </div>
                </div>
                <div class="row">
                    <label class="col-md-4">Keterangan</label>
                    <div class="col-md-8">
                        : <b><?php echo $pengeluaran->kas_description ?></b>
                    </div>
                </div>
                

            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->