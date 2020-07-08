<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>



    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
          
                    <a href="<?php echo base_url('admin/dashboard');?>">Admin</a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">

                        <?php if ($user->role_id == 1) : ?>
                            <li class="active">
                                <a href="<?php echo base_url('admin/dashboard');?>" aria-expanded="true"><i class="ti-desktop"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/pelanggan');?>" aria-expanded="true"><i class="ti-user"></i><span>Pelanggan</span></a>
                            </li>
                            
                            <li>
                                <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i><span>Setings</span></a>
                                <ul class="collapse">
                                    <li><a href="<?php echo base_url('admin/meta');?>">Web Seting</a></li>
                                    <li><a href="<?php echo base_url('admin/meta/logo');?>">Logo</a></li>
                                    <li><a href="<?php echo base_url('admin/meta/favicon');?>">Favicon</a></li>
                                   
                                </ul>
                            </li>

                        <?php else:?>
                            
                            <li class="active">
                                <a href="<?php echo base_url('admin/dashboard');?>" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/pelanggan');?>" aria-expanded="true"><i class="ti-user"></i><span>Pelanggan</span></a>
                            </li>

                            <li>
                                <a href="<?php echo base_url('auth/logout'); ?>" aria-expanded="true"><i class="ti-power-off"></i><span>Logout</span></a>
                            </li>
                         
                        <?php endif;?>    
                            
                            
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->