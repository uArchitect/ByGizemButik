<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Kategoriyi Güncelle"; ?></h3>
            </div>
            <form action="<?= base_url('Blog/editCategoryPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $category->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Dil"; ?></label>
                        <select name="lang_id" class="form-control">
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= $category->lang_id == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= "Kategori Adı"; ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= "Kategori Adı"; ?>" value="<?= esc($category->name); ?>" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Slug"; ?>
                            <small>(<?= "URL'de görünecek isim"; ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug" placeholder="<?= "Slug"; ?>" value="<?= esc($category->slug); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= 'Açıklama'; ?> (<?= 'Meta Etiket'; ?>)</label>
                        <input type="text" class="form-control" name="description" placeholder="<?= 'Açıklama'; ?> (<?= 'Meta Etiket'; ?>)" value="<?= esc($category->description); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= 'Anahtar Kelimeler'; ?> (<?= 'Meta Etiket'; ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= 'Anahtar Kelimeler'; ?> (<?= 'Meta Etiket'; ?>)" value="<?= esc($category->keywords); ?>">
                    </div>
                    <div class="form-group">
                        <label><?= 'Sıra'; ?></label>
                        <input type="number" class="form-control" name="category_order" placeholder="<?= 'Sıra'; ?>" value="<?= esc($category->category_order); ?>" min="1" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= 'Değişiklikleri Kaydet'; ?> </button>
                </div>
            </form>
        </div>
    </div>
</div>