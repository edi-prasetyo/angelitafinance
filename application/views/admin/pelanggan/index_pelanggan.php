<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
?>

<!-- Progress Table start -->
<div class="col-12">
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
                            <?php echo form_open('admin/pelanggan');?>
                           
                                            <div class="form-row d-flex justify-content-between align-items-center ">
                                            
                                                <div class="col-sm-7 my-1 row">
                                                
                                                    <div class="col-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="ti-user"></i></div>
                                                        </div>
                                                        <input type="text" class="form-control" name="keyword" placeholder="Cari Pelanggan">
                                                    </div>
                                                    </div>
                                                    <div class="col-auto">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                   
                                                </div>
                                                
                                                </div>
                                                <?php echo form_close();?>
                                               
                                                
                                                <a href="<?php echo base_url('admin/pelanggan/create');?>" class="btn btn-primary"><i class="ti-plus"></i> Add New</a>

                                            </div>
                                    
                                        <hr>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-center">
                                            <thead class="text-uppercase">
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">No Hanphone</th>
                                                    <th scope="col">Alamat</th>
                                                    <th scope="col">action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; foreach ($list_pelanggan as $list_pelanggan) :?>
                                                  
                                                <tr>
                                                    <th scope="row"><?php echo $no;?></th>
                                                    <td><?php echo $list_pelanggan->user_name;?></td>
                                                    <td><?php echo $list_pelanggan->user_phone;?></td>
                                                    <td><?php echo $list_pelanggan->user_address;?></td> 
                                                    <td>
                                                        
                                                        <?php if ($list_pelanggan->role_id == 1 || $list_pelanggan->role_id == 2 ) :?>
                                                            <?php else:?>
                                                            <a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/pelanggan/update/'.$list_pelanggan->id);?>" class="text-secondary"><i class="fa fa-edit"></i></a>
                                                            
                                                            <?php if ($user->role_id == 1) :?>
                                                                <?php include "delete_pelanggan.php";?>
                                                            <?php else:?>
                                                                
                                                            <?php endif;?>
                                                                                                                           
                                                            
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