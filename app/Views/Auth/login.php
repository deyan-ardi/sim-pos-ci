<?= $this->extend($config->viewLayout) ?>
<?= $this->section('title') ?>
Masuk Sistem
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
    <div class="auth-content row justify-content-center container">
        <div class="card col-md-5">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <img src="<?= base_url(); ?>/logo-dark.png" width="30%" alt="" class="img-fluid mb-4">
                        </div>
                        <h4 class="mb-3 f-w-400">Masuk Akun Anda</h4>

                        <?= view('App\Auth\_message_block') ?>

                        <form action="<?= route_to('login') ?>" method="post">
                            <?= csrf_field() ?>

                            <?php if ($config->validFields === ['email']) : ?>
                                <div class="form-group">
                                    <label for="login"><?= lang('Auth.email') ?></label>
                                    <input type="email" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="<?= lang('Auth.email') ?>">
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <div class="form-group">
                                    <label for="login">Email atau Username</label>
                                    <input type="text" class="form-control <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" name="login" placeholder="Email atau Username">
                                    <div class="invalid-feedback">
                                        <?= session('errors.login') ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" name="password" class="form-control  <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="********">
                                    <div class="invalid-feedback">
                                        <?= session('errors.password') ?>
                                    </div>
                                    <div class="input-group-append">
                                        <a href="" class="btn btn-light btn-sm">
                                            <i class="fas fa-eye-slash text-secondary m-0 pt-2" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <?php if ($config->allowRemembering) : ?>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="checkbox" name="remember" class="form-check-input" <?php if (old('remember')) : ?> checked <?php endif ?>>
                                        Ingat Saya
                                    </label>
                                </div>
                            <?php endif; ?>

                            <br>

                            <button type="submit" class="btn btn-primary btn-block">Masuk Sistem</button>
                        </form>
                        <hr>

                        <?php if ($config->allowRegistration) : ?>
                            <p><a href="<?= route_to('register') ?>">Daftar Akun Baru?</a></p>
                        <?php endif; ?>
                        <?php if ($config->activeResetter) : ?>
                            <p><a href="<?= route_to('forgot') ?>">Lupa Kata Sandi?</a></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ auth-signin ] end -->
<?= $this->endSection() ?>