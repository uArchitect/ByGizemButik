<?php include FCPATH . 'assets/vendor/tinymce/languages.php'; ?>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Dili Güncelle"; ?></h3>
            </div>
            <form action="<?= base_url('Language/editLanguagePost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= esc($language->id); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Dil Adı"; ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= "Dil Adı"; ?>" value="<?= esc($language->name); ?>" maxlength="200" required>
                        <small>(Ex: English)</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Kısa Form"; ?> </label>
                        <input type="text" class="form-control" name="short_form" placeholder="<?= "Kısa Form"; ?>" value="<?= esc($language->short_form); ?>" maxlength="200" required>
                        <small>(Ex: en)</small>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Dil Kodu"; ?> </label>
                        <input type="text" class="form-control" name="language_code" placeholder="<?= "Dil Kodu"; ?>" value="<?= esc($language->language_code); ?>" maxlength="200" required>
                        <small>(Ex: en_us)</small>
                    </div>
                    <div class="form-group">
                        <label><?= "Sıra"; ?></label>
                        <input type="number" class="form-control" name="language_order" placeholder="<?= "Sıra"; ?>" value="<?= esc($language->language_order); ?>" min="1" required>
                    </div>
                    <div class="form-group">
                        <label><?= "Metin Yönü"; ?></label>
                        <?= formRadio('text_direction', 'ltr', 'rtl', "Soldan Sağa", "Sağdan Sola", $language->text_direction); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Metin Editörü Dili"; ?></label>
                        <select name="text_editor_lang" class="form-control" required>
                            <option value=""><?= "Seç"; ?></option>
                            <?php if (!empty($edLangArray)):
                                foreach ($edLangArray as $edLang): ?>
                                    <option value="<?= $edLang['short']; ?>" <?= $edLang['short'] == $language->text_editor_lang ? 'selected' : ''; ?>><?= $edLang['name']; ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Bayrak"; ?></label>
                        <div class="display-block m-b-15">
                            <img src="<?= base_url($language->flag_path); ?>" alt=""/>
                        </div>
                        <div class="display-block">
                            <a class='btn btn-default btn-sm btn-file-upload'>
                                <i class="fa fa-image text-muted"></i>&nbsp;&nbsp;<?= "Resim Seç"; ?>
                                <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info-flag').html($(this).val().replace(/.*[\/\\]/, ''));">
                            </a>
                            <br>
                            <span class='label label-default label-file-upload' id="upload-file-info-flag"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('status', 1, 0, "Aktif", "Pasif", $language->status); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>