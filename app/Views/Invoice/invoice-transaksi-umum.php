<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Transaksi Umum</title>
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
        <p style="font-size:9px"><i>Silahkan Simpan Bukti Invoice Ini Sebagai Syarat Mendapatkan Garansi </i></p>
        <p style="font-size:9px"><i>Tanggal Cetak : <?= date('d F Y H:i:s'); ?> WITA | <?= user()->username; ?></i></p>
    </footer>
    <main>
        <table class="w-100" style="padding-top:50px;margin-top:50px">
            <tr>
                <td class="w-50 text-left">
                    <h5 style="font-size:12px">Informasi Klien</h5>
                    <?php
                    if ($sortir == 1) {
                        $ket = 'Keseluruhan';
                    } elseif ($sortir == 2) {
                        $ket = 'Tahun ' . date('Y');
                    } elseif ($sortir == 3) {
                        $ket = 'Bulan ' . date('F Y');
                    } elseif ($sortir == 4) {
                        $ket = 'Hari Ini,Tanggal ' . date('d F Y');
                    } else {
                        $ket = 'Tanggal ' . date('d F Y', strtotime($tgl_dari)) . ' - ' . date('d F Y', strtotime($tgl_sampai));
                    }
                    ?>
                    <table class="w-100" style="padding-top:20 ;">
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Tanggal Cetak</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= date('d F Y') ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Filter Data</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: <?= $ket; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="120px">
                                <p style="font-size:12px">Status</p>
                            </td>
                            <td>
                                <p style="font-size:12px">: Laporan Transaksi Keseluruhan</p>
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
                            <h5 style="color:#ffffff;font-size:12px">Kode Transaksi</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Kode Member</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Nama Member</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Total Transaksi</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Total Keuntungan</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Nama Kasir</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;">
                            <h5 style="color:#ffffff;font-size:12px">Status Transaksi</h5>
                        </td>
                        <td style="background-color:#7460ee;vertical-align: middle;" width="160px" class="text-right">
                            <h5 style="color:#ffffff;font-size:12px">Tanggal Transaksi</h5>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i                = 1;
                    $v                = 1;
                    $f = 0;
                    $total_keuntungan = 0;
                    $total_transaksi  = 0;
                    ?>
                    <?php if (empty($detail)) : ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">
                                <p style="font-size:12px">Tidak Ada Transaksi</p>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($detail as $d) : ?>
                            <tr>
                                <td style="width:25px; vertical-align:middle;text-align: center;">
                                    <p style="font-size:11px"><?= $i++; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->sale_code; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->member_code; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->member_name; ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px">Rp. <?= format_rupiah($d->sale_total); ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px">Rp. <?= format_rupiah($d->sale_profit); ?></p>
                                </td>
                                <td>
                                    <p style="font-size:11px"><?= $d->username; ?></p>
                                </td>
                                <?php if ($d->sale_status == 0) : ?>
                                    <td>
                                        <p style="font-size:11px">DRAFT</p>
                                    </td>
                                <?php elseif ($d->sale_status == 1) : ?>
                                    <td>
                                        <?php
                                        $f++;
                                        $total_keuntungan = $total_keuntungan + 0;
                                        $total_transaksi  = $total_transaksi + $d->sale_pay;
                                        ?>
                                        <p style="font-size:11px">DP PEMBAYARAN</p>
                                    </td>
                                <?php else : ?>
                                    <td>
                                        <?php
                                        $v++;
                                        $total_keuntungan = $total_keuntungan + $d->sale_profit;
                                        $total_transaksi  = $total_transaksi + $d->sale_total;
                                        ?>
                                        <p style="font-size:11px">SUKSES</p>
                                    </td>
                                <?php endif; ?>
                                <td style="text-align: right ;">
                                    <p style="font-size:11px"><?= CodeIgniter\I18n\Time::parse($d->updated_at)->toLocalizedString('d MMM yyyy, H:m'); ?> WITA </p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">JUMLAH TRANSAKSI</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= $i - 1; ?> Transaksi</p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">JUMLAH TRANSAKSI SUKSES</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= $v - 1; ?> Transaksi</p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">TOTAL KEUNTUNGAN TRANSAKSI SUKSES</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px">Rp. <?= format_rupiah($total_keuntungan); ?></p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">JUMLAH TRANSAKSI DP PEMBAYARAN</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px"><?= $f - 1; ?> Transaksi</p>
                        </td>
                    </tr>
                    <tr style="background-color:whitesmoke">
                        <td class="text-right" colspan="5">
                            <p style="font-size:11px">TOTAL UANG MASUK TRANSAKSI</p>
                        </td>
                        <td class="text-right">
                            <p style="font-size:11px">Rp. <?= format_rupiah($total_transaksi); ?></p>
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
                    <p style="font-size:11px;text-align:justify"><?= empty($note) ? "Tidak Ada Remark" : $note->value; ?></p>
                </td>
            </tr>
        </table>
    </main>
</body>

</html>