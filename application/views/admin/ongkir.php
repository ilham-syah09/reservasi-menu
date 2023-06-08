<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title; ?></h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
						<li class="breadcrumb-item active"><?= $title; ?></li>
					</ol>
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
						<div class="card-header">
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addOngkir">Add Ongkir</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="example">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Kecamatan</th>
											<th>Harga</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($ongkir as $o) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
												<td><?= $o->kecamatan; ?></td>
												<td><?= 'Rp. ' . number_format($o->harga, 0, ',', '.'); ?></td>
												<td>
													<div class="dropdown">
														<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Action
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<a href="#" class="dropdown-item edit_btn" data-toggle="modal" data-target="#editOngkir" data-id="<?= $o->id; ?>" data-kecamatan="<?= $o->kecamatan; ?>" data-harga="<?= $o->harga; ?>">Edit</a>
															<a href="<?= base_url('admin/ongkir/delete/' . $o->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="dropdown-item">Delete</a>
														</div>
													</div>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal add -->
<div class="modal fade" id="addOngkir" tabindex="-1" role="dialog" aria-labelledby="addOngkir" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/ongkir/add'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Kecamatan</label>
								<input type="text" class="form-control" name="kecamatan">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Harga</label>
								<input type="number" class="form-control" name="harga">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- modal edit -->
<div class="modal fade" id="editOngkir" tabindex="-1" role="dialog" aria-labelledby="editMenu" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Ongkir</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/ongkir/edit'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="id" id="id">
							<div class="form-group">
								<label>Kecamatan</label>
								<input type="text" class="form-control" name="kecamatan" id="kecamatan">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label>Harga</label>
								<input type="number" class="form-control" name="harga" id="harga">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let kecamatan = $(this).data('kecamatan');
			let harga = $(this).data('harga');

			$('#id').val(id);
			$('#kecamatan').val(kecamatan);
			$('#harga').val(harga);
		});
	});
</script>