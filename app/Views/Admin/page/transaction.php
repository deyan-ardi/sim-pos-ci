<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Transaksi Barang - Menu Kasir Project
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
    const ajax_send = () => {
        // console.log(event.key == "Enter");
        if (event.key == "Enter") {
            var url = "<?= base_url() . '/transaction/cashier/validation_payment' ?>"
            $.ajax({
                url: url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data) {
                    if (data.status == true) {
                        swal({
                                title: "Query Berhasil!",
                                text: data.message,
                                icon: "success",
                            })
                            .then(() => {
                                location.reload(); // for reload a page
                            });
                    } else if (data.status == 'kurang') {
                        swal({
                                title: "Pembayaran Kurang!",
                                text: "Pembayaran Ini Dilanjutkan Sebagai Pembayaran DP",
                                icon: "info",
                            })
                            .then(() => {
                                location.reload(); // for reload a page
                            });
                    } else {
                        swal({
                                title: "Terjadi Kesalahan!",
                                text: data.message,
                                icon: "error",
                            })
                            .then(() => {
                                location.reload(); // for reload a page
                            });
                    }
                    //if success close modal and reload ajax table
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error adding / update data');
                }
            });
        }
        // console.log($('#form').serialize());
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? rupiah : "";
    }

    const bayar = document.getElementById("bayar");
    if (bayar != null) {
        bayar.addEventListener("keyup", function(e) {
            bayar.value = formatRupiah(this.value, "");
        });
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
<script>
    $(document).ready(function() {
        $('#member_id').selectize({
            sortField: 'text'
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Sistem Kasir Project Transaksi Project</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Menu Kasir Project</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <?php if (empty($find_sale)) : ?>
                            <!-- [ Main Content ] start -->
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Sistem Kasir Project - Pilih Penawaran</span></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body">
                                                <form action="" method="POST">
                                                    <?php csrf_field() ?>

                                                    <div class="form-group">
                                                        <select name="penawaran_id" id="penawaran_id" required class="form-control <?= $validation->getError('penawaran_id') ? 'is-invalid' : ''; ?>">
                                                            <option value="">--Pilih Penawaran Dari Marketing--</option>
                                                            <?php foreach ($penawaran as $m) : ?>
                                                                <option value="<?= $m->id; ?>">Penawaran <?= $m->penawaran_code; ?> - Untuk Klien <?= $m->member_name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError('penawaran_id'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="submit_penawaran" value="submit" class="btn btn-primary mt-3 col-12"><i class="feather icon-save"></i> Pilih Penawaran</button>
                                                    </div>
                                                </form>

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
                                                        <h5>Sistem Kasir Project - Input Barang Project</span></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="card-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-6">
                                                                        <input type="text" class="form-control" disabled value="<?= $find_sale[0]->member_code . ' - ' . $find_sale[0]->member_name; ?>">
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input type="text" class="form-control" disabled value="Diskon <?= $find_sale[0]->member_discount; ?> %">
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <input type="text" class="form-control" disabled value="<?= $count_user; ?> Kali Transaksi">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" disabled value="KODE TRANSAKSI : <?= $find_sale[0]->sale_code; ?>" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" disabled value="KODE PENAWARAN : <?= $find_sale[0]->sale_penawaran_code; ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Sistem Kasir Project - Rincian Barang Project</span></h5>
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
                                                                        <th>Jumlah Pesan</th>
                                                                        <th>Jumlah Stok</th>
                                                                        <th>Harga Satuan</th>
                                                                        <th>Besar Diskon</th>
                                                                        <th>Jumlah Sebelum Diskon</th>
                                                                        <th>Jumlah Akhir</th>
                                                                        <th>Status Barang</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i           = 1;
                                                                    $total_order = 0;
                                                                    $status = 0;
                                                                    foreach ($transaction as $d) :
                                                                    ?>
                                                                        <tr>
                                                                            <td><?= $i++; ?></td>
                                                                            <td><?= $d->item_code; ?></td>
                                                                            <td><?= $d->item_name; ?></td>
                                                                            <td><?= $d->detail_quantity; ?> Unit</td>
                                                                            <td><?= $d->item_stock; ?> Unit</td>
                                                                            <td>Rp. <?= format_rupiah($d->item_sale); ?></td>
                                                                            <td>Rp. <?= format_rupiah($d->detail_value_discount); ?> (<?= $d->detail_percen_discount ?>%)</td>
                                                                            <td>Rp. <?= format_rupiah($d->detail_before_discount); ?></td>
                                                                            <td>Rp. <?= format_rupiah($d->detail_total); ?></td>
                                                                            <?php if ($d->item_stock - $d->detail_quantity < 0) : ?>
                                                                                <?php $status--; ?>
                                                                                <td><button type="button" class="btn btn-danger btn-sm"> Invalid</button></td>
                                                                            <?php else : ?>
                                                                                <?php $status++; ?>
                                                                                <td><button type="button" class="btn btn-success btn-sm"> Tersedia</button></td>
                                                                            <?php endif; ?>
                                                                        </tr>
                                                                    <?php
                                                                        $total_order = $total_order + $d->detail_total;
                                                                    endforeach; ?>
                                                                </tbody>
                                                                <tfoot>

                                                                    <tr>
                                                                        <th colspan="7" rowspan="10"></th>
                                                                        <th>Sub Total I</th>
                                                                        <th colspan="7">Rp. <?= format_rupiah($total_order); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Diskon Member</th>
                                                                        <th colspan="7"> <?= $find_sale[0]->sale_discount; ?>%</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php
                                                                        $disk      = ($total_order * $find_sale[0]->sale_discount) / 100;
                                                                        $sub_tot_2 = $total_order - $disk;
                                                                        ?>
                                                                        <th>Sub Total II</th>
                                                                        <th colspan="7">Rp. <?= format_rupiah($sub_tot_2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Handling & Final Connecting (Optional)</th>
                                                                        <th colspan="7">
                                                                            Rp. <?= format_rupiah($find_sale[0]->sale_handling); ?>
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Sub Total III</th>
                                                                        <th colspan="7">Rp. <?= format_rupiah($sub_tot_2 + $find_sale[0]->sale_handling); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>PPN</th>
                                                                        <th colspan="7"><?= $pph[0]->pph_value; ?> %</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Grand Total</th>
                                                                        <th colspan="7">Rp. <?= format_rupiah($find_sale[0]->sale_total); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Perlu Membayar</th>
                                                                        <th colspan="7">Rp. <?= format_rupiah($find_sale[0]->sale_kurang); ?></th>
                                                                    </tr>
                                                                    <?php if ($find_sale[0]->sale_pay < $find_sale[0]->sale_total  && $status == count($transaction)) : ?>
                                                                        <tr>
                                                                            <th>Bayar</th>
                                                                            <th colspan="7">
                                                                                <form action="" onkeyup="ajax_send()" method="post" id="form">
                                                                                    <?php csrf_field() ?>
                                                                                    <input type="hidden" name="cetak_ulang" value="cetak_ulang">
                                                                                    <input type="hidden" name="id_transaksi" value="<?= $find_sale[0]->id; ?>">
                                                                                    <input type="text" id="bayar" min="0" placeholder="Jumlah Dibayar Dalam Rupiah" name="bayar" class="form-control">
                                                                                </form>
                                                                            </th>
                                                                        </tr>
                                                                    <?php else : ?>
                                                                        <tr>
                                                                            <?php if ($status != count($transaction)) : ?>
                                                                                <th>Bayar</th>
                                                                                <th colspan="7">
                                                                                    <p>Proses Pembayaran Tidak Dapat Dilakukan</p>
                                                                                </th>
                                                                            <?php else : ?>
                                                                                <th>Bayar</th>
                                                                                <th colspan="7">
                                                                                    <p>Rp. <?= format_rupiah($find_sale[0]->sale_pay); ?></p>
                                                                                </th>
                                                                            <?php endif; ?>
                                                                        </tr>
                                                                    <?php endif; ?>
                                                                    <tr>
                                                                        <th>Kembali</th>
                                                                        <th colspan="7">
                                                                            <h3 class="text-primary">Rp. <?= format_rupiah(($find_sale[0]->sale_pay - $find_sale[0]->sale_total < 0) ? 0 : $find_sale[0]->sale_pay - $find_sale[0]->sale_total); ?></h3>
                                                                        </th>
                                                                    </tr>

                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                        <?php if (empty($transaction) || $find_sale[0]->sale_pay == 0 || $status != count($transaction)) {
                                                            $disabled = 'disabled';
                                                        } else {
                                                            $disabled = '';
                                                        } ?>
                                                        <div class="mt-4 row justify-content-center">
                                                            <div class="col-9">
                                                                <form action="" id="cetak-<?= $find_sale[0]->id; ?>" target="_blank" rel="noopener noreferrer" method="post">
                                                                    <?php csrf_field() ?>
                                                                    <input type="hidden" name="_key" value="download">
                                                                    <input type="hidden" name="invoice" value="invoice">
                                                                    <button type="submit" <?= $disabled; ?> data-formid="<?= $find_sale[0]->id; ?>" data-nama="<?= $find_sale[0]->sale_code; ?>" class="form-control cetak-button btn btn-primary"><i class="feather icon-printer"></i> Cetak Transaksi</button>
                                                                </form>
                                                            </div>
                                                            <div class="col-3">
                                                                <form action="" id="delete-<?= $find_sale[0]->id; ?>" method="POST">
                                                                    <?php csrf_field() ?>

                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <input type="hidden" name="batalkan_transaksi" value="batalkan">
                                                                    <button type="submit" data-formid="<?= $find_sale[0]->id; ?>" data-nama="<?= $find_sale[0]->sale_code; ?>" class="form-control delete-button btn btn-danger"><i class="feather icon-trash-2"></i>Batalkan</button>
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