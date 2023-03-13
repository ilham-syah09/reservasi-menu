<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h4>Change password</h4>
        </div>

        <div class="text-center mt-4">
            <h6><?= $this->session->userdata('reset_email'); ?></h6>
        </div>

        <div class="card-body">
            <form action="<?= base_url('auth/changePassword'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="New password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="retype_password" placeholder="Retype new password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Change Password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>