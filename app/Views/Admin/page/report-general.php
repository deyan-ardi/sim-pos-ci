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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Laporan Transaksi General</h5>
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
                                        <h5>List Laporan Transaksi</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Kode Member</th>
                                                        <th>Nama Member</th>
                                                        <th>Total Transaksi</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Status Transaksi</th>
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
                                                            <td><?= $t->sale_code; ?></td>
                                                            <td><?= $t->member_code; ?></td>
                                                            <td><?= $t->member_name; ?></td>
                                                            <td>Rp. <?= format_rupiah($t->sale_total); ?></td>
                                                            <td><?= $t->username; ?></td>
                                                            <?php if ($t->sale_status === 0) : ?>
                                                                <td><button type="button" class="btn btn-danger btn-sm"> Draft</button></td>
                                                            <?php else : ?>
                                                                <td><button type="button" class="btn btn-success btn-sm"> Sukses</button></td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($t->updated_at)->humanize(); ?>
                                                            </td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <?php if ($t->sale_status === 0) : ?>
                                                                        <a href="<?= base_url(); ?>/transaction-general/report/search?sale_code=<?= $t->sale_code; ?>" name="lihat_transaksi" value="delete" class="btn btn-warning btn-icon btn-rounded" title="Lihat Transaksi" data-toggle="tooltip"><i class="feather icon-search"></i></a>
                                                                    <?php else : ?>
                                                                        <form action="" target="_blank" method="POST">
                                                                            <?= csrf_field(); ?>
                                                                            <input type="hidden" name="id_transaksi" value="<?= $t->sale_code; ?>">
                                                                            <button type="submit" name="invoice" value="invoice" class="btn btn-success btn-icon btn-rounded" title="Cetak Ulang Invoice Transaksi" data-toggle="tooltip"><i class="feather icon-printer"></i></button>
                                                                        </form>
                                                                    <?php endif; ?>
                                                                    <!-- Delete -->
                                                                    <form action="" id="<?= $t->id; ?>" method="POST">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="id_transaksi" value="<?= $t->sale_code; ?>">
                                                                        <input type="hidden" name="delete_transaksi" value="delete">
                                                                        <button type="submit" data-formid="<?= $t->id ?>" data-nama="<?= $t->sale_code ?>" class="btn btn-danger btn-icon btn-rounded delete-button" title="Hapus Transaksi" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                    </form>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Kode Member</th>
                                                        <th>Nama Member</th>
                                                        <th>Total Transaksi</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Status Transaksi</th>
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
<?= $this->endSection(); ?>