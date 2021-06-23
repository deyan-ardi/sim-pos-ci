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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Data Item Barang</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Data Barang</a></li>
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
                                        <h5>List Item Barang</h5>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-file-plus"></i> Tambahkan Barang</button>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Gambar Produk</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Merk Barang</th>
                                                        <th>Tipe Barang</th>
                                                        <th>Berat Barang</th>
                                                        <th>Panjang Barang</th>
                                                        <th>Lebar Barang</th>
                                                        <th>Tinggi Barang</th>
                                                        <th>Deskripsi Barang</th>
                                                        <th>Stok</th>
                                                        <th>Harga Beli</th>
                                                        <th>Harga Jual</th>
                                                        <th>Diskon</th>
                                                        <th>Harga Jual Akhir</th>
                                                        <th>Untung Per Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Disuplai Oleh</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($items as $c) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><img src="<?= base_url(); ?>/upload/produk/<?= $c->item_image; ?>" alt="Gambar Produk" width="50%">
                                                            </td>
                                                            <td><?= $c->item_code; ?></td>
                                                            <td><?= $c->item_name; ?></td>
                                                            <td>
                                                                <?= !empty($c->item_merk) ? $c->item_merk : "Kosong"; ?>
                                                            </td>
                                                            <td><?= !empty($c->item_type) ? $c->item_type : "Kosong"; ?>
                                                            </td>
                                                            <td><?= $c->item_weight; ?> Kg</td>
                                                            <td><?= $c->item_length; ?> Meter</td>
                                                            <td><?= $c->item_width; ?> Meter</td>
                                                            <td><?= $c->item_height; ?> Meter</td>
                                                            <td><?= !empty($c->item_description) ? $c->item_description : "Kosong"; ?>
                                                            </td>
                                                            <td><?= $c->item_stock; ?> Buah</td>
                                                            <td>Rp. <?= format_rupiah($c->item_hpp); ?></td>
                                                            <td>Rp. <?= format_rupiah($c->item_before_sale); ?></td>
                                                            <td><?= format_rupiah($c->item_discount); ?> %</td>
                                                            <td>Rp. <?= format_rupiah($c->item_sale); ?></td>
                                                            <td>Rp. <?= format_rupiah($c->item_profit); ?></td>
                                                            <td><?= $c->category_name; ?></td>
                                                            <td><?= $c->supplier_name; ?></td>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                            </td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <!-- Update Button Modal -->
                                                                    <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory-<?= $c->id; ?>"><i class="feather icon-edit" title="Ubah Barang" data-toggle="tooltip"></i></button>

                                                                    <!-- Update Modal -->
                                                                    <div id="updateCategory-<?= $c->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryLabel-<?= $c->id; ?>" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="updateCategoryLabel-<?= $c->id; ?>">Ubah Data
                                                                                        Barang</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                                        <?= csrf_field(); ?>
                                                                                        <input type="hidden" name="_method" value="PATCH">
                                                                                        <input type="hidden" name="id_item" value="<?= $c->id; ?>">
                                                                                        <div class="form-group">
                                                                                            <input type="file" accept=".png,.jpg,.jpeg" class="form-control <?= $validation->getError('item_image_up') ? "is-invalid" : ""; ?>" name="item_image_up">
                                                                                            <small id="file" class="form-text text-muted">Bersifat
                                                                                                opsional, jika ingin diubah
                                                                                                pastikan file
                                                                                                maksimal 1 Mb, bertipe .jpg,
                                                                                                .png. atau
                                                                                                .jpeg</small>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_image_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control <?= $validation->getError('item_code_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_code_up" required placeholder="Kode Barang" value="<?= (old('item_code_up')) ? old('item_code_up') : $c->item_code; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_code_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control <?= $validation->getError('item_name_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_name_up" required placeholder="Nama Barang" value="<?= (old('item_name_up')) ? old('item_name_up') : $c->item_name; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_name_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control <?= $validation->getError('item_merk_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_merk_up" placeholder="Merk Barang (Opsional)" value="<?= (old('item_merk_up')) ? old('item_merk_up') : $c->item_merk; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_merk_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control <?= $validation->getError('item_type_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_type_up" placeholder="Tipe Barang (Opsional)" value="<?= (old('item_type_up')) ? old('item_type_up') : $c->item_type; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_type_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_weight_up') ? "is-invalid" : ""; ?>" name="item_weight_up" placeholder="Berat Dalam Kg (Opsional)" value="<?= (old('item_weight_up')) ? old('item_weight_up') : $c->item_weight; ?>">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">Kg</span>
                                                                                            </div>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_weight_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_length_up') ? "is-invalid" : ""; ?>" name="item_length_up" placeholder="Panjang Dalam Meter (Opsional)" value="<?= (old('item_length_up')) ? old('item_length_up') : $c->item_length; ?>">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">Meter</span>
                                                                                            </div>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_length_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_width_up') ? "is-invalid" : ""; ?>" name="item_width_up" placeholder="Lebar Dalam Meter (Opsional)" value="<?= (old('item_width_up')) ? old('item_width_up') : $c->item_length; ?>">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">Meter</span>
                                                                                            </div>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_width_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_height_up') ? "is-invalid" : ""; ?>" name="item_height_up" placeholder="Tinggi Dalam Meter (Opsional)" value="<?= (old('item_height_up')) ? old('item_height_up') : $c->item_height; ?>">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">Meter</span>
                                                                                            </div>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_height_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">Rp</span>
                                                                                            </div>
                                                                                            <input type="number" min="0" class="form-control <?= $validation->getError('item_hpp_up') ? "is-invalid" : ""; ?>" name="item_hpp_up" placeholder="Harga Beli (Rupiah)" required value="<?= (old('item_hpp_up')) ? old('item_hpp_up') : $c->item_hpp; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_hpp_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_up') ? "is-invalid" : ""; ?>" name="item_stock_up" placeholder="Jumlah Stok" required value="<?= (old('item_stock_up')) ? old('item_stock_up') : $c->item_stock; ?>">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">Buah</span>
                                                                                            </div>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_stock_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">Rp</span>
                                                                                            </div>
                                                                                            <input type="number" min="0" class="form-control <?= $validation->getError('item_sale_up') ? "is-invalid" : ""; ?>" name="item_sale_up" placeholder="Harga Jual (Rupiah)" required value="<?= (old('item_sale_up')) ? old('item_sale_up') : $c->item_sale; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_sale_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group input-group search-form">
                                                                                            <input type="number" min="0" max="100" step="0.01" class="form-control <?= $validation->getError('item_discount_up') ? "is-invalid" : ""; ?>" name="item_discount_up" placeholder="Diskon Barang Dalam Persen (Opsional)" value="<?= (old('item_discount_up')) ? old('item_discount_up') : $c->item_discount; ?>">
                                                                                            <div class="input-group-append">
                                                                                                <span class="input-group-text bg-transparent">%</span>
                                                                                            </div>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_discount_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <textarea class="form-control <?= $validation->getError('item_description_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_description_up" placeholder="Deskripsi Barang (Opsional)"><?= (old('item_description_up')) ? old('item_description_up') : $c->item_description; ?></textarea>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("item_description_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <select name="category_up" id="category_up" required class="form-control <?= $validation->getError('category_up') ? "is-invalid" : ""; ?>">
                                                                                                <option value="">- Pilih
                                                                                                    Kategori Barang -
                                                                                                </option>
                                                                                                <?php foreach ($category as $ca) : ?>
                                                                                                    <?php if ($ca->id == $c->category_id) : ?>
                                                                                                        <option value="<?= $ca->id; ?>" selected>
                                                                                                            <?= $ca->category_name; ?>
                                                                                                        </option>
                                                                                                    <?php else : ?>
                                                                                                        <option value="<?= $ca->id; ?>">
                                                                                                            <?= $ca->category_name; ?>
                                                                                                        </option>
                                                                                                    <?php endif; ?>

                                                                                                <?php endforeach; ?>

                                                                                            </select>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("category_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <select name="supplier_up" id="supplier_up" required class="form-control <?= $validation->getError('supplier_up') ? "is-invalid" : ""; ?>">
                                                                                                <option value="">- Pilih
                                                                                                    Supplier -</option>
                                                                                                <?php foreach ($supplier as $ca) : ?>
                                                                                                    <?php if ($ca->id == $c->supplier_id) : ?>
                                                                                                        <option value="<?= $ca->id; ?>" selected>
                                                                                                            <?= $ca->supplier_name; ?>
                                                                                                        </option>
                                                                                                    <?php else : ?>
                                                                                                        <option value="<?= $ca->id; ?>">
                                                                                                            <?= $ca->supplier_name; ?>
                                                                                                        </option>
                                                                                                    <?php endif; ?>
                                                                                                <?php endforeach; ?>
                                                                                            </select>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("supplier_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" name="update_items" value="update" class="btn btn-primary">Simpan
                                                                                                Perubahan</button>
                                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <!-- Delete -->
                                                                    <form action="" method="POST">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="id_item" value="<?= $c->id; ?>">
                                                                        <button type="submit" name="delete_items" value="delete" class="btn btn-danger btn-icon btn-rounded" title="Hapus Barang" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                    </form>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Gambar Produk</th>
                                                        <th>Kode Barang</th>
                                                        <th>Nama Barang</th>
                                                        <th>Merk Barang</th>
                                                        <th>Tipe Barang</th>
                                                        <th>Berat Barang</th>
                                                        <th>Panjang Barang</th>
                                                        <th>Lebar Barang</th>
                                                        <th>Tinggi Barang</th>
                                                        <th>Deskripsi Barang</th>
                                                        <th>Stok</th>
                                                        <th>Harga Beli</th>
                                                        <th>Harga Jual</th>
                                                        <th>Diskon</th>
                                                        <th>Harga Jual Akhir</th>
                                                        <th>Untung Per Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Disuplai Oleh</th>
                                                        <th>Diubah Terakhir</th>
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
                <h5 class="modal-title" id="addCategoryLabel">Tambah Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="file" accept=".png,.jpg,.jpeg" class="form-control <?= $validation->getError('item_image') ? "is-invalid" : ""; ?>" name="item_image" required>
                        <small id="file" class="form-text text-muted">File maksimal 1 Mb, bertipe .jpg, .png. atau
                            .jpeg</small>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_image"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_code') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_code" required placeholder="Kode Barang" value="<?= (old('item_code')) ? old('item_code') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_code"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_name') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_name" required placeholder="Nama Barang" value="<?= (old('item_name')) ? old('item_name') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_name"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_merk') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_merk" placeholder="Merk Barang (Opsional)" value="<?= (old('item_merk')) ? old('item_merk') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_merk"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_type') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_type" placeholder="Tipe Barang (Opsional)" value="<?= (old('item_type')) ? old('item_type') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_type"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_weight') ? "is-invalid" : ""; ?>" name="item_weight" placeholder="Berat Dalam Kg (Opsional)" value="<?= (old('item_weight')) ? old('item_weight') : ""; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Kg</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_weight"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_length') ? "is-invalid" : ""; ?>" name="item_length" placeholder="Panjang Dalam Meter (Opsional)" value="<?= (old('item_length')) ? old('item_length') : ""; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Meter</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_length"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_width') ? "is-invalid" : ""; ?>" name="item_width" placeholder="Lebar Dalam Meter (Opsional)" value="<?= (old('item_width')) ? old('item_width') : ""; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Meter</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_width"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_height') ? "is-invalid" : ""; ?>" name="item_height" placeholder="Tinggi Dalam Meter (Opsional)" value="<?= (old('item_height')) ? old('item_height') : ""; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Meter</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_height"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control <?= $validation->getError('item_hpp') ? "is-invalid" : ""; ?>" name="item_hpp" placeholder="Harga Beli (Rupiah)" required value="<?= (old('item_hpp')) ? old('item_hpp') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_hpp"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock') ? "is-invalid" : ""; ?>" name="item_stock" placeholder="Jumlah Stok" required value="<?= (old('item_stock')) ? old('item_stock') : ""; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Buah</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_stock"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Rp</span>
                        </div>
                        <input type="number" min="0" class="form-control <?= $validation->getError('item_sale') ? "is-invalid" : ""; ?>" name="item_sale" placeholder="Harga Jual (Rupiah)" required value="<?= (old('item_sale')) ? old('item_sale') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_sale"); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" max="100" step="0.01" class="form-control <?= $validation->getError('item_discount') ? "is-invalid" : ""; ?>" name="item_discount" placeholder="Diskon Barang Dalam Persen (Opsional)" value="<?= (old('item_discount')) ? old('item_discount') : "" ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">%</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_discount"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control <?= $validation->getError('item_description') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="item_description" placeholder="Deskripsi Barang (Opsional)"><?= (old('item_description')) ? old('item_description') : ""; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError("item_description"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="category" id="category" required class="form-control <?= $validation->getError('category') ? "is-invalid" : ""; ?>">
                            <option value="">- Pilih Kategori Barang -</option>
                            <?php foreach ($category as $c) : ?>
                                <option value="<?= $c->id; ?>"><?= $c->category_name; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError("category"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="supplier" id="supplier" required class="form-control <?= $validation->getError('supplier') ? "is-invalid" : ""; ?>">
                            <option value="">- Pilih Supplier -</option>
                            <?php foreach ($supplier as $c) : ?>
                                <option value="<?= $c->id; ?>"><?= $c->supplier_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError("supplier"); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="input_items" value="items" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>