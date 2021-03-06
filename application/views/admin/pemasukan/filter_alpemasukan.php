<!-- Invoice Example -->
<div class="mb-4">
    <div class="card">
        <div class="card-header bg-gradient-primary">
            <h6 class="m-0 font-weight-bold text-white"><?php echo $title; ?></h6>

        </div>

        <div class="col-md-12">
            <?php echo form_open('admin/pemasukan/filter_alpemasukan'); ?>
            <div class="row my-3">


                <div class="col-lg-4 form-group">
                    <input type="text" name="start_date" class="form-control" placeholder="Dari Tanggal" id="start_date">

                </div>
                <div class="col-lg-4 form-group">
                    <input type="text" name="end_date" class="form-control" placeholder="Sampai Tanggal" id="end_date">

                </div>
                <div class="col-lg-4 form-group">
                    <button type="submit" class="btn btn-primary btn-block bg-gradient-primary"><i class="ti-search"></i> Tampilkan Data </button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>

        <div id="printableArea">
            <?php
            //Notifikasi
            if ($this->session->flashdata('messagefilter')) {
                echo '<div class="col-md-12"><div class="alert alert-info alert-dismissable fade show">';
                echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
                echo $this->session->flashdata('messagefilter');
                echo '</div></div>';
            }

            ?>

            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Asrama</th>

                            <th>Donatur</th>
                            <th>Kategori</th>
                            <th>Tipe</th>
                            <th>Nominal</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($filter_alpemasukan as $filter_alpemasukan) : ?>
                            <tr>
                                <td class="text-info"><?php echo $no; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($filter_alpemasukan->tanggal)); ?></td>
                                <td>
                                    <div class="badge badge-success bg-gradient-success"> <i class="fas fa-store"></i> <?php echo $filter_alpemasukan->asrama_name; ?></div><br>
                                    <i class="far fa-user"></i> <?php echo $filter_alpemasukan->user_name; ?>
                                </td>
                                <td><?php echo $filter_alpemasukan->donatur_title; ?> <?php echo $filter_alpemasukan->donatur_name; ?></td>
                                <td><?php echo $filter_alpemasukan->category_name; ?></td>
                                <td>
                                    <?php if ($filter_alpemasukan->type == 'Pemasukan') : ?>
                                        <span class="badge badge-success bg-gradient-success"><?php echo $filter_alpemasukan->type; ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-danger"><?php echo $filter_alpemasukan->type; ?></span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <?php if ($filter_alpemasukan->nominal == NULL) : ?>
                                        Rp. <?php echo '0'; ?>
                                    <?php else : ?>
                                        Rp. <?php echo number_format($filter_alpemasukan->nominal, '0', ',', '.') ?>
                                    <?php endif; ?>

                                </td>


                            </tr>
                            <tr>
                            </tr>
                        <?php $no++;

                        endforeach;
                        ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th style="font-size: 30px;">Jumlah</th>
                            <th style="font-size: 30px;">Rp. <?php echo number_format($total_pemasukan_aldate, '0', ',', '.'); ?></th>

                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card-footer">

            <button class="btn btn-primary bg-gradient-primary" type="button" onclick="printDiv('printableArea')"><i class="ti-printer"></i> Print</button>

        </div>



    </div>


</div>