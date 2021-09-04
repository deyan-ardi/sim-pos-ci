<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Request Order Barang
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Marketing Request Order Barang</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Request Order Barang</a></li>
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
                                        <h5>List Order Barang</h5>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-file-plus"></i> Buat Permintaan Order</button>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Deskripsi Permintaan</th>
                                                        <th>Total Permintaan</th>
                                                        <th>Permintaan Dari</th>
                                                        <th>Status Permintaan</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $tot = 1;
                                                    foreach ($request_order as $c) : ?>
                                                        <tr>
                                                            <td><?= $tot++; ?></td>
                                                            <td> <?= CodeIgniter\I18n\Time::parse($c->updated_at)->format('Y-m-d'); ?>
                                                            </td>
                                                            <td><?= $c->item_code; ?></td>
                                                            <td><?= $c->item_name; ?></td>
                                                            <td><?= $c->request_description; ?></td>
                                                            <td><?= $c->request_total; ?> Buah</td>
                                                            <td><?= $c->username; ?></td>
                                                            <?php if ($c->request_status == 0) : ?>
                                                                <td><a href="" class="btn btn-warning btn-sm">Draft</a></td>
                                                            <?php elseif ($c->request_status == 2) : ?>
                                                                <td><a href="" class="btn btn-danger btn-sm">Permintaan Ditolak</a></td>
                                                            <?php else : ?>
                                                                <td><a href="" class="btn btn-success btn-sm">Permintaan Diterima</a></td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <!-- Set Status Button Modal -->
                                                                    <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateOrder-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Status Permintaan Order" data-toggle="tooltip"></i></button>


                                                                    <!-- Modal -->
                                                                    <div id="updateOrder-<?= $c->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateOrder-<?= $c->id ?>Label" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="updateOrder-<?= $c->id ?>Label">Ubah Status Permintaan Order</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="" method="POST">
                                                                                        <?= csrf_field(); ?>
                                                                                        <input type="hidden" name="_method" value="PATCH">
                                                                                        <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                                                                                        <div class="form-group">
                                                                                            <select class="form-control <?= $validation->getError('request_status') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="request_status" required>
                                                                                                <option value="">Status Request Order</option>
                                                                                                <option value="1" <?= $c->request_status == 1 ? "selected" : ""; ?>>Request Diterima</option>
                                                                                                <option value="2" <?= $c->request_status == 2 ? "selected" : ""; ?>>Request Ditolak</option>
                                                                                            </select>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("request_status"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" name="update_status_order" value="order" class="btn btn-primary">Simpan Perubahan</button>
                                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Tanggal</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Deskripsi Permintaan</th>
                                                        <th>Total Permintaan</th>
                                                        <th>Permintaan Dari</th>
                                                        <th>Status Permintaan</th>
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