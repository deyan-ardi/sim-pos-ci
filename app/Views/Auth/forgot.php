<?= $this->extend($config->viewLayout) ?>
<?= $this->section('title') ?>
Halaman Lupa Kata Sandi
<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="auth-wrapper">
    <!-- [ reset-password ] start -->
    <div class="auth-content row justify-content-center container">
        <div class="card col-md-6">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <img src="<?= base_url(); ?>/logo-dark.png" width="30%" alt="" class="img-fluid mb-4">
                        </div>
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
            </div>
        </div>
    </div>
    <!-- [ reset-password ] end -->
</div>
<?= $this->endSection() ?>