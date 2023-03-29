<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
	<div id="header-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<?php foreach ($kategori as $i => $k) : ?>
				<div class="carousel-item <?= ($i == 0) ? 'active' : ''; ?>" style="height: 410px;">
					<img class="img-fluid" src="<?= base_url('upload/gambar/' . $k->gambar); ?>" alt="<?= $k->kategori; ?>">
					<div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
						<div class="p-3">
							<h3 class="display-4 text-white font-weight-semi-bold mb-4"><?= $k->kategori; ?></h3>
							<a href="<?= base_url('shop/' . $k->id); ?>" class="btn btn-light py-2 px-3">Shop Now</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
			<div class="btn btn-dark" style="width: 45px; height: 45px;">
				<span class="carousel-control-prev-icon mb-n2"></span>
			</div>
		</a>
		<a class="carousel-control-next" href="#header-carousel" data-slide="next">
			<div class="btn btn-dark" style="width: 45px; height: 45px;">
				<span class="carousel-control-next-icon mb-n2"></span>
			</div>
		</a>
	</div>
</div>
<!-- Page Header End -->

<!-- Categories Start -->
<div class="container-fluid pt-5">
	<div class="text-center mb-4">
		<h2 class="section-title px-5"><span class="px-2">Category Products</span></h2>
	</div>
	<div class="row px-xl-5 pb-3">
		<?php foreach ($productKategori as $product) : ?>
			<div class="col-lg-3 col-md-6 pb-1">
				<div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
					<p class="text-right"><?= $product->total; ?> Products</p>
					<a href="<?= base_url('shop/' . $product->id); ?>" class="cat-img position-relative overflow-hidden mb-3">
						<img class="img-fluid" src="<?= base_url('upload/gambar/' . gambar($product->idMenu)); ?>" alt="<?= $product->kategori; ?>">
					</a>
					<h5 class="font-weight-semi-bold m-0"><?= $product->kategori; ?></h5>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<!-- Categories End -->

<!-- Featured Start -->
<div class="container-fluid pt-5">
	<div class="row px-xl-5 pb-3">
		<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
			<div class="d-flex align-items-center border mb-4" style="padding: 30px;">
				<h1 class="fa fa-check text-primary m-0 mr-3"></h1>
				<h5 class="font-weight-semi-bold m-0">Quality Product</h5>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
			<div class="d-flex align-items-center border mb-4" style="padding: 30px;">
				<h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
				<h5 class="font-weight-semi-bold m-0">Free Shipping</h5>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
			<div class="d-flex align-items-center border mb-4" style="padding: 30px;">
				<h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
				<h5 class="font-weight-semi-bold m-0">14-Day Return</h5>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
			<div class="d-flex align-items-center border mb-4" style="padding: 30px;">
				<h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
				<h5 class="font-weight-semi-bold m-0">24/7 Support</h5>
			</div>
		</div>
	</div>
</div>
<!-- Featured End -->

<!-- Products Start -->
<div class="container-fluid pt-5">
	<div class="text-center mb-4">
		<h2 class="section-title px-5"><span class="px-2">Most Popular Products</span></h2>
	</div>
	<div class="row px-xl-5 pb-3">
		<?php foreach ($products as $product) : ?>
			<div class="col-lg-3 col-md-6 col-sm-12 pb-1">
				<div class="card product-item border-0 mb-4">
					<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
						<img class="img-fluid w-100" src="<?= base_url('upload/gambar/' . gambar($product->id)); ?>" alt="<?= $product->nama_menu; ?>">
					</div>
					<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
						<h6 class="text-truncate mb-3"><?= $product->nama_menu; ?></h6>
						<div class="d-flex justify-content-center">
							<h6><?= 'Rp. ' . number_format($product->harga, 0, ',', '.'); ?></h6>
						</div>
					</div>
					<div class="card-footer d-flex justify-content-between bg-light border">
						<a href="<?= base_url('detail/' . $product->id); ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
						<?php if ($product->stok > 0) : ?>
							<form action="<?= base_url('addToCart'); ?>" method="POST">
								<input type="hidden" name="idMenu" value="<?= $product->id; ?>">
								<button type="submit" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</button>
							</form>
						<?php else : ?>
							<a href="javascript:void(0)" class="btn btn-sm text-muted p-0" data-toggle="tooltip" title="Sold Out"><i class="fas fa-shopping-cart text-muted mr-1"></i><del>Add To Cart</del></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<!-- Products End -->

<!-- Vendor Start -->
<div class="container-fluid py-5">
	<div class="row px-xl-5">
		<div class="col">
			<div class="owl-carousel vendor-carousel">
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-1.jpg" alt="">
				</div>
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-2.jpg" alt="">
				</div>
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-3.jpg" alt="">
				</div>
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-4.jpg" alt="">
				</div>
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-5.jpg" alt="">
				</div>
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-6.jpg" alt="">
				</div>
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-7.jpg" alt="">
				</div>
				<div class="vendor-item border p-4">
					<img src="<?= base_url(); ?>/assets/frontend/img/vendor-8.jpg" alt="">
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Vendor End -->