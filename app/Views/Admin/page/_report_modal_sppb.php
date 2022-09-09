<!-- Modal -->

<input type="hidden" name="id_transaksi" value="<?= $sale_id; ?>">

<label for="">Data Detail Transaksi</label>
<div class="dt-responsive table-responsive">
    <table id="simpletable-2" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>
                    <div class="form-check form-check-inline ms-1">
                        <input type="checkbox" class="form-check-input check-all" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1"></label>
                    </div>

                </th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Banyak</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($sale_detail)) : ?>
                <tr>
                    <td colspan="5" class="text-center">Data Tidak Ditemukan</td>
                </tr>
            <?php else : ?>
                <?php foreach ($sale_detail as $item) : ?>
                    <?php if ($item->detail_send_status == 0 && $item->detail_send_status != NULL) : ?>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input check-item" value="<?= $item->id ?> " multiple name="checkbox_data[]" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1"></label>
                                </div>
                            </td>
                            <td><?= $item->item_code; ?></td>
                            <td><?= $item->item_name; ?></td>
                            <td><?= $item->detail_quantity; ?> Unit</td>
                            <td><?= format_rupiah($item->detail_total); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
    </table>
    <div class="form-group">
        <label for="date">Tanggal Estimasi</label>
        <input type="date" min="<?= date('Y-m-d'); ?>" class="form-control <?= $validation->getError('estimasi') ? 'is-invalid' : ''; ?>" name="estimasi" required>
        <div class="invalid-feedback">
            <?= $validation->getError('estimasi'); ?>
        </div>
    </div>
    <div class="form-group">
        <label for="date">Alamat Pengiriman</label>
        <textarea class="form-control <?= $validation->getError('alamat') ? 'is-invalid' : ''; ?>" name="alamat" required placeholder="Alamat Pengiriman"></textarea>
        <div class="invalid-feedback">
            <?= $validation->getError('alamat'); ?>
        </div>
    </div>

</div>
<script>
    $('.check-all').on('change', function() {
        if ($(this).is(':checked')) {
            $('.check-item').each(function(i, e) {
                $(e).prop('checked', true);
            });
        } else {
            $('.check-item').each(function(i, e) {
                $(e).prop('checked', false);
            });
        }
    });


    $('.check-item').each(function(i, e) {
        $(e).prop('checked', false);
    });
</script>