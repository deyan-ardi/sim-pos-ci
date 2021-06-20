<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Dashboard Page
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- am chart js -->
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/core.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/charts.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/animated.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/maps.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/worldLow.js"></script>
<script src="<?= base_url(); ?>/assets/plugins/chart-am4/js/continentsLow.js"></script>

<!-- Rating Js -->
<script src="<?= base_url(); ?>/assets/plugins/ratting/js/jquery.barrating.min.js"></script>

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
                                            <h5 class="m-b-10">Point Of Sale Application</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="index-2.html"><i
                                                        class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Dashboard</a></li>
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
                                                <h5>Categories</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-blue f-36">56</span>
                                                <p class="m-b-0">Total Categories</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-blue" style="width:56%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-blue border-0">
                                                <a href="">
                                                    <h6 class="text-white m-b-0">Read Detail <i
                                                            class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Items Product</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-green f-36">85</span>
                                                <p class="m-b-0">Total Item</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-green" style="width:85%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-green border-0">
                                                <a href="">
                                                    <h6 class="text-white m-b-0">Read Detail <i
                                                            class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Member</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-purple f-36">42</span>
                                                <p class="m-b-0">Total Person</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-purple" style="width:42%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-purple border-0">
                                                <a href="">
                                                    <h6 class="text-white m-b-0">Read Detail <i
                                                            class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="card statustic-card">
                                            <div class="card-header borderless pb-0">
                                                <h5>Supplier</h5>
                                            </div>
                                            <div class="card-body text-center">
                                                <span class="d-block text-c-red f-36">42</span>
                                                <p class="m-b-0">Total Supplier</p>
                                                <div class="progress">
                                                    <div class="progress-bar bg-c-red" style="width:42%"></div>
                                                </div>
                                            </div>
                                            <div class="card-footer bg-c-red border-0">
                                                <a href="">
                                                    <h6 class="text-white m-b-0">Read Detail <i
                                                            class="feather icon-arrow-right"></i>
                                                    </h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Project statustic end -->
                            <!-- what-new start -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card latest-update-card update-card">
                                    <div class="card-header">
                                        <h5>Last Activity</h5>
                                    </div>
                                    <div class="new-scroll" style="height:350px;position:relative;">
                                        <div class="card-body">
                                            <div class="latest-update-box">
                                                <div class="row p-t-20 p-b-30">
                                                    <div class="col-auto text-right update-meta">
                                                        <img src="<?= base_url(); ?>/assets/images/user/avatar-1.jpg"
                                                            alt="user image" class="img-radius align-top update-icon">
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6 class="m-0">Your Manager Posted.</h6>
                                                        </a>
                                                        <p class="m-b-0">Jonny michel</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta">
                                                        <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6 class="m-0">You have 3 pending Task.</h6>
                                                        </a>
                                                        <p class="m-b-0">Hemilton</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta">
                                                        <i
                                                            class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6 class="m-0">New Order Received.</h6>
                                                        </a>
                                                        <p class="m-b-0">Hemilton</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta">
                                                        <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6 class="m-0">You have 3 pending Task.</h6>
                                                        </a>
                                                        <p class="m-b-0">Hemilton</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta">
                                                        <img src="<?= base_url(); ?>/assets/images/user/avatar-4.jpg"
                                                            alt="user image" class="img-radius align-top update-icon">
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6 class="m-0">Your Manager Posted.</h6>
                                                        </a>
                                                        <p class="m-b-0">Jonny michel</p>
                                                    </div>
                                                </div>
                                                <div class="row p-b-30">
                                                    <div class="col-auto text-right update-meta">
                                                        <i
                                                            class="feather icon-check f-w-600 bg-c-green update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6 class="m-0">New Order Received.</h6>
                                                        </a>
                                                        <p class="m-b-0">Shirley Hoe</p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-auto text-right update-meta">
                                                        <i class="feather icon-briefcase bg-c-red update-icon"></i>
                                                    </div>
                                                    <div class="col p-l-5">
                                                        <a href="#!">
                                                            <h6 class="m-0">You have 2 pending Task.</h6>
                                                        </a>
                                                        <p class="m-b-0">James Alexander</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- what-new end -->
                            <!-- moodrate start -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card widget-profile">
                                    <div class="widget-profile-card-3">
                                        <img class="img-fluid"
                                            src="<?= base_url(); ?>/assets/images/widget/img-round1.jpg"
                                            alt="Profile-user">
                                    </div>
                                    <div class="card-body text-center">
                                        <h3><?= ucWords($user[0]['username']); ?></h3>
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
                                                <h4><?= ucWords(strtolower($user[0]['name'])); ?></h4>
                                                <span>Hak Akses</span>
                                            </div>
                                            <?php else : ?>
                                            <div class="col text-center">
                                                <span>Hak Akses</span>
                                            </div>
                                            <?php endif; ?>

                                        </div>
                                        <div class="mt-5">
                                            <button type="button" class="btn btn-rounded btn-primary">Edit Data</button>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <!-- moodrate end -->
                            <!-- Gadjets-section start -->
                            <div class="col-xl-4 col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Profit Report</h5>
                                    </div>
                                    <div class="card-body">
                                        <div id="type-chart" style="height:180px;"></div>
                                        <div class="mt-3">
                                            <span class="d-block mb-2"><i class="fas fa-circle f-10 m-r-15"
                                                    style="color:#67b7dc;"></i>Desktop Computers<span
                                                    class="float-right f-w-400">76.7%</span></span>
                                            <span class="d-block mb-2"><i class="fas fa-circle f-10 m-r-15"
                                                    style="color:#8067dc;"></i>Smartphones<span
                                                    class="float-right f-w-400">15%</span></span>
                                            <span class="d-block"><i class="fas fa-circle f-10 m-r-15"
                                                    style="color:#dc67ce;"></i>Tablets<span
                                                    class="float-right f-w-400">30%</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Gadjets-section end -->
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection(); ?>