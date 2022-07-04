<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Data Item Barang
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#yajra-datatables').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: '<?= base_url('marketing/order-items/getItemAll'); ?>',
            },
            columns: [{
                    data: 'row_number',
                    name: 'row_number',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'item_image',
                    name: 'item_image',
                    render: function(o) {
                        if (o == null || o == "") {
                            return "Tidak Ada Gambar";
                        }
                        return '<img src="<?= base_url(); ?>/upload/produk/' + o + '" alt="Gambar Produk" width="50%">'
                    },
                },
                {
                    data: 'item_code',
                    name: 'item_code'
                },
                {
                    data: 'item_name',
                    name: 'item_name'
                },
                {
                    data: 'item_merk',
                    name: 'item_merk',
                    render: function(o) {
                        if (o == null || o == "") {
                            return "Tidak Ada Merek";
                        }
                        return o;
                    }
                },
                {
                    data: 'item_type',
                    name: 'item_type',
                    render: function(o) {
                        if (o == null || o == "") {
                            return "Tidak Ada Type";
                        }
                        return o;
                    }
                },
                {
                    data: 'item_weight',
                    name: 'item_weight',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Kg';
                    }
                },
                {
                    data: 'item_length',
                    name: 'item_length',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Meter';
                    }
                },
                {
                    data: 'item_width',
                    name: 'item_width',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Meter';
                    }
                },
                {
                    data: 'item_height',
                    name: 'item_height',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Meter';
                    }
                },
                {
                    data: 'item_description',
                    name: 'item_description',
                    render: function(o) {
                        if (o == null || o == "") {
                            return "Tidak Ada Deskripsi";
                        } else {
                            return o;
                        }
                    }
                },
                {
                    data: 'item_warehouse_a',
                    name: 'item_warehouse_a',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Unit';
                    }
                },
                {
                    data: 'item_warehouse_b',
                    name: 'item_warehouse_b',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Unit';
                    }
                },
                {
                    data: 'item_warehouse_c',
                    name: 'item_warehouse_c',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Unit';
                    }
                },
                {
                    data: 'item_warehouse_d',
                    name: 'item_warehouse_d',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Unit';
                    }
                },
                {
                    data: 'item_stock',
                    name: 'item_stock',
                    render: function(o) {
                        if (o == null || o == "") {
                            o = 0;
                        }
                        return o + ' Unit';
                    }
                },
                {
                    data: 'item_before_sale',
                    name: 'item_before_sale',
                    render: function(o) {
                        return format_rupiah(o);
                    }
                },
                {
                    data: 'item_discount',
                    name: 'item_discount',
                    render: function(o) {
                        return format_rupiah(o);
                    }
                },
                {
                    data: 'item_sale',
                    name: 'item_sale',
                    render: function(o) {
                        return format_rupiah(o);
                    }
                },

                {
                    data: 'category_name',
                    name: 'category_name',
                },
                {
                    data: 'supplier_name',
                    name: 'supplier_name',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                    searchable: false,
                    render: function(o) {
                        const options = {
                            timeZone: "Asia/Makassar",
                            year: "numeric",
                            month: "short",
                            day: "2-digit",
                            hour12: false,
                            hour: "2-digit",
                            minute: "2-digit",
                        };
                        const new_date = new Date(o);
                        return new_date.toLocaleTimeString("en-US", options) + " WITA";
                    }
                },
            ],
            columnDefs: [{
                targets: [0],
                orderable: false,
            }, ]
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
                                            <table id="yajra-datatables" class="table table-striped table-bordered nowrap">
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
                                                        <th>Kategori</th>
                                                        <th>Disuplai Oleh</th>
                                                        <th>Diubah Terakhir</th>

                                                    </tr>
                                                </thead>
                                                <tbody>

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