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
                        <?php if (! empty($awal) && ! empty($akhir)) : ?>
                            <div>Data dari <?= $awal; ?> sampai <?= $akhir; ?></div>
                        <?php else : ?>
                            <div>Keseluruhan Data</div>
                        <?php endif; ?>
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
                    <th class="desc">KODE BARANG</th>
                    <th class="desc">NAMA BARANG</th>
                    <th class="desc">KODE TRANSAKSI</th>
                    <th>TOTAL TRANSAKSI</th>
                    <th>KATEGORI BARANG</th>
                    <th>STATUS TRANSAKSI</th>
                    <th>NAMA KASIR</th>
                    <th>TANGGAL MASUK</th>
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
                        <td colspan="9" style="text-align: center;">
                            <h4><em>Tidak Ada Transaksi Barang Keluar</em></h4>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($barang as $c) : ?>
                        <?php
                        $total_item++;
                        $total_order = $total_order + $c->detail_quantity;
                        ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $c->item_code; ?></td>
                            <td><?= $c->item_name; ?></td>
                            <td><?= $c->sale_code; ?></td>
                            <td><?= $c->detail_quantity; ?> Unit</td>
                            <td><?= $c->category_name; ?></td>
                            <td><button class="btn btn-success">Sukses</button></td>
                            <td><?= $c->username; ?></td>
                            <td>
                                <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                <tr class="total">
                    <th colspan="5">Total Item Dibeli</th>
                    <th colspan="4"><?= $total_item; ?> Item</th>
                </tr>
                <tr class="grand-total">
                    <th colspan="5">Total Jumlah Keluar</th>
                    <th colspan="4"><?= $total_order; ?> Unit</th>
                </tr>
            </tbody>
        </table>
    </main>
    <footer>
        Laporan Transaksi ini sah dikeluarkan oleh PT Dapur Inspirasi Nusantara, <br> Dicetak Oleh <?= user()->username ?> Pada Tanggal <?= date('d F Y H:i:s') ?> WITA
    </footer>
</body>

</html>