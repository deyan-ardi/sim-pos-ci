<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }


        h1 {
            /* border-top: 1px solid #5D6975; */
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }

        #info #project {
            text-align: right;
        }

        #info {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        #info #company {
            text-align: left;
        }

        #project div,

        #output {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        #output tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        #output th,
        #output td {
            text-align: center;
        }

        #output th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        #output .service,
        #output .desc {
            text-align: left;
        }

        #output td {
            padding: 20px;
            text-align: right;
        }

        .card-success {
            background-color: #109a71;
            padding: 10px;
        }

        #output td.service,
        #output td.desc {
            vertical-align: top;
        }

        #output td.unit,
        #output td.qty,
        #output td.total {
            font-size: 1.2em;
        }

        #output td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: fixed;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <?php
        if ($sortir == 1) {
            $ket = "Keseluruhan";
        } else if ($sortir == 2) {
            $ket = "Tahun " . date('Y');
        } else if ($sortir == 3) {
            $ket = "Bulan " . date('F Y');
        } else if ($sortir == 4) {
            $ket = "Hari Ini,Tanggal " . date('d F Y');
        } else {
            $ket = "Tanggal " . date('d F Y', strtotime($tgl_dari)) . " - " . date('d F Y', strtotime($tgl_sampai));
        }
        ?>
        <h1>LAPORAN TRANSAKSI <?= strtoupper($ket); ?></h1>
        <table id="info">
            <tr>
                <td id="company">
                    <div>
                        <h5>PERUSAHAAN :</h5>
                        <div>PT Dapur Inspirasi Nusantara</div>
                        <div>Jl. Mertasari Jl. Suwung Batan Kendal No.68 F, Sidakarya, <br /> Denpasar Selatan, Kota Denpasar, Bali</div>
                        <div>(0361) 710984</div>
                        <div><a href="mailto:dintara.kitchen@gmail.com">dintara.kitchen@gmail.com</a></div>
                    </div>
                </td>
            </tr>
        </table>
    </header>
    <main>
        <table id="output">
            <thead>
                <tr>
                    <th class="service">#</th>
                    <th class="desc">KODE TRANSAKSI</th>
                    <th class="desc">KODE MEMBER</th>
                    <th class="desc">NAMA MEMBER</th>
                    <th>TOTAL TRANSAKSI</th>
                    <th>TOTAL KEUNTUNGAN</th>
                    <th>NAMA KASIR</th>
                    <th>STATUS TRANSAKSI</th>
                    <th>TANGGAL TRANSAKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $v = 1;
                $total_keuntungan = 0;
                $total_transaksi = 0;
                ?>
                <?php if (empty($detail)) : ?>
                    <tr>
                        <td colspan="9" style="text-align: center;">
                            <h4><em>Tidak Ada Transaksi Pada Tanggal Yang Disortir</em></h4>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($detail as $t) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $t->sale_code; ?></td>
                            <td><?= $t->member_code; ?></td>
                            <td><?= $t->member_name; ?></td>
                            <td>Rp. <?= format_rupiah($t->sale_total); ?></td>
                            <td>Rp. <?= format_rupiah($t->sale_profit); ?></td>
                            <td><?= $t->username; ?></td>
                            <?php if ($t->sale_status == 0) : ?>
                                <td>
                                    DRAFT
                                </td>
                            <?php else : ?>
                                <?php
                                $v++;
                                $total_keuntungan = $total_keuntungan + $t->sale_profit;
                                $total_transaksi = $total_transaksi + $t->sale_total;
                                ?>
                                <td>
                                    SUKSES
                                </td>
                            <?php endif; ?>
                            <td>
                                <?= CodeIgniter\I18n\Time::parse($t->updated_at)->toLocalizedString('d MMM yyyy, H:m');    ?> WITA
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <tr class="total">
                    <th colspan="5" rowspan="4"></th>
                    <th colspan="2">Jumlah Kegiatan Transaksi</th>
                    <th colspan="3"><?= $i - 1; ?> Transaksi
                    </th>
                </tr>
                <tr class="total">
                    <th colspan="2">Jumlah Transaksi Sukses</th>
                    <th colspan="3"><?= $v - 1; ?> Transaksi
                    </th>
                </tr>
                <tr class="total">
                    <th colspan="2">Total Transaksi Sukses</th>
                    <th colspan="3">Rp. <?= format_rupiah($total_transaksi); ?></th>
                </tr>
                <tr class="grand-total">
                    <th colspan="2">Total Keuntungan Transaksi Sukses</th>
                    <th colspan="3">Rp. <?= format_rupiah($total_keuntungan); ?></th>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTE:</div>
            <div class="notice">Status Transaksi yang bersifat "Draft" tidak akan dihitung oleh sistem</div>
        </div>
    </main>
    <footer>
        Laporan Transaksi ini sah dikeluarkan oleh PT Dapur Inspirasi Nusantara, <br> Dicetak Oleh <?= user()->username ?> Pada Tanggal <?= date("d F Y H:i:s") ?> WITA
    </footer>
</body>

</html>