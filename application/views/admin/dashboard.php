<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $title; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:void(0)" class="text-decoration-none">
                                <h1 class="mb-4 display-5 font-weight-semi-bold"><img src="<?= base_url('assets/logo/logo.png'); ?>" alt="Citra Bakery" class="img img-circle mr-2" width="120">Citra Bakery</h1>
                            </a>
                            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Jalan Panggung Baru No. 19 Kecamatan Tegal Timur Kota Tegal</p>
                            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>admin@citrabakery.com</p>
                            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>0815 6900 053</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('admin/menu'); ?>" class="text-dark">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah Menu</span>
                                <span class="info-box-number">
                                    <?= $menu; ?>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('admin/pesanan'); ?>" class="text-dark">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah Order</span>
                                <span class="info-box-number"><?= $orders; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('admin/omset'); ?>" class="text-dark">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Pemasukan</span>
                                <span class="info-box-number"><?= 'Rp. ' . number_format($totalPemasukan, 0, ',', '.'); ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="<?= base_url('admin/user'); ?>" class="text-dark">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Jumlah User</span>
                                <span class="info-box-number"><?= $user; ?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->