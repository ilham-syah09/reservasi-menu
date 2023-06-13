<!-- Shop Start -->
<div class="container-fluid pt-5">
	<div class="row px-xl-5">
		<!-- Shop Sidebar Start -->
		<div class="col-lg-3 col-md-12">
			<!-- Price Start -->
			<div class="border-bottom mb-4 pb-4">
				<h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
				<form>
					<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
						<input type="checkbox" class="custom-control-input" id="price-1" value="1" <?= ($filter == 1) ? 'checked' : ''; ?>>
						<label class="custom-control-label" for="price-1">All Price</label>
						<span class="badge border font-weight-normal"><?= $countProduct[1]; ?></span>
					</div>
					<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
						<input type="checkbox" class="custom-control-input" id="price-2" value="2" <?= ($filter == 2) ? 'checked' : ''; ?>>
						<label class="custom-control-label" for="price-2">
							< Rp. 30.000</label>
								<span class="badge border font-weight-normal"><?= $countProduct[2]; ?></span>
					</div>
					<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
						<input type="checkbox" class="custom-control-input" id="price-3" value="3" <?= ($filter == 3) ? 'checked' : ''; ?>>
						<label class="custom-control-label" for="price-3">Rp. 30.000 - Rp. 50.000</label>
						<span class="badge border font-weight-normal"><?= $countProduct[3]; ?></span>
					</div>
					<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
						<input type="checkbox" class="custom-control-input" id="price-4" value="4" <?= ($filter == 4) ? 'checked' : ''; ?>>
						<label class="custom-control-label" for="price-4">> Rp. 50.000</label>
						<span class="badge border font-weight-normal"><?= $countProduct[4]; ?></span>
					</div>
					<div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
						<input type="checkbox" disabled class="custom-control-input" id="by-search" value="4" <?= ($filter != 1 && $filter != 2 && $filter != 3 && $filter != 4) ? 'checked' : ''; ?>>
						<label class="custom-control-label" for="by-search">By search</label>
					</div>
				</form>
			</div>
			<!-- Price End -->
		</div>
		<!-- Shop Sidebar End -->

		<!-- Shop Product Start -->
		<div class="col-lg-9 col-md-12">
			<div class="row pb-3">
				<div class="col-12 pb-1">
					<div class="row">
						<div class="col-12">
							<div class="d-flex align-items-center justify-content-between mb-4">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search by name" id="input-search" value="<?= ($filter != 1 && $filter != 2 && $filter != 3 && $filter != 4) ? $filter : ''; ?>" autocomplete="off">
									<div class="input-group-append">
										<span class="input-group-text bg-transparent text-primary" id="btn-search">
											<i class="fa fa-search"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php foreach ($products as $product) : ?>
					<div class="col-lg-4 col-6 pb-1">
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
								<a href="javascript:void(0)" class="btn btn-sm text-dark p-0"><i class="text-primary mr-1"><?= $product->stok; ?></i>Stock</a>
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

				<div class="col-12 pb-1 d-flex justify-content-between">
					<div class="text-primary my-auto">
						<?= 'Total product : ' . $total_rows; ?>
					</div>
					<nav aria-label="Page navigation">
						<?= $paging; ?>
					</nav>
				</div>
			</div>
		</div>
		<!-- Shop Product End -->
	</div>
</div>
<!-- Shop End -->

<script>
	$('#price-1').on('click', function() {
		$('#price-2').prop('checked', false);
		$('#price-3').prop('checked', false);
		$('#price-4').prop('checked', false);

		let filter = $(this).val();

		setTimeout(function() {
			document.location.href = `<?= base_url('shop/' . $kategori_ini); ?>/${filter}`;
		}, 1000);
	});

	$('#price-2').on('click', function() {
		$('#price-1').prop('checked', false);
		$('#price-3').prop('checked', false);
		$('#price-4').prop('checked', false);

		let filter = $(this).val();

		setTimeout(function() {
			document.location.href = `<?= base_url('shop/' . $kategori_ini); ?>/${filter}`;
		}, 1000);
	});

	$('#price-3').on('click', function() {
		$('#price-2').prop('checked', false);
		$('#price-1').prop('checked', false);
		$('#price-4').prop('checked', false);

		let filter = $(this).val();

		setTimeout(function() {
			document.location.href = `<?= base_url('shop/' . $kategori_ini); ?>/${filter}`;
		}, 1000);
	});

	$('#price-4').on('click', function() {
		$('#price-2').prop('checked', false);
		$('#price-3').prop('checked', false);
		$('#price-1').prop('checked', false);

		let filter = $(this).val();

		setTimeout(function() {
			document.location.href = `<?= base_url('shop/' . $kategori_ini); ?>/${filter}`;
		}, 1000);
	});

	$('#input-search').on('keypress', function(e) {
		if (e.which == 13) {
			search();
		}
	});

	$('#btn-search').on('click', function() {
		search();
	});

	const search = () => {
		const product = $('#input-search').val();

		setTimeout(function() {
			document.location.href = `<?= base_url('shop/' . $kategori_ini); ?>/${product}`;
		}, 500);
	}
</script>