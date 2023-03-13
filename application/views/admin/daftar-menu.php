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
                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addKategori">Add Kategori</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Nama Menu</th>
                                            <th>Kategori</th>
                                            <th>Image</th>
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
                                                <td>ini gambar</td>
                                                <td>1</td>
                                                <td><?= $m->harga; ?></td>
                                                <td>
                                                    <a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editMenu" data-id="<?= $m->id; ?>" data-nama_menu="<?= $m->nama_menu; ?>" data-harga="<?= $m->harga; ?>" data-katid="<?= $m->kategori_id; ?>">Edit</a>
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
                        <div class="form-group col-md-12">
                            <label for="inputState">Kategori</label>
                            <select id="inputState" class="form-control" name="kategori_id">
                                <option selected>Choose...</option>
                                <?php foreach ($kategori as $kat) : ?>
                                    <option value="<?= $kat->id; ?>"><?= $kat->kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
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
                        <div class="form-group col-md-12">
                            <label>Kategori</label>
                            <select name="kategori_id" class="form-control" id="kategori_id">
                                <?php foreach ($kategori as $kat) : ?>
                                    <option value="<?= $kat->id; ?>"><?= $kat->kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
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

            $('#id').val(id);
            $('#nama_menu').val(nama_menu);
            $('#harga').val(harga);
            $('#kategori_id').val(katid);
        });
    });
</script>