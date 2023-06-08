<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css">

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
							<label>Delivery/ Pickup Date</label>
							<input class="form-control datepicker" name="tanggal" type="text" required id="tanggal" placeholder="yyyy/mm/dd">
						</div>
						<div class="col-md-6 form-group">
							<label>Delivery/ Pickup Hours</label>
							<input class="form-control js-masked-time" name="jam" type="text" required placeholder="__:__">
						</div>
						<div class="col-md-6 form-group">
							<label>Opsi</label>
							<select name="opsi" class="form-control" required>
								<option value="">-- Select Opsi --</option>
								<option value="Delivery">Delivery</option>
								<option value="Picked up">Picked up</option>
							</select>
						</div>
						<div class="col-md-6 form-group">
							<label>Shipping</label>
							<select name="idOngkir" class="form-control" id="ongkir" required>
								<option value="">-- Select Shipping --</option>
								<?php foreach ($ongkir as $o) : ?>
									<option value="<?= $o->id; ?>" data-ongkir="<?= $o->harga; ?>"><?= $o->kecamatan; ?></option>
								<?php endforeach; ?>
							</select>
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
						<?php $subTotal = 0; ?>
						<?php foreach ($cart as $c) : ?>
							<?php $subTotal += ($c->harga * $c->total); ?>
							<div class="d-flex justify-content-between">
								<p><?= $c->nama_menu; ?> <sup><?= '(' . $c->total . ')'; ?></sup></p>
								<p><?= 'Rp. ' . number_format(($c->harga * $c->total), 0, ',', '.'); ?></p>
							</div>
						<?php endforeach; ?>
						<input type="hidden" id="subTotal" value="<?= $subTotal; ?>">
						<hr class="mt-0">
						<div class="d-flex justify-content-between mb-3 pt-1">
							<h6 class="font-weight-medium">Subtotal</h6>
							<h6 class="font-weight-medium"><?= 'Rp. ' . number_format($subTotal, 0, ',', '.'); ?></h6>
						</div>
						<div class="d-flex justify-content-between">
							<h6 class="font-weight-medium">Shipping</h6>
							<h6 class="font-weight-medium" id="shipping"></h6>
						</div>
					</div>
					<div class="card-footer border-secondary bg-transparent">
						<div class="d-flex justify-content-between mt-2">
							<h5 class="font-weight-bold">Total</h5>
							<h5 class="font-weight-bold" id="total"></h5>
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

<script src="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?= base_url('assets/plugins/jquery.maskedinput/'); ?>jquery.maskedinput.min.js"></script>

<script>
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});

	$('#tanggal').datepicker('setStartDate', new Date());

	$('.js-masked-time').mask('99:99');

	$('#ongkir').change(function() {
		let rupiah = new Intl.NumberFormat('id-ID', {
			style: 'currency',
			currency: 'IDR'
		});

		let ongkir = $(this).find(':selected').data('ongkir');
		let subTotal = $('#subTotal').val();

		if (ongkir == undefined) {
			$('#shipping').text('');
			$('#total').text('');

			return 0;
		}

		let total = Number(ongkir) + Number(subTotal);

		$('#shipping').text(rupiah.format(ongkir));
		$('#total').text(rupiah.format(total));
	})
</script>