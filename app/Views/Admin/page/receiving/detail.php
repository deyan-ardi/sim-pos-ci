<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Tambahkan Order
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
<script>
    $(document).ready(function() {
        $('#item_id').selectize({
            sortField: 'text'
        });
    });
    const update = (x) => {
        $(document).ready(function() {
            $('#item_id-' + x).selectize({
                sortField: 'text'
            });
        });
    }
</script>
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Receiving Order Barang </h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Receiving Order Barang</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card borderless-card">
                                    <div class="profile-card">
                                        <img class="img-fluid" src="<?= base_url(); ?>/upload/supplier/59858.jpg" alt="">
                                        <div class="card-body">
                                            <h3 class="text-white">Supplier <?= $supplier[0]->supplier_name; ?></h3>
                                            <p><?= $supplier[0]->supplier_description; ?></p>
                                            <a href="tel:0<?= $supplier[0]->supplier_contact; ?>"><button class="btn btn-info"><i class="feather icon-phone-call"></i> Hubungi Supplier</button></a>
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
                                                <span>Unit Barang Dimiliki</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Order Barang - Kode PO <span class="text-primary"><?= $supplier[0]->order_code; ?></span></h5>
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
                                                            <th>Receiving</th>
                                                            <th>Belum Datang</th>
                                                            <th>Status</th>
                                                            <th>Diubah Terakhir</th>
                                                            <th>Pegawai</th>
                                                            <?php if ($supplier[0]->order_status != 1) : ?>
                                                                <th class="text-center"><i class="feather icon-settings"></i>
                                                                </th>
                                                            <?php endif; ?>
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
                                                                <td><?= $c->receiving_total; ?> Unit</td>
                                                                <td><?= $c->progress_total; ?> Unit</td>
                                                                <?php if ($c->status_order == 1) : ?>
                                                                    <td><a href="" class="btn btn-warning btn-sm">Pemeriksaan</a></td>
                                                                <?php elseif ($c->status_order == 2) : ?>
                                                                    <td><a href="" class="btn btn-success btn-sm">Terpenuhi</a></td>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                                </td>
                                                                <td><?= $c->username; ?></td>
                                                                <?php if ($supplier[0]->order_status != 1 && $c->status_order == 1) : ?>
                                                                    <td>
                                                                        <div class="row justify-content-center">

                                                                            <!-- Update Button Modal -->
                                                                            <button type="button" onclick="update('<?= $c->id ?>')" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Order" data-toggle="tooltip"></i></button>
                                                                        </div>
                                                                    </td>
                                                                <?php elseif ($c->status_order == 2) : ?>
                                                                    <td>
                                                                        <button type="button" class="btn btn-success btn-icon btn-rounded" data-toggle="modal"><i class="feather icon-check" title="Terpenuhi" data-toggle="tooltip"></i></button>
                                                                    </td>
                                                                <?php endif; ?>
                                                            </tr>
                                                        <?php
                                                            $total_order = $total_order + $c->detail_quantity;
                                                        endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="5" rowspan="2"></th>
                                                            <th>Total Barang</th>
                                                            <th colspan="4"><?= $i - 1; ?> Jenis Barang</th>
                                                        </tr>
                                                        <tr>
                                                            <th>Total Item Dipesan</th>
                                                            <th colspan="4"><?= $total_order; ?> Unit Barang</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
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

<?php foreach ($order as $c) : ?>
    <!-- Update Modal -->
    <div id="updateCategory-<?= $c->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryLabel-<?= $c->id; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryLabel-<?= $c->id; ?>">Receiving Order Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_order_detail" value="<?= $c->id; ?>">
                        <div class="form-group">
                            <div class="input-group search-form">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">Total Order</span>
                                </div>
                                <input type="number" min="0" class="form-control" disabled required placeholder="Belum Datang" value="<?= $c->detail_quantity; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">Unit</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group search-form">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">Belum Datang</span>
                                </div>
                                <input type="number" min="0" class="form-control" disabled required placeholder="Belum Datang" value="<?= $c->progress_total; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">Unit</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group search-form">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">Receiving</span>
                                </div>
                                <input type="number" min="0" max="<?= $c->detail_quantity ?>" class="form-control <?= $validation->getError('item_quantity_up') ? 'is-invalid' : ''; ?>" name="receiving_total" required placeholder="Order Masuk" value="<?= old('receiving_total') ?: $c->receiving_total; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">Unit</span>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('receiving_total'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="receiving_remark" id="receiving_remark" class="form-control <?= $validation->getError('receiving_remark') ? 'is-invalid' : ''; ?>" placeholder="Masukkan Remark (Optional)" cols="30" rows="5"><?= old('receiving_remark') ?: $c->receiving_remark; ?></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('receiving_remark'); ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="update_receiving" value="update" class="btn btn-primary">Simpan
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