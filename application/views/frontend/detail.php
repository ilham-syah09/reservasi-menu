<!-- Shop Detail Start -->
<div class="container-fluid py-5">
	<div class="row px-xl-5">
		<div class="col-lg-5 pb-5">
			<div id="product-carousel" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner border">
					<?php foreach ($gambar as $i => $g) : ?>
						<div class="carousel-item <?= ($i == 0) ? 'active' : ''; ?>">
							<img class="w-100 h-100" src="<?= base_url('upload/gambar/' . $g->gambar); ?>" alt="Image">
						</div>
					<?php endforeach; ?>
				</div>
				<a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
					<i class="fa fa-2x fa-angle-left text-dark"></i>
				</a>
				<a class="carousel-control-next" href="#product-carousel" data-slide="next">
					<i class="fa fa-2x fa-angle-right text-dark"></i>
				</a>
			</div>
		</div>

		<div class="col-lg-7 pb-5">
			<h3 class="font-weight-semi-bold"><?= $product->nama_menu; ?></h3>
			<div class="d-flex mb-3">
				<div class="text-primary mr-2">
					<small class="fas fa-star"></small>
					<small class="fas fa-star"></small>
					<small class="fas fa-star"></small>
					<small class="fas fa-star-half-alt"></small>
					<small class="far fa-star"></small>
				</div>
				<small class="pt-1">(50 Reviews)</small>
			</div>
			<h3 class="font-weight-semi-bold mb-4"><?= 'Rp. ' . number_format($product->harga, 0, ',', '.'); ?></h3>
			<p class="mb-4">
				<?= $product->deskripsi; ?>
			</p>
			<p class="mb-4">
				<label class="font-weight-semi-bold">Stock : </label><?= ($product->stok > 0) ? ' ' . $product->stok : ' sold out'; ?>
			</p>
			<?php if ($product->stok > 0) : ?>
				<form action="<?= base_url('addToCart'); ?>" method="POST">
					<div class="d-flex align-items-center mb-4 pt-2">
						<input type="hidden" name="idMenu" value="<?= $product->id; ?>">
						<div class="input-group quantity mr-3" style="width: 130px;">
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary btn-minus">
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<input type="text" class="form-control bg-secondary text-center" value="1" name="total">
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary btn-plus">
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
						<button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
					</div>
				</form>
			<?php endif; ?>
		</div>
	</div>
	<div class="row px-xl-5">
		<div class="col">
			<div class="nav nav-tabs justify-content-center border-secondary mb-4">
				<a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
				<a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
			</div>
			<div class="tab-content">
				<div class="tab-pane fade show active" id="tab-pane-1">
					<h4 class="mb-3">Product Description</h4>
					<p>
						<?= $product->deskripsi; ?>
					</p>
				</div>
				<div class="tab-pane fade" id="tab-pane-3">
					<div class="row">
						<div class="col-md-6">
							<h4 class="mb-4">1 review for "<?= $product->nama_menu; ?>"</h4>
							<div class="media mb-4">
								<img src="<?= base_url(); ?>/assets/frontend/img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
								<div class="media-body">
									<h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
									<div class="text-primary mb-2">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star-half-alt"></i>
										<i class="far fa-star"></i>
									</div>
									<p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<h4 class="mb-4">Leave a review</h4>
							<small>Your email address will not be published. Required fields are marked *</small>
							<div class="d-flex my-3">
								<p class="mb-0 mr-2">Your Rating * :</p>
								<div class="text-primary">
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
									<i class="far fa-star"></i>
								</div>
							</div>
							<form>
								<div class="form-group">
									<label for="message">Your Review *</label>
									<textarea id="message" cols="30" rows="5" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<label for="name">Your Name *</label>
									<input type="text" class="form-control" id="name">
								</div>
								<div class="form-group">
									<label for="email">Your Email *</label>
									<input type="email" class="form-control" id="email">
								</div>
								<div class="form-group mb-0">
									<input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
	<div class="text-center mb-4">
		<h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
	</div>
	<div class="row px-xl-5">
		<div class="col">
			<div class="owl-carousel related-carousel">
				<?php foreach ($products as $product) : ?>
					<div class="card product-item border-0">
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
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
<!-- Products End -->