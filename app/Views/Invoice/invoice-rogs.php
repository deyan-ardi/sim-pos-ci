<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice ROGS - <?= $order[0]->order_code; ?></title>
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
        <p style="font-size:9px"><i>Invoice ROGS Dicetak dan Dikeluarkan Oleh PT DAPUR INSPIRASI NUSANTARA</i></p>
        <p style="font-size:9px"><i>Tanggal Cetak : <?= date('d F Y H:i:s'); ?> WITA | <?= user()->username; ?></i></p>
    </footer>
    <main>
        <table class="w-100" style="padding-top:50px;margin-top:50px">
            <tr>
                <td class="w-50 text-left">
                    <h5 style="font-size:12px">Informasi Umum</h5>
                    <table class="w-100" style="padding-top:20 ;">
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Terima Dari</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= $supplier->supplier_name; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Alamat</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= $supplier->supplier_address ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Tanggal</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= date('d F Y'); ?></p>
                            </td>
                        </tr>
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
                                <p style="font-size:12px">Kode ROGS</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: </p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Kode PO</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: PO.<?= $order[0]->order_code; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Status</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <input type="checkbox" name="status">Complete <input type="checkbox" name="status">Partial</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <h5 style="font-size:12px;margin-top:20px;">Informasi Detail ROGS</h5>
        <table style="width: 100%;border:1px solid black;">
            <tr>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Internal</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Lokal Bali</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Luar Pulau</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Import</p>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top:20px; border:1px solid black;">

            <tr>
                <td width="120px">
                    <p style="font-size:12px">Delivered By(Carrier/Courier/Forwarder Name)</p>
                </td>
                <td>
                    <p style="font-size:12px">: </p>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top:20px; border:1px solid black;">
            <tr>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Sea Freight</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Air Freight</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Courier</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Expedition</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Truck</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Intern Staff</p>
                </td>
            </tr>
        </table>
        <table style="width: 100%; margin-top:20px;padding-top: 20px;padding-bottom:20px; border:1px solid black;">
            <tr>
                <td width="120px">
                    <p style="font-size:12px">TTD Pengantar Barang:</p>
                </td>
                <td width="120px">
                    <p style="font-size:12px">Pukul/Jam:</p>
                </td>
            </tr>
        </table>
        <table style="width: 100%;margin-top:20px; border:1px solid black;">
            <tr>
                <td width="120px">
                    <p style="font-size:12px">Freight & Delivery Charge By:</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Prepaid (dibayar oleh pengirim)</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Collect (dibayar oleh SE)</p>
                </td>
                <td>
                    <p style="font-size:12px"><input type="checkbox" name="status">Lunas</p>
                </td>
            </tr>
        </table>
        <h5 style="font-size:12px;margin-top:20px;">List Item</h5>

        <table class="table table-sm table-striped" style="width:100%;">
            <thead>
                <tr>
                    <td style="background-color:#7460ee;vertical-align:middle;text-align: center;">
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
                        <h5 style="color:#ffffff;font-size:12px">Kondisi</h5>
                    </td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i     = 1;
                ?>
                <?php if (empty($order_detail)) : ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">
                            <p style="font-size:12px">Tidak Ada Item Yang Dipesan</p>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($order_detail as $d) : ?>
                        <tr>
                            <td style=" vertical-align:middle;text-align: center;">
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
                                <p style="font-size:11px"><input type="checkbox" name="status">Good <input type="checkbox" name="status">Acceptable <input type="checkbox" name="status">Unacceptable</p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <table class="w-100" style="padding-top:20px">
            <tr>
                <td>
                    <h5 style="font-size:12px">Remark/Note</h5>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size:11px"><input type="checkbox" name="status"> Barang dengan kondisi <b>Good</b> dan <b>Acceptable</b> telah saya terima dan telah catat dalam buku dan kartu stock</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size:11px"><input type="checkbox" name="status"> Barang dengan kondisi <b>Unacceptable</b> telah saya kembalikan pada tanggal ........................ dengan tembusan ke Purchasing agar dikomunikasikan dan dimintakan penggantinya</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p style="font-size:11px"><input type="checkbox" name="status"> ...................................................................................................................................</p>
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
                        <h5 style="font-size:12px"><?= !empty($ttd_kanan->header) ? $ttd_kanan->header : ''; ?></h5>
                    </td>
                </tr>
                <tr>
                    <td style=" padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_kiri->value) ? $ttd_kiri->value : ''; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_kiri->position) ? '(' . $ttd_kiri->position . ')' : '' ?></p>
                    </td>
                    <td style="padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_tengah_satu->value) ? $ttd_tengah_satu->value : ''; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_tengah_satu->position) ? '(' . $ttd_tengah_satu->position . ')' : ''; ?></p>
                    </td>
                    <td style="padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_tengah_dua->value) ? $ttd_tengah_dua->value : ''; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_tengah_dua->position) ? '(' . $ttd_tengah_dua->position . ')' : ''; ?></p>
                    </td>
                    <td style=" padding-top: 4em;">
                        <h5 style="font-size:12px"><u><?= !empty($ttd_kanan->value) ? $ttd_kanan->value : ''; ?></u></h5>
                        <p style="font-size:11px"><?= !empty($ttd_kanan->position) ? '(' . $ttd_kanan->position . ')' : ''; ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </main>
</body>

</html>