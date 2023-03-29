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
                        <div class="card-header">
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addKategori">Add Menu</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Menu</th>
                                            <th>Kategori</th>
                                            <th>Deskripsi</th>
                                            <th>Stock</th>
                                            <th>Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        foreach ($menu as $m) : ?>
                                            <tr>
                                                <td class="text-center"><?= $i++; ?></td>
                                                <td><?= $m->nama_menu; ?></td>
                                                <td><?= $m->kategori; ?></td>
                                                <td><?= $m->deskripsi; ?></td>
                                                <td><?= $m->stok; ?></td>
                                                <td><?= $m->harga; ?></td>
                                                <td>
                                                    <a href="#" class="badge badge-info stok_btn" data-toggle="modal" data-target="#stokModal" data-id="<?= $m->id; ?>" data-stok="<?= $m->stok; ?>">Stok</a>
                                                    <a href="#" class="badge badge-primary gambar_btn" data-toggle="modal" data-target="#gambarModal" data-id="<?= $m->id; ?>">Gambar</a>
                                                    <a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editMenu" data-id="<?= $m->id; ?>" data-nama_menu="<?= $m->nama_menu; ?>" data-harga="<?= $m->harga; ?>" data-katid="<?= $m->kategori_id; ?>" data-deskripsi="<?= $m->deskripsi; ?>">Edit</a>
                                                    <a href="<?= base_url('admin/menu/delete/' . $m->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="addKategori" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" class="form-control" name="nama_menu">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inputState">Kategori</label>
                                <select id="inputState" class="form-control" name="kategori_id">
                                    <option selected>Choose...</option>
                                    <?php foreach ($kategori as $kat) : ?>
                                        <option value="<?= $kat->id; ?>"><?= $kat->kategori; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" cols="30" rows="5" class="form-control"></textarea>
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
<div class="modal fade" id="editMenu" tabindex="-1" role="dialog" aria-labelledby="editMenu" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/edit'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label>Nama Menu</label>
                                <input type="text" class="form-control" name="nama_menu" id="nama_menu">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori_id" class="form-control" id="kategori_id">
                                    <?php foreach ($kategori as $kat) : ?>
                                        <option value="<?= $kat->id; ?>"><?= $kat->kategori; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" cols="30" rows="5" class="form-control" id="deskripsi"></textarea>
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

<!-- modal stok -->
<div class="modal fade" id="stokModal" tabindex="-1" role="dialog" aria-labelledby="stokModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/stok'); ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" id="idMenu">
                            <input type="hidden" name="stokLama" id="stokLama">
                            <div class="form-group">
                                <label>Jumlah Stok</label>
                                <input type="text" class="form-control" name="stok">
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

<!-- modal gambar -->
<div class="modal fade" id="gambarModal" tabindex="-1" role="dialog" aria-labelledby="gambarModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addGambar">Tambah Gambar</a>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <div id="tampil" class="d-none">
                                <div class="table-responsive" style="overflow-y: auto; max-height: 500px;">
                                    <table class="table table-bordered table-hover table-vcenter" id="tabel">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Gambar</th>
                                                <th>Action</th>
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

<!-- modal add gambar-->
<div class="modal fade" id="addGambar" tabindex="-1" role="dialog" aria-labelledby="addGambar" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Gambar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/menu/addGambar'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="idMenu" id="idMenuG">
                            <div class="form-group">
                                <label>Gambar</label>
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

<script>
    let edit_btn = $('.edit_btn');

    $(edit_btn).each(function(i) {
        $(edit_btn[i]).click(function() {
            let id = $(this).data('id');
            let nama_menu = $(this).data('nama_menu');
            let harga = $(this).data('harga');
            let katid = $(this).data('katid');
            let deskripsi = $(this).data('deskripsi');

            $('#id').val(id);
            $('#nama_menu').val(nama_menu);
            $('#harga').val(harga);
            $('#kategori_id').val(katid);
            $('#deskripsi').val(deskripsi);
        });
    });

    let stok_btn = $('.stok_btn');

    $(stok_btn).each(function(i) {
        $(stok_btn[i]).click(function() {
            let id = $(this).data('id');
            let stok = $(this).data('stok');

            $('#idMenu').val(id);
            $('#stokLama').val(stok);
        });
    });

    let gambar_btn = $('.gambar_btn');

    $(gambar_btn).each(function(i) {
        $(gambar_btn[i]).click(function() {
            let idMenu = $(this).data('id');

            $('#idMenuG').val(idMenu);

            $.ajax({
                url: `<?= base_url('admin/menu/getListGambar'); ?>`,
                type: 'get',
                dataType: 'json',
                data: {
                    idMenu
                },
                async: true,
                beforeSend: function(e) {
                    $('#tampil').addClass('d-none');
                },
                success: function(res) {
                    $('#tampil').removeClass('d-none');
                    $('.tr_isi').remove();

                    if (res.data) {
                        $(res.data).each(function(i) {
                            $("#tabel").append(
                                `<tr class='tr_isi'>
                                <td class='text-center'>${i + 1}</td>
                                <td>
                                <a href="<?= base_url('upload/gambar/'); ?>${res.data[i].gambar}" target="_blank">
                                    <img src="<?= base_url('upload/gambar/'); ?>${res.data[i].gambar}" alt="${res.data[i].gambar}" class="img-thumbnail" width="200">
                                </a>
                                </td>
                                <td><a href="<?= base_url('admin/menu/deleteGambar/'); ?>${res.data[i].id}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a></td>
                                <tr>`
                            );
                        });
                    } else {
                        $("#tabel").append(
                            "<tr class='tr_isi'>" +
                            "<td colspan='3' class='text-center'>Kosong</td>" +
                            "<tr>");
                    }
                },
                complete: function() {
                    $('#tampil').removeClass('d-none');
                }
            });
        });
    });
</script>