<?= $this->extend('Admin/master/layout'); ?>
<?= $this->section('title'); ?>
Data Pelanggan Project
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
                title: "Hapus Member " + nama + "?",
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
                        text: "Data Member " + nama + " Batal Dihapus",
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
                                            <h5 class="m-b-10">Dintara Point Of Sale - Data Pelanggan Project</h5>
                                        </div>
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>"><i class="feather icon-home"></i></a></li>
                                            <li class="breadcrumb-item"><a href="#!">Data Pelanggan Project</a></li>
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
                                        <h5>List Pelanggan Project</h5>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-gradient-primary btn-rounded btn-glow mb-4" data-toggle="modal" data-target="#addCategory"><i class="feather icon-file-plus"></i> Tambahkan Pelanggan</button>
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Pelanggan</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Kontak Pelanggan</th>
                                                        <th>Perusahaan</th>
                                                        <th>Jabatan</th>
                                                        <th>Email Pelanggan</th>
                                                        <th>Deskripsi Pelanggan</th>
                                                        <th>Discount Pelanggan</th>
                                                        <th>Diubah Terakhir</th>
                                                        <th class="text-center"><i class="feather icon-settings"></i>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($member as $c) : ?>
                                                        <tr>
                                                            <td><?= $i++; ?></td>
                                                            <td><?= $c->member_code; ?></td>
                                                            <td><?= $c->member_name; ?></td>
                                                            <td>0<?= $c->member_contact; ?></td>
                                                            <td><?= $c->member_company; ?></td>
                                                            <td><?= $c->member_job; ?></td>
                                                            <td><?= $c->member_email; ?></td>
                                                            <td><?= !empty($c->member_description) ? $c->member_description : "Kosong"; ?></td>
                                                            <td><?= $c->member_discount; ?> %</td>
                                                            <td>
                                                                <?= CodeIgniter\I18n\Time::parse($c->updated_at)->humanize(); ?>
                                                            </td>
                                                            <td>
                                                                <div class="row justify-content-center">
                                                                    <!-- Update Button Modal -->
                                                                    <button type="button" class="btn btn-warning btn-icon btn-rounded" data-toggle="modal" data-target="#updateCategory-<?= $c->id ?>"><i class="feather icon-edit" title="Ubah Member" data-toggle="tooltip"></i></button>

                                                                    <?php if ($c->member_status == 0) : ?>
                                                                        <!-- Delete -->
                                                                        <form action="" id="<?= $c->id ?>" method="POST">
                                                                            <?= csrf_field(); ?>
                                                                            <input type="hidden" name="_method" value="DELETE" />
                                                                            <input type="hidden" name="id_member" value="<?= $c->id; ?>">
                                                                            <input type="hidden" name="delete_member" value="delete">
                                                                            <button type="submit" data-formid="<?= $c->id ?>" data-nama="<?= $c->member_name ?>" class="btn delete-button btn-danger btn-icon btn-rounded" title="Hapus Member" data-toggle="tooltip"><i class="feather icon-trash"></i></button>
                                                                        </form>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Kode Pelanggan</th>
                                                        <th>Nama Pelanggan</th>
                                                        <th>Kontak Pelanggan</th>
                                                        <th>Perusahaan</th>
                                                        <th>Jabatan</th>
                                                        <th>Email Pelanggan</th>
                                                        <th>Deskripsi Pelanggan</th>
                                                        <th>Discount Pelanggan</th>
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
<?php foreach ($member as $c) : ?>
    <!-- Update Modal -->
    <div id="updateCategory-<?= $c->id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryLabel<?= $c->id ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateCategoryLabel<?= $c->id ?>">Ubah Data
                        Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="PATCH">
                        <input type="hidden" name="id_member" value="<?= $c->id; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control" required disabled value="<?= $c->member_code; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?= $validation->getError('member_name_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_name_up" required placeholder="Nama Pelanggan Project" value="<?= (old('member_name_up')) ? old('member_name_up') : $c->member_name; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError("member_name_up"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="number" min="0" maxlength="15" class="form-control <?= $validation->getError('member_contact_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_contact_up" required placeholder="Kontak Member" value="<?= (old('member_contact_up')) ? old('member_contact_up') :  $c->member_contact; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError("member_contact_up"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?= $validation->getError('member_company_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_company_up" required placeholder="Nama Perusahaan" value="<?= (old('member_company_up')) ? old('member_company_up') : $c->member_company; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError("member_company_up"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control <?= $validation->getError('member_job_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_job_up" required placeholder="Jabatan Pelanggan" value="<?= (old('member_job_up')) ? old('member_job_up') : $c->member_job; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError("member_job_up"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control <?= $validation->getError('member_email_up') ? "is-invalid" : ""; ?>" name="member_email_up" required placeholder="Email Pelanggan" value="<?= (old('member_email_up')) ? old('member_email_up') : $c->member_email; ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError("member_email_up"); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control <?= $validation->getError('member_description_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_description_up" placeholder="Deskripsi Member (Opsional)" value="<?= (old('member_description_up')) ? old('member_description_up') : $c->member_description; ?>"></textarea>
                            <div class="invalid-feedback">
                                <?= $validation->getError("member_description_up"); ?>
                            </div>
                        </div>
                        <div class="input-group search-form form-group">
                            <input type="number" min="0" max="100" step="0.01" class="form-control <?= $validation->getError('member_discount_up') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_discount_up" placeholder="Diskon Dalam Persen (Opsional)" value="<?= (old('member_discount_up')) ? old('member_discount_up') : $c->member_discount; ?>">
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent">%</span>
                            </div>
                            <div class="invalid-feedback">
                                <?= $validation->getError("member_discount_up"); ?>
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" name="update_member" value="update" class="btn btn-primary">Simpan
                                Perubahan</button>
                            <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryLabel">Tambah Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('member_name') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_name" required placeholder="Nama Pelanggan Project" value="<?= (old('member_name')) ? old('member_name') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("member_name"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" maxlength="15" class="form-control <?= $validation->getError('member_contact') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_contact" required placeholder="Kontak Pelanggan" value="<?= (old('member_contact')) ? old('member_contact') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("member_contact"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('member_company') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_company" required placeholder="Nama Perusahaan" value="<?= (old('member_company')) ? old('member_company') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("member_company"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control <?= $validation->getError('member_job') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_job" required placeholder="Jabatan Pelanggan" value="<?= (old('member_job')) ? old('member_job') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("member_job"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control <?= $validation->getError('member_email') ? "is-invalid" : ""; ?>" name="member_email" required placeholder="Email Pelanggan" value="<?= (old('member_email')) ? old('member_email') : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError("member_email"); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control <?= $validation->getError('member_description') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_description" placeholder="Deskripsi Pelanggan (Opsional)" value="<?= (old('member_description')) ? old('member_description') : ""; ?>"></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError("member_description"); ?>
                        </div>
                    </div>
                    <div class="input-group search-form form-group">
                        <input type="number" min="0" max="100" step="0.01" class="form-control <?= $validation->getError('member_discount') ? "is-invalid" : ""; ?>" style="text-transform: capitalize;" name="member_discount" placeholder="Diskon Dalam Persen (Opsional)" value="<?= (old('member_discount')) ? old('member_discount') : ""; ?>">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent">%</span>
                        </div>
                        <div class="invalid-feedback">
                            <?= $validation->getError("member_discount"); ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="input_member" value="member" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>