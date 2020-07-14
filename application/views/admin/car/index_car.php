<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
?>

<!-- Progress Table start -->
<div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                            <?php
//Notifikasi
if ($this->session->flashdata('message')) {
    echo '<div class="alert alert-success alert-dismissable fade show">';
    echo '<button class="close" data-dismiss="alert" aria-label="Close">×</button>';
    echo $this->session->flashdata('message');
    echo '</div>';
}
echo validation_errors('<div class="alert alert-warning">', '</div>');

?>
                            <?php echo form_open('admin/car');?>
                           
                                            <div class="form-row d-flex justify-content-between align-items-center ">
                                            
                                                <div class="col-sm-7 my-1 row">
                                                
                                                    <div class="col-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-search"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" name="keyword" placeholder="Cari Plat Nomor">
                                                    </div>
                                                    </div>
                                                    <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary">Cari</button>
                                                   
                                                </div>
                                                
                                                </div>
                                                <?php echo form_close();?>
                                               
                                                
                                                <a href="<?php echo base_url('admin/car/create');?>" class="btn btn-primary"><i class="ti-plus"></i> Add New</a>

                                            </div>
                                    
                                        <hr>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Plat Nomor</th>
                                                    <th scope="col">Nama Mobil</th>
                                                    <th scope="col">Warna</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach ($car as $car) :?>
                                                  
                                                <tr>
                                                    <th scope="row"><?php echo $no;?></th>
                                                    <td><?php echo $car->car_number;?></td>
                                                    <td><?php echo $car->type_name;?></td>
                                                    <td><?php echo $car->car_color;?></td> 
                                                    <td><?php if ($car->car_status == 'Active') :?>
                                                        <span class="badge badge-success">Aktif</span>
                                                    <?php else:?>
                                                        <span class="badge badge-danger">Inactive</span>
                                                    <?php endif;?>
                                                        
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url('admin/car/update/' .$car->id);?>" class="text-primary"><i class="fas fa-edit"></i></a>
                                                        
                                                        <?php if ($car->car_status == 'Active') :?>
                                                            <a class="text-danger" href="<?php echo base_url('admin/car/banned/'.$car->id);?>"><i class="fas fa-times-circle"></i></a>
                                                        <?php else:?>
                                                            <a class="text-success" href="<?php echo base_url('admin/car/activated/'.$car->id);?>"><i class="fas fa-check"></i></a>
                                                        <?php endif;?>
                                                            
                                                            
                                                            
                                                        
                                                    </td>
                                                </tr>
                                                
                                                <?php $no++; endforeach;  ?>
                                               
                                            </tbody>
                                        </table>

                                        <div class="pagination col-md-12 text-center mt-3">
        <?php if (isset($pagination)) {
            echo $pagination;
        } ?>
    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Progress Table end -->