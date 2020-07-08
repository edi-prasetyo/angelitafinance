<!-- Progress Table start -->
<div class="col-12 mt-5">
                        <div class="card">
                            <div class="card-body">
                            <?php echo form_open('admin/pelanggan/search');?>
                           
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
                                                <?php $no = 1; foreach ($user as $list_pelanggan) :?>
                                                  
                                                <tr>
                                                    <th scope="row"><?php echo $no;?></th>
                                                    <td><?php echo $list_pelanggan->user_name;?></td>
                                                    <td><?php echo $list_pelanggan->user_phone;?></td>
                                                    <td><?php echo $list_pelanggan->user_address;?></td> 
                                                    <td>
                                                        <ul class="d-flex justify-content-center">
                                                            <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                            <li><a href="#" class="text-danger"><i class="ti-trash"></i></a></li>
                                                        </ul>
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