<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Receiving Order Barang Supplier
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
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($order as $c) : ?>
                                                        <?php if ($c->order_status == 6 || $c->order_status == 7) : ?>
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

                                                                <td><a href="<?= base_url(); ?>/suppliers/receiving/detail?order_code=<?= $c->order_code; ?>" class="btn btn-info"><i class="feather icon-shopping-cart"></i> Lihat Pesanan</a></td>

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
                                                                <td>
                                                                    <div class="row justify-content-center">
                                                                        <?php if ($c->order_status !== 8) : ?>
                                                                            <!-- Set Status Button Modal -->
                                                                            <?php if (in_groups('GUDANG') || in_groups('SUPER ADMIN')) : ?>
                                                                                <?php if ($c->order_status == 6 || $c->order_status == 7) : ?>
                                                                                    <button type="button" class="btn btn-info btn-icon btn-rounded" data-toggle="modal" data-target="#updateOrder-<?= $c->id; ?>"><i class="feather icon-package" title="Ubah Status Order" data-toggle="tooltip"></i></button>
                                                                                <?php endif; ?>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                        <!-- Delete -->
                                                                        <form target="_blank" rel="noopener noreferrer" action="<?= base_url(); ?>/suppliers/receiving/invoice" method="POST">
                                                                            <?= csrf_field(); ?>
                                                                            <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                                                                            <button type="submit" name="print_order" value="print" class="btn btn-warning btn-icon btn-rounded" title="Unduh Data Order" data-toggle="tooltip"><i class="feather icon-download"></i></button>
                                                                        </form>


                                                                    </div>
                                                                </td>
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
                                                        <th>Aksi</th>
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

<?php foreach ($order as $c) : ?>
    <!-- Update Modal -->
    <div id="updateOrder-<?= $c->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateOrderLabel-<?= $c->id; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrderLabel-<?= $c->id; ?>">Ubah Status Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                        <div class="form-group">
                            <select class="form-control <?= $validation->getError('order_name_up') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="order_name_up" required>
                                <?php if (in_groups('GUDANG') || in_groups('SUPER ADMIN')) : ?>
                                    <?php if ($c->order_status == 6 || $c->order_status == 7) : ?>
                                        <option value="7" <?= $c->order_status == 7 ? 'selected' : ''; ?>>Diterima - Barang Telah Diterima Oleh Pihak Gudang</option>
                                        <option value="8" <?= $c->order_status == 8 ? 'selected' : ''; ?>>Selesai - Barang Telah Dicek dan Telah Sesuai</option>
                                    <?php else : ?>
                                        <option value="">-- Pesanan Belum Dikirim Oleh Supplier --</option>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('order_name_up'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_status_order" value="update" class="btn btn-primary">Simpan
                                Perubahan</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- [ Main Content ] end -->
<?= $this->endSection(); ?>