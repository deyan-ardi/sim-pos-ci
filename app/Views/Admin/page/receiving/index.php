<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Receiving Order Barang Supplier
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Receiving Order Barang Supplier</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Receiving Order Barang Supplier</a></li>
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
                                        <h5>List Receiving Order Barang</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode PO</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Kontak Supplier</th>
                                                        <th>Email Supplier</th>
                                                        <th>Alamat Supplier</th>
                                                        <th>Total Item Dipesan</th>
                                                        <th>Total Barang Dipesan</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Data Pesanan</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;

                                                    foreach ($order as $c) : ?>
                                                        <?php if ($c->order_status == 7 || $c->order_status == 8) : ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td>PO No.<?= $c->order_code; ?></td>
                                                                <td><?= $c->supplier_name; ?></td>
                                                                <td>0<?= $c->supplier_contact; ?></td>
                                                                <td><?= $c->supplier_email; ?></td>
                                                                <td><?= $c->supplier_address; ?></td>
                                                                <td><?= $c->order_total_quantity; ?> Jenis Barang</td>
                                                                <td><?= $c->order_total_item; ?> Barang</td>
                                                                <td><?= $c->username ?></td>

                                                                <td><a href="<?= base_url(); ?>/suppliers/receiving-detail?order_code=<?= $c->order_code; ?>" class="btn btn-info"><i class="feather icon-shopping-cart"></i> Lihat Pesanan</a></td>

                                                                <td>
                                                                    <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                                </td>
                                                                <?php if ($c->order_status == 1) : ?>
                                                                    <td><a href="" class="btn btn-warning btn-sm">Request Diterima</a></td>
                                                                <?php elseif ($c->order_status == 2) : ?>
                                                                    <td><a href="" class="btn btn-info btn-sm">Persetujuan</a></td>
                                                                <?php elseif ($c->order_status == 3) : ?>
                                                                    <td><a href="" class="btn btn-info btn-sm">Order Keluar</a></td>
                                                                <?php elseif ($c->order_status == 4) : ?>
                                                                    <td><a href="" class="btn btn-info btn-sm">Invoice Masuk</a></td>
                                                                <?php elseif ($c->order_status == 5) : ?>
                                                                    <td><a href="" class="btn btn-info btn-sm">Produksi</a></td>
                                                                <?php elseif ($c->order_status == 6) : ?>
                                                                    <td><a href="" class="btn btn-info btn-sm">Dikirim Supplier</a></td>
                                                                <?php elseif ($c->order_status == 7) : ?>
                                                                    <td><a href="" class="btn btn-info btn-sm">Diterima Gudang</a></td>
                                                                <?php elseif ($c->order_status == 8) : ?>
                                                                    <td><a href="" class="btn btn-success btn-sm">Selesai</a></td>
                                                                <?php else : ?>
                                                                    <td><a href="" class="btn btn-danger btn-sm">Pengembalian</a></td>
                                                                <?php endif; ?>
                                                            </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode PO</th>
                                                        <th>Nama Supplier</th>
                                                        <th>Kontak Supplier</th>
                                                        <th>Email Supplier</th>
                                                        <th>Alamat Supplier</th>
                                                        <th>Total Item Dipesan</th>
                                                        <th>Total Barang Dipesan</th>
                                                        <th>Dipesan Oleh</th>
                                                        <th>Data Pesanan</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th>Status Order</th>

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