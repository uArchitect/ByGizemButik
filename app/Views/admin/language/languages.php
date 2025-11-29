<?php include FCPATH . 'assets/vendor/tinymce/languages.php'; ?>
<div class="row">
    <div class="col-sm-12 title-section">
        <h3>Dil Ayarları</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="pull-left">
                    <h3 class="box-title">Diller</h3>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="table-responsive">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped data_table" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="20">ID</th>
                                    <th>Dil Adı</th>
                                    <th>Varsayılan Dil</th>
                                    <th>Çeviri/Dışa Aktar</th>
                                    <th class="th-options">Seçenekler</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($languages)):
                                    foreach ($languages as $item): ?>
                                        <tr>
                                            <td><?= esc($item->id); ?></td>
                                            <td>
                                                <?= esc($item->name); ?>&nbsp;
                                                <?php if ($item->status == 1): ?>
                                                    <label class="label label-success lbl-lang-status">Aktif</label>
                                                <?php else: ?>
                                                    <label class="label label-danger lbl-lang-status">Pasif</label>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (defaultLangId() == $item->id): ?>
                                                    <label class="label label-default lbl-lang-status">Varsayılan</label>
                                                <?php else: ?>
                                                    <form action="<?= base_url('Language/setDefaultLanguagePost'); ?>" method="post" class="display-inline-block">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="site_lang" value="<?= $item->id; ?>">
                                                        <button type="submit" class="btn btn-sm btn-success float-right">
                                                            <i class="fa fa-check" aria-hidden="true"></i>&nbsp;&nbsp;Varsayılan Yap
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= adminUrl('edit-translations/' . $item->id . '?show=50'); ?>" class="btn btn-sm btn-info float-right">
                                                    <i class="fa fa-exchange"></i>&nbsp;&nbsp;<?= "Çevirileri Düzenle"; ?>
                                                </a>&nbsp;&nbsp;
                                                <form action="<?= base_url('Language/exportLanguagePost'); ?>" method="post" class="display-inline-block">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="lang_id" value="<?= $item->id; ?>">
                                                    <button type="submit" class="btn btn-sm btn-warning float-right">
                                                        <i class="fa fa-cloud-download" aria-hidden="true"></i>&nbsp;&nbsp;<?= "Dışa Aktar"; ?>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?><span class="caret"></span></button>
                                                    <ul class="dropdown-menu options-dropdown">
                                                        <li><a href="<?= adminUrl('edit-language/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Düzenle"; ?></a></li>
                                                        <li><a href="javascript:void(0)" onclick="deleteItem('Language/deleteLanguagePost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
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
    <div class="col-lg-6 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Dil Ekle"; ?></h3>
            </div>
            <form action="<?= base_url('Language/addLanguagePost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Dil Adı"; ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= "Dil Adı"; ?>" value="<?= old('name'); ?>" maxlength="200" required>
                        <small>(Ex: English)</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Kısa Form"; ?> </label>
                        <input type="text" class="form-control" name="short_form" placeholder="<?= "Kısa Form"; ?>" value="<?= old('short_form'); ?>" maxlength="200" required>
                        <small>(Ex: en)</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Dil Kodu"; ?> </label>
                        <input type="text" class="form-control" name="language_code" placeholder="<?= "Dil Kodu"; ?>" value="<?= old('language_code'); ?>" maxlength="200" required>
                        <small>(Ex: en-US)</small>
                    </div>
                    <div class="form-group">
                        <label><?= "Sıra"; ?></label>
                        <input type="number" class="form-control" name="language_order" placeholder="<?= "Sıra"; ?>" value="1" min="1" required>
                    </div>
                    <div class="form-group">
                        <label><?= "Metin Yönü"; ?></label>
                        <?= formRadio('text_direction', 'ltr', 'rtl', "Sol'dan Sağa", "Sağ'dan Sola", 'ltr'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Metin Editörü Dili"; ?></label>
                        <select name="text_editor_lang" class="form-control" required>
                            <option value=""><?= "Seç"; ?></option>
                            <?php if (!empty($edLangArray)):
                                foreach ($edLangArray as $edLang): ?>
                                    <option value="<?= $edLang['short']; ?>"><?= $edLang['name']; ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Bayrak"; ?></label>
                        <div class="display-block">
                            <a class='btn btn-default btn-sm btn-file-upload'>
                                <i class="fa fa-image text-muted"></i>&nbsp;&nbsp;<?= "Resim Seç"; ?>
                                <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info-flag').html($(this).val().replace(/.*[\/\\]/, ''));" required>
                            </a>
                            <br>
                            <span class='label label-default label-file-upload' id="upload-file-info-flag"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('status', 1, 0, "Aktif", "Pasif", '1'); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Dil Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box" style="max-width: 500px;">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Dil İçe Aktar"; ?></h3>
            </div>
            <form action="<?= base_url('Language/importLanguagePost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "JSON Dil Dosyası"; ?></label>
                        <div class="display-block">
                            <a class='btn btn-default btn-sm btn-file-upload'>
                                <i class="fa fa-file text-muted"></i>&nbsp;&nbsp;<?= "Dosya Seç"; ?>
                                <input type="file" name="file" size="40" accept=".json" required onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));">
                            </a>
                            <br>
                            <span class='label label-default label-file-upload' id="upload-file-info"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Bayrak"; ?></label>
                        <div class="display-block">
                            <a class='btn btn-default btn-sm btn-file-upload'>
                                <i class="fa fa-image text-muted"></i>&nbsp;&nbsp;<?= "Resim Seç"; ?>
                                <input type="file" name="flag" size="40" accept=".png, .jpg, .jpeg, .gif" required onchange="$('#upload-file-info-1').html($(this).val().replace(/.*[\/\\]/, ''));">
                            </a>
                        </div>
                        <span class='label label-default label-file-upload' id="upload-file-info-1"></span>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Dil İçe Aktar"; ?></button>
                </div>
            </form>
        </div>
        <div class="alert alert-info alert-large" style="width: auto !important;display: inline-block;max-width: 500px;">
            <?= "Diller"; ?>: <a href="https://codingest.net/languages" target="_blank" style="color: #0c5460;font-weight: bold">https://codingest.net/languages</a>
        </div>
    </div>
</div>