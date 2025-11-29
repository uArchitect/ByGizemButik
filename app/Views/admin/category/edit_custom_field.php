<div class="row">
    <div class="col-sm-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Özel Alanı Güncelle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('custom-fields'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Özel Alanlar"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Category/editCustomFieldPost'); ?>" method="post" onkeypress="return event.keyCode != 13;">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $field->id; ?>">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><?= "Alan Adı"; ?></label>
                                <?php foreach ($activeLanguages as $language): ?>
                                    <input type="text" class="form-control m-b-5" name="name_lang_<?= $language->id; ?>" value="<?= parseSerializedNameArray($field->name_array, $language->id, false); ?>" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                                <?php endforeach; ?>
                            </div>

                            <div class="form-group">
                                <label><?= "Filtre Anahtarı"; ?> <small>(<?= "Filtre anahtarı açıklaması"; ?>)</small></label>
                                <input type="text" class="form-control" name="product_filter_key" placeholder="<?= "Alan Adı"; ?>" value="<?= esc($field->product_filter_key); ?>" maxlength="255" required>
                            </div>
                            <div class="form-group">
                                <label><?= "Satır Genişliği"; ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="row_width" value="half" id="row_width_1" class="custom-control-input" <?= $field->row_width == 'half' ? 'checked' : ''; ?>>
                                            <label for="row_width_1" class="custom-control-label"><?= "Yarım Genişlik"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="row_width" value="full" id="row_width_2" class="custom-control-input" <?= $field->row_width != 'half' ? 'checked' : ''; ?>>
                                            <label for="row_width_2" class="custom-control-label"><?= "Tam Genişlik"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= "Gerekli"; ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="is_required" value="1" id="is_required_1" class="custom-control-input" <?= $field->is_required == 1 ? 'checked' : ''; ?>>
                                            <label for="is_required_1" class="custom-control-label"><?= "Evet"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="is_required" value="0" id="is_required_2" class="custom-control-input" <?= $field->is_required != 1 ? 'checked' : ''; ?>>
                                            <label for="is_required_2" class="custom-control-label"><?= "Hayır"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= "Nerede Gösterilecek"; ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="where_to_display" value="2" id="where_to_display_1" class="custom-control-input" <?= $field->where_to_display != 1 ? 'checked' : ''; ?>>
                                            <label for="where_to_display_1" class="custom-control-label"><?= "Ek Bilgiler"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="where_to_display" value="1" id="where_to_display_2" class="custom-control-input" <?= $field->where_to_display == 1 ? 'checked' : ''; ?>>
                                            <label for="where_to_display_2" class="custom-control-label"><?= "Ürün Detayları"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= "Durum"; ?></label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="status" value="1" id="status_1" class="custom-control-input" <?= $field->status == 1 ? 'checked' : ''; ?>>
                                            <label for="status_1" class="custom-control-label"><?= "Aktif"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="status" value="0" id="status_2" class="custom-control-input" <?= $field->status != 1 ? 'checked' : ''; ?>>
                                            <label for="status_2" class="custom-control-label"><?= "Pasif"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= "Sıra"; ?></label>
                                <input type="number" class="form-control" name="field_order" placeholder="<?= "Sıra"; ?>" value="<?= esc($field->field_order); ?>" min="1" max="99999" required>
                            </div>
                            <div class="form-group">
                                <label><?= "Tür"; ?></label>
                                <select class="form-control" name="field_type">
                                    <option value="text" <?= $field->field_type == 'text' ? 'selected' : ''; ?>><?= "Metin"; ?></option>
                                    <option value="textarea" <?= $field->field_type == 'textarea' ? 'selected' : ''; ?>><?= "Metin Alanı"; ?></option>
                                    <option value="number" <?= $field->field_type == 'number' ? 'selected' : ''; ?>><?= "Sayı"; ?></option>
                                    <option value="checkbox" <?= $field->field_type == 'checkbox' ? 'selected' : ''; ?>><?= "Onay Kutusu"; ?></option>
                                    <option value="radio_button" <?= $field->field_type == 'radio_button' ? 'selected' : ''; ?>><?= "Radyo Butonu"; ?></option>
                                    <option value="dropdown" <?= $field->field_type == 'dropdown' ? 'selected' : ''; ?>><?= "Açılır Liste"; ?></option>
                                    <option value="date" <?= $field->field_type == 'date' ? 'selected' : ''; ?>><?= "Tarih"; ?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                    <a href="<?= adminUrl('custom-field-options/' . $field->id); ?>" class="btn btn-warning pull-right m-r-5"><i class="fa fa-list"></i>&nbsp;&nbsp;<?= "Seçenekleri Düzenle"; ?></a>
                </div>
            </form>
        </div>
    </div>
</div>