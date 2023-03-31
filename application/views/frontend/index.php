<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="<?= base_url(); ?>/assets/frontend/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url(); ?>/assets/frontend/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url(); ?>/assets/frontend/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/toastr/toastr.min.css">

    <script src="<?= base_url(); ?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
</head>

<body>
    <div class="toastr-success" data-flashdata="<?= $this->session->flashdata('toastr-success'); ?>"></div>
    <div class="toastr-error" data-flashdata="<?= $this->session->flashdata('toastr-error'); ?>"></div>

    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h3 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">CB</span>Citra Bakery</h3>
                </a>
            </div>
            <div class="col-lg-9 col-12 text-right">
                <a href="" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                <a href="" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge">0</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 2;">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <?php foreach ($kategori as $k) : ?>
                            <?php
                            if (isset($kategori_ini)) {
                                if ($kategori_ini == $k->id) {
                                    $class = 'active';
                                } else {
                                    $class = '';
                                }
                            } else {
                                $class = '';
                            }; ?>
                            <a href="<?= base_url('shop/' . $k->id); ?>" class="nav-item nav-link <?= $class; ?>"><?= $k->kategori; ?></a>
                        <?php endforeach; ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h3 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">CB</span>Citra Bakery</h3>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="<?= base_url(); ?>" class="nav-item nav-link <?= ($this->u1 == 'home') ? 'active' : ''; ?>">Home</a>
                            <a href="<?= base_url('shop'); ?>" class="nav-item nav-link <?= ($this->u1 == 'shop') ? 'active' : ''; ?>">Shop</a>
                            <a href="javascript:void(0)" class="nav-item nav-link <?= ($this->u1 == 'detail') ? 'active' : ''; ?>">Shop Detail</a>
                            <div class="nav-item dropdown">
                                <a href="javascript:void(0)" class="nav-link dropdown-toggle <?= ($this->u1 == 'cart' || $this->u1 == 'checkout' || $this->u1 == 'order') ? 'active' : ''; ?>" data-toggle="dropdown">Orders</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="<?= base_url('cart'); ?>" class="dropdown-item <?= ($this->u1 == 'cart') ? 'text-primary' : ''; ?>">Shopping Cart</a>
                                    <a href="javascript:void(0)" class="dropdown-item <?= ($this->u1 == 'checkout') ? 'text-primary' : ''; ?>">Checkout</a>
                                    <a href="<?= base_url('orders'); ?>" class="dropdown-item <?= ($this->u1 == 'orders') ? 'text-primary' : ''; ?>">List Orders</a>
                                </div>
                            </div>
                            <a href="<?= base_url('contact'); ?>" class="nav-item nav-link <?= ($this->u1 == 'contact') ? 'active' : ''; ?>">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <?php if ($this->dt_user == null) : ?>
                                <a href="<?= base_url('auth'); ?>" class="nav-item nav-link">Login</a>
                                <a href="<?= base_url('auth/registrasi'); ?>" class="nav-item nav-link">Register</a>
                            <?php else : ?>
                                <a href="<?= base_url('auth/logout'); ?>" class="nav-item nav-link">Logout</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <?php $this->load->view($page); ?>

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary text-dark mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">CB</span>Citra Bakery</h1>
                </a>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Jl. Kita Solusi, Kota Tegal, Jawa Tengah</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>admin@citrabakaery.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>0812 3423 4508</p>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-dark">
                    &copy; <a class="text-dark font-weight-semi-bold" href="#">Citra Bakery</a>. All Rights Reserved.
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="<?= base_url(); ?>/assets/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/frontend/lib/easing/easing.min.js"></script>
    <script src="<?= base_url(); ?>/assets/frontend/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="<?= base_url(); ?>/assets/frontend/mail/jqBootstrapValidation.min.js"></script>
    <script src="<?= base_url(); ?>/assets/frontend/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url(); ?>/assets/frontend/js/main.js"></script>

    <script src="<?= base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
    <script src="<?= base_url(); ?>assets/plugins/toastr/customScript.js"></script>
</body>

</html>