<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Data User Sistem
<?= $this->endSection(); ?>

<?= $this->section('footer'); ?>
<!-- datatable Js -->
<script src="<?= base_url(); ?>/assets/plugins/data-tables/js/datatables.min.js"></script>
<script src="<?= base_url(); ?>/assets/js/pages/data-basic-custom.js"></script>
<script type="text/javascript">
    $(".delete-button").on("click", function(e) {
        e.preventDefault();
        var self = $(this);
        var nama = $(this).attr("data-nama");
        var formId = $(this).attr("data-formid");
        swal({
                title: "Hapus User " + nama + "?",
                text: "Informasi Yang Terkait Dengan Data Ini Akan Hilang Secara Permanen",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    $("#" + formId).submit();
                } else {
                    swal({
                        title: "File Aman !",
                        text: "Data User " + nama + " Batal Dihapus",
                        icon: "info",
                    });
                }
            });
    });
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Data User Sistem</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Data User Sistem</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>List Data User Sistem</h5>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-file-plus"></i> Tambahkan User</button>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Foto User</th>
                                                        <th>Email</th>
                                                        <th>Nama User</th>
                                                        <th>Kontak</th>
                                                        <th>Hak Akses</th>
                                                        <th>Status</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($user as $c) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <?php if (empty($c->user_image)) : ?>
                                                                <td><img src="<?= base_url(); ?>/upload/user/user-default.jpg" width="50%" alt="Default Image"></td>
                                                            <?php else : ?>
                                                                <td><img src="<?= base_url(); ?>/upload/user/<?= $c->user_image; ?>" alt="Image User" width="50%"></td>
                                                            <?php endif; ?>
                                                            <td><?= $c->email; ?></td>
                                                            <td><?= $c->username; ?></td>
                                                            <td><?= !empty($c->user_number) ? $c->user_number : "Kosong"; ?></td>
                                                            <td><?= ucWords(strtolower($c->name)); ?></td>
                                                            <?php if ($c->active == 1) : ?>
                                                                <td><button type="button" class="btn btn-icon btn-success"><i class="feather icon-check-circle" title="User Aktif" data-toggle="tooltip"></i></button></td>
                                                            <?php else : ?>
                                                                <td><button type="button" class="btn btn-icon btn-danger"><i class="feather icon-alert-triangle" title="User Tidak Aktif" data-toggle="tooltip"></i></button></td>
                                                            <?php endif; ?>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                            </td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <!-- Update Button Modal -->
                                                                    <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory-<?= $c->userid; ?>"><i class="feather icon-edit" title="Ubah User" data-toggle="tooltip"></i></button>

                                                                    <!-- Update Modal -->
                                                                    <div id="updateCategory-<?= $c->userid; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryLabel-<?= $c->userid; ?>" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="updateCategoryLabel-<?= $c->userid; ?>">Ubah Data
                                                                                        Kategori</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                                        <?= csrf_field(); ?>
                                                                                        <input type="hidden" name="_method" value="PATCH">
                                                                                        <input type="hidden" name="id_user" value="<?= $c->userid; ?>">
                                                                                        <div class="form-group">
                                                                                            <input type="file" accept=".png,.jpeg,.jpg" class="form-control <?= $validation->getError('user_image_up') ? "is-invalid" : ""; ?>" name="user_image_up">
                                                                                            <small id="file" class="form-text text-muted">Bersifat Opsional, jika ingin menambahkan silahkan sesuaikan foto profil yang diupload <br> maksimal 1 Mb, bertipe .jpg, .png. atau
                                                                                                .jpeg</small>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("user_image_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="email" class="form-control <?= $validation->getError('email_up') ? "is-invalid" : ""; ?>" name="email_up" required placeholder="Email User" value="<?= (old('email_up')) ? old('email_up') : $c->email; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("email_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control <?= $validation->getError('username_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="username_up" required placeholder="Nama User" value="<?= (old('username_up')) ? old('username_up') : $c->username; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("username_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="number" min="0" maxlength="15" class="form-control <?= $validation->getError('user_number_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="user_number_up" placeholder="Kontak User (Opsional)" value="<?= (old('user_number_up')) ? old('user_number_up') : $c->user_number; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("user_number_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="password" class="form-control <?= $validation->getError('password_up') ? "is-invalid" : ""; ?>" name="password_up" placeholder="Kata Sandi Akun" value="<?= (old('password_up')) ? old('password_up') : ""; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("password_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <input type="password" class="form-control <?= $validation->getError('password_confirm_up') ? "is-invalid" : ""; ?>" name="password_confirm_up" placeholder="Konfirmasi Kata Sandi Akun" value="<?= (old('password_confirm_up')) ? old('password_confirm_up') : ""; ?>">
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("password_confirm_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <select class="form-control <?= $validation->getError('group_up') ? "is-invalid" : ""; ?>" name="group_up">
                                                                                                <option value="">Pilih Hak Akses</option>
                                                                                                <option value="1" <?= $c->name == "KASIR" ? "selected" : ""; ?>>Kasir</option>
                                                                                                <option value="2" <?= $c->name == "ADMIN" ? "selected" : ""; ?>>Admin</option>
                                                                                                <option value="3" <?= $c->name == "SUPER ADMIN" ? "selected" : ""; ?>>Super Admin</option>
                                                                                                <option value="4" <?= $c->name == "ATASAN" ? "selected" : ""; ?>>Atasan</option>
                                                                                            </select>
                                                                                            <div class="invalid-feedback">
                                                                                                <?= $validation->getError("group_up"); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="submit" name="update_user" value="update" class="btn btn-primary">Simpan
                                                                                                Perubahan</button>
                                                                                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>



                                                                    <!-- Delete -->
                                                                    <form action="" id="<?= $c->userid; ?>" method="POST">
                                                                        <?= csrf_field(); ?>
                                                                        <input type="hidden" name="_method" value="DELETE" />
                                                                        <input type="hidden" name="id_user" value="<?= $c->userid; ?>">
                                                                        <input type="hidden" name="delete_user" value="delete">
                                                                        <button type="submit" data-formid="<?= $c->userid ?>" data-nama="<?= $c->username ?>" class="btn btn-danger btn-icon btn-rounded delete-button" title="Hapus User" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                    </form>

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Foto User</th>
                                                        <th>Email</th>
                                                        <th>Nama User</th>
                                                        <th>Kontak</th>
                                                        <th>Hak Akses</th>
                                                        <th>Status</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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

<!-- Modal -->
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="file" accept=".png,.jpeg,.jpg" class="form-control <?= $validation->getError('user_image') ? "is-invalid" : ""; ?>" name="user_image">
                        <small id="file" class="form-text text-muted">Bersifat Opsional, jika ingin menambahkan silahkan sesuaikan foto profil yang diupload maksimal 1 Mb, bertipe .jpg, .png. atau
                            .jpeg</small>
                        <div class="invalid-feedback">
                            <?= $validation->getError("user_image"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control <?= $validation->getError('email') ? "is-invalid" : ""; ?>" name="email" required placeholder="Email User" value="<?= (old('email')) ? old('email') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("email"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('username') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="username" required placeholder="Nama User" value="<?= (old('username')) ? old('username') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("username"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" maxlength="15" class="form-control <?= $validation->getError('user_number') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="user_number" placeholder="Kontak User (Opsional)" value="<?= (old('user_number')) ? old('user_number') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("user_number"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control <?= $validation->getError('password') ? "is-invalid" : ""; ?>" name="password" required placeholder="Kata Sandi Akun" value="<?= (old('password')) ? old('password') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("password"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control <?= $validation->getError('password_confirm') ? "is-invalid" : ""; ?>" name="password_confirm" required placeholder="Konfirmasi Kata Sandi Akun" value="<?= (old('password_confirm')) ? old('password_confirm') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("password_confirm"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control <?= $validation->getError('group') ? "is-invalid" : ""; ?>" name="group">
                            <option value="">Pilih Hak Akses</option>
                            <option value="1">Kasir</option>
                            <option value="2">Admin</option>
                            <option value="3">Super Admin</option>
                            <option value="4">Atasan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError("group"); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit_user" value="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>