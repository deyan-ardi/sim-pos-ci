<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Data Item Barang
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    const deleteButton = (formId, nama) => {
        swal({
                title: "Hapus Item Barang Dengan Kode " + nama + "?",
                text: "Informasi Yang Terkait Dengan Data Ini Akan Hilang Secara Permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $("#submit-" + formId).submit();
                } else {
                    swal({
                        title: "File Aman !",
                        text: "Data Item Barang Dengan Kode " + nama + " Batal Dihapus",
                        icon: "info",
                    });
                }
            });
    };
    const requestUbahPosisi = (value) => {
        console.log(value);
        $.ajax({
            url: "<?= base_url('/items/ubah/posisi'); ?>",
            method: 'POST',
            dataType: 'html',
            data: {
                id: value,
            },
            beforeSend: function() {
                $('#loadedPosisi').show();
            },
            complete: function() {
                $('#loadedPosisi').hide();
            },
            success: function(result) {
                $('#modal-body-posisi').empty()
                $('#modal-body-posisi').append(result);
            },
            error: function(result) {
                alert(result.responseText);
            }
        });
    }

    const requestUbahItem = (value) => {
        console.log(value);
        $.ajax({
            url: "<?= base_url('/items/ubah/item'); ?>",
            method: 'POST',
            dataType: 'html',
            data: {
                id: value,
            },
            beforeSend: function() {
                $('#loadedItem').show();
            },
            complete: function() {
                $('#loadedItem').hide();
            },
            success: function(result) {
                $('#modal-body-item').empty()
                $('#modal-body-item').append(result);
            },
            error: function(result) {
                alert(result.responseText);
            }
        });
    }

    $(document).ready(function() {
        var table = $('#yajra-datatables').DataTable({
            processing: true, //Feature control the processing indicator.
            serverSide: true, //Feature control DataTables' server-side processing mode.
            order: [],
            ajax: {
                url: '<?= base_url('items/getItemAll'); ?>',
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
                <?php if (! in_groups('GUDANG')) : ?> {
                        data: 'item_hpp',
                        name: 'item_hpp',
                        render: function(o) {
                            return format_rupiah(o);
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
                        data: 'item_profit',
                        name: 'item_profit',
                        render: function(o) {
                            return format_rupiah(o);

                        }
                    },
                <?php endif; ?> {
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
                {
                    data: 'action',
                    name: 'action',
                    searchable: false,
                    render: function(o) {
                        <?php if (in_groups('GUDANG') || in_groups('SUPER ADMIN')) : ?>
                            const action =
                                `<div class="row justify-content-center">
                                <!-- Posisi Barang Button -->
                                <button type="button" onclick="requestUbahPosisi('` + o.id + `')" class="btn btn-info btn-icon btn-rounded" data-toggle="modal" data-target="#updatePosisi"><i class="feather icon-box" title="Posisi Barang" data-toggle="tooltip"></i></button>

                                <!-- Update Button Modal -->
                                <button type="button" onclick="requestUbahItem('` + o.id +
                                `')" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory"><i class="feather icon-edit" title="Ubah Barang" data-toggle="tooltip"></i></button>

                                <!-- Delete -->
                                <form action="" id="submit-` + o.id +
                                `" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <input type="hidden" name="id_item" value="` + o.id + `">
                                    <input type="hidden" name="delete_items" value="delete">
                                    <button type="button" onclick="deleteButton(` + o.id +
                                `,'` + o.item_code +
                                `')" class="btn delete-button btn-danger btn-icon btn-rounded" title="Hapus Barang" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                </form>
                            </div>`;
                        <?php else : ?>
                            const action =
                                `<div class="row justify-content-center">
                                <!-- Update Button Modal -->
                                <button type="button" onclick="requestUbahItem('` + o.id +
                                `')" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory"><i class="feather icon-edit" title="Ubah Barang" data-toggle="tooltip"></i></button>

                                <!-- Delete -->
                                <form action="" id="submit-` + o.id +
                                `" method="POST">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE" />
                                    <input type="hidden" name="id_item" value="` + o.id + `">
                                    <input type="hidden" name="delete_items" value="delete">
                                    <button type="button" onclick="deleteButton(` + o.id +
                                `,'` + o.item_code +
                                `')" class="btn delete-button btn-danger btn-icon btn-rounded" title="Hapus Barang" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                </form>
                            </div>`;
                        <?php endif; ?>
                        return action;
                    }
                },
            ],
            columnDefs: [{
                targets: [0],
                orderable: false,
            }, ]
        });
    });

    $(document).ready(function() {
        $('#item_id').selectize({
            sortField: 'text'
        });
    });
    $(document).ready(function() {
        $('#supp_id').selectize({
            sortField: 'text'
        });
    });
    const update = (x) => {
        $(document).ready(function() {
            $('#item_id-' + x).selectize({
                sortField: 'text'
            });
        });

        $(document).ready(function() {
            $('#supp_id-' + x).selectize({
                sortField: 'text'
            });
        });
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('header'); ?>
<!-- data tables css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

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
                                                        <?php if (! in_groups('GUDANG')) : ?>
                                                            <th>Harga Beli</th>
                                                            <th>Harga Jual</th>
                                                            <th>Diskon</th>
                                                            <th>Harga Jual Akhir</th>
                                                            <th>Untung Per Barang</th>
                                                        <?php endif; ?>
                                                        <th>Kategori</th>
                                                        <th>Disuplai Oleh</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
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
                                                        <?php if (! in_groups('GUDANG')) : ?>
                                                            <th>Harga Beli</th>
                                                            <th>Harga Jual</th>
                                                            <th>Diskon</th>
                                                            <th>Harga Jual Akhir</th>
                                                            <th>Untung Per Barang</th>
                                                        <?php endif; ?>
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
<div id="updatePosisi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updatePosisiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatePosisiLabel">Ubah Posisi dan Jumlah
                    Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="POST">
                <?= csrf_field(); ?>
                <div class="modal-body" id="modal-body-posisi">
                    <div id="loadedPosisi">Loading Data....</div>
                </div>
                <div class="modal-footer pr-1">
                    <button type="submit" name="update_posisi_item" value="update" class="btn btn-primary">Simpan
                        Perubahan</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="updateCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCategoryLabel">Ubah Data
                    Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body" id="modal-body-item">
                    <div id="loadedItem">Loading Data....</div>
                </div>
                <div class="modal-footer pr-1">
                    <button type="submit" name="update_items" value="update" class="btn btn-primary">Simpan
                        Perubahan</button>
                    <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Tambah Barang Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="file" accept=".png,.jpg,.jpeg" class="form-control <?= $validation->getError('item_image') ? 'is-invalid' : ''; ?>" name="item_image">
                        <small id="file" class="form-text text-muted">Bersifat opsional, file maksimal 1 Mb, bertipe .jpg, .png. atau
                            .jpeg</small>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_image'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_code') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_code" required placeholder="Kode Barang" value="<?= (old('item_code')) ?: ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_code'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_name') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_name" required placeholder="Nama Barang" value="<?= (old('item_name')) ?: ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_name'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_merk') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_merk" placeholder="Merk Barang (Opsional)" value="<?= (old('item_merk')) ?: ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_merk'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('item_type') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_type" placeholder="Tipe Barang (Opsional)" value="<?= (old('item_type')) ?: ''; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_type'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_weight') ? 'is-invalid' : ''; ?>" name="item_weight" placeholder="Berat Dalam Kg (Opsional)" value="<?= (old('item_weight')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Kg</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_weight'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_length') ? 'is-invalid' : ''; ?>" name="item_length" placeholder="Panjang Dalam Meter (Opsional)" value="<?= (old('item_length')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Meter</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_length'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_width') ? 'is-invalid' : ''; ?>" name="item_width" placeholder="Lebar Dalam Meter (Opsional)" value="<?= (old('item_width')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Meter</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_width'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_height') ? 'is-invalid' : ''; ?>" name="item_height" placeholder="Tinggi Dalam Meter (Opsional)" value="<?= (old('item_height')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Meter</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_height'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Stok Gudang Holding</span>
                        </div>
                        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_a') ? 'is-invalid' : ''; ?>" name="item_stock_a" value="0" placeholder="Jumlah Stok Gudang A" required value="<?= (old('item_stock_a')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Unit</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_stock_a'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Stok Gudang Gurita</span>
                        </div>
                        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_b') ? 'is-invalid' : ''; ?>" name="item_stock_b" value="0" placeholder="Jumlah Stok Gudang B" required value="<?= (old('item_stock_b')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Unit</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_stock_b'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Stok Showroom Sunset</span>
                        </div>
                        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_c') ? 'is-invalid' : ''; ?>" name="item_stock_c" value="0" placeholder="Jumlah Stok Gudang C" required value="<?= (old('item_stock_c')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Unit</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_stock_c'); ?>
                        </div>
                    </div>
                    <div class="form-group input-group search-form">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Stok Gudang Jakarta</span>
                        </div>
                        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_d') ? 'is-invalid' : ''; ?>" name="item_stock_d" value="0" placeholder="Jumlah Stok Gudang D" required value="<?= (old('item_stock_d')) ?: ''; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">Unit</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_stock_d'); ?>
                        </div>
                    </div>
                    <?php if (! in_groups('GUDANG')) : ?>
                        <div class="form-group input-group search-form">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent">Rp</span>
                            </div>
                            <input type="number" min="0" class="form-control <?= $validation->getError('item_hpp') ? 'is-invalid' : ''; ?>" name="item_hpp" placeholder="Harga Beli (Rupiah)" required value="<?= (old('item_hpp')) ?: ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('item_hpp'); ?>
                            </div>
                        </div>
                        <div class="form-group input-group search-form">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent">Rp</span>
                            </div>
                            <input type="number" min="0" class="form-control <?= $validation->getError('item_sale') ? 'is-invalid' : ''; ?>" name="item_sale" placeholder="Harga Jual (Rupiah)" required value="<?= (old('item_sale')) ?: ''; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('item_sale'); ?>
                            </div>
                        </div>
                        <div class="form-group input-group search-form">
                            <input type="number" min="0" max="100" step="0.01" class="form-control <?= $validation->getError('item_discount') ? 'is-invalid' : ''; ?>" name="item_discount" placeholder="Diskon Barang Dalam Persen (Opsional)" value="<?= (old('item_discount')) ?: '' ?>">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent">%</span>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError('item_discount'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <textarea class="form-control <?= $validation->getError('item_description') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_description" placeholder="Deskripsi Barang (Opsional)"><?= (old('item_description')) ?: ''; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('item_description'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <select id="item_id" name="category" required class="form-control <?= $validation->getError('category') ? 'is-invalid' : ''; ?>">
                            <option value="">- Pilih Kategori Barang -</option>
                            <?php foreach ($category as $c) : ?>
                                <option value="<?= $c->id; ?>"><?= $c->category_name; ?></option>
                            <?php endforeach; ?>

                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('category'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="supplier" id="supp_id" required class="form-control <?= $validation->getError('supplier') ? 'is-invalid' : ''; ?>">
                            <option value="">- Pilih Supplier -</option>
                            <?php foreach ($supplier as $c) : ?>
                                <option value="<?= $c->id; ?>"><?= $c->supplier_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('supplier'); ?>
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