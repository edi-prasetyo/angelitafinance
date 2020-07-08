<?php
$id = $this->session->userdata('id');
$user = $this->user_model->user_detail($id);
$meta = $this->meta_model->get_meta();
?>



    <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <!-- <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form> -->
                        </div>
                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                            
                            
                            <li class="settings-btn">
                                <i class="ti-settings"></i>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left"><?php echo $title ?></h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="<?php echo base_url('admin/dashboard');?>">Home</a></li>
                                <li><?php echo ucfirst(str_replace('_', ' ', $this->uri->segment(2))) ?></li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="<?php echo base_url('assets/img/avatars/' . $user->user_image); ?>" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $user->user_name; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url('admin/myaccount'); ?>">Myaccount</a>
                                <a class="dropdown-item" href="<?php echo base_url('admin/myaccount/update'); ?>">Ubah Profile</a>
                                <a class="dropdown-item" href="<?php echo base_url('admin/myaccount/ubah_password'); ?>">Ubah Password</a>
                                <a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">
                