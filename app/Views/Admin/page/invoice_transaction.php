<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Invoice Transaksi <?= $sale[0]->sale_code; ?></title>
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
        <h1>KODE TRANSAKSI <?= $sale[0]->sale_code; ?></h1>
        <table id="info">
            <tr>
                <td id="company">
                    <div>
                        <h5>PERUSAHAAN :</h5>
                        <div>PT Dapur Inspirasi Nusantara</div>
                        <div>Jl. Mertasari Jl. Suwung Batan Kendal No.68 F, Sidakarya, <br /> Denpasar Selatan, Kota Denpasar, Bali</div>
                        <div>(0361) 710984</div>
                        <div><a href="mailto:dintara.kitchen@gmail.com">dintara.kitchen@gmail.com</a></div>
                        <div>Jenis Transaksi : Transaksi <?= $sale[0]->sale_ket; ?></div>
                    </div>
                </td>
                <td id="project">
                    <div>
                        <h5>CUSTOMER :</h5>
                        <div>Kode Member : <?= $member->member_code; ?></div>
                        <div><?= date("d F Y H:i:s", strtotime($sale[0]->updated_at)); ?> WITA</div>
                        <div><?= $member->member_name; ?></div>
                        <?php if ($sale[0]->sale_ket == "project") : ?>
                            <div><?= $member->member_company; ?></div>
                            <div><?= $member->member_job; ?></div>
                            <div>0<?= $member->member_contact; ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="card-success" style="color:white;">
                        <h4>SUKSES</h4>
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
                    <th>BANYAK</th>
                    <th>HARGA</th>
                    <th>JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $total = 0;
                ?>
                <?php if (empty($detail)) : ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">
                            <h4><em>Tidak Ada Item Yang Dibeli</em></h4>
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($detail as $d) : ?>
                        <tr>
                            <td class="service"><?= $i++; ?></td>
                            <td class="service"><?= $d->item_code; ?></td>
                            <td class="desc"><?= $d->item_name; ?></td>
                            <td class="qty"><?= $d->detail_quantity; ?> Buah</td>
                            <td class="qty">Rp. <?= format_rupiah($d->item_sale); ?></td>
                            <td class="qty">Rp. <?= format_rupiah($d->detail_total); ?></td>
                        </tr>

                    <?php
                        $total = $total + $d->detail_total;
                    endforeach; ?>
                <?php endif; ?>
                <tr>
                    <td colspan="5">SUB TOTAL I</td>
                    <td class="total">Rp. <?= format_rupiah($total); ?></td>
                </tr>
                <tr>
                    <td colspan="5">DISKON MEMBER</td>
                    <td class="total"><?= $member->member_discount; ?> %</td>
                </tr>
                <tr>
                    <?php
                    $disk = ($total * $sale[0]->sale_discount) / 100;
                    $sub_tot_2 = $total - $disk;
                    ?>
                    <td colspan="5">SUB TOTAL II</td>
                    <td class="total">Rp. <?= format_rupiah($sub_tot_2); ?></td>
                </tr>
                <tr>
                    <td colspan="5">Handling & Final Connecting</td>
                    <td class="total">Rp. <?= format_rupiah($sale[0]->sale_handling); ?></td>
                </tr>
                <tr>
                    <td colspan="5">SUB TOTAL III</td>
                    <td class="total">Rp. <?= format_rupiah($sub_tot_2 + $sale[0]->sale_handling); ?></td>
                </tr>
                <tr>
                    <td colspan="5">PPh</td>
                    <td class="total"><?= $pph[0]->pph_value; ?> %</td>
                </tr>
                <tr>
                    <td colspan="5">GRAND TOTAL</td>
                    <td class="grand total">Rp. <?= format_rupiah($sale[0]->sale_total); ?></td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTE:</div>
            <?php if (!empty($note->value)) : ?>
                <div class="notice"><?= $note->value; ?></div>
            <?php else : ?>
                <div class="notice">Silahkan simpan bukti transaksi ini sebagai syarat untuk mendapatkan garansi</div>
            <?php endif; ?>
        </div>
        <div id="ttd" style="margin-top:45px">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: left;">
                        <h4><?= !empty($ttd_kiri->header) ? $ttd_kiri->header : ""; ?></h4>
                    </td>
                    <td style="text-align: center;">
                        <h4><?= !empty($ttd_tengah->header) ? $ttd_tengah->header : ""; ?></h4>
                    </td>
                    <td style="text-align: right;">
                        <h4><?= !empty($ttd_kanan->header) ? $ttd_kanan->header : ""; ?></h4>
                    </td>
                </tr>
                <tr>
                    <td style=" text-align: left;padding-top: 4em;">
                        <h4><u><?= !empty($ttd_kiri->value) ? $ttd_kiri->value : ""; ?></u></h4>
                        <h5><?= !empty($ttd_kiri->position) ? "(" . $ttd_kiri->position . ")" : ""; ?></h5>
                    </td>

                    <td style="text-align: center;padding-top: 4em;">
                        <h4><u><?= !empty($ttd_tengah->value) ? $ttd_tengah->value : ""; ?></u></h4>
                        <h5><?= !empty($ttd_tengah->position) ? "(" . $ttd_tengah->position . ")" : ""; ?></h5>
                    </td>

                    <td style="text-align: right;padding-top: 4em;">
                        <h4><u><?= !empty($ttd_kanan->value) ? $ttd_kanan->value : ""; ?></u></h4>
                        <h5><?= !empty($ttd_kanan->position) ? "(" . $ttd_kanan->position . ")" : ""; ?></h5>
                    </td>
                </tr>
            </table>
            <table style="width: 100%; margin-top:2rem">
                <tr>
                    <td style="text-align: center;" colspan="3">
                        <h4><?= !empty($ttd_bawah->header) ? $ttd_bawah->header : ""; ?></h4>
                    </td>
                </tr>
                <tr>
                    <td style=" text-align: center;padding-top: 4em;" colspan="3">
                        <h4><u><?= !empty($ttd_bawah->value) ? $ttd_bawah->value : ""; ?></u></h4>
                        <h5><?= !empty($ttd_bawah->position) ? "(" . $ttd_bawah->position . ")" : ""; ?></h5>
                    </td>
                </tr>
            </table>
        </div>
    </main>
    <footer>
        Invoice ini sah dikeluarkan oleh PT Dapur Inspirasi Nusantara, <br> Dicetak Oleh <?= $user[0]['username']; ?> Pada Tanggal <?= date("d F Y H:i:s"); ?> WITA
    </footer>
</body>

</html>