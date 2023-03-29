 <!-- Cart Start -->
 <div class="container-fluid pt-5">
 	<div class="row px-xl-5">
 		<div class="col-lg-8 table-responsive mb-5">
 			<table class="table table-bordered text-center mb-0">
 				<thead class="bg-secondary text-dark">
 					<tr>
 						<th>Products</th>
 						<th>Price</th>
 						<th>Quantity</th>
 						<th>Total</th>
 						<th>Remove</th>
 					</tr>
 				</thead>
 				<tbody class="align-middle">
 					<?php $total = 0;; ?>
 					<?php foreach ($cart as $c) : ?>
 						<?php $total += ($c->harga * $c->total); ?>
 						<tr>
 							<td class="align-middle">
 								<img src="<?= base_url('upload/gambar/' . gambar($c->idMenu)); ?>" alt="<?= $c->nama_menu; ?>" class="img-thumbnail" style="width: 50px;"> <?= $c->nama_menu; ?>
 							</td>
 							<td class="align-middle"><?= 'Rp. ' . number_format($c->harga, 0, ',', '.'); ?></td>
 							<td class="align-middle">
 								<div class="input-group mx-auto" style="width: 100px;">
 									<div class="input-group-btn">
 										<button class="btn btn-sm btn-primary btn_minus" data-id="<?= $c->id; ?>">
 											<i class="fa fa-minus"></i>
 										</button>
 									</div>
 									<input type="text" class="form-control form-control-sm bg-secondary text-center input-total" value="<?= $c->total; ?>">
 									<div class="input-group-btn">
 										<button type="submit" class="btn btn-sm btn-primary btn_plus" data-id="<?= $c->id; ?>">
 											<i class="fa fa-plus"></i>
 										</button>
 									</div>
 								</div>
 							</td>
 							<td class="align-middle">
 								<?= 'Rp. ' . number_format(($c->harga * $c->total), 0, ',', '.'); ?>
 							</td>
 							<td class="align-middle">
 								<form action="<?= base_url('deleteCart'); ?>" method="POST">
 									<input type="hidden" name="id" value="<?= $c->id; ?>">
 									<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
 								</form>
 							</td>
 						</tr>
 					<?php endforeach; ?>
 				</tbody>
 			</table>
 		</div>
 		<div class="col-lg-4">
 			<div class="card border-secondary mb-5">
 				<div class="card-header bg-secondary border-0">
 					<h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
 				</div>
 				<div class="card-body">
 					<div class="d-flex justify-content-between mb-3 pt-1">
 						<h6 class="font-weight-medium">Subtotal</h6>
 						<h6 class="font-weight-medium" id="subTotal"><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></h6>
 					</div>
 					<div class="d-flex justify-content-between">
 						<h6 class="font-weight-medium">Shipping</h6>
 						<h6 class="font-weight-medium">Rp. 0</h6>
 					</div>
 				</div>
 				<div class="card-footer border-secondary bg-transparent">
 					<div class="d-flex justify-content-between mt-2">
 						<h5 class="font-weight-bold">Total</h5>
 						<h5 class="font-weight-bold" id="total"><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></h5>
 					</div>
 					<button class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</button>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
 <!-- Cart End -->

 <script>
 	let input_total = $('.input-total');

 	let btn_plus = $('.btn_plus');

 	$(btn_plus).each(function(i) {
 		$(btn_plus[i]).click(function() {
 			let id = $(this).data('id');

 			let tot = $(input_total[i]).val();
 			let total = parseInt(tot) + 1;

 			$(input_total[i]).val(total);

 			updateQty(id, total);
 		});
 	});

 	let btn_minus = $('.btn_minus');

 	$(btn_minus).each(function(i) {
 		$(btn_minus[i]).click(function() {
 			let id = $(this).data('id');

 			let tot = $(input_total[i]).val();
 			let total = parseInt(tot) - 1;

 			if (total == 0) {
 				total = 1;
 				toastr.warning('The minimum order cannot be less than one');

 				return 0;
 			}

 			$(input_total[i]).val(total);

 			updateQty(id, total);
 		});
 	});

 	const updateQty = (id, total) => {
 		$.ajax({
 			url: `<?= base_url('updateQuantity'); ?>`,
 			type: 'post',
 			dataType: 'json',
 			data: {
 				id,
 				total
 			},
 			success: function(res) {
 				$('#subTotal').text(res.total);
 				$('#total').text(res.total);

 				toastr.success('Successfully updated product quantity');
 			}
 		});
 	}
 </script>