<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Laporan Transaksi
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
                title: "Hapus Transaksi Dengan Kode " + nama + "?",
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
                        text: "Data Transaksi Dengan Kode " + nama + " Batal Dihapus",
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Laporan Penawaran Project</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Laporan Transaksi</a></li>
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
                                        <h5>List Laporan Penawaran Project</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Penawaran</th>
                                                        <th>Kode Member</th>
                                                        <th>Nama Member</th>
                                                        <th>Total Penawaran</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Status Penawaran</th>
                                                        <th>Diubah Pada</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;

                                                    foreach ($transaksi as $t) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $t->penawaran_code; ?></td>
                                                            <td><?= $t->member_code; ?></td>
                                                            <td><?= $t->member_name; ?></td>
                                                            <td>Rp. <?= format_rupiah($t->penawaran_total); ?></td>
                                                            <td><?= $t->username; ?></td>
                                                            <?php if ($t->penawaran_status == 0) : ?>
                                                                <td><button type="button" class="btn btn-danger btn-sm"> Draft</button></td>
                                                            <?php elseif ($t->penawaran_status == 1) : ?>
                                                                <td><button type="button" class="btn btn-warning btn-sm"> Diproses</button></td>
                                                            <?php else : ?>
                                                                <td><button type="button" class="btn btn-success btn-sm"> Selesai</button></td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($t->updated_at)->humanize(); ?>
                                                            </td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <?php if (in_groups('SUPER ADMIN') ||  in_groups('MARKETING')) : ?>
                                                                        <?php if ($t->penawaran_status == 1) : ?>
                                                                            <a href="<?= base_url(); ?>/transaction/marketing/search?penawaran_code=<?= $t->penawaran_code; ?>" name="lihat_transaksi" value="delete" class="btn btn-warning btn-icon btn-rounded" title="Lihat Penawaran" data-toggle="tooltip"><i class="feather icon-search"></i></a>

                                                                            <!-- Button -->
                                                                            <button type="button" class="btn btn-info btn-icon btn-rounded" data-toggle="modal" data-target="#updateOrder-<?= $t->id; ?>"><i class="feather icon-package" title="Ubah Status Penawaran" data-toggle="tooltip"></i></button>

                                                                            <!-- Delete -->
                                                                            <form action="" id="<?= $t->id; ?>" method="POST">
                                                                                <?= csrf_field(); ?>
                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                <input type="hidden" name="id_transaksi" value="<?= $t->penawaran_code; ?>">
                                                                                <input type="hidden" name="delete_transaksi" value="delete">
                                                                                <button type="submit" data-formid="<?= $t->id ?>" data-nama="<?= $t->penawaran_code ?>" class="btn btn-danger btn-icon btn-rounded delete-button" title="Hapus Penawaran" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                            </form>
                                                                        <?php elseif ($t->penawaran_status == 0) : ?>
                                                                            <a href="<?= base_url(); ?>/transaction/marketing/search?penawaran_code=<?= $t->penawaran_code; ?>" name="lihat_transaksi" value="delete" class="btn btn-warning btn-icon btn-rounded" title="Lihat Penawaran" data-toggle="tooltip"><i class="feather icon-search"></i></a>
                                                                        <?php else : ?>
                                                                            <form action="" target="_blank" method="POST">
                                                                                <?= csrf_field(); ?>
                                                                                <input type="hidden" name="id_transaksi" value="<?= $t->penawaran_code; ?>">
                                                                                <button type="submit" name="invoice" value="invoice" class="btn btn-success btn-icon btn-rounded" title="Cetak Ulang Penawaran" data-toggle="tooltip"><i class="feather icon-printer"></i></button>
                                                                            </form>
                                                                        <?php endif; ?>
                                                                    <?php else : ?>
                                                                        <form action="" target="_blank" method="POST">
                                                                            <?= csrf_field(); ?>
                                                                            <input type="hidden" name="id_transaksi" value="<?= $t->penawaran_code; ?>">
                                                                            <button type="submit" name="invoice" value="invoice" class="btn btn-success btn-icon btn-rounded" title="Cetak Ulang Penawaran" data-toggle="tooltip"><i class="feather icon-printer"></i></button>
                                                                        </form>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Penawaran</th>
                                                        <th>Kode Member</th>
                                                        <th>Nama Member</th>
                                                        <th>Total Penawaran</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Status Penawaran</th>
                                                        <th>Diubah Pada</th>
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
<?php foreach ($transaksi as $t) : ?>
    <!-- Update Modal -->
    <div id="updateOrder-<?= $t->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateOrderLabel-<?= $t->id; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrderLabel-<?= $t->id; ?>">Ubah Status Penawaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_transaksi" value="<?= $t->penawaran_code; ?>">
                        <div class="form-group">
                            <select class="form-control <?= $validation->getError('penawaran_status') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="penawaran_status" required>
                                <?php if (in_groups('MARKETING') || in_groups('SUPER ADMIN')) : ?>
                                    <option value="1" <?= $t->penawaran_status == 1 ? 'selected' : ''; ?>>DIPROSES</option>
                                    <option value="2" <?= $t->penawaran_status == 2 ? 'selected' : ''; ?>>SELESAI</option>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('penawaran_status'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_status_penawaran" value="update" class="btn btn-primary">Simpan
                                Perubahan</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>