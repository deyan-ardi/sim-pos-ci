<?= $this->extend($config->viewLayout) ?>
<?= $this->section('title') ?>
Halaman Lupa Kata Sandi
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
                        <h4 class="mb-3 f-w-400">Setel Ulang Kata Sandi</h4>

                        <?= view('App\Auth\_message_block') ?>

                        <p>Tidak masalah! Silahkan masukkan email akun anda pada kolom dibawah dan kami akan mengirimkan instruksi untuk menyetel ulang kata sandi</p>


                        <form action="<?= route_to('forgot') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input type="email" class="form-control <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" aria-describedby="emailHelp" placeholder="<?= lang('Auth.email') ?>">
                                <div class="invalid-feedback">
                                    <?= session('errors.email') ?>
                                </div>
                            </div>

                            <br>

                            <button type="submit" class="btn btn-primary btn-block">Kirimkan Instruksi</button>
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