<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Laporan Keuangan PT Dapur Inspirasi Nusantara
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>


<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
<!-- am chart js -->
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/core.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/charts.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/animated.js"></script>
<!-- dashboard-custom js -->
<script src="<?= base_url(); ?>/assets/js/pages/dashboard-sale.js"></script>
<script>
    let status = "<?= $sortir ?>"
    if (status == 5) {
        document.querySelector('.form-custom').style.display = "";
        document.querySelector('.show-custom').required = "true";
    } else {
        document.querySelector('.form-custom').style.display = "none";
        document.querySelector('.show-custom').required = "";
    }
    const check_value = (v) => {
        let status = "<?= $sortir ?>"
        if (v == 5) {
            document.querySelector('.form-custom').style.display = "";
            document.querySelector('.show-custom').required = "true";
        } else {
            document.querySelector('.form-custom').style.display = "none";
            document.querySelector('.show-custom').required = "";
        }

    }
    chartOne(<?= $transaksi_json ?>);
    chartTwo(<?= $order_json ?>);
    // Grafik
</script>

<?= $this->endSection(); ?>

<?= $this->section('header'); ?>

<!-- data tables css -->
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/data-tables/css/datatables.min.css">

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<?php
if ($sortir == 1) {
    $ket = 'Keseluruhan';
} elseif ($sortir == 2) {
    $ket = 'Tahun ' . date('Y');
} elseif ($sortir == 3) {
    $ket = 'Bulan ' . date('F Y');
} elseif ($sortir == 4) {
    $ket = 'Hari Ini,Tanggal ' . date('d F Y');
} else {
    $ket = 'Tanggal ' . date('d F Y', strtotime($tgl_dari)) . ' - ' . date('d F Y', strtotime($tgl_sampai));
}
?>
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Laporan Keuangan PT Dapur Inspirasi Nusantara</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Data Laporan Keuangan</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->

                        <div class="row">
                            <?php
                            $v = 0;
                            $n = 0;

                            foreach ($transaksi as $all) {
                                if ($all->sale_status == 1) {
                                    $v++;
                                } else {
                                    $n++;
                                }
                            }
                            ?>
                            <?php
                            $j = 0;
                            $s = 0;

                            foreach ($order as $all) {
                                if ($all->order_status == 8) {
                                    $s++;
                                }
                                $j++;
                            }
                            ?>
                            <!-- support-section start -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card support-bar">
                                    <div class="card-body pb-0">
                                        <span class="text-c-purple">Grafik Transaksi <?= $ket; ?></span>
                                        <p class="mb-3 mt-3">Total keuntungan per transaksi yang berlangsung</p>
                                    </div>
                                    <div id="support-chart" style="height:100px;width:100%;"></div>
                                    <div class="card-footer bg-purple text-white">
                                        <div class="row text-center">
                                            <div class="col">
                                                <h4 class="m-0 text-white"><?= $v; ?></h4>
                                                <span>Transaksi Sukses</span>
                                            </div>
                                            <div class="col">
                                                <h4 class="m-0 text-white"><?= $n ?></h4>
                                                <span>Transaksi Draft</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- support-section end -->
                            <!-- support1-section start -->
                            <div class="col-xl-6 col-md-6">
                                <div class="card support-bar">
                                    <div class="card-body pb-0">
                                        <span class="text-c-blue">Grafik Order Barang Ke Supplier</span>
                                        <p class="mb-3 mt-3">Total order barang yang berlangsung</p>
                                    </div>
                                    <div id="support-chart1" style="height:100px;width:100%;"></div>
                                    <div class="card-footer bg-primary text-white">
                                        <div class="row text-center">
                                            <div class="col">
                                                <h4 class="m-0 text-white"><?= $j; ?></h4>
                                                <span>Order Barang</span>
                                            </div>
                                            <div class="col">
                                                <h4 class="m-0 text-white"><?= $s; ?></h4>
                                                <span>Sukses</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- support-section1 end -->

                            <!-- support-section2 end -->
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">

                                        <h5>List Data Transaksi - <span class="text-primary"> Transaksi <?= $ket; ?></span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-search"></i> Sortir Rekapan</button>
                                            <form action="" method="POST" target="_blank">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id_sortir" value="<?= $sortir; ?>">
                                                <?php if ($tgl_dari !== null && $tgl_sampai !== null) : ?>
                                                    <input type="hidden" name="dari" value="<?= $tgl_dari; ?>">
                                                    <input type="hidden" name="sampai" value="<?= $tgl_sampai; ?>">
                                                <?php endif; ?>
                                                <button type="submit" name="submit_laporan" value="submit" class="btn btn-gradient-warning btn-rounded btn-glow mb-4"><i class="feather icon-download"></i> Unduh Laporan</button>
                                            </form>
                                        </div>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Kode Member</th>
                                                        <th>Nama Member</th>
                                                        <th>Total Transaksi</th>
                                                        <th>Total Keuntungan</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Jenis Transaksi</th>
                                                        <th>Status Transaksi</th>
                                                        <th>Tanggal Transaksi</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i                = 1;
                                                    $v                = 1;
                                                    $total_keuntungan = 0;
                                                    $total_transaksi  = 0;
                                                    ?>
                                                    <?php foreach ($transaksi as $t) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $t->sale_code; ?></td>
                                                            <td><?= $t->member_code; ?></td>
                                                            <td><?= $t->member_name; ?></td>
                                                            <td>Rp. <?= format_rupiah($t->sale_total); ?></td>
                                                            <td>Rp. <?= format_rupiah($t->sale_profit); ?></td>
                                                            <td><?= $t->username; ?></td>
                                                            <td>Transaksi <?= $t->sale_ket; ?></td>
                                                            <?php if ($t->sale_status == 0) : ?>
                                                                <td><button type="button" class="btn btn-danger btn-sm"> Draft</button></td>
                                                            <?php else : ?>
                                                                <?php
                                                                $v++;
                                                                $total_keuntungan = $total_keuntungan + $t->sale_profit;
                                                                $total_transaksi  = $total_transaksi + $t->sale_total;
                                                                ?>
                                                                <td><button type="button" class="btn btn-success btn-sm"> Sukses</button></td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($t->updated_at)->toLocalizedString('d MMM yyyy, H:m'); ?> WITA
                                                            </td>
                                                            <td>
                                                                <form action="" target="_blank" method="POST">
                                                                    <?= csrf_field(); ?>
                                                                    <input type="hidden" name="id_transaksi" value="<?= $t->sale_code; ?>">
                                                                    <button type="submit" name="invoice" value="invoice" class="btn btn-warning btn-icon btn-rounded" title="Unduh Laporan Transaksi" data-toggle="tooltip"><i class="feather icon-download"></i></button>
                                                                </form>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th colspan="5" rowspan="4"></th>
                                                        <th colspan="3">Jumlah Kegiatan Transaksi</th>
                                                        <th colspan="3"><?= $i - 1; ?> Transaksi
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">Jumlah Transaksi Sukses</th>
                                                        <th colspan="3"><?= $v - 1; ?> Transaksi
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">Total Transaksi Sukses</th>
                                                        <th colspan="3">Rp. <?= format_rupiah($total_transaksi); ?></th>
                                                    </tr>
                                                    <tr>
                                                        <th colspan="3">Total Keuntungan Transaksi Sukses</th>
                                                        <th colspan="3">Rp. <?= format_rupiah($total_keuntungan); ?></th>
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
                <h5 class="modal-title" id="addCategoryLabel">Sortir Rekapan Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="form" action="" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <select name="order" required onchange="check_value(this.value)" id="order" class="form-control <?= $validation->getError('order') ? 'is-invalid' : ''; ?>">
                            <option value="1" <?= $sortir == 1 ? 'selected' : '' ?>>Berdasarkan Keseluruhan</option>
                            <option value="2" <?= $sortir == 2 ? 'selected' : '' ?>>Berdasarkan Tahun Ini</option>
                            <option value="3" <?= $sortir == 3 ? 'selected' : '' ?>>Berdasarkan Bulan Ini</option>
                            <option value="4" <?= $sortir == 4 ? 'selected' : '' ?>>Berdasarkan Hari Ini</option>
                            <option value="5" <?= $sortir == 5 ? 'selected' : '' ?>>Kustom Sortir</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('order'); ?>
                        </div>
                    </div>
                    <div class="form-custom">
                        <div class="form-group">
                            <label for="dari">Dari Tanggal : </label>
                            <input id="dari" type="date" class="form-control show-custom <?= $validation->getError('tgl_dari') ? 'is-invalid' : ''; ?>" value="<?= date($tgl_dari); ?>" name="tgl_dari">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_dari'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group" id="sampai-form">
                                <label for="sampai">Sampai Tanggal :</label>
                                <input type="date" class="form-control show-custom <?= $validation->getError('tgl_sampai') ? 'is-invalid' : ''; ?>" value="<?= date($tgl_sampai); ?>" name="tgl_sampai">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('tgl_sampai'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit_sortir" value="sortir" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>