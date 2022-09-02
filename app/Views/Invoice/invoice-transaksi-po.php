<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice PO - <?= $order[0]->order_code; ?></title>
    <style>
        @page {
            margin-top: 70px;
            margin-bottom: 70px;
            margin-left: 0;
            margin-right: 0;
        }

        .float-left {
            float: left !important
        }

        .w-50 {
            width: 50% !important
        }

        .text-left {
            text-align: left !important
        }

        .float-right {
            float: right !important
        }

        .text-right {
            text-align: right !important
        }

        body {
            font-family: "times-roman", sans-serif, "Arial";
            font-size: 16px;
        }

        main {
            margin: 10px 2cm;
        }

        h1 {
            font-size: 16px;
        }

        .w-100 {
            width: 100% !important
        }

        div.pagebreak {
            page-break-after: always;
        }

        header {
            position: fixed;
            top: -55px;
            left: 0px;
            right: 0px;
            height: 130px;
            text-align: center;
            margin: 0 2cm;
        }

        footer {
            position: fixed;
            bottom: -10px;
            left: 0px;
            right: 0px;
            width: 100%;
            height: auto;
            text-align: center;
        }

        .w-100 {
            width: 100%;
        }

        .text-success {
            color: #28a745 !important
        }

        a.text-success:focus,
        a.text-success:hover {
            color: #19692c !important
        }

        .text-center {
            text-align: center !important
        }

        .w-50 {
            width: 50%;
        }

        .text-light {
            color: #f8f9fa !important
        }

        a.text-light:focus,
        a.text-light:hover {
            color: #cbd3da !important
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529
        }
    </style>
</head>

<body>
    <header style="border-bottom:1px solid #DDD" style="padding-bottom:50px;">
        <!-- <img src="PT DAPUR INSPIRASI NUSANTARA" alt="PT DAPUR INSPIRASI NUSANTARA" width="180px"> -->
        <h2>PT DAPUR INSPIRASI NUSANTARA</h2>
        <h3>Dintara Kitchen Bali</h3>
        <p style="font-size:11px">Jl. Mertasari Jl. Suwung Batan Kendal No.68 F, Sidakarya, <br /> Denpasar Selatan, Kota Denpasar, Bali</p>
        <p style="font-size:11px">Telp.(0361) 710984 | Email: <a href="mailto:dintara.kitchen@gmail.com">dintara.kitchen@gmail.com</a> | Website: <a href="https://www.dintarakitchen.com/">https://www.dintarakitchen.com/</a></p>
        <p style="font-size:9px;padding-bottom:20px;">====================================================================================================================</p>
    </header>
    <footer>
        <p style="font-size:9px;padding-bottom:20px">===============================================================================================================</p>
        <p style="font-size:9px"><i>Invoice Sah Dicetak dan Dikeluarkan Oleh PT DAPUR INSPIRASI NUSANTARA</i></p>
        <p style="font-size:9px"><i>Silahkan Gunakan Invoice Ini Untuk Melakukan Proses PO</i></p>
        <p style="font-size:9px"><i>Tanggal Cetak : <?= date('d F Y H:i:s'); ?> WITA | <?= user()->username; ?></i></p>
    </footer>
    <main>
        <table class="w-100" style="padding-top:50px;margin-top:50px">
            <tr>
                <td class="w-50 text-left">
                    <h5 style="font-size:12px">Informasi Supplier</h5>
                    <table class="w-100" style="padding-top:20 ;">
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Nama Supplier</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= $supplier->supplier_name; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Kontrak Supplier</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= $supplier->supplier_contact ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Alamat Supplier</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= $supplier->supplier_address; ?></p>
                            </td>
                        </tr>

                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Deskripsi Supplier</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= $supplier->supplier_description; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="w-50 text-right">
                    <h5 style="font-size:12px">Informasi Transaksi</h5>
                    <table class="w-100" style="padding-top:20 ;">
                        <tr>
                            <td></td>
                            <?php if ($order[0]->order_status == 1) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Request Diterima</h4>
                                </td>
                            <?php elseif ($order[0]->order_status == 2) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Persetujuan</h4>
                                </td>
                            <?php elseif ($order[0]->order_status == 3) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Order Keluar</h4>
                                </td>
                            <?php elseif ($order[0]->order_status == 4) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Invoice Masuk</h4>
                                </td>
                            <?php elseif ($order[0]->order_status == 5) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Produksi</h4>
                                </td>
                            <?php elseif ($order[0]->order_status == 6) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Dikirim Supplier</h4>
                                </td>
                            <?php elseif ($order[0]->order_status == 7) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Diterima Gudang</h4>
                                </td>
                            <?php else : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#28a745">Selesai</h4>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <p style="font-size:12px"><?= "Kode." . $order[0]->order_code; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <p style="font-size:12px">Transaksi PO</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="padding-top: 50px ;">
            <table class="table table-sm table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <td style="background-color:#7460ee; width:25px; vertical-align:middle;text-align: center;">
                            <h5 style="color:#ffffff;font-size:12px">No.</h5>
                        </td>
                        <td style="background-color:#7460ee; vertical-align:middle;">
                            <h5 style="color:#ffffff;font-size:12px">Kode Barang</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Nama Barang</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Banyak</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Harga</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;" width="160px" class="text-right">
                            <h5 style="color:#ffffff;font-size:12px">Sub Total</h5>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i           = 1;
                    $total_item  = 0;
                    $total_order = 0;
                    $total_akhir = 0;
                    ?>
                    <?php if (empty($order_detail)) : ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">
                                <p style="font-size:12px">Tidak Ada Item Yang Dibeli</p>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($order_detail as $d) : ?>
                            <?php
                            $total_item++;
                            $total_order = $total_order + $d->detail_quantity;
                            ?>
                            <tr>
                                <td style="width:25px; vertical-align:middle;text-align: center;">
                                    <p style="font-size:11px"><?= $i++; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->item_code; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->item_name; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->detail_quantity; ?> Unit</p>
                                </td>
                                <td>
                                    <p style="font-size:11px">Rp. <?= format_rupiah($d->item_sale); ?></p>
                                </td>
                                <td class="text-right">
                                    <p style="font-size:11px">Rp. <?= format_rupiah($d->detail_quantity * $d->item_sale); ?></p>
                                </td>
                            </tr>
                        <?php
                            $total_akhir = $total_akhir + ($d->detail_quantity * $d->item_sale);
                        endforeach; ?>
                    <?php endif; ?>

                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">TOTAL BARANG</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= $total_item; ?> Jenis</p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">TOTAL ITEM DIPESAN</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= $total_order; ?> Unit</p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">TOTAL BIAYA PESANAN</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= format_rupiah($total_akhir) ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <table class="w-100" style="padding-top:50px">
            <tr>
                <td>
                    <h5 style="font-size:12px">Remark:</h5>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size:11px;text-align:justify"><?= $remark; ?></p>
                </td>
            </tr>
        </table>
        <div id="ttd" style="margin-top:45px">
            <table style="width: 100%;">
                <tr>
                    <td>
                        <p style="text-align: right;font-size:12px">Denpasar, <?= date('d F Y'); ?></p>
                    </td>
                </tr>
            </table>
            <table style="width: 100%; padding-top:20px">
                <tr>
                    <td>
                        <h5 style="font-size:12px"><?= !empty($ttd_kiri->header) ? $ttd_kiri->header : ''; ?></h5>
                    </td>
                    <td>
                        <h5 style="font-size:12px"><?= !empty($ttd_tengah_satu->header) ? $ttd_tengah_satu->header : ''; ?></h5>
                    </td>
                    <td>
                        <h5 style="font-size:12px"><?= !empty($ttd_tengah_dua->header) ? $ttd_tengah_dua->header : ''; ?></h5>
                    </td>
                    <td>
                        <h5 style="font-size:12px"><?= !empty($ttd_tengah_tiga->header) ? $ttd_tengah_tiga->header : ''; ?></h5>
                    </td>
                    <td>
                        <h5 style="font-size:12px"><?= !empty($ttd_tengah_empat->header) ? $ttd_tengah_empat->header : ''; ?></h5>
                    </td>
                    <td>
                        <h5 style="font-size:12px"><?= !empty($ttd_kanan->header) ? $ttd_kanan->header : ''; ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style=" padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_kiri->value) ? $ttd_kiri->value : '____________________'; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_kiri->position) ? '(' . $ttd_kiri->position . ')' : 'Admin Purchasing' ?></p>
                    </td>

                    <td style="padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_tengah_satu->value) ? $ttd_tengah_satu->value : '____________________'; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_tengah_satu->position) ? '(' . $ttd_tengah_satu->position . ')' : 'Head Purchasing'; ?></p>
                    </td>
                    <td style="padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_tengah_dua->value) ? $ttd_tengah_dua->value : '____________________'; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_tengah_dua->position) ? '(' . $ttd_tengah_dua->position . ')' : 'Procurement'; ?></p>
                    </td>
                    <td style=" padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_tengah_tiga->value) ? $ttd_tengah_tiga->value : '____________________'; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_tengah_tiga->position) ? '(' . $ttd_tengah_tiga->position . ')' : 'Finance Manager'; ?></p>
                    </td>
                    <td style="padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_tengah_empat->value) ? $ttd_tengah_empat->value : '____________________'; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_tengah_empat->position) ? '(' . $ttd_tengah_empat->position . ')' : 'General Manager'; ?></p>
                    </td>
                    <td style=" padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_kanan->value) ? $ttd_kanan->value : '____________________'; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_kanan->position) ? '(' . $ttd_kanan->position . ')' : 'Directur'; ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>