<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Pengaturan Transaksi
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Pengaturan Transaksi</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Pengaturan Transaksi</a></li>
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
                                        <h5>Pengaturan PPh</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nilai PPh</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $tot = 1;
                                                    foreach ($pph as $c) : ?>
                                                        <tr>
                                                            <td><?= $tot++; ?></td>
                                                            <td><?= $c->pph_value; ?> %</td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <!-- Set Status Button Modal -->
                                                                    <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateOrder-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Nilai PPh" data-toggle="tooltip"></i></button>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nilai PPh</th>
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
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Pengaturan Invoice</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable2" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Key</th>
                                                        <th>Value</th>
                                                        <th>Position/Jabatan TTD</th>
                                                        <th>Header TTD</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach ($invoice as $i => $c) : ?>
                                                        <tr>
                                                            <td><?= $i + 1; ?></td>
                                                            <?php if ($c->key == "kiri" || $c->key == "tengah" || $c->key == "kanan" || $c->key == "bawah") : ?>
                                                                <td>Konfigurasi TTD Bagian <?= ucWords($c->key); ?></td>
                                                            <?php else : ?>
                                                                <td><?= ucWords($c->key); ?></td>
                                                            <?php endif; ?>
                                                            <td><?= empty($c->value) ? "Belum Disetel" : $c->value; ?></td>
                                                            <td><?= empty($c->position) ? "Belum Disetel" : $c->position; ?></td>
                                                            <td><?= empty($c->header) ? "Belum Disetel" : $c->header; ?></td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <!-- Set Status Button Modal -->
                                                                    <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updatePengaturan-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Nilai Pengaturan" data-toggle="tooltip"></i></button>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Key</th>
                                                        <th>Value</th>
                                                        <th>Position/Jabatan TTD</th>
                                                        <th>Header TTD</th>
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
<?php foreach ($pph as $c) : ?>
    <!-- Modal -->
    <div id="updateOrder-<?= $c->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateOrder-<?= $c->id ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrder-<?= $c->id ?>Label">Ubah Nilai PPh</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                        <div class="form-group">
                            <div class="form-group input-group search-form">
                                <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('pph') ? "is-invalid" : ""; ?>" name="pph" placeholder="Nilai PPh" required value="<?= (old('pph')) ? old('pph') : $c->pph_value; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">%</span>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError("pph"); ?>
                                </div>
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
<?php endforeach; ?>
<?php foreach ($invoice as $c) : ?>
    <!-- Modal -->
    <div id="updatePengaturan-<?= $c->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatePengaturan-<?= $c->id ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrder-<?= $c->id ?>Label">Ubah Nilai Pengaturan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                        <div class="form-group">
                            <?php if ($c->key == "kiri" || $c->key == "tengah" || $c->key == "kanan" || $c->key == "bawah") : ?>
                                <input type="text" class="form-control" disabled value="Konfigurasi TTD Bagian <?= ucWords($c->key); ?>">
                            <?php else : ?>
                                <input type="text" class="form-control" disabled value="<?= ucWords($c->key); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?= $validation->getError('pengaturan') ? "is-invalid" : ""; ?>" name="pengaturan" placeholder="Nilai Pengaturan" value="<?= (old('pengaturan')) ? old('pengaturan') : $c->value; ?>">

                            <div class="invalid-feedback">
                                <?= $validation->getError("pengaturan"); ?>
                            </div>
                            <small>Kosongkan untuk mendisable pengaturan</small>
                        </div>
                        <?php if ($c->key == "kiri" || $c->key == "tengah" || $c->key == "kanan" || $c->key == "bawah") : ?>
                            <div class="form-group">
                                <input type="text" class="form-control <?= $validation->getError('posisi') ? "is-invalid" : ""; ?>" name="posisi" placeholder="Nilai Posisi" value="<?= (old('posisi')) ? old('posisi') : $c->position; ?>">

                                <div class="invalid-feedback">
                                    <?= $validation->getError("posisi"); ?>
                                </div>
                                <small>Kosongkan untuk mendisable posisi jabatan di TTD</small>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control <?= $validation->getError('header') ? "is-invalid" : ""; ?>" name="header" placeholder="Nilai Header" value="<?= (old('header')) ? old('header') : $c->header; ?>">

                                <div class="invalid-feedback">
                                    <?= $validation->getError("header"); ?>
                                </div>
                                <small>Kosongkan untuk mendisable header TTD</small>
                            </div>
                        <?php endif; ?>

                        <div class="modal-footer">
                            <button type="submit" name="update_pengaturan" value="pengaturan" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>