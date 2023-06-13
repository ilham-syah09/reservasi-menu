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
			<?php if ($rating['total'] != 0) : ?>
				<div class="d-flex mb-3">
					<div class="text-primary mr-2">
						<?php if ($rating['rating'] < 1) : ?>
							<small class="fas fa-star-half-alt"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] == 1) : ?>
							<small class="fas fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] > 1 && $rating['rating'] < 2) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star-half-alt"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] == 2) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] > 2 && $rating['rating'] < 3) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star-half-alt"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] == 3) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="far fa-star"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] > 3 && $rating['rating'] < 4) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star-half-alt"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] == 4) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="far fa-star"></small>
						<?php elseif ($rating['rating'] > 4 && $rating['rating'] < 5) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star-half-alt"></small>
						<?php elseif ($rating['rating'] == 5) : ?>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
							<small class="fas fa-star"></small>
						<?php endif; ?>
					</div>
					<small class="pt-1">(<?= $rating['rating'] . ' / ' . $rating['total']; ?> Reviews)</small>
				</div>
			<?php endif; ?>
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
						<div class="input-group mr-3" style="width: 130px;">
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary" id="btn_minus">
									<i class="fa fa-minus"></i>
								</button>
							</div>
							<input type="text" class="form-control bg-secondary text-center" value="1" name="total" id="input_total">
							<div class="input-group-btn">
								<button type="button" class="btn btn-primary" id="btn_plus">
									<i class="fa fa-plus"></i>
								</button>
							</div>
						</div>
						<button type="submit" class="btn btn-primary px-3" id="add-to-cart"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
					</div>
				</form>
			<?php endif; ?>
		</div>
	</div>
	<div class="row px-xl-5">
		<div class="col">
			<div class="nav nav-tabs justify-content-center border-secondary mb-4">
				<a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
				<a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews (<?= $rating['total']; ?>)</a>
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
							<div class="row">
								<h4 class="mb-4"><?= $rating['total']; ?> review for "<?= $product->nama_menu; ?>"</h4>
								<?php foreach ($review as $rev) : ?>
									<div class="col-md-12">
										<div class="media mb-4">
											<img src="<?= base_url('upload/profile/' . $rev->image); ?>" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
											<div class="media-body">
												<h6><?= $rev->name; ?><small> - <i><?= date('d M Y', strtotime($rev->createdAt)); ?></i></small></h6>
												<div class="text-primary mb-2">
													<?php if ($rev->rating == 1) : ?>
														<i class="fas fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
													<?php elseif ($rev->rating == 2) : ?>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
													<?php elseif ($rev->rating == 3) : ?>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="far fa-star"></i>
														<i class="far fa-star"></i>
													<?php elseif ($rev->rating == 4) : ?>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="far fa-star"></i>
													<?php elseif ($rev->rating == 5) : ?>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
														<i class="fas fa-star"></i>
													<?php endif; ?>
												</div>
												<p><?= $rev->review; ?></p>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col-md-6">
							<h4 class="mb-4">Leave a review</h4>
							<small>Your email address will not be published. Required fields are marked *</small>
							<div class="d-flex my-3">
								<p class="mb-0 mr-2">Your Rating * :</p>
								<div class="text-primary">
									<i class="far fa-star" id="star-1"></i>
									<i class="far fa-star" id="star-2"></i>
									<i class="far fa-star" id="star-3"></i>
									<i class="far fa-star" id="star-4"></i>
									<i class="far fa-star" id="star-5"></i>
								</div>
							</div>
							<form action="<?= base_url('review'); ?>" method="POST">
								<input type="hidden" name="idMenu" value="<?= $product->id; ?>">
								<input type="hidden" name="rating" id="rating">
								<div class="form-group">
									<label for="message">Your Review *</label>
									<textarea id="message" cols="30" rows="5" name="review" class="form-control" required></textarea>
								</div>
								<div class="form-group">
									<label for="name">Your Name *</label>
									<input type="text" class="form-control" id="name" value="<?= ($this->dt_user) ? $this->dt_user->name : ''; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="email">Your Email *</label>
									<input type="email" class="form-control" id="email" value="<?= ($this->dt_user) ? $this->dt_user->email : ''; ?>" readonly>
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
				<?php foreach ($products as $pro) : ?>
					<div class="card product-item border-0">
						<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
							<img class="img-fluid w-100" src="<?= base_url('upload/gambar/' . gambar($pro->id)); ?>" alt="<?= $pro->nama_menu; ?>">
						</div>
						<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
							<h6 class="text-truncate mb-3"><?= $pro->nama_menu; ?></h6>
							<div class="d-flex justify-content-center">
								<h6><?= 'Rp. ' . number_format($pro->harga, 0, ',', '.'); ?></h6>
							</div>
						</div>
						<div class="card-footer d-flex justify-content-between bg-light border">
							<a href="<?= base_url('detail/' . $pro->id); ?>" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
							<a href="javascript:void(0)" class="btn btn-sm text-dark p-0">Stock <i class="text-primary mr-1"><?= $product->stok; ?></i></a>
							<?php if ($pro->stok > 0) : ?>
								<form action="<?= base_url('addToCart'); ?>" method="POST">
									<input type="hidden" name="idMenu" value="<?= $pro->id; ?>">
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

<script>
	const stok = <?php echo $product->stok; ?>;
	let totalSebelumnya = 1;

	$('#btn_plus').click(function() {
		let id = $(this).data('id');

		let tot = $('#input_total').val();
		let total = parseInt(tot) + 1;

		if (total > stok) {
			total = stok;
			toastr.warning('Orders cannot exceed stock');

			$('#input_total').val(total);
			$('#add-to-cart').prop('disabled', false);

			return 0;
		}

		$('#input_total').val(total);
		$('#add-to-cart').prop('disabled', false);
	});

	$('#btn_minus').click(function() {
		let id = $(this).data('id');

		let tot = $('#input_total').val();
		let total = parseInt(tot) - 1;

		if (total == 0) {
			total = 1;
			toastr.warning('The minimum order cannot be less than one');

			$('#add-to-cart').prop('disabled', false);

			return 0;
		}

		$('#input_total').val(total);
		$('#add-to-cart').prop('disabled', false);
	});

	$('#input_total').change(function() {
		let total = $(this).val();

		if (total > stok) {
			total = stok;
			toastr.warning('Orders cannot exceed stock');

			$('#input_total').val(total);

			$('#add-to-cart').prop('disabled', true);
		}

		if (total == '') {
			$('#input_total').val(totalSebelumnya);
		}

		$('#add-to-cart').prop('disabled', false);
	});

	$('#input_total').click(function() {
		totalSebelumnya = $(this).val();
		$('#add-to-cart').prop('disabled', true);
	});

	$('#star-1').click(function() {
		$(this).removeClass('far');
		$(this).addClass('fas');

		$('#star-2').removeClass('fas');
		$('#star-2').addClass('far');

		$('#star-3').removeClass('fas');
		$('#star-3').addClass('far');

		$('#star-4').removeClass('fas');
		$('#star-4').addClass('far');

		$('#star-5').removeClass('fas');
		$('#star-5').addClass('far');

		$('#rating').val(1);
	});

	$('#star-2').click(function() {
		$('#star-1').removeClass('far');
		$('#star-1').addClass('fas');

		$(this).removeClass('far');
		$(this).addClass('fas');

		$('#star-3').removeClass('fas');
		$('#star-3').addClass('far');

		$('#star-4').removeClass('fas');
		$('#star-4').addClass('far');

		$('#star-5').removeClass('fas');
		$('#star-5').addClass('far');

		$('#rating').val(2);
	});

	$('#star-3').click(function() {
		$('#star-1').removeClass('far');
		$('#star-1').addClass('fas');

		$('#star-2').removeClass('far');
		$('#star-2').addClass('fas');

		$(this).removeClass('far');
		$(this).addClass('fas');

		$('#star-4').removeClass('fas');
		$('#star-4').addClass('far');

		$('#star-5').removeClass('fas');
		$('#star-5').addClass('far');

		$('#rating').val(3);
	});

	$('#star-4').click(function() {
		$('#star-1').removeClass('far');
		$('#star-1').addClass('fas');

		$('#star-2').removeClass('far');
		$('#star-2').addClass('fas');

		$('#star-3').removeClass('far');
		$('#star-3').addClass('fas');

		$(this).removeClass('far');
		$(this).addClass('fas');

		$('#star-5').removeClass('fas');
		$('#star-5').addClass('far');

		$('#rating').val(4);
	});

	$('#star-5').click(function() {
		$('#star-1').removeClass('far');
		$('#star-1').addClass('fas');

		$('#star-2').removeClass('far');
		$('#star-2').addClass('fas');

		$('#star-3').removeClass('far');
		$('#star-3').addClass('fas');

		$('#star-4').removeClass('far');
		$('#star-4').addClass('fas');

		$(this).removeClass('far');
		$(this).addClass('fas');

		$('#rating').val(5);
	});
</script>