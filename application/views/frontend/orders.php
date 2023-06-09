<!-- Cart Start -->
<div class="container-fluid pt-5">
	<div class="row px-xl-5">
		<div class="col-lg-12 table-responsive mb-5">
			<table class="table table-bordered text-center mb-0">
				<thead class="bg-secondary text-dark">
					<tr>
						<th>Opsi</th>
						<th>Delivery/ Pick-up Schedule</th>
						<th>Address</th>
						<th>Note</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($orders as $order) : ?>
						<tr>
							<td><?= $order->opsi; ?></td>
							<td><?= date('d M Y', strtotime($order->tanggal)) . ' - ' . $order->jam; ?></td>
							<td><?= $order->alamat; ?></td>
							<td><?= $order->catatan; ?></td>
							<td class="align-middle">
								<button type="button" class="btn btn-sm btn-primary detail_btn" data-toggle="modal" title="Detail Product" data-target="#detailProduct" data-idkhusus="<?= $order->idKhusus; ?>" data-link="<?= base_url('print/' . $order->idKhusus); ?>"><i class="fa fa-info"></i></button>
								<?php if ($order->statusPembayaran == 0) : ?>
									<button type="button" class="btn btn-sm btn-success upload_btn" data-toggle="modal" title="Upload transfer invoice" data-target="#uploadBerkas" data-idkhusus="<?= $order->idKhusus; ?>"><i class="fa fa-upload"></i></button>
								<?php endif; ?>
								<?php if ($order->buktiPembayaran != null) : ?>
									<button type="button" class="btn btn-sm btn-warning view_btn" data-toggle="modal" title="View transfer invoice" data-target="#viewFile" data-file="<?= $order->buktiPembayaran; ?>"><i class="fa fa-eye"></i></button>
								<?php endif; ?>
								<?php if ($order->statusPembayaran == 1) : ?>
									<button type="button" class="btn btn-sm btn-info progres_btn" data-toggle="modal" title="View Progress Order" data-target="#progresModal" data-idkhusus="<?= $order->idKhusus; ?>"><i class="fa fa-circle-notch"></i></button>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<!-- Cart End -->

<!-- modal detail pesanan -->
<div class="modal fade" id="detailProduct" tabindex="-1" role="dialog" aria-labelledby="detailProductTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div id="tampil" class="d-none">
								<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
									<table class="table table-bordered table-hover table-vcenter" id="tabel_detail">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Product</th>
												<th>Quantity</th>
												<th>Price</th>
												<th>Subtotal</th>
												<th>View Product</th>
											</tr>
										</thead>
										<tbody id="isi_table">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<a class="btn btn-primary" target="_blank" id="cetak-btn">Print</a>
			</div>
		</div>
	</div>
</div>

<!-- modal upload berkas -->
<div class="modal fade" id="uploadBerkas" tabindex="-1" role="dialog" aria-labelledby="uploadBerkas" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Upload transfer invoice</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('uploadBerkas'); ?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="idKhusus" id="idKhusus">
							<div class="form-group">
								<label>File</label>
								<input type="file" class="form-control" name="gambar" accept=".jpeg, .jpg, .png">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal view file -->
<div class="modal fade" id="viewFile" tabindex="-1" role="dialog" aria-labelledby="viewFile" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">View transfer invoice</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Picture</label>
							<br>
							<img src="" alt="Picture invoice" class="img-thumbnail" width="100%" id="image-file">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- modal progres order -->
<div class="modal fade" id="progresModal" tabindex="-1" role="dialog" aria-labelledby="progresModalTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Progres Order</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div id="tampil-progres" class="d-none">
								<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
									<table class="table table-bordered table-hover table-vcenter" id="tabel-progres">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Status</th>
												<th>Date</th>
											</tr>
										</thead>
										<tbody id="isi_table-progres">

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script>
	let detail_btn = $('.detail_btn');

	$(detail_btn).each(function(i) {
		$(detail_btn[i]).click(function() {
			let idKhusus = $(this).data('idkhusus');
			let link = $(this).data('link');

			$("#cetak-btn").attr("href", link);

			$.ajax({
				url: `<?= base_url('getListProduct'); ?>`,
				type: 'get',
				dataType: 'json',
				data: {
					idKhusus
				},
				async: true,
				beforeSend: function(e) {
					$('#loader').removeClass('d-none');
					$('#tampil').addClass('d-none');
				},
				success: function(res) {
					$('#tampil').removeClass('d-none');
					$('.tr_isi').remove();
					$('.tr_ongkir').remove();
					$('.tr_total').remove();

					if (res.data != null) {
						let totalHarga = 0;
						let harga = 0;
						let finalHarga;

						let rupiah = new Intl.NumberFormat('id-ID', {
							style: 'currency',
							currency: 'IDR'
						});

						$(res.data).each(function(i) {
							harga = (res.data[i].total * res.data[i].harga);
							totalHarga += harga;

							$("#tabel_detail").append(
								"<tr class='tr_isi'>" +
								"<td class='text-center'>" + (i + 1) + "</td>" +
								"<td>" + res.data[i].nama_menu + "</td>" +
								"<td>" + res.data[i].total + "</td>" +
								"<td>" + rupiah.format(res.data[i].harga) + "</td>" +
								"<td>" + rupiah.format(harga) + "</td>" +
								`<td><a href="<?= base_url('detail/'); ?>${res.data[i].idMenu}" class="badge badge-info"><i class="fa fa-eye"></a></td>` +
								"<tr>"
							);
						});

						if (res.data[0].opsi == 'Delivery') {
							$("#tabel_detail").append(
								"<tr class='tr_ongkir'>" +
								"<td colspan='3' class='text-center'>Shipping</td>" +
								"<td>" + res.data[0].kecamatan + "</td>" +
								"<td>" + rupiah.format(res.data[0].ongkir) + "</td>" +
								"<td></td>" +
								"<tr>"
							);

							finalHarga = rupiah.format(Number(totalHarga) + Number(res.data[0].ongkir));
						} else {
							$("#tabel_detail").append(
								"<tr class='tr_ongkir'>" +
								"<td colspan='4' class='text-center'>" + res.data[0].opsi + "</td>" +
								"<td>Rp. 0</td>" +
								"<td></td>" +
								"<tr>"
							);

							finalHarga = rupiah.format(Number(totalHarga));
						}

						$("#tabel_detail").append(
							"<tr class='tr_total'>" +
							"<td colspan='4' class='text-center'>Total</td>" +
							"<td>" + finalHarga + "</td>" +
							"<td></td>" +
							"<tr>"
						);
					} else {
						$("#tabel_detail").append(
							"<tr class='tr_isi'>" +
							"<td colspan='5' class='text-center'>Kosong</td>" +
							"<tr>");
					}
				},
				complete: function() {
					$('#tampil').removeClass('d-none');
					$('#loader').addClass('d-none');
				}
			});
		});
	});

	let upload_btn = $('.upload_btn');

	$(upload_btn).each(function(i) {
		$(upload_btn[i]).click(function() {
			let idKhusus = $(this).data('idkhusus');

			$('#idKhusus').val(idKhusus);
		})
	});

	let view_btn = $('.view_btn');

	$(view_btn).each(function(i) {
		$(view_btn[i]).click(function() {
			let file = $(this).data('file');

			$("#image-file").attr("src", `<?= base_url('upload/bukti/'); ?>${file}`);
		});
	});

	let progres_btn = $('.progres_btn');

	$(progres_btn).each(function(i) {
		$(progres_btn[i]).click(function() {
			let idKhusus = $(this).data('idkhusus');

			$.ajax({
				url: `<?= base_url('getListProgres'); ?>`,
				type: 'get',
				dataType: 'json',
				data: {
					idKhusus
				},
				async: true,
				beforeSend: function(e) {
					$('#tampil-progres').addClass('d-none');
				},
				success: function(res) {
					$('#tampil-progres').removeClass('d-none');
					$('.tr_isi-progres').remove();

					if (res.data != null) {
						$(res.data).each(function(i) {
							$("#tabel-progres").append(
								`<tr class='tr_isi-progres'>
                                <td class='text-center'>${i + 1}</td>
                                <td>${res.data[i].status}</td>
                                <td>${res.data[i].createdAt}</td>
                                <tr>`
							);
						});

					} else {
						$("#tabel-progres").append(
							"<tr class='tr_isi-progres'>" +
							"<td colspan='2' class='text-center'>Empty</td>" +
							"<tr>");
					}
				},
				complete: function() {
					$('#tampil-progres').removeClass('d-none');
				}
			});
		});
	});
</script>