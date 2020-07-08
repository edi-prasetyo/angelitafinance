
<div class="login-area">
<div class="container">
    <div class="col-md-6 mx-auto">
        <div class="login-box">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->

                <div class="p-5">
                    <div class="text-center">
                    <div class="login-form-head">
                        <h4>Sign In</h4>
                        <p>Hello there, Sign in and start managing your Angelitarentcar Customer</p>
                       
                    </div>
                    </div>
                    
                    <?php
                        echo form_open('auth')
                        ?>

<div class="login-form-body">
<?php echo $this->session->flashdata('message'); ?>
                    <div class="form-gp">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>">
                            <i class="ti-email"></i>
                            <div class="text-danger"></div>
                            <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                    <div class="form-gp">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" id="password">
                            <i class="ti-lock"></i>
                            <div class="text-danger"></div>
                            <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>

                        <div class="submit-btn-area">
                            <button type="submit">Submit <i class="ti-arrow-right"></i></button>
                            <div class="login-other row mt-4">                           
                            </div>
                        </div>
                        <?php echo form_close() ?>
                   
</div>
                    
                </div>

            </div>
        </div>
    </div>

</div>
</div>












