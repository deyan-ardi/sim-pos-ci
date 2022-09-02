<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Order Barang Supplier
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Order Barang Supplier</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Order Barang Supplier</a></li>
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
                                        <?php if (in_groups('SUPER ADMIN') || in_groups('PURCHASING')) : ?>
                                            <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-file-plus"></i> Buat Pesanan</button>
                                        <?php endif; ?>
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
                                                        <th>Manajemen Pesanan</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th>Status Order</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;

                                                    foreach ($order as $c) : ?>
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
                                                            <?php if ($c->order_status == 1) : ?>
                                                                <td><a href="<?= base_url(); ?>/suppliers/create_orders?order_code=<?= $c->order_code; ?>" class="btn btn-primary"><i class="feather icon-shopping-cart"></i> Buat Pesanan</a></td>
                                                            <?php else : ?>
                                                                <td><a href="<?= base_url(); ?>/suppliers/create_orders?order_code=<?= $c->order_code; ?>" class="btn btn-info"><i class="feather icon-shopping-cart"></i> Lihat Pesanan</a></td>

                                                            <?php endif; ?>
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
                                                            <?php endif; ?>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <?php if ($c->order_status !== 8) : ?>
                                                                        <!-- Set Status Button Modal -->
                                                                        <?php if (in_groups('PURCHASING') || in_groups('SUPER ADMIN')) : ?>
                                                                            <?php if ($c->order_status != 6) : ?>
                                                                                <button type="button" class="btn btn-info btn-icon btn-rounded" data-toggle="modal" data-target="#updateOrder-<?= $c->id; ?>"><i class="feather icon-package" title="Ubah Status Order" data-toggle="tooltip"></i></button>
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>

                                                                        <!-- Delete -->
                                                                        <form action="" id="<?= $c->id; ?>" method="POST">
                                                                            <?= csrf_field(); ?>
                                                                            <input type="hidden" name="_method" value="DELETE" />
                                                                            <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                                                                            <input type="hidden" name="delete_order" value="delete">
                                                                            <button type="submit" data-formid="<?= $c->id ?>" data-nama="<?= $c->order_code ?>" class="btn btn-danger delete-button btn-icon btn-rounded" title="Hapus Order" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                        </form>
                                                                    <?php endif; ?>
                                                                    <!-- Delete -->
                                                                    <form target="_blank" rel="noopener noreferrer" action="<?= base_url(); ?>/suppliers/invoice" method="POST">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                                                                        <button type="submit" name="print_order" value="print" class="btn btn-warning btn-icon btn-rounded" title="Unduh Data Order" data-toggle="tooltip"><i class="feather icon-download"></i></button>
                                                                    </form>


                                                                </div>
                                                            </td>
                                                        </tr>
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
                                                        <th>Manajemen Pesanan</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th>Status Order</th>
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
                                <?php if (in_groups('PURCHASING') || in_groups('SUPER ADMIN')) : ?>
                                    <?php if ($c->order_status != 6) : ?>
                                        <option value="1" <?= $c->order_status == 1 ? 'selected' : ''; ?>>Request Diterima - Permintaan Pesanan Diterima</option>
                                        <option value="2" <?= $c->order_status == 2 ? 'selected' : ''; ?>>Persetujuan - Pesanan Telah Dibuat, Request Persetujuan</option>
                                        <option value="3" <?= $c->order_status == 3 ? 'selected' : ''; ?>>Order Keluar - Pesanan Disetujui, Order Keluar</option>
                                        <option value="4" <?= $c->order_status == 4 ? 'selected' : ''; ?>>Invoice Masuk - Invoice Barang Yang Dipesan Telah Diterima</option>
                                        <option value="5" <?= $c->order_status == 5 ? 'selected' : ''; ?>>Produksi - Barang Pesanan Sudah Dalam Tahap Produksi</option>
                                        <option value="6" <?= $c->order_status == 6 ? 'selected' : ''; ?>>Dikirim Oleh Vendor - Pesanan Dikirim Supplier</option>
                                    <?php else : ?>
                                        <option value="">-- Pesanan Sudah Dikirim, Tidak Dapat Diubah --</option>
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

<!-- Modal -->
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Tambah Data Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="text" disabled class="form-control" required value="PO No.<?= $kode_po; ?>">
                    </div>
                    <div class="form-group">
                        <select id="item_id" class="form-control <?= $validation->getError('supplier_name') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="supplier_name" required>
                            <option value="">Pilih Supplier</option>
                            <?php foreach ($supplier as $s) : ?>
                                <option value="<?= $s->id; ?>"><?= $s->supplier_name; ?> (0<?= $s->supplier_contact; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('supplier_name'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="input_order" value="order" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>