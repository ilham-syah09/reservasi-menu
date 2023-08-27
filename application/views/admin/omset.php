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
						<li class="breadcrumb-item"><a href="<?= base_url('admin/kategori'); ?>">Home</a></li>
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
						<div class="card-body">
							<button type="button" class="btn btn-warning" data-toggle="tooltip" title="Download Rekap" onclick="window.open('<?= base_url('admin/omset/all'); ?>')">
								<i class="fa fa-download"></i>
							</button>
							<div class="table-responsive mt-3">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Tahun</th>
											<th>Pemasukan</th>
										</tr>
									</thead>
									<tbody>
										<?php $total = 0;
										foreach ($dataTahunan as $i => $data) : ?>
											<?php $total += $data['subTotal']; ?>
											<tr>
												<td class="text-center"><?= $i + 1; ?></td>
												<td><?= $data['tahun']; ?></td>
												<td><?= 'Rp. ' . number_format($data['subTotal'], 0, ',', '.'); ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2" class="text-center">Total pemasukan</td>
											<td><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<div class="row">
				<div class="col-sm-4 col-xl-4">
					<div class="form-group">
						<label for="by_tahun">Tahun</label>
						<select class="js-select2 form-control" name="by_tahun" id="by_tahun">
							<option value="">-- Pilih Tahun --</option>
							<?php foreach ($tahun as $th) : ?>
								<option value="<?= $th->tahun; ?>" <?= ($th->tahun == $th_ini) ? 'selected' : ''; ?>>
									<?= $th->tahun; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<button type="button" class="btn btn-warning" data-toggle="tooltip" title="Download Rekap" onclick="window.open('<?= base_url('admin/omset/tahunan/' . $th_ini); ?>')">
								<i class="fa fa-download"></i>
							</button>
							<div class="table-responsive mt-3">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Bulan</th>
											<th>Pemasukan</th>
										</tr>
									</thead>
									<tbody>
										<?php $total = 0;
										foreach ($dataBulanan as $i => $data) : ?>
											<?php $total += $data['subTotal']; ?>
											<tr>
												<td class="text-center"><?= $i + 1; ?></td>
												<td><?= bulan($data['bulan']); ?></td>
												<td><?= 'Rp. ' . number_format($data['subTotal'], 0, ',', '.'); ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2" class="text-center">Total pemasukan</td>
											<td><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xl-4">
					<div class="form-group">
						<label for="by_bulan">Bulan</label>
						<select class="js-select2 form-control" name="by_bulan" id="by_bulan">
							<option value="">-- Pilih Bulan --</option>
							<?php foreach (range(1, 12) as $bulan) : ?>
								<option value="<?= $bulan; ?>" <?= ($bulan == $bln_ini) ? 'selected' : ''; ?>>
									<?= bulan($bulan); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<button type="button" class="btn btn-warning" data-toggle="tooltip" title="Download Rekap" onclick="window.open('<?= base_url('admin/omset/bulanan/' . $th_ini . '/' . $bln_ini); ?>')">
								<i class="fa fa-download"></i>
							</button>
							<div class="table-responsive mt-3">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Tanggal</th>
											<th>Pemasukan</th>
										</tr>
									</thead>
									<tbody>
										<?php $total = 0;
										foreach ($dataHarian as $i => $data) : ?>
											<?php $total += $data['subTotal']; ?>
											<tr>
												<td class="text-center"><?= $i + 1; ?></td>
												<td><?= date('d M Y', strtotime($data['tanggal'])); ?></td>
												<td><?= 'Rp. ' . number_format($data['subTotal'], 0, ',', '.'); ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="2" class="text-center">Total pemasukan</td>
											<td><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal detail pesanan -->
<div class="modal fade" id="detailPesanan" tabindex="-1" role="dialog" aria-labelledby="detailPesananTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detail Pesanan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div id="tampil" class="d-none">
								<label>Daftar Pesanan</label>
								<div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
									<table class="table table-bordered table-hover table-vcenter" id="tabel_detail">
										<thead>
											<tr>
												<th class="text-center">#</th>
												<th>Nama Menu</th>
												<th>Jumlah Pesanan</th>
												<th>Harga</th>
												<th>Total Harga</th>
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
				<a class="btn btn-primary" target="_blank" id="cetak-btn">Cetak</a>
			</div>
		</div>
	</div>
</div>

<!-- modal status pembayaran -->
<div class="modal fade" id="statusPembayaranModal" tabindex="-1" role="dialog" aria-labelledby="statusPembayaranModalTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Status Pembayaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/pesanan/status'); ?>" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="hidden" name="idUser" id="idUser">
								<input type="hidden" name="idKhusus" id="idKhusus">
								<label>Daftar Pesanan</label>
								<select name="statusPembayaran" id="statusPembayaran" class="form-control">
									<option value="0">Belum Bayar</option>
									<option value="1">Lunas</option>
								</select>
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
	$('#by_tahun').change(function() {
		let tahun = $(this).find(':selected').val();

		if (tahun === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/omset/index/') ?>${tahun}`;
	});

	$('#by_bulan').change(function() {
		let tahun = $('#by_tahun').find(':selected').val();
		let bulan = $(this).find(':selected').val();

		if (bulan === '') {
			return 0;
		}

		document.location.href = `<?php echo base_url('admin/omset/index/') ?>${tahun}/${bulan}`;
	});
</script>