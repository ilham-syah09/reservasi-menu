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
            <div class="row mb-3">
                <div class="col-lg-4 col-md-12">
                    <label>Tanggal</label>
                    <input type="date" class="form-control" value="<?= $date; ?>" id="by_tanggal">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="examples">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Pembeli</th>
                                            <th>Tanggal Pesanan</th>
                                            <th>No HP</th>
                                            <th>Catatan</th>
                                            <th>Alamat</th>
                                            <th>Bukti Bayar</th>
                                            <th>Status Pembayaran</th>
                                            <th>Keterangan</th>
                                            <th>Total Biaya</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0;
                                        foreach ($pesanan as $i => $psn) : ?>
                                            <?php $total += $psn->totalBiaya; ?>
                                            <tr>
                                                <td><?= $i + 1; ?></td>
                                                <td><?= $psn->name; ?></td>
                                                <td><?= date('d M Y - H:i', strtotime($psn->createdAt)); ?></td>
                                                <td><?= $psn->noHp; ?></td>
                                                <td><?= $psn->catatan; ?></td>
                                                <td><?= $psn->alamat; ?></td>
                                                <td>
                                                    <?php if ($psn->buktiPembayaran != null) : ?>
                                                        <a href="<?= base_url('upload/bukti/' . $psn->buktiPembayaran); ?>" target="_blank">
                                                            <img src="<?= base_url('upload/bukti/' . $psn->buktiPembayaran); ?>" alt="<?= $psn->buktiPembayaran; ?>" class="img-thumbnail" width="180">
                                                        </a>
                                                    <?php else : ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($psn->statusPembayaran == 0) : ?>
                                                        <span class="badge badge-warning">Belum Bayar</span>
                                                    <?php elseif ($psn->statusPembayaran == 1) : ?>
                                                        <span class="badge badge-success">Lunas</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= $psn->opsi . ' | ' . date('d M Y', strtotime($psn->tanggal)) . ' - ' . $psn->jam; ?></td>
                                                <td><?= 'Rp. ' . number_format($psn->totalBiaya, 0, ',', '.'); ?></td>
                                                <td>
                                                    <a href="#" class="badge badge-info detail_btn" data-toggle="modal" data-target="#detailPesanan" data-iduser="<?= $psn->idUser; ?>" data-idkhusus="<?= $psn->idKhusus; ?>" data-link="<?= base_url('admin/pesanan/cetak/' . $psn->idUser . '/' . $psn->idKhusus); ?>">Detail</a>
                                                    <a href="#" class="badge badge-success statusPem_btn" data-toggle="modal" data-target="#statusPembayaranModal" data-iduser="<?= $psn->idUser; ?>" data-idkhusus="<?= $psn->idKhusus; ?>" data-statuspembayaran="<?= $psn->statusPembayaran; ?>">Pembayaran</a>
                                                    <a href="<?= base_url('admin/pesanan/delete/' . $psn->idKhusus); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9" class="text-center">Total pemasukan hari ini</td>
                                            <td colspan="2"><?= 'Rp. ' . number_format($total, 0, ',', '.'); ?></td>
                                        </tr>
                                    </tfoot>
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
    $('#by_tanggal').change(function() {
        let tanggal = $(this).val();

        document.location.href = `<?php echo base_url('admin/pesanan/index/') ?>${tanggal}`;
    });

    let detail_btn = $('.detail_btn');

    $(detail_btn).each(function(i) {
        $(detail_btn[i]).click(function() {
            let idUser = $(this).data('iduser');
            let idKhusus = $(this).data('idkhusus');
            let link = $(this).data('link');

            $("#cetak-btn").attr("href", link);

            $.ajax({
                url: `<?= base_url('admin/pesanan/getListPesanan'); ?>`,
                type: 'get',
                dataType: 'json',
                data: {
                    idUser,
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
                                "<td>" + res.data[i].harga + "</td>" +
                                "<td>" + res.data[i].total + "</td>" +
                                "<td>" + rupiah.format(harga) + "</td>" +
                                "<tr>"
                            );
                        });

                        if (res.data[0].opsi == 'Delivery') {
                            $("#tabel_detail").append(
                                "<tr class='tr_ongkir'>" +
                                "<td colspan='3' class='text-center'>Pengiriman</td>" +
                                "<td>" + res.data[0].kecamatan + "</td>" +
                                "<td>" + rupiah.format(res.data[0].ongkir) + "</td>" +
                                "<tr>"
                            );

                            finalHarga = rupiah.format(Number(totalHarga) + Number(res.data[0].ongkir));
                        } else {
                            $("#tabel_detail").append(
                                "<tr class='tr_ongkir'>" +
                                "<td colspan='4' class='text-center'>" + res.data[0].opsi + "</td>" +
                                "<td>Rp. 0</td>" +
                                "<tr>"
                            );

                            finalHarga = rupiah.format(Number(totalHarga));
                        }

                        $("#tabel_detail").append(
                            "<tr class='tr_total'>" +
                            "<td colspan='4' class='text-center'>Total Bayar</td>" +
                            "<td>" + finalHarga + "</td>" +
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

    let statusPem_btn = $('.statusPem_btn');

    $(statusPem_btn).each(function(i) {
        $(statusPem_btn[i]).click(function() {
            let idUser = $(this).data('iduser');
            let idKhusus = $(this).data('idkhusus');
            let statusPembayaran = $(this).data('statuspembayaran');

            $('#idUser').val(idUser);
            $('#idKhusus').val(idKhusus);
            $('#statusPembayaran').val(statusPembayaran);
        });
    });
</script>