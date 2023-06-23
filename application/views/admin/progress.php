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
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Pembeli</th>
                                            <th>Tanggal Pesanan</th>
                                            <th>No HP</th>
                                            <th>Catatan</th>
                                            <th>Alamat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($pesanan as $i => $psn) : ?>
                                            <tr>
                                                <td><?= $i + 1; ?></td>
                                                <td><?= $psn->name; ?></td>
                                                <td><?= date('d M Y - H:i', strtotime($psn->createdAt)); ?></td>
                                                <td><?= $psn->noHp; ?></td>
                                                <td><?= $psn->catatan; ?></td>
                                                <td><?= $psn->alamat; ?></td>
                                                <td>
                                                    <a href="#" class="badge badge-warning detail_btn" data-toggle="modal" data-target="#detailPesanan" data-iduser="<?= $psn->idUser; ?>" data-idkhusus="<?= $psn->idKhusus; ?>">Detail Pesanan</a>
                                                    <a href="#" class="badge badge-info progres_btn" data-toggle="modal" data-target="#progresPesanan" data-iduser="<?= $psn->idUser; ?>" data-idkhusus="<?= $psn->idKhusus; ?>">Progres</a>
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
            </div>
        </div>
    </div>
</div>

<!-- modal progres pesanan -->
<div class="modal fade" id="progresPesanan" tabindex="-1" role="dialog" aria-labelledby="progresPesananTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Progres Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addProgres">Tambah Progres</a>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div id="tampil-progres" class="d-none">
                                <div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
                                    <table class="table table-bordered table-hover table-vcenter" id="tabel-progres">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                                <th>Action</th>
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

<!-- modal add -->
<div class="modal fade" id="addProgres" tabindex="-1" role="dialog" aria-labelledby="addProgres" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Progres</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/progress/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="idUser" id="idUser">
                            <input type="hidden" name="idKhusus" id="idKhusus">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Sedang diproses">Sedang diproses</option>
                                    <option value="Sedang diantar">Sedang Diantar</option>
                                    <option value="Sudah diterima pembeli">Sudah diterima pembeli</option>
                                </select>
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

<script>
    $('#by_tanggal').change(function() {
        let tanggal = $(this).val();

        document.location.href = `<?php echo base_url('admin/progress/index/') ?>${tanggal}`;
    });

    let detail_btn = $('.detail_btn');

    $(detail_btn).each(function(i) {
        $(detail_btn[i]).click(function() {
            let idUser = $(this).data('iduser');
            let idKhusus = $(this).data('idkhusus');

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
                                "<td colspan='3' class='text-center'>Shipping</td>" +
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

    let progres_btn = $('.progres_btn');

    $(progres_btn).each(function(i) {
        $(progres_btn[i]).click(function() {
            let idUser = $(this).data('iduser');
            let idKhusus = $(this).data('idkhusus');

            $('#idUser').val(idUser);
            $('#idKhusus').val(idKhusus);

            $.ajax({
                url: `<?= base_url('admin/progress/getListProgres'); ?>`,
                type: 'get',
                dataType: 'json',
                data: {
                    idUser,
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
                                <td><a href="<?= base_url('admin/progress/delete/'); ?>${res.data[i].id}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a></td>
                                <tr>`
                            );
                        });

                    } else {
                        $("#tabel-progres").append(
                            "<tr class='tr_isi-progres'>" +
                            "<td colspan='3' class='text-center'>Kosong</td>" +
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