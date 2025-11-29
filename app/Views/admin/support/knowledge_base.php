<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= "Bilgi Bankası"; ?></h3>
    </div>
</div>
<div class="form-group">
    <label><?= "Dil"; ?></label>
    <select name="lang_id" class="form-control" onchange="window.location.href = '<?= adminUrl(); ?>/knowledge-base?lang='+this.value;" style="max-width: 600px;">
        <?php foreach ($activeLanguages as $language): ?>
            <option value="<?= $language->id; ?>" <?= $language->id == $langId ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "İçerikler"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('knowledge-base/add-content?lang=' . $langId); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;<?= "İçerik Ekle"; ?>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped data_table" role="grid">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?= "ID"; ?></th>
                                    <th><?= "Başlık"; ?></th>
                                    <th><?= "Dil"; ?></th>
                                    <th><?= "Kategori"; ?></th>
                                    <th><?= "Tarih"; ?></th>
                                    <th class="th-options"><?= "Seçenekler"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($contents)):
                                    foreach ($contents as $item): ?>
                                        <tr>
                                            <td><?= esc($item->id); ?></td>
                                            <td><?= esc($item->title); ?></td>
                                            <td>
                                                <?php $language = getLanguage($item->lang_id);
                                                if (!empty($language)) {
                                                    echo esc($language->name);
                                                } ?>
                                            </td>
                                            <td><?= esc($item->category_name); ?></td>
                                            <td><?= formatDate($item->created_at); ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?><span class="caret"></span></button>
                                                    <ul class="dropdown-menu options-dropdown">
                                                        <li><a href="<?= adminUrl('knowledge-base/edit-content/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Düzenle"; ?></a></li>
                                                        <li><a href="javascript:void(0)" onclick="deleteItem('SupportAdmin/deleteContentPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
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

<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Kategoriler"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('knowledge-base/add-category?lang=' . $langId); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;<?= "Kategori Ekle"; ?>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped data_table" role="grid">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?= "ID"; ?></th>
                                    <th><?= "Başlık"; ?></th>
                                    <th><?= "Dil"; ?></th>
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
                                                    echo esc($language->name);
                                                } ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?><span class="caret"></span></button>
                                                    <ul class="dropdown-menu options-dropdown">
                                                        <li><a href="<?= adminUrl('knowledge-base/edit-category/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Düzenle"; ?></a></li>
                                                        <li><a href="javascript:void(0)" onclick="deleteItem('SupportAdmin/deleteCategoryPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
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