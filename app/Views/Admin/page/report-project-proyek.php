<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
SPPB
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

    const getDetail = (id) => {
        $.ajax({
            url: "<?= base_url('/sppb/transaction/load'); ?>",
            method: 'POST',
            dataType: 'html',
            data: {
                id: id,
            },
            beforeSend: function() {
                $('#loadedItem').show();
            },
            complete: function() {
                $('#loadedItem').hide();
            },
            success: function(result) {
                $('#modal-body-item').empty();
                $('#modal-body-item').append(result);
            },
            error: function(result) {
                alert(result.responseText);
            }
        });
    }
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Cetak SPPB Transaksi Project</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Cetak SPPB</a></li>
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
                                        <h5>SPPB Transaksi Project</h5>
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
                                                        <th>Nama Kasir</th>
                                                        <th>Status Transaksi</th>
                                                        <th>Status Pengiriman</th>
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
                                                            <td><?= $t->username; ?></td>
                                                            <?php if ($t->sale_status == 0) : ?>
                                                                <td><button type="button" class="btn btn-danger btn-sm"> Draft</button></td>
                                                            <?php elseif ($t->sale_status == 1) : ?>
                                                                <td><button type="button" class="btn btn-warning btn-sm"> DP Pembayaran</button></td>
                                                            <?php else : ?>
                                                                <td><button type="button" class="btn btn-success btn-sm"> Sukses</button></td>
                                                            <?php endif; ?>
                                                            <?php if ($t->sale_send_status == 0) : ?>
                                                                <td><button type="button" class="btn btn-danger btn-sm"> Menunggu</button></td>
                                                            <?php elseif ($t->sale_send_status == 1) : ?>
                                                                <td><button type="button" class="btn btn-warning btn-sm"> Progress</button></td>
                                                            <?php else : ?>
                                                                <td><button type="button" class="btn btn-success btn-sm"> Sukses</button></td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($t->updated_at)->humanize(); ?>
                                                            </td>
                                                            <?php if ($t->sale_status != 0) : ?>
                                                                <td>
                                                                    <div class="row justify-content-center">
                                                                        <form action="" method="POST" target="_blank" rel="noopener noreferrer">
                                                                            <?= csrf_field(); ?>
                                                                            <input type="hidden" name="id_transaksi" value="<?= $t->id; ?>">

                                                                            <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#cetakData" onclick="getDetail('<?= $t->id; ?>')" title="Atur SPPB" data-toggle="tooltip"><i class="feather icon-settings"></i></button>

                                                                            <button type="submit" name="invoice-cetak" value="cetak" class="btn btn-success btn-icon btn-rounded" title="Cetak SPPB" data-toggle="tooltip"><i class="feather icon-printer"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </td>
                                                            <?php else : ?>
                                                                <td>
                                                                    <div class="alert alert-info">
                                                                        Menunggu
                                                                    </div>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Kode Member</th>
                                                        <th>Nama Member</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Status Transaksi</th>
                                                        <th>Status Pengiriman</th>
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

<div id="cetakData" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cetakDataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakDataLabel">Pengaturan SPPB
                    Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body" id="modal-body-item">
                    <div id="loadedPosisi">Loading Data....</div>
                </div>
                <div class="modal-footer pr-1">
                    <button type="submit" name="invoice" value="update" class="btn btn-primary">Simpan SPPB</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>