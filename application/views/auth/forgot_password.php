<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h4>Form Login</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('auth/forgotPassword'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="abc@gmail.com" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Verify</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <hr>
            <div class="text-center">
                <a href="<?= base_url('auth'); ?>"> Kembali ke login</a> <br>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>