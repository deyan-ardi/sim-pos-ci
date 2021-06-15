<?= $this->extend($config->viewLayout) ?>
<?= $this->section('title') ?>
Reset Password Page
<?= $this->endSection() ?>

<?= $this->section('main') ?>
<div class="auth-wrapper">
    <!-- [ reset-password ] start -->
    <div class="auth-content container">
        <div class="card">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="card-body">
                        <img src="<?= base_url(); ?>/assets/images/logo-dark.svg" alt="" class="img-fluid mb-4">
                        <h4 class="mb-3 f-w-400">Reset your password</h4>
                        <?= view('App\Auth\_message_block') ?>

                        <p><?= lang('Auth.enterCodeEmailPassword') ?></p>

                        <form action="<?= route_to('reset-password') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group">
                                <label for="token"><?= lang('Auth.token') ?></label>
                                <input type="text"
                                    class="form-control <?php if (session('errors.token')) : ?>is-invalid<?php endif ?>"
                                    name="token" placeholder="<?= lang('Auth.token') ?>"
                                    value="<?= old('token', $token ?? '') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.token') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email"><?= lang('Auth.email') ?></label>
                                <input type="email"
                                    class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
                                    name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>"
                                    value="<?= old('email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="password"><?= lang('Auth.newPassword') ?></label>
                                <input type="password"
                                    class="form-control <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                                    name="password">
                                <div class="invalid-feedback">
                                    <?= session('errors.password') ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="pass_confirm"><?= lang('Auth.newPasswordRepeat') ?></label>
                                <input type="password"
                                    class="form-control <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
                                    name="pass_confirm">
                                <div class="invalid-feedback">
                                    <?= session('errors.pass_confirm') ?>
                                </div>
                            </div>

                            <br>

                            <button type="submit"
                                class="btn btn-primary btn-block"><?= lang('Auth.resetPassword') ?></button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 d-none d-md-block">
                    <img src="<?= base_url(); ?>/assets/images/auth/auth-bg.jpg" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    <!-- [ reset-password ] end -->
</div>

<?= $this->endSection() ?>