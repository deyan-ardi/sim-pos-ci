<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Data Item Barang
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
                title: "Hapus Item Barang Dengan Kode " + nama + "?",
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
                        text: "Data Item Barang Dengan Kode " + nama + " Batal Dihapus",
                        icon: "info",
                    });
                }
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Marketing Data Item Barang</h5>
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
                                                        <th>Stok Gudang A</th>
                                                        <th>Stok Gudang B</th>
                                                        <th>Stok Gudang C</th>
                                                        <th>Stok Gudang D</th>
                                                        <th>Stok Total</th>
                                                        <th>Harga Jual</th>
                                                        <th>Diskon</th>
                                                        <th>Harga Jual Akhir</th>
                                                        <th>Untung Per Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Disuplai Oleh</th>
                                                        <th>Diubah Terakhir</th>

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
                                                            <td><?= $c->item_warehouse_a; ?> Buah</td>
                                                            <td><?= $c->item_warehouse_b; ?> Buah</td>
                                                            <td><?= $c->item_warehouse_c; ?> Buah</td>
                                                            <td><?= $c->item_warehouse_d; ?> Buah</td>
                                                            <td><?= $c->item_stock; ?> Buah</td>
                                                            <td>Rp. <?= format_rupiah($c->item_before_sale); ?></td>
                                                            <td><?= format_rupiah($c->item_discount); ?> %</td>
                                                            <td>Rp. <?= format_rupiah($c->item_sale); ?></td>
                                                            <td>Rp. <?= format_rupiah($c->item_profit); ?></td>
                                                            <td><?= $c->category_name; ?></td>
                                                            <td><?= $c->supplier_name; ?></td>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
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
                                                        <th>Stok Gudang A</th>
                                                        <th>Stok Gudang B</th>
                                                        <th>Stok Gudang C</th>
                                                        <th>Stok Gudang D</th>
                                                        <th>Stok Total</th>
                                                        <th>Harga Jual</th>
                                                        <th>Diskon</th>
                                                        <th>Harga Jual Akhir</th>
                                                        <th>Untung Per Barang</th>
                                                        <th>Kategori</th>
                                                        <th>Disuplai Oleh</th>
                                                        <th>Diubah Terakhir</th>
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