<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Dashboard Page
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- dashboard-custom js -->
<script src="<?= base_url(); ?>/assets/js/pages/dashboard-project.js"></script>
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Halaman Beranda</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Halaman Beranda</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!-- Project statustic start -->
                            <div class="col-xl-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Kategori Produk</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-blue f-36"><?= $kategori; ?></span>
                                                <p class="m-b-0">Total Kategori</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-blue" style="width:50%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-blue border-0">
                                                <a href="<?= base_url(); ?>/categories">
                                                    <h6 class="text-white m-b-0">Lihat Detail <i class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Item Produk</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-green f-36"><?= $item; ?></span>
                                                <p class="m-b-0">Total Item</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-green" style="width:50%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-green border-0">
                                                <a href="<?= base_url(); ?>/items">
                                                    <h6 class="text-white m-b-0">Lihat Detail <i class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Member Toko</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-purple f-36"><?= $member; ?></span>
                                                <p class="m-b-0">Total Member</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-purple" style="width:50%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-purple border-0">
                                                <a href="<?= base_url(); ?>/members">
                                                    <h6 class="text-white m-b-0">Lihat Detail <i class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Supplier Barang</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-red f-36"><?= $supplier; ?></span>
                                                <p class="m-b-0">Total Supplier</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-red" style="width:50%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-red border-0">
                                                <a href="<?= base_url(); ?>/suppliers">
                                                    <h6 class="text-white m-b-0">Lihat Detail <i class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Project statustic end -->

                            <!-- moodrate start -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card widget-profile">
                                    <div class="widget-profile-card-3">
                                        <?php if (!empty(user()->user_image)) : ?>
                                            <img class="img-fluid" src="<?= base_url(); ?>/upload/user/<?= user()->user_image; ?>" alt="Profile-user">
                                        <?php else : ?>
                                            <img class="img-fluid" src="<?= base_url(); ?>/upload/user/user-default.jpg" alt="Profile-user">

                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body text-center">
                                        <h3><?= ucwords($user[0]['username']); ?></h3>
                                        <p><?= strtolower($user[0]['email']); ?></p>
                                        <div class="row mt-5">
                                            <?php if (!empty($user[0]['user_number'])) : ?>
                                                <div class="col text-center">
                                                    <h4><?= $user[0]['user_number']; ?></h4>
                                                    <span>Kontak</span>
                                                </div>
                                            <?php else : ?>
                                                <div class="col text-center">
                                                    <h4>Kosong</h4>
                                                    <span>Kontak</span>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (!empty($user[0]['name'])) : ?>
                                                <div class="col text-center">
                                                    <h4><?= ucwords(strtolower($user[0]['name'])); ?></h4>
                                                    <span>Hak Akses</span>
                                                </div>
                                            <?php else : ?>
                                                <div class="col text-center">
                                                    <span>Hak Akses</span>
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="mt-5">
                                            <a href="<?= base_url(); ?>/profile-setting"><button type="button" class="btn btn-rounded btn-primary">Edit Data</button></a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- moodrate end -->
                            <!-- what-new start -->
                            <div class="col-xl-8 col-md-6">
                                <div class="card latest-update-card update-card">
                                    <div class="card-header">
                                        <h5>Last Activity</h5>
                                    </div>
                                    <div class="new-scroll" style="height:350px;position:relative;">
                                        <div class="card-body">
                                            <div class="latest-update-box">
                                                <?php
                                                $i = 0;

                                                foreach ($sale as $s) : ?>
                                                    <?php if ($i++ == 0) : ?>
                                                        <div class="row p-t-20 p-b-30">
                                                        <?php else : ?>
                                                            <div class="row p-b-30">
                                                            <?php endif; ?>
                                                            <div class="col-auto text-right update-meta">
                                                                <i class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                                            </div>
                                                            <div class="col p-l-5">
                                                                <a href="#!">
                                                                    <h6 class="m-0">Transaksi <?= $s->sale_code; ?> Telah Berhasil Dibuat <?= CodeIgniter\I18n\Time::parse($s->updated_at)->toLocalizedString('d MMM yyyy, H:m'); ?> WITA</h6>
                                                                </a>
                                                                <p class="m-b-0">~ Dintara Point Of Sale</p>
                                                            </div>
                                                            </div>
                                                        <?php endforeach; ?>
                                                        </div>

                                                        <div class="latest-update-box">
                                                            <?php
                                                            $j = 0;
                                                            foreach ($penawaran as $p) : ?>
                                                                <?php if ($j++ == 0 && $i == 0) : ?>
                                                                    <div class="row p-t-20 p-b-30">
                                                                    <?php else : ?>
                                                                        <div class="row p-b-30">
                                                                        <?php endif; ?>
                                                                        <div class="col-auto text-right update-meta">
                                                                            <i class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                                                        </div>
                                                                        <div class="col p-l-5">
                                                                            <a href="#!">
                                                                                <h6 class="m-0">Penawaran <?= $p->penawaran_code; ?> Telah Berhasil Dibuat <?= CodeIgniter\I18n\Time::parse($s->updated_at)->toLocalizedString('d MMM yyyy, H:m'); ?> WITA</h6>
                                                                            </a>
                                                                            <p class="m-b-0">~ Dintara Point Of Sale</p>
                                                                        </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                    </div>
                                                        </div>
                                            </div>
                                        </div>
                                        <!-- what-new end -->

                                    </div>
                                    <!-- [ Main Content ] end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <?= $this->endSection(); ?>