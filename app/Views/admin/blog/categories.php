<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Kategori Ekle"; ?></h3>
            </div>
            <form action="<?= base_url('Blog/addCategoryPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Dil"; ?></label>
                        <select name="lang_id" class="form-control">
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= selectedLangId() == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= "Kategori Adı"; ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= "Kategori Adı"; ?>" value="<?= old('name'); ?>" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Slug"; ?>
                            <small>(<?= "Slug açıklaması"; ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug" placeholder="<?= "Slug"; ?>" value="<?= old('slug'); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="description" placeholder="<?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)" value="<?= old('description'); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)" value="<?= old('keywords'); ?>">
                    </div>
                    <div class="form-group">
                        <label><?= "Sıra"; ?></label>
                        <input type="number" class="form-control" name="category_order" placeholder="<?= "Sıra"; ?>" value="1" min="1" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Kategori Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-7 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="pull-left">
                    <h3 class="box-title"><?= "Kategoriler"; ?></h3>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped cs_datatable_lang" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?= "ID"; ?></th>
                                    <th><?= "Kategori Adı"; ?></th>
                                    <th><?= "Dil"; ?></th>
                                    <th><?= "Sıra"; ?></th>
                                    <th class="th-options"><?= "Seçenekler"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($categories)):
                                    foreach ($categories as $item): ?>
                                        <tr>
                                            <td><?= esc($item->id); ?></td>
                                            <td><?= esc($item->name); ?></td>
                                            <td>
                                                <?php $language = getLanguage($item->lang_id);
                                                if (!empty($language)) {
                                                    echo $language->name;
                                                } ?>
                                            </td>
                                            <td><?= esc($item->category_order); ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?><span class="caret"></span></button>
                                                    <ul class="dropdown-menu options-dropdown">
                                                        <li><a href="<?= adminUrl('edit-blog-category/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Düzenle"; ?></a></li>
                                                        <li><a href="javascript:void(0)" onclick="deleteItem('Blog/deleteCategoryPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>