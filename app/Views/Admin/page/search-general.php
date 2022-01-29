<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Transaksi Barang - Menu Kasir
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
<script>
    // Ajax Send Input Pembayaran
    $('#form').on('keypress', function(e) {
        return e.which !== 13;
    });
    $('#bayar').bind('keyup paste', function() {
        this.value = +this.value.replace(/[^0-9]/g, '');
    });
    $('#handling').bind('keyup paste', function() {
        this.value = +this.value.replace(/[^0-9]/g, '');
    });
    const ajax_send = () => {
        // console.log(event.key === "Enter");
        if (event.key === "Enter") {
            var url = "<?php echo base_url() . "/GeneralTransaction/validation_payment" ?>"
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    //if success close modal and reload ajax table
                    location.reload(); // for reload a page
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        }
        // console.log($('#form').serialize());
    }
    const ajax_send_handling = () => {
        // console.log(event.key === "Enter");
        if (event.key === "Enter") {
            $('#form_handling').submit();
        }
        // console.log($('#form').serialize());
    }
</script>
<script type="text/javascript">
    $(".cetak-button").on("click", function(e) {
        e.preventDefault();
        var self = $(this);
        var nama = $(this).attr("data-nama");
        var formId = $(this).attr("data-formid");
        swal({
                title: "Yakin Mencetak Transaksi " + nama + "?",
                text: "Pastikan printer dalam keadaan hidup, Anda akan diarahkan ke halaman pencetakan",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 5000);
                    $("#cetak-" + formId).submit();
                } else {
                    swal({
                        title: "File Aman !",
                        text: "Data Transaksi " + nama + " Batal Dicetak",
                        icon: "info",
                    });
                }
            });
    });
</script>
<script type="text/javascript">
    $(".delete-button").on("click", function(e) {
        e.preventDefault();
        var self = $(this);
        var nama = $(this).attr("data-nama");
        var formId = $(this).attr("data-formid");
        swal({
                title: "Yakin Membatalkan Transaksi " + nama + "?",
                text: "Data pesanan akan dihapus",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $("#delete-" + formId).submit();
                } else {
                    swal({
                        title: "File Aman !",
                        text: "Data Transaksi " + nama + " Batal Dihapus",
                        icon: "info",
                    });
                }
            });
    });
</script>
<script>
    waktu();

    function waktu() {
        var waktu = new Date();
        setTimeout("waktu()", 1000);
        if (document.getElementById("jam") != null || document.getElementById("menit") != null) {
            document.getElementById("jam").innerHTML = waktu.getHours() + "	:";
            document.getElementById("menit").innerHTML = waktu.getMinutes() + " WITA";
        }
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Sistem Kasir dan Transaksi General</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Menu Kasir</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <?php if ($find_sale[0]->sale_status == 1) : ?>
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Sistem Kasir - Informasi Transaksi</span></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-12">
                                                        <h4 class="text-center mb-4">Transaksi dan Cetak Ulang Berhasil Dilakukan, Silahkan Ke Menu Kasir</h4>
                                                        <a href="<?= base_url(); ?>/transaction-general" class="btn btn-warning col-12"><i class="feather icon-lock"></i> Ke Menu Kasir</a>
                                                        <form action="" id="cetak-<?= $find_sale[0]->sale_code; ?>" target="_blank" method="post">
                                                            <?php csrf_field() ?>
                                                            <input type="hidden" name="_key" value="download">
                                                            <input type="hidden" name="invoice" value="invoice">
                                                            <button type="submit" data-formid="<?= $find_sale[0]->sale_code; ?>" data-nama="<?= $find_sale[0]->sale_code; ?>" class="form-control cetak-button btn btn-primary"><i class="feather icon-printer"></i> Cetak Ulang Transaksi</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Tanggal dan Waktu Server</span></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <div class="row justify-content-center">
                                                    <div class="h2 mb-0 mr-1 font-weight-bold text-primary" id="jam"></div>
                                                    <div class="h2 mb-0 mr-1 font-weight-bold text-primary" id="menit"></div>
                                                </div>
                                                <p class="text-center"><?= date('l, d F Y') ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else : ?>
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="row">
                                        <?php if ($find_sale[0]->sale_pay <= $find_sale[0]->sale_total) : ?>
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Sistem Kasir - Input Barang Yang Dibeli</span></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <form action="" method="POST">
                                                                <div class="form-group">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <input type="text" class="form-control" disabled value="<?= $find_sale[0]->member_code . " - " . $find_sale[0]->member_name; ?>">
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <input type="text" class="form-control" disabled value="Diskon General Member <?= $find_sale[0]->member_discount; ?> %">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" disabled value="KODE TRANSAKSI : <?= $find_sale[0]->sale_code; ?>" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <select name="item_barang" required id="item" class="form-control <?= $validation->getError('item_barang') ? "is-invalid" : ""; ?>">
                                                                        <option value="">--Pilih Barang--</option>
                                                                        <?php foreach ($item as $i) : ?>
                                                                            <?php if ($i->item_stock <= 0) : ?>
                                                                                <option value="<?= $i->id; ?>"><?= $i->item_code; ?> - <?= $i->item_name; ?> - [ STOK HABIS ]</option>
                                                                            <?php else : ?>
                                                                                <option value="<?= $i->id; ?>"><?= $i->item_code; ?> - <?= $i->item_name; ?> - Sisa Stock <?= $i->item_stock; ?> Buah</option>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                    <div class="invalid-feedback">
                                                                        <?= $validation->getError("item_barang"); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group search-form">
                                                                    <input type="number" min="1" class="form-control <?= $validation->getError('item_quantity') ? "is-invalid" : ""; ?>" name="item_quantity" required placeholder="Jumlah Beli" value="<?= old('item_quantity') ? old('item_quantity') : ""; ?>">
                                                                    <div class="input-group-append">
                                                                        <span class="input-group-text bg-transparent">Buah</span>
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        <?= $validation->getError("item_quantity"); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="submit" name="submit_transaksi" value="submit" class="btn btn-primary mt-3 col-12"><i class="feather icon-save"></i> Tambah Transaksi</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Sistem Kasir - Rincian Transaksi</span></h5>
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
                                                                        <th>Banyak</th>
                                                                        <th>Harga</th>
                                                                        <th>Jumlah</th>
                                                                        <?php if ($find_sale[0]->sale_pay <= $find_sale[0]->sale_total) : ?>
                                                                            <?php $colspan = 3; ?>
                                                                            <?php $colspan_all = 3; ?>

                                                                            <th class="text-center"><i class="feather icon-settings"></i>
                                                                            </th>
                                                                        <?php else : ?>
                                                                            <?php $colspan_all = 2; ?>
                                                                            <?php $colspan = 3; ?>
                                                                        <?php endif; ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i = 1;
                                                                    $total_order = 0;
                                                                    foreach ($transaction as $d) :
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $i++; ?></td>
                                                                            <td><?= $d->item_code; ?></td>
                                                                            <td><?= $d->item_name; ?></td>
                                                                            <td><?= $d->detail_quantity; ?> Buah</td>
                                                                            <td>Rp. <?= format_rupiah($d->item_sale); ?></td>
                                                                            <td>Rp. <?= format_rupiah($d->detail_total); ?></td>
                                                                            <?php if ($find_sale[0]->sale_pay <= $find_sale[0]->sale_total) : ?>
                                                                                <td>
                                                                                    <!-- Delete -->
                                                                                    <form action="" method="POST">
                                                                                        <?= csrf_field(); ?>
                                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                                        <input type="hidden" name="id_item" value="<?= $d->id; ?>">
                                                                                        <button type="submit" name="delete_item" value="delete" class="btn btn-danger btn-icon btn-rounded" title="Hapus Barang" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                                    </form>
                                                                                </td>
                                                                            <?php endif; ?>
                                                                        </tr> <?php
                                                                                $total_order = $total_order + $d->detail_total;
                                                                            endforeach; ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <?php if (!empty($find_sale[0]->sale_handling)) : ?>
                                                                        <tr>
                                                                            <th colspan="<?= $colspan_all; ?>" rowspan="9"></th>
                                                                            <th>Sub Total I</th>
                                                                            <th colspan="<?= $colspan; ?>">Rp. <?= format_rupiah($total_order); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Diskon Member</th>
                                                                            <th colspan="<?= $colspan; ?>"> <?= $find_sale[0]->sale_discount; ?>%</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <?php
                                                                            $disk = ($total_order * $find_sale[0]->sale_discount) / 100;
                                                                            $sub_tot_2 = $total_order - $disk;
                                                                            ?>
                                                                            <th>Sub Total II</th>
                                                                            <th colspan="<?= $colspan; ?>">Rp. <?= format_rupiah($sub_tot_2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Handling & Final Connecting</th>
                                                                            <th colspan="<?= $colspan; ?>">
                                                                                Rp. <?= format_rupiah($find_sale[0]->sale_handling); ?>
                                                                            </th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Sub Total III</th>
                                                                            <th colspan="<?= $colspan; ?>">Rp. <?= format_rupiah($sub_tot_2 + $find_sale[0]->sale_handling); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>PPN</th>
                                                                            <th colspan="<?= $colspan; ?>"><?= $pph[0]->pph_value; ?> %</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Grand Total</th>
                                                                            <th colspan="<?= $colspan; ?>">Rp. <?= format_rupiah($find_sale[0]->sale_total); ?></th>
                                                                        </tr>
                                                                        <?php if ($find_sale[0]->sale_pay < $find_sale[0]->sale_total && !empty($transaction)) : ?>

                                                                            <tr>
                                                                                <th>Bayar</th>
                                                                                <th colspan="<?= $colspan; ?>">
                                                                                    <form action="" onkeyup="ajax_send()" method="post" id="form">
                                                                                        <?php csrf_field() ?>
                                                                                        <input type="hidden" name="cetak_ulang" value="cetak_ulang">
                                                                                        <input type="hidden" name="id_transaksi" value="<?= $find_sale[0]->id; ?>">
                                                                                        <input type="number" id="bayar" min="0" placeholder="Jumlah Dibayar Dalam Rupiah" name="bayar" class="form-control">
                                                                                    </form>
                                                                                </th>
                                                                            </tr>
                                                                        <?php else : ?>
                                                                            <th>Bayar</th>
                                                                            <th colspan="<?= $colspan; ?>">
                                                                                <p>Rp. <?= format_rupiah($find_sale[0]->sale_pay); ?></p>
                                                                            </th>
                                                                        <?php endif; ?>
                                                                        <tr>
                                                                            <th>Kembali</th>
                                                                            <th colspan="<?= $colspan; ?>">
                                                                                <h3 class="text-primary">Rp. <?= format_rupiah(($find_sale[0]->sale_pay - $find_sale[0]->sale_total < 0) ? 0 : $find_sale[0]->sale_pay - $find_sale[0]->sale_total); ?></h3>
                                                                            </th>
                                                                        </tr>
                                                                    <?php else : ?>
                                                                        <tr>
                                                                            <th colspan="<?= $colspan_all; ?>" rowspan="4"></th>
                                                                            <th>Sub Total I</th>
                                                                            <th colspan="<?= $colspan; ?>">Rp. <?= format_rupiah($total_order); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th>Diskon Member</th>
                                                                            <th colspan="<?= $colspan; ?>"> <?= $find_sale[0]->sale_discount; ?>%</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <?php
                                                                            $disk = ($total_order * $find_sale[0]->sale_discount) / 100;
                                                                            $sub_tot_2 = $total_order - $disk;
                                                                            ?>
                                                                            <th>Sub Total II</th>
                                                                            <th colspan="<?= $colspan; ?>">Rp. <?= format_rupiah($sub_tot_2); ?></th>
                                                                        </tr>
                                                                        <?php if ($find_sale[0]->sale_total > 0) : ?>
                                                                            <tr>
                                                                                <th>Handling & Final Connecting</th>
                                                                                <th colspan="<?= $colspan; ?>">
                                                                                    <form action="<?= base_url('transaction-general/report/add_handling'); ?>" method="POST" onkeyup="ajax_send_handling()" id="form_handling">
                                                                                        <?php csrf_field() ?>
                                                                                        <input type="hidden" name="handling" value="handling">
                                                                                        <input type="hidden" name="id_transaksi" value="<?= $find_sale[0]->id; ?>">
                                                                                        <input type="number" min="0" id="handling" value="0" placeholder=" Dalam Rupiah" name="handling_tot" class="form-control">
                                                                                    </form>
                                                                                </th>
                                                                            </tr>
                                                                        <?php else : ?>
                                                                            <tr>
                                                                                <th>Handling & Final Connecting</th>
                                                                                <th colspan="<?= $colspan; ?>">
                                                                                    Rp. <?= format_rupiah($find_sale[0]->sale_handling); ?>
                                                                                </th>
                                                                            </tr>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <?php if (empty($transaction) || $find_sale[0]->sale_pay < $find_sale[0]->sale_total) {
                                                            $disabled = "disabled";
                                                        } else {
                                                            $disabled = "";
                                                        } ?>
                                                        <div class="mt-4 row justify-content-center">
                                                            <div class="col-9">
                                                                <form action="" id="cetak-<?= $find_sale[0]->sale_code; ?>" target="_blank" method="post">
                                                                    <?php csrf_field() ?>
                                                                    <input type="hidden" name="_key" value="download">
                                                                    <input type="hidden" name="invoice" value="invoice">
                                                                    <button type="submit" <?= $disabled; ?> data-formid="<?= $find_sale[0]->sale_code; ?>" data-nama="<?= $find_sale[0]->sale_code; ?>" class="form-control cetak-button btn btn-primary"><i class="feather icon-printer"></i> Cetak Transaksi</button>
                                                                </form>
                                                            </div>
                                                            <div class="col-3">
                                                                <form action="" id="delete-<?= $find_sale[0]->sale_code; ?>" method="POST">
                                                                    <?php csrf_field() ?>

                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="batalkan_transaksi" value="batalkan">
                                                                    <button type="submit" data-formid="<?= $find_sale[0]->sale_code; ?>" data-nama="<?= $find_sale[0]->sale_code; ?>" class="form-control delete-button btn btn-danger"><i class="feather icon-trash-2"></i>Batalkan</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- [ Main Content ] end -->
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection(); ?>