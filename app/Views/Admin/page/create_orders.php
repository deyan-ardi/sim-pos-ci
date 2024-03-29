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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Buat Order Barang </h5>
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
                                            <div class="row">
                                                <form action="" method="POST" target="_blank" rel="noopener noreferrer">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id_transaksi" value="<?= $supplier[0]->id; ?>">
                                                    <?php if (in_groups('SUPER ADMIN') || in_groups('PURCHASING')) : ?>
                                                        <?php if ($supplier[0]->order_status == 1) : ?>
                                                            <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-file-plus"></i> Buat Pesanan</button>
                                                        <?php endif; ?>

                                                        <button type="button" data-toggle="modal" data-target="#cetakPO" class="btn btn-gradient-success btn-rounded btn-glow mb-4"><i class="feather icon-printer"></i>Cetak PO</button>
                                                    <?php endif; ?>

                                                    <button type="submit" name="input_rogs" value="rogs" class="btn btn-gradient-warning btn-rounded btn-glow mb-4"><i class="feather icon-printer"></i>Cetak ROGS</button>
                                                </form>
                                                <?php if (in_groups('SUPER ADMIN') || in_groups('GUDANG')) : ?>
                                                    <form action="" method="POST" target="_blank" rel="noopener noreferrer">
                                                        <?= csrf_field(); ?>
                                                        <button type="submit" name="input_retur" value="rogs" class="btn btn-gradient-danger btn-rounded btn-glow mb-4"><i class="feather icon-printer"></i>Cetak Retur</button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                            <div class="dt-responsive table-responsive">
                                                <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Kode Barang</th>
                                                            <th>Nama Barang</th>
                                                            <th>Harga Beli</th>
                                                            <th>Harga Jual</th>
                                                            <th>Harga Jual Akhir</th>
                                                            <th>Jumlah Order</th>
                                                            <th>Diubah Terakhir</th>
                                                            <th>Pegawai</th>
                                                            <?php if ($supplier[0]->order_status == 1) : ?>
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
                                                                <td>Rp.<?= format_rupiah($c->item_hpp); ?></td>
                                                                <td>Rp.<?= format_rupiah($c->item_before_sale); ?></td>
                                                                <td>Rp.<?= format_rupiah($c->item_sale); ?></td>
                                                                <td><?= $c->detail_quantity; ?> Unit</td>
                                                                <td>
                                                                    <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                                </td>
                                                                <td><?= $c->username; ?></td>
                                                                <?php if ($supplier[0]->order_status == 1) : ?>
                                                                    <td>
                                                                        <div class="row justify-content-center">

                                                                            <!-- Update Button Modal -->
                                                                            <button type="button" onclick="update('<?= $c->id ?>')" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Order" data-toggle="tooltip"></i></button>


                                                                            <!-- Delete -->
                                                                            <form action="" method="POST">
                                                                                <?= csrf_field(); ?>
                                                                                <input type="hidden" name="_method" value="DELETE" />
                                                                                <input type="hidden" name="id_order" value="<?= $c->id; ?>">
                                                                                <button type="submit" name="delete_order" value="delete" class="btn btn-danger btn-icon btn-rounded" title="Hapus Order" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                            </form>

                                                                        </div>
                                                                    </td>
                                                                <?php endif; ?>
                                                            </tr>
                                                        <?php
                                                            $total_order = $total_order + $c->detail_quantity;
                                                        endforeach; ?>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th colspan="<?= $supplier[0]->order_status == 1 ? 5 : 4 ?>" rowspan="2"></th>
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
<!-- Modal -->
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Buat Order Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <?= csrf_field(); ?>
                    <input type="hidden" value="<?= $supplier[0]->id; ?>" name="id_order">
                    <div class="form-group">
                        <select id="item_id" class="form-control <?= $validation->getError('item_name') ? 'is-invalid' : ''; ?>" style=" text-transform: capitalize;" name="item_name" required>
                            <option value="">Pilih Item Barang Yang Ingin Dipesan</option>
                            <?php foreach ($item as $s) : ?>
                                <option value="<?= $s->id; ?>">
                                    <?= $s->item_code; ?> - <?= $s->item_name; ?> - <?= $s->item_merk; ?> - <?= $s->item_type; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group search-form">
                            <input type="number" min="0" class="form-control <?= $validation->getError('item_quantity') ? 'is-invalid' : ''; ?>" name="item_quantity" required placeholder="Jumlah Order" value="<?= old('item_quantity') ?: ''; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent">Unit</span>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('item_quantity'); ?>
                            </div>
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

<div id="cetakPO" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cetakPOLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cetakPOLabel">Cetak PO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" target="_blank" rel="noopener noreferrer" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <textarea name="order_po" id="order_po" class="form-control <?= $validation->getError('order_po') ? 'is-invalid' : ''; ?>" required placeholder="Masukkan Remark Sebelum Mencetak PO" cols="30" rows="5"><?= old('order_po') ?: $supplier[0]->order_po; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('order_po'); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="input_order_po" value="input_order_po" class="btn btn-primary">Cetak PO</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php foreach ($order as $c) : ?>
    <!-- Update Modal -->
    <div id="updateCategory-<?= $c->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryLabel-<?= $c->id; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryLabel-<?= $c->id; ?>">Ubah Data
                        Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_order_detail" value="<?= $c->id; ?>">
                        <input type="hidden" value="<?= $supplier[0]->id; ?>" name="id_order">
                        <div class="form-group">
                            <select id="item_id-<?= $c->id ?>" class="form-control <?= $validation->getError('item_name_up') ? 'is-invalid' : ''; ?>" style=" text-transform: capitalize;" name="item_name_up" required>
                                <option value="">Pilih Item Barang Yang Ingin Dipesan</option>
                                <?php foreach ($item as $s) : ?>
                                    <?php if ($s->id == $c->item_id) : ?>
                                        <option value="<?= $s->id; ?>" selected>
                                            <?= $s->item_code; ?> - <?= $s->item_name; ?> - <?= $s->item_merk; ?> - <?= $s->item_type; ?>
                                        </option>
                                    <?php else : ?>
                                        <option value="<?= $s->id; ?>">
                                            <?= $s->item_code; ?> - <?= $s->item_name; ?> - <?= $s->item_merk; ?> - <?= $s->item_type; ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= $validation->getError('item_name_up'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group search-form">
                                <input type="number" min="0" class="form-control <?= $validation->getError('item_quantity_up') ? 'is-invalid' : ''; ?>" name="item_quantity_up" required placeholder="Jumlah Order" value="<?= old('item_quantity_up') ?: $c->detail_quantity; ?>">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent">Unit</span>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $validation->getError('item_quantity_up'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="update_order" value="update" class="btn btn-primary">Simpan
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