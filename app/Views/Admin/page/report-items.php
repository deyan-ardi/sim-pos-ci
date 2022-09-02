<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Data Item Barang
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Laporan Transaksi Barang</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Laporan Transaksi Barang</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="card">
                            <div class="card-body py-2">
                                <form class="row" action="" method="GET">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-2 d-flex align-items-center">
                                                <span class="p">Filter Data</span>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group m-0">
                                                    <label class="m-0 mb-2" for="tanggal_awal"><small>Tanggal
                                                            Awal</small></label>
                                                    <input type="date" id="tanggal_awal" class="form-control " name="tanggal_awal" value="<?= $_GET['tanggal_awal'] ?? ''; ?>">

                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group m-0">
                                                    <label class="m-0 mb-2" for="tanggal_akhir"><small>Tanggal
                                                            Akhir</small></label>
                                                    <input type="date" id="tanggal_akhir" class="form-control" name="tanggal_akhir" value="<?= $_GET['tanggal_akhir'] ?? ''; ?>">

                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group m-0">
                                                    <label class="m-0 mb-2" for=""></label>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" name="filter" value="filter" class="btn btn-sm mt-2 btn-primary rounded px-5">Filter</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Item Barang Diterima Gudang</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="" target="_blank" rel="noopener noreferrer" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="tanggal_awal" value="<?= $_GET['tanggal_awal'] ?? ''; ?>">
                                            <input type="hidden" name="tanggal_akhir" value="<?= $_GET['tanggal_akhir'] ?? ''; ?>">
                                            <button type="submit" class="btn btn-success mb-3" name="export_in" value="submit"><i class="fa fa-print"></i> Export PDF</button>
                                        </form>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Order</th>
                                                        <th>Total Order</th>
                                                        <th>Barang Diterima</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Status Barang</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($items as $c) : ?>
                                                        <?php if ($c->status_order != 0) : ?>

                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $c->item_code; ?></td>
                                                                <td><?= $c->item_name; ?></td>
                                                                <td><?= $c->order_code; ?></td>
                                                                <td><?= $c->detail_quantity; ?> Unit</td>
                                                                <td><?= $c->receiving_total ?> Unit Sesuai</td>
                                                                <td><?= $c->category_name; ?></td>
                                                                <td><?= $c->supplier_name; ?></td>
                                                                <?php if ($c->status_order == 1) : ?>
                                                                    <td><a href="" class="btn btn-warning btn-sm">Berlangsung</a></td>
                                                                <?php elseif ($c->status_order == 2) : ?>
                                                                    <td><a href="" class="btn btn-success btn-sm">Selesai</a></td>
                                                                <?php endif; ?>
                                                                <td><?= $c->username; ?></td>
                                                                <td>
                                                                    <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Order</th>
                                                        <th>Total Order</th>
                                                        <th>Barang Diterima</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Status Order</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- [ Main Content ] end -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Item Barang Diretur Ke Supplier</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="" target="_blank" rel="noopener noreferrer" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="tanggal_awal" value="<?= $_GET['tanggal_awal'] ?? ''; ?>">
                                            <input type="hidden" name="tanggal_akhir" value="<?= $_GET['tanggal_akhir'] ?? ''; ?>">
                                            <button type="submit" class="btn btn-success mb-3" name="export_retur" value="submit"><i class="fa fa-print"></i> Export PDF</button>
                                        </form>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable3" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Order</th>
                                                        <th>Total Order</th>
                                                        <th>Diretur</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Status Barang</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($item_retur as $c) : ?>
                                                        <?php if ($c->status_order != 0) : ?>

                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $c->item_code; ?></td>
                                                                <td><?= $c->item_name; ?></td>
                                                                <td><?= $c->order_code; ?></td>
                                                                <td><?= $c->detail_quantity; ?> Unit</td>
                                                                <td><?= $c->retur_total ?> Unit Diretur</td>
                                                                <td><?= $c->category_name; ?></td>
                                                                <td><?= $c->supplier_name; ?></td>
                                                                <?php if ($c->status_order == 1) : ?>
                                                                    <td><a href="" class="btn btn-warning btn-sm">Berlangsung</a></td>
                                                                <?php elseif ($c->status_order == 2) : ?>
                                                                    <td><a href="" class="btn btn-success btn-sm">Selesai</a></td>
                                                                <?php endif; ?>
                                                                <td><?= $c->username; ?></td>
                                                                <td>
                                                                    <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Order</th>
                                                        <th>Total Order</th>
                                                        <th>Diretur</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Status Order</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Item Barang Belum Diterima (Retur Tidak Termasuk)</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="" target="_blank" rel="noopener noreferrer" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="tanggal_awal" value="<?= $_GET['tanggal_awal'] ?? ''; ?>">
                                            <input type="hidden" name="tanggal_akhir" value="<?= $_GET['tanggal_akhir'] ?? ''; ?>">
                                            <button type="submit" class="btn btn-success mb-3" name="export_belum" value="submit"><i class="fa fa-print"></i> Export PDF</button>
                                        </form>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable4" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Order</th>
                                                        <th>Total Order</th>
                                                        <th>Belum Diterima</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Status Barang</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($item_belum as $c) : ?>
                                                        <?php if ($c->status_order != 0) : ?>

                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $c->item_code; ?></td>
                                                                <td><?= $c->item_name; ?></td>
                                                                <td><?= $c->order_code; ?></td>
                                                                <td><?= $c->detail_quantity; ?> Unit</td>
                                                                <td><?= $c->progress_total ?> Unit Diproses</td>
                                                                <td><?= $c->category_name; ?></td>
                                                                <td><?= $c->supplier_name; ?></td>
                                                                <?php if ($c->status_order == 1) : ?>
                                                                    <td><a href="" class="btn btn-warning btn-sm">Berlangsung</a></td>
                                                                <?php elseif ($c->status_order == 2) : ?>
                                                                    <td><a href="" class="btn btn-success btn-sm">Selesai</a></td>
                                                                <?php endif; ?>
                                                                <td><?= $c->username; ?></td>
                                                                <td>
                                                                    <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Order</th>
                                                        <th>Total Order</th>
                                                        <th>Belum Diterima</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Status Order</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Item Barang Terjual</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <form action="" target="_blank" rel="noopener noreferrer" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="tanggal_awal" value="<?= $_GET['tanggal_awal'] ?? ''; ?>">
                                                <input type="hidden" name="tanggal_akhir" value="<?= $_GET['tanggal_akhir'] ?? ''; ?>">
                                                <button type="submit" class="btn btn-success mb-3" name="export_out" value="submit"><i class="fa fa-print"></i> Export PDF</button>
                                            </form>
                                            <table id="simpletable2" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Transaksi</th>
                                                        <th>Total Transaksi</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Status Order</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Tanggal Masuk</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;

                                                    foreach ($item_outs as $c) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $c->item_code; ?></td>
                                                            <td><?= $c->item_name; ?></td>
                                                            <td><?= $c->sale_code; ?></td>
                                                            <td><?= $c->detail_quantity; ?> Unit</td>
                                                            <td><?= $c->category_name; ?></td>
                                                            <td><button class="btn btn-success">Sukses</button></td>
                                                            <td><?= $c->username; ?></td>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Kode Order</th>
                                                        <th>Total Order</th>
                                                        <th>Kategori Barang</th>
                                                        <th>Status Order</th>
                                                        <th>Nama Kasir</th>
                                                        <th>Tanggal Masuk</th>
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