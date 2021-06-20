<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Pengaturan Profil
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
<script>
    const previewImg = () => {
        const file = document.getElementById('file');
        // const fileLabel = document.querySelector('.custom-file-control');
        const imgPreview = document.querySelector('.img-preview');
        // fileLabel.textContent = file.files[0].name;

        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(file.files[0]);
        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>

<?= $this->section('header'); ?>
<!-- data tables css -->
<link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/data-tables/css/datatables.min.css">

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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Pengaturan Profil</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Pengaturan Profil</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Informasi Profil</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card-body">
                                            <form method="POST" enctype="multipart/form-data" action="">
                                                <input type="hidden" name="_method" value="PATCH">
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label class="form-label">Nama Pengguna:</label>
                                                        <input type="text" style="text-transform: capitalize;" value="<?= (old('username')) ? old('username') : user()->username; ?>" class="form-control <?= $validation->getError('username') ? "is-invalid" : ""; ?>" name="username" required placeholder="Nama Lengkap">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError("username"); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="form-label">Nomor Whatsapp:</label>
                                                        <input type="number" min="0" name="user_number" value="<?= (old('user_number')) ? old('user_number') : user()->user_number; ?>" maxlength="15" class="form-control <?= $validation->getError('user_number') ? "is-invalid" : ""; ?>" placeholder="Kontak Whatsapp">
                                                        <div class="invalid-feedback">
                                                            <?= $validation->getError("user_number"); ?>
                                                        </div>
                                                        <small class="form-text text-muted">Jangan menggunakan format +62</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label class="form-label">Kata Sandi Baru:</label>
                                                        <div class="input-group search-form">
                                                            <input type="password" class="form-control <?= $validation->getError('password') ? "is-invalid" : ""; ?>" name="password" placeholder="********">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-transparent"><i class="feather icon-lock"></i></span>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError("password"); ?>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">Opsional, silahkan isi kata sandi jika anda ingin mengganti</small>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label class="form-label">Ulang Kata Sandi Baru:</label>
                                                        <div class="input-group search-form">
                                                            <input type="password" class="form-control <?= $validation->getError('re_password') ? "is-invalid" : ""; ?>" name="re_password" placeholder="********">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-transparent"><i class="feather icon-lock"></i></span>
                                                            </div>
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError("re_password"); ?>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">Opsional, silahkan isi ulang kata sandi jika anda ingin mengganti</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label class="form-label">Foto Profil</label>
                                                        <div>
                                                            <input type="file" id="file" accept=".jpg, .png, .jpeg" name="user_image" onchange="previewImg()" class=" form-control <?= $validation->getError('user_image') ? "is-invalid" : ""; ?>">
                                                            <div class="invalid-feedback">
                                                                <?= $validation->getError("user_image"); ?>
                                                            </div>
                                                        </div>
                                                        <small class="form-text text-muted">Opsional, jika ingin mengganti pastikan file berformat .jpg,.png, atau .jpeg dengan ukuran maksimal 1 Mb</small>
                                                    </div>
                                                </div>
                                                <button type="submit" name="submit_profil" value="submit" class="btn btn-primary"><i class="feather icon-lock"></i>Simpan Perubahan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card borderless-card">
                                    <div class="profile-card">
                                        <?php if (empty(user()->user_image)) : ?>
                                            <img class="img-fluid img-preview" src="<?= base_url(); ?>/upload/user/user-default.jpg" alt="">
                                        <?php else : ?>
                                            <img class="img-fluid img-preview" src="<?= base_url(); ?>/upload/user/<?= user()->user_image; ?>" alt="">
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer bg-inverse">
                                        <div class="row text-center">
                                            <div class="col">
                                                <h6><?= strtolower($user[0]['email']); ?></h6>
                                                <span>Email</span>
                                            </div>
                                            <div class="col">
                                                <h6><?= ucwords(strtolower($user[0]['name'])); ?></h6>
                                                <span>Hak Akses</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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