<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Tambahkan Order
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
<?= $item_count = 0; ?>
<?php foreach ($item as $i) {
    $item_count++;
} ?>
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - List Order Barang </h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Order Barang</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Order Barang - Kode Pesanan <span class="text-primary"><?= $supplier[0]->order_code; ?></span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="dt-responsive table-responsive">
                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Jumlah Order</th>
                                                            <th>Diubah Terakhir</th>
                                                            <th>Diubah Oleh</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i           = 1;
                                                        $total_order = 0;

                                                        foreach ($order as $c) : ?>
                                                            <tr>
                                                                <td><?= $i++; ?></td>
                                                                <td><?= $c->item_code; ?></td>
                                                                <td><?= $c->item_name; ?></td>
                                                                <td><?= $c->detail_quantity; ?> Unit</td>
                                                                <td>
                                                                    <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                                </td>
                                                                <td><?= $c->username; ?></td>
                                                            </tr>
                                                        <?php
                                                            $total_order = $total_order + $c->detail_quantity;
                                                        endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="4" rowspan="2"></th>
                                                            <th>Total Barang</th>
                                                            <th colspan="2"><?= $i - 1; ?> Jenis</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Item Dipesan</th>
                                                            <th colspan="2"><?= $total_order; ?> Unit Barang</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card borderless-card">
                                    <div class="profile-card">
                                        <img class="img-fluid" src="<?= base_url(); ?>/upload/supplier/59858.jpg" alt="">
                                        <div class="card-body">
                                            <h3 class="text-white"><?= $supplier[0]->supplier_name; ?></h3>
                                            <p><?= $supplier[0]->supplier_description; ?></p>
                                            <a href="tel:0<?= $supplier[0]->supplier_contact; ?>"><button class="btn btn-info"><i class="feather icon-phone-call"></i> Hubungi</button></a>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-inverse">
                                        <div class="row text-center">
                                            <div class="col">
                                                <h4><?= $count_order; ?></h4>
                                                <span>Kali Order</span>
                                            </div>
                                            <div class="col">
                                                <h4><?= $item_count ?></h4>
                                                <span>Barang</span>
                                            </div>
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