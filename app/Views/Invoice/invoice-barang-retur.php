<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lapoan Transaksi Barang Retur</title>
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
        <p style="font-size:9px"><i>Laporan Transaksi Barang Retur Ini Sah Dicetak dan Dikeluarkan Oleh PT DAPUR INSPIRASI NUSANTARA</i></p>
        <p style="font-size:9px"><i>Tanggal Cetak : <?= date('d F Y H:i:s') ?> WITA | <?= user()->username ?></i></p>
    </footer>
    <main>
        <table class="w-100" style="padding-top:50px;margin-top:50px">
            <tr>
                <td class="w-50 text-left">
                    <h5 style="font-size:12px">Informasi Laporan</h5>
                    <table class="w-100" style="padding-top:20 ;">
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Kode Cetak</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= date('Hi') . "/BARANG-RETUR/" . date('Ymd') ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Filter Data</p>
                            </td>
                            <?php if (!empty($awal) && !empty($akhir)) : ?>
                                <td>
                                    <p style="font-size:12px">: Dari<?= $awal; ?> s/d <?= $akhir; ?></p>
                                </td>
                            <?php else : ?>
                                <td>
                                    <p style="font-size:12px">: Keseluruhan Data</p>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Status</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: Laporan Barang Retur</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div style="padding-top: 30px;">
            <table class="table table-sm table-striped" style="width: 100%;">
                <thead>
                    <tr>
                        <td style="background-color:#7460ee; width:25px; vertical-align:middle;text-align: center;">
                            <h5 style="color:#ffffff;font-size:12px">No.</h5>
                        </td>
                        <td style="background-color:#7460ee; vertical-align:middle;">
                            <h5 style="color:#ffffff;font-size:12px">Kode Barang</h5>
                        </td>
                        <td style="background-color:#7460ee; vertical-align:middle;">
                            <h5 style="color:#ffffff;font-size:12px">Nama Barang</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Kode Order</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Total Order</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Barang Diretur</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Kategori Barang</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Nama Supplier</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Status Order</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;" width="160px" class="text-right">
                            <h5 style="color:#ffffff;font-size:12px">Dipesan Oleh</h5>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i           = 1;
                    $total_item  = 0;
                    $total_order = 0;
                    ?>
                    <?php if (empty($barang)) : ?>
                        <tr>
                            <td colspan="10" style="text-align: center;">
                                <p style="font-size:12px">Tidak Ada Barang Retur</p>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($barang as $d) : ?>
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
                                    <p style="font-size:11px"><?= $d->order_code; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->detail_quantity; ?> Unit</p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->retur_total; ?> Unit</p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->category_name; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->supplier_name; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px;color:#28a745">Selesai</p>
                                </td>
                                <td class="text-right">
                                    <p style="font-size:11px;"><?= $d->username; ?></p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="7">
                            <p style="font-size:11px">TOTAL ITEM DIPESAN</p>
                        </td>
                        <td class="text-right" colspan="3">
                            <p style="font-size:11px"><?= $total_item; ?> Item</p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="7">
                            <p style="font-size:11px">TOTAL JUMLAH ORDER</p>
                        </td>
                        <td class="text-right" colspan="3">
                            <p style="font-size:11px"><?= $total_order; ?> Unit</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>