<!-- Checkout Start -->
<div class="container-fluid pt-5">
	<form action="<?= base_url('placeOrder'); ?>" method="POST">
		<div class="row px-xl-5">
			<div class="col-lg-8">
				<div class="mb-4">
					<h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
					<div class="row">
						<div class="col-md-6 form-group">
							<label>Full Name</label>
							<input class="form-control" name="name" readonly type="text" value="<?= $this->dt_user->name; ?>">
						</div>
						<div class="col-md-6 form-group">
							<label>Mobile No</label>
							<input class="form-control" name="noHp" type="text" value="<?= $this->dt_user->noHp; ?>" readonly>
						</div>
						<div class="col-md-6 form-group">
							<label>Address</label>
							<textarea name="alamat" cols="30" rows="5" class="form-control" required></textarea>
						</div>
						<div class="col-md-6 form-group">
							<label>Note</label>
							<textarea name="catatan" cols="30" rows="5" class="form-control"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card border-secondary mb-5">
					<div class="card-header bg-secondary border-0">
						<h4 class="font-weight-semi-bold m-0">Order Total</h4>
					</div>
					<div class="card-body">
						<h5 class="font-weight-medium mb-3">Products</h5>
						<?php $total = 0; ?>
						<?php foreach ($cart as $c) : ?>
							<?php $total += ($c->harga * $c->total); ?>
							<div class="d-flex justify-content-between">
								<p><?= $c->nama_menu; ?> <sup><?= '(' . $c->total . ')'; ?></sup></p>
								<p><?= 'Rp. ' . number_format(($c->harga * $c->total), 0, ',', '.'); ?></p>
							</div>
						<?php endforeach; ?>
						<hr class="mt-0">
						<div class="d-flex justify-content-between mb-3 pt-1">
							<h6 class="font-weight-medium">Subtotal</h6>
							<h6 class="font-weight-medium"><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></h6>
						</div>
						<div class="d-flex justify-content-between">
							<h6 class="font-weight-medium">Shipping</h6>
							<h6 class="font-weight-medium">Rp. 0</h6>
						</div>
					</div>
					<div class="card-footer border-secondary bg-transparent">
						<div class="d-flex justify-content-between mt-2">
							<h5 class="font-weight-bold">Total</h5>
							<h5 class="font-weight-bold"><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></h5>
						</div>
					</div>
				</div>
				<div class="card border-secondary mb-5">
					<div class="card-header bg-secondary border-0">
						<h4 class="font-weight-semi-bold m-0">Payment</h4>
					</div>
					<div class="card-body">
						<div class="form-group">
							<div class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="payment" value="1" id="qris">
								<label class="custom-control-label" for="qris">QRIS</label>
							</div>
						</div>
						<div class="">
							<div class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" name="payment" value="2" id="banktransfer">
								<label class="custom-control-label" for="banktransfer">Bank Transfer</label>
							</div>
						</div>
					</div>
					<div class="card-footer border-secondary bg-transparent">
						<button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place Order</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<!-- Checkout End -->