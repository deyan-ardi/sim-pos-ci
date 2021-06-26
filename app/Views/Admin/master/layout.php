<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from html.phoenixcoded.net/dasho/bootstrap/default/dashboard-project.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 14 Jun 2021 15:35:02 GMT -->

<head>

    <title>Dintara Point Of Sale - <?= $this->renderSection('title'); ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="Point of Sale Project" />
    <meta name="keywords" content="point of sale, aplikasi kasir, codeigniter">
    <meta name="author" content="Ganatech ID" />
    <?= $this->include('Admin/master/_header'); ?>
</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <div class="berhasil" data-berhasil="<?= session()->getFlashdata('berhasil') ?>"></div>
    <div class="gagal" data-gagal="<?= session()->getFlashdata('gagal') ?>"></div>
    <!-- [ Pre-loader ] End -->

    <?= $this->include('Admin/master/_sidebar'); ?>
    <?= $this->include('Admin/master/_navbar'); ?>
    <?= $this->renderSection('main'); ?>
    <?= $this->include('Admin/master/_footer'); ?>
</body>

</html>