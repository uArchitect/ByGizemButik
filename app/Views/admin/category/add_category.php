<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Kategori Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('categories'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Kategoriler"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Category/addCategoryPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="parent_id" value="0">
                <div class="box-body">
                    <?php foreach ($activeLanguages as $language): ?>
                        <div class="form-group">
                            <label><?= "Kategori Adı"; ?> (<?= $language->name; ?>)</label>
                            <input type="text" class="form-control" name="name_lang_<?= $language->id; ?>" placeholder="<?= "Kategori Adı"; ?>" maxlength="255" required>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label class="control-label"><?= "Slug"; ?>
                            <small>(<?= "Slug açıklaması"; ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug_lang" placeholder="<?= "Slug"; ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Başlık"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="title_meta_tag" placeholder="<?= "Başlık"; ?> (<?= "Meta Etiket"; ?>)" value="<?= old('title_meta_tag'); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <textarea class="form-control form-textarea" name="description" placeholder="<?= "Açıklama"; ?>"><?= old('description'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)" value="<?= old('keywords'); ?>">
                    </div>
                    <div class="form-group">
                        <label><?= "Sıra"; ?></label>
                        <input type="number" class="form-control" name="category_order" placeholder="<?= "Sıra"; ?>" value="<?= old('category_order'); ?>" min="1" max="99999" required>
                    </div>
                    <div class="form-group">
                        <label><?= "Ana Kategori"; ?></label>
                        <select class="form-control select2" name="category_id[]" onchange="getSubCategories(this.value, 1);" required>
                            <option value="0"><?= "Yok"; ?></option>
                            <?php if (!empty($parentCategories)):
                                foreach ($parentCategories as $parentCategory): ?>
                                    <option value="<?= $parentCategory->id; ?>"><?= getCategoryName($parentCategory, $activeLang->id); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                        <div id="category_select_container"></div>
                    </div>
                    <div class="form-group">
                        <label><?= "Görünürlük"; ?></label>
                        <?= formRadio('visibility', 1, 0, "Göster", "Gizle", 1); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Ana Menüde Göster"; ?></label>
                        <?= formRadio('show_on_main_menu', 1, 0, "Evet", "Hayır", 1); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Ana Menüde Resim Göster"; ?></label>
                        <?= formRadio('show_image_on_main_menu', 1, 0, "Evet", "Hayır", '0'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Kategori Sayfasında Açıklama Göster"; ?></label>
                        <?= formRadio('show_description', 1, 0, "Evet", "Hayır", '0'); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Resim"; ?></label>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?= "Resim Seç"; ?>
                                <input type="file" id="Multifileupload" name="file" size="40" accept=".jpg, .jpeg, .webp, .png, .gif">
                            </a>
                        </div>
                        <div id="MultidvPreview" class="image-preview"></div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Kategori Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>