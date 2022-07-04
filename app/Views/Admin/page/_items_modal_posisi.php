<!-- Modal -->

<input type="hidden" name="_method" value="PATCH">
<input type="hidden" name="id_item" value="<?= $items->id; ?>">

<div class="form-group input-group search-form">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Gudang Holding</span>
    </div>
    <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_a_up') ? 'is-invalid' : ''; ?>" name="item_stock_a_up" placeholder="Jumlah Stok Gudang A" required value="<?= (old('item_stock_a_up')) ?: $items->item_warehouse_a; ?>">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Unit</span>
    </div>
    <div class="invalid-feedback">
        <?= $validation->getError('item_stock_a_up'); ?>
    </div>
</div>
<div class="form-group input-group search-form">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Gudang Gurita</span>
    </div>
    <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_b_up') ? 'is-invalid' : ''; ?>" name="item_stock_b_up" placeholder="Jumlah Stok Gudang B" required value="<?= (old('item_stock_b_up')) ?: $items->item_warehouse_b; ?>">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Unit</span>
    </div>
    <div class="invalid-feedback">
        <?= $validation->getError('item_stock_b_up'); ?>
    </div>
</div>
<div class="form-group input-group search-form">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Showroom Sunset</span>
    </div>
    <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_c_up') ? 'is-invalid' : ''; ?>" name="item_stock_c_up" placeholder="Jumlah Stok Gudang C" required value="<?= (old('item_stock_c_up')) ?: $items->item_warehouse_c; ?>">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Unit</span>
    </div>
    <div class="invalid-feedback">
        <?= $validation->getError('item_stock_c_up'); ?>
    </div>
</div>
<div class="form-group input-group search-form">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Gudang Jakarta</span>
    </div>
    <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_d_up') ? 'is-invalid' : ''; ?>" name="item_stock_d_up" placeholder="Jumlah Stok Gudang D" required value="<?= (old('item_stock_d_up')) ?: $items->item_warehouse_d; ?>">
    <div class="input-group-append">
        <span class="input-group-text bg-transparent">Unit</span>
    </div>
    <div class="invalid-feedback">
        <?= $validation->getError('item_stock_d_up'); ?>
    </div>
</div>

