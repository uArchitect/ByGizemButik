<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title">Sayfalar</h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('add-page'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Sayfa Ekle
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped cs_datatable_lang" role="grid">
                        <thead>
                        <tr role="row">
                            <th width="20">ID</th>
                            <th>Başlık</th>
                            <th>Dil</th>
                            <th>Konum</th>
                            <th>Görünürlük</th>
                            <th>Sayfa Tipi</th>
                            <th>Tarih</th>
                            <th class="th-options">Seçenekler</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($pages)):
                            foreach ($pages as $item): ?>
                                <tr>
                                    <td><?= esc($item->id); ?></td>
                                    <td><?= esc($item->title); ?></td>
                                    <td><?php
                                        $language = getLanguage($item->lang_id);
                                        if (!empty($language)) {
                                            echo $language->name;
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($item->location == 'top_menu') {
                                            echo "Üst Menü";
                                        } elseif ($item->location == 'footer_bottom') {
                                            echo "Footer Alt";
                                        } else {
                                            echo "Footer " . ucfirst($item->location);
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if ($item->visibility == 1): ?>
                                            <label class="label label-success"><i class="fa fa-eye"></i></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><i class="fa fa-eye"></i></label>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($item->is_custom == 1): ?>
                                            <label class="label bg-teal"><?= "Özel"; ?></label>
                                        <?php else: ?>
                                            <label class="label label-default"><?= "Varsayılan"; ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= formatDate($item->created_at); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li><a href="<?= adminUrl('edit-page/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Düzenle"; ?></a></li>
                                                <?php if ($item->is_custom == 1): ?>
                                                    <li><a href="javascript:void(0)" onclick="deleteItem('Admin/deletePagePost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
                                                <?php endif; ?>
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