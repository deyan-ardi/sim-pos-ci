    <!-- Update Modal -->
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" name="id_item" value="<?= $items[0]->id; ?>">
    <div class="form-group">
        <input type="file" accept=".png,.jpg,.jpeg" class="form-control <?= $validation->getError('item_image_up') ? 'is-invalid' : ''; ?>" name="item_image_up">
        <small id="file" class="form-text text-muted">Bersifat
            opsional, jika ingin diubah
            pastikan file
            maksimal 1 Mb, bertipe .jpg,
            .png. atau
            .jpeg</small>
        <div class="invalid-feedback">
            <?= $validation->getError('item_image_up'); ?>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control <?= $validation->getError('item_code_up') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_code_up" required placeholder="Kode Barang" value="<?= (old('item_code_up')) ?: $items[0]->item_code; ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('item_code_up'); ?>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control <?= $validation->getError('item_name_up') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_name_up" required placeholder="Nama Barang" value="<?= (old('item_name_up')) ?: $items[0]->item_name; ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('item_name_up'); ?>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control <?= $validation->getError('item_merk_up') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_merk_up" placeholder="Merk Barang (Opsional)" value="<?= (old('item_merk_up')) ?: $items[0]->item_merk; ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('item_merk_up'); ?>
        </div>
    </div>
    <div class="form-group">
        <input type="text" class="form-control <?= $validation->getError('item_type_up') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_type_up" placeholder="Tipe Barang (Opsional)" value="<?= (old('item_type_up')) ?: $items[0]->item_type; ?>">
        <div class="invalid-feedback">
            <?= $validation->getError('item_type_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_weight_up') ? 'is-invalid' : ''; ?>" name="item_weight_up" placeholder="Berat Dalam Kg (Opsional)" value="<?= (old('item_weight_up')) ?: $items[0]->item_weight; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Kg</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_weight_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_length_up') ? 'is-invalid' : ''; ?>" name="item_length_up" placeholder="Panjang Dalam Meter (Opsional)" value="<?= (old('item_length_up')) ?: $items[0]->item_length; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Meter</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_length_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_width_up') ? 'is-invalid' : ''; ?>" name="item_width_up" placeholder="Lebar Dalam Meter (Opsional)" value="<?= (old('item_width_up')) ?: $items[0]->item_length; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Meter</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_width_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <input type="number" min="0" step="0.01" class="form-control <?= $validation->getError('item_height_up') ? 'is-invalid' : ''; ?>" name="item_height_up" placeholder="Tinggi Dalam Meter (Opsional)" value="<?= (old('item_height_up')) ?: $items[0]->item_height; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Meter</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_height_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Stok Gudang Holding</span>
        </div>
        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_a_up') ? 'is-invalid' : ''; ?>" name="item_stock_a_up" placeholder="Jumlah Stok Gudang A" required value="<?= (old('item_stock_a_up')) ?: $items[0]->item_warehouse_a; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Unit</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_stock_a_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Stok Gudang Gurita</span>
        </div>
        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_b_up') ? 'is-invalid' : ''; ?>" name="item_stock_b_up" placeholder="Jumlah Stok Gudang B" required value="<?= (old('item_stock_b_up')) ?: $items[0]->item_warehouse_b; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Unit</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_stock_b_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Stok Showroom Sunset</span>
        </div>
        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_c_up') ? 'is-invalid' : ''; ?>" name="item_stock_c_up" placeholder="Jumlah Stok Gudang C" required value="<?= (old('item_stock_c_up')) ?: $items[0]->item_warehouse_c; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Unit</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_stock_c_up'); ?>
        </div>
    </div>
    <div class="form-group input-group search-form">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Stok Gudang Jakarta</span>
        </div>
        <input type="number" min="0" class="form-control <?= $validation->getError('item_stock_d_up') ? 'is-invalid' : ''; ?>" name="item_stock_d_up" placeholder="Jumlah Stok Gudang D" required value="<?= (old('item_stock_d_up')) ?: $items[0]->item_warehouse_d; ?>">
        <div class="input-group-append">
            <span class="input-group-text bg-transparent">Unit</span>
        </div>
        <div class="invalid-feedback">
            <?= $validation->getError('item_stock_d_up'); ?>
        </div>
    </div>
    <?php if (! in_groups('GUDANG')) : ?>
        <div class="form-group input-group search-form">
            <div class="input-group-append">
                <span class="input-group-text bg-transparent">Rp</span>
            </div>
            <input type="number" min="0" class="form-control <?= $validation->getError('item_hpp_up') ? 'is-invalid' : ''; ?>" name="item_hpp_up" placeholder="Harga Beli (Rupiah)" required value="<?= (old('item_hpp_up')) ?: $items[0]->item_hpp; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('item_hpp_up'); ?>
            </div>
        </div>
        <div class="form-group input-group search-form">
            <div class="input-group-append">
                <span class="input-group-text bg-transparent">Rp</span>
            </div>
            <input type="number" min="0" class="form-control <?= $validation->getError('item_sale_up') ? 'is-invalid' : ''; ?>" name="item_sale_up" placeholder="Harga Jual (Rupiah)" required value="<?= (old('item_sale_up')) ?: $items[0]->item_sale; ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('item_sale_up'); ?>
            </div>
        </div>
        <div class="form-group input-group search-form">
            <input type="number" min="0" max="100" step="0.01" class="form-control <?= $validation->getError('item_discount_up') ? 'is-invalid' : ''; ?>" name="item_discount_up" placeholder="Diskon Barang Dalam Persen (Opsional)" value="<?= (old('item_discount_up')) ?: $items[0]->item_discount; ?>">
            <div class="input-group-append">
                <span class="input-group-text bg-transparent">%</span>
            </div>
            <div class="invalid-feedback">
                <?= $validation->getError('item_discount_up'); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <textarea class="form-control <?= $validation->getError('item_description_up') ? 'is-invalid' : ''; ?>" style="text-transform: capitalize;" name="item_description_up" placeholder="Deskripsi Barang (Opsional)"><?= (old('item_description_up')) ?: $items[0]->item_description; ?></textarea>
        <div class="invalid-feedback">
            <?= $validation->getError('item_description_up'); ?>
        </div>
    </div>
    <div class="form-group">
        <select name="category_up" id="item_id-<?= $items[0]->id ?>" required class="form-control <?= $validation->getError('category_up') ? 'is-invalid' : ''; ?>">
            <?php foreach ($category as $ca) : ?>
                <?php if ($ca->id == $items[0]->category_id) : ?>
                    <option value="<?= $ca->id; ?>" selected>
                        <?= $ca->category_name; ?>
                    </option>
                <?php else : ?>
                    <option value="<?= $ca->id; ?>">
                        <?= $ca->category_name; ?>
                    </option>
                <?php endif; ?>

            <?php endforeach; ?>

        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('category_up'); ?>
        </div>
    </div>
    <div class="form-group">
        <select name="supplier_up" id="supp_id-<?= $items[0]->id ?>" required class="form-control <?= $validation->getError('supplier_up') ? 'is-invalid' : ''; ?>">
            <?php foreach ($supplier as $ca) : ?>
                <?php if ($ca->id == $items[0]->supplier_id) : ?>
                    <option value="<?= $ca->id; ?>" selected>
                        <?= $ca->supplier_name; ?>
                    </option>
                <?php else : ?>
                    <option value="<?= $ca->id; ?>">
                        <?= $ca->supplier_name; ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('supplier_up'); ?>
        </div>
    </div>