<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Data Kategori Barang
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
<script type="text/javascript">
    $(".delete-button").on("click", function(e) {
        e.preventDefault();
        var self = $(this);
        var nama = $(this).attr("data-nama");
        var formId = $(this).attr("data-formid");
        swal({
                title: "Hapus Kategori Barang " + nama + "?",
                text: "Informasi Yang Terkait Dengan Data Ini Akan Hilang Secara Permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $("#" + formId).submit();
                } else {
                    swal({
                        title: "File Aman !",
                        text: "Data Kategori Barang " + nama + " Batal Dihapus",
                        icon: "info",
                    });
                }
            });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('header'); ?>
<!-- data tables css -->
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/data-tables/css/datatables.min.css">

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Dintara Point Of Sale - Data Kategori Barang</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Data Kategori Barang</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Data Kategori</h5>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-file-plus"></i> Tambahkan Kategori</button>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Kategori</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($category as $c) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $c->category_name; ?></td>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                            </td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <!-- Update Button Modal -->
                                                                    <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Kategori" data-toggle="tooltip"></i></button>

                                                                    <!-- Update Modal -->
                                                                    <div id="updateCategory-<?= $c->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryLabel-<?= $c->id; ?>" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="updateCategoryLabel-<?= $c->id; ?>">Ubah Data
                                                                                        Kategori</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="" method="POST">
                                                                                        <?= csrf_field(); ?>
                                                                                        <input type="hidden" name="_method" value="PATCH">
                                                                                        <input type="hidden" name="id_category" value="<?= $c->id; ?>">
                                                                                        <input type="text" class="form-control <?= $validation->getError('category_update') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="category_update" placeholder="Nama Kategori" value="<?= (old('category_update')) ? old('category_update') : $c->category_name; ?>">
                                                                                        <div class="invalid-feedback">
                                                                                            <?= $validation->getError("category_update"); ?>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" name="update_category" value="update" class="btn btn-primary">Simpan
                                                                                                Perubahan</button>
                                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <!-- Delete -->
                                                                    <form action="" id="<?= $c->id; ?>" method="POST">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="id_category" value="<?= $c->id; ?>">
                                                                        <input type="hidden" name="delete_category" value="delete">
                                                                        <button type="submit" data-formid="<?= $c->id ?>" data-nama="<?= $c->category_name ?>" class="btn delete-button btn-danger btn-icon btn-rounded" title="Hapus Kategori" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                    </form>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nama Kategori</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>

                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->

<!-- Modal -->
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Tambah Kategori Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <?= csrf_field(); ?>
                    <input type="text" class="form-control <?= $validation->getError('category') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="category" required placeholder="Nama Kategori" value="<?= (old('category')) ? old('category') : ""; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError("category"); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit_category" value="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>