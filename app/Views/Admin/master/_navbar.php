    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">

        <div class="m-header">
            <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
            <a href="<?= base_url(); ?>" class="b-brand">
                <!-- <div class="b-bg">
						<i class="fas fa-bolt"></i>
					</div>
					<span class="b-title">Dasho</span> -->
                <img src="<?= base_url(); ?>/logo-white.png" width="15%" alt="" class="logo images">
                <img src="<?= base_url(); ?>/logo-white.png" width="30%" alt="" class="logo-thumb images">
            </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="#!">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <a href="#!" class="mob-toggler"></a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <div class="main-search open">
                        <div class="input-group">
                            <input type="text" id="m-search" class="form-control" placeholder="Pencarian Menu...">
                            <a href="#!" class="input-group-append search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </a>
                            <span class="input-group-append search-btn btn btn-primary">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-users"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <?php if (!empty(user()->user_image)) : ?>
                                    <img class="img-radius" src="<?= base_url(); ?>/upload/user/<?= user()->user_image; ?>" alt="Profile-user">
                                <?php else : ?>
                                    <img class="img-radius" src="<?= base_url(); ?>/upload/user/user-default.jpg" alt="Profile-user">

                                <?php endif; ?>
                                <span>
                                    <span class="text-muted"><?= ucWords(user()->username); ?></span>
                                    <span class="h6"><?= strtolower(user()->email); ?></span>
                                </span>
                            </div>
                            <ul class="pro-body">
                                <li><a href="<?= base_url(); ?>/profile-setting" class="dropdown-item"><i class="feather icon-user"></i> Pengaturan Profil</a>
                                </li>
                                <li><a href="<?= base_url(); ?>/logout" class="dropdown-item"><i class="feather icon-power text-danger"></i>
                                        Keluar</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    </header>
    <!-- [ Header ] end -->