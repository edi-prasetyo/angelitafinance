<?php

$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);

//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success alert-dismissable fade show">';
    echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>
<!-- Invoice Example -->
<div class="mb-4">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
                </div>
                <div class="col-md-3">
                <a class="m-0 float-right btn btn-primary bg-gradient-primary btn-block" href="<?php echo base_url('admin/pengeluaran/create'); ?>">Buat pengeluaran <i class="fa fa-plus ml-3"></i></a>
                </div>
                <div class="col-md-3">
                    <a class="m-0 float-right btn btn-primary bg-gradient-primary btn-block" href="<?php echo base_url('admin/pengeluaran/filter_alpengeluaran'); ?>">Filter Data Per tanggal <i class="fa fa-calendar ml-3"></i></a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Kategory</th>
                        <th>desc</th>
                        <th>Pengeluaran</th>
                        <th width="22%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pengeluaran as $pengeluaran) : ?>
                        <tr>
                            <td class="text-info"><?php echo $no; ?></td>
                            <td><?php echo $pengeluaran->kas_tanggal; ?></td>
                            <td>
                            <?php echo $pengeluaran->kas_description; ?>
                            </td>
                            <td><?php echo $pengeluaran->category_name; ?></td>
                            <td><?php echo $pengeluaran->kas_description; ?></td>
                            <td>
                                    Rp. <?php echo number_format($pengeluaran->kas_keluar, '0', ',', '.') ?>
                            </td>
                            <td>
                                <?php include "view_pengeluaran.php"; ?>
                                <a href="<?php echo base_url('admin/pengeluaran/update/' . $pengeluaran->id); ?>" class="btn btn-sm btn-info"><i class="ti-pencil-alt"></i> edit</a>
                                <?php if ($user->role_id == 3) : ?>

                                <?php else:?>
                                    <?php include "delete_pengeluaran.php"; ?>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php $no++;
                    endforeach; ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th width="5%"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th style="font-size: 30px;">Jumlah</th>
                        <th style="font-size: 30px;">Rp. <?php echo number_format($total_pengeluaran, '0', ',', '.'); ?></th>
                        <th width="22%"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="card-footer">


        </div>

    </div>

    <div class="pagination col-md-12 text-center mt-3">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>
</div>
