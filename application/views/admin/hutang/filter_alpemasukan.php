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

                <div class="form-group">
              <label class="col-form-label">Start Date</label>
              <div class="input-group date" id="start_date" data-target-input="nearest">
                <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#start_date"/>
                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>

                </div>
                <div class="col-lg-4 form-group">

                <div class="form-group">
              <label class="col-form-label">End Date</label>
              <div class="input-group date" id="end_date" data-target-input="nearest">
                <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#end_date"/>
                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>


              </div>
                </div>
                <div class="col-lg-4 form-group">
                <label class="col-form-label"><span style="color:transparent";>Label</span></label>
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
                  <thead class="text-uppercase">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tanggal</th>
                      <th scope="col">User</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col">Status</th>
                      <th scope="col">Pemasukan</th>

                    </tr>
                  </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($filter_alpemasukan as $filter_alpemasukan) : ?>
                            <tr>
                                <td class="text-info"><?php echo $no; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($filter_alpemasukan->kas_tanggal)); ?></td>
                                <td><?php echo $filter_alpemasukan->user_name;?></td>
                                <td><?php echo $filter_alpemasukan->car_name;?></td>
                                <td>
                                  <?php if ($filter_alpemasukan->payment_status == 'Hutang') :?>
                                    <span class="badge badge-danger"><?php echo $filter_alpemasukan->payment_status;?></span>
                                  <?php elseif ($filter_alpemasukan->payment_status == 'Proses') :?>
                                    <span class="badge badge-warning"><?php echo $filter_alpemasukan->payment_status;?></span>
                                  <?php else :?>
                                    <span class="badge badge-success"><?php echo $filter_alpemasukan->payment_status;?></span>
                                  <?php endif;?>
                                </td>

                                <td>
                                  Rp. <?php echo number_format($filter_alpemasukan->kas_masuk,'0',',','.');?></td>


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
