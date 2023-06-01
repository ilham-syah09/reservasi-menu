<div class="login-box">
    <!-- /.login-logo -->
    <div class="register-logo">
        <a href="../../index2.html"><b>CITRA BAKERY</a>
    </div>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h4>Form Login</h4>
        </div>
        <div class="card-body">
            <form action="<?= base_url('auth/proses'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="abc@gmail.com" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <hr>
            <div class="text-center">
                <span>Belum punya akun?</span><a href="<?= base_url('auth/registrasi'); ?>"> Daftar disini</a> <br>
                <a href="<?= base_url('auth/forgotPassword'); ?>">Lupa Password?</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>