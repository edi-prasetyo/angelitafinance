<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Angelita Finance</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/admin/css/adminlte.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/template/admin/css/font-awesome.min.css'); ?>">

</head>

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo base_url(); ?>" class="h1"><b>Angelita</b>Finance</a>
            </div>
            <div class="card-body">
                <?php echo $this->session->flashdata('message');
                unset($_SESSION['message']);
                ?>
                <p class="login-box-msg">Sign in to start your session</p>
                <?php echo form_open('auth'); ?>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>

        </div>

    </div>
</body>

</html>