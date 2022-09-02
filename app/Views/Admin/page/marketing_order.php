<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Request Order Barang
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
                title: "Hapus Permintaan Order Dengan Kode " + nama + "?",
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
                        text: "Data Pesanan Supplier Dengan Kode " + nama + " Batal Dihapus",
                        icon: "info",
                    });
                }
            });
    });
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
                                                            <td><?= $c->request_total; ?> Unit</td>
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
                                                                    <?php if ($c->request_status == 0) : ?>
                                                                        <!-- Set Status Button Modal -->
                                                                        <button type="button" onclick="update('<?= $c->id ?>')" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateOrder-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Permintaan Order" data-toggle="tooltip"></i></button>
                                                                    <?php endif; ?>
                                                                    <!-- Delete -->
                                                                    <?php if ($c->request_status !== 1) : ?>
                                                                        <form action="" id="<?= $c->id; ?>" method="POST">
                                                                            <?= csrf_field(); ?>
                                                                            <input type="hidden" name="_method" value="DELETE" />
                                                                            <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                                                                            <input type="hidden" name="delete_request_order" value="delete">
                                                                            <button type="submit" data-formid="<?= $c->id ?>" data-nama="<?= $c->item_name ?>" class="btn btn-danger delete-button btn-icon btn-rounded" title="Hapus Order" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                        </form>
                                                                    <?php endif; ?>
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

<!-- Modal -->
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Tambah Data Permintaan Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <select id="item_id" class="form-control <?= $validation->getError('item_name') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_name" required>
                            <option value="">Pilih Item Barang</option>
                            <?php foreach ($item as $i) : ?>
                                <option value="<?= $i->id; ?>"><?= $i->item_code; ?> - <?= $i->item_name; ?> - <?= $i->item_merk; ?> - <?= $i->item_type; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control <?= $validation->getError('request_description') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" placeholder="Deskripsi Order" name="request_description" required></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('request_description'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" class="form-control <?= $validation->getError('order_total') ? 'is-invalid' : ''; ?>" name="order_total" placeholder="Jumlah Order" required value="<?= (old('order_total')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Unit</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('order_total'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="input_request_order" value="order" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($request_order as $c) : ?>
    <!-- Modal -->
    <div id="updateOrder-<?= $c->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateOrder-<?= $c->id ?>Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrder-<?= $c->id ?>Label">Ubah Permintaan Order</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                        <div class="form-group">
                            <select id="item_id-<?= $c->id ?>" class="form-control <?= $validation->getError('item_name') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_name" required>
                                <?php foreach ($item as $i) : ?>
                                    <option value="<?= $i->id; ?>" <?= $i->id == $c->item_id ? 'selected' : '' ?>><?= $i->item_code; ?> - <?= $i->item_name; ?> - <?= $i->item_merk; ?> - <?= $i->item_type; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('item_name'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <textarea class="form-control <?= $validation->getError('request_description') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" placeholder="Deskripsi Order" name="request_description" required> <?= $c->request_description; ?> </textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError('request_description'); ?>
                            </div>
                        </div>
                        <div class="form-group input-group search-form">
                            <input type="number" min="0" class="form-control <?= $validation->getError('order_total') ? 'is-invalid' : ''; ?>" name="order_total" placeholder="Jumlah Order" required value="<?= (old('order_total')) ?: $c->request_total; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent">Unit</span>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('order_total'); ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_request_order" value="order" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?= $this->endSection(); ?>