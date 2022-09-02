<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Order Barang - <?= $order->order_code; ?></title>
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
        <p style="font-size:9px"><i>Invoice Order Sah Dicetak dan Dikeluarkan Oleh PT DAPUR INSPIRASI NUSANTARA</i></p>
        <p style="font-size:9px"><i>Setelah mencetak invoice ini, silahkan lakukan pengorderan barang kepada supplier yang dituju</i></p>
        <p style="font-size:9px"><i>Tanggal Cetak : <?= date('d F Y H:i:s'); ?> WITA | <?= user()->username; ?></i></p>
    </footer>
    <main>
        <table class="w-100" style="padding-top:50px;margin-top:50px">
            <tr>
                <td class="w-50 text-left">
                    <h5 style="font-size:12px">Informasi Order</h5>
                    <table class="w-100" style="padding-top:20 ;">
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Dicetak Oleh</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= user()->username; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Tanggal Cetak</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= date('d F Y'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Kode PO</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: PO.<?= $order->order_code; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Status</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: Invoice Order Barang</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="w-50 text-right">
                    <h5 style="font-size:12px">Informasi Supplier</h5>
                    <table class="w-100" style="padding-top:20 ;">
                        <tr>
                            <td></td>
                            <?php if ($order->order_status == 1) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Request Diterima</h4>
                                </td>
                            <?php elseif ($order->order_status == 2) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Persetujuan</h4>
                                </td>
                            <?php elseif ($order->order_status == 3) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Order Keluar</h4>
                                </td>
                            <?php elseif ($order->order_status == 4) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Invoice Masuk</h4>
                                </td>
                            <?php elseif ($order->order_status == 5) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Produksi</h4>
                                </td>
                            <?php elseif ($order->order_status == 6) : ?>
                                <td width="120px" class="text-right">
                                    <h4 style="font-size:14px;padding:3px;color:#3B9AE1">Dikirim Supplier</h4>
                                </td>
                            <?php elseif ($order->order_status == 7) : ?>
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
                                <p style="font-size:12px"><?= $supplier->supplier_name; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <p style="font-size:12px">0<?= $supplier->supplier_contact; ?></p>
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
                        <td style="background-color:#7460ee;vertical-align: middle;" width="160px" class="text-right">
                            <h5 style="color:#ffffff;font-size:12px">Jumlah Order</h5>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i     = 1;
                    $total = 0;
                    ?>
                    <?php if (empty($detail)) : ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">
                                <p style="font-size:12px">Tidak Ada Item Yang Dipesan</p>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($detail as $d) : ?>
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
                                <td class="text-right">
                                    <p style="font-size:11px"><?= $d->detail_quantity ?> Unit</p>
                                </td>
                            </tr>
                        <?php
                            $total = $total + $d->detail_quantity;
                        endforeach; ?>
                    <?php endif; ?>

                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="3">
                            <p style="font-size:11px">TOTAL BARANG</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= $i - 1; ?> Jenis</p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="3">
                            <p style="font-size:11px">TOTAL ITEM DIPESAN</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= $total; ?> Unit</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>