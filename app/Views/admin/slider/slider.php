<?php $animationArray = ['none', 'bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'wobble', 'jello', 'heartBeat', 'bounceIn', 'bounceInDown', 'bounceInLeft',
    'bounceInRight', 'bounceInUp', 'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig', 'flip',
    'flipInX', 'flipInY', 'lightSpeedIn', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'slideInUp', 'slideInDown', 'slideInLeft',
    'slideInRight', 'zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp', 'hinge', 'jackInTheBox', 'rollIn']; ?>
<div class="row">
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Öğesi Ekle</h3>
            </div>
            <form action="<?= base_url('Admin/addSliderItemPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label>Dil</label>
                        <select name="lang_id" class="form-control">
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= selectedLangId() == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Başlık</label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık" value="<?= old('title'); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Açıklama</label>
                        <textarea name="description" class="form-control" placeholder="Açıklama"><?= old('description'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Link</label>
                        <input type="text" class="form-control" name="link" placeholder="Link" value="<?= old('link'); ?>">
                    </div>
                    <div class="row row-form">
                        <div class="col-sm-12 col-md-6 col-form">
                            <div class="form-group">
                                <label class="control-label">Sıra</label>
                                <input type="number" class="form-control" name="item_order" placeholder="Sıra" value="<?= old('item_order'); ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-form">
                            <div class="form-group">
                                <label class="control-label">Buton Metni</label>
                                <input type="text" class="form-control" name="button_text" placeholder="Buton Metni" value="<?= old('button_text'); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row row-form">
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label class="control-label">Metin Rengi</label>
                                <input type="color" class="form-control" name="text_color" value="#ffffff">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label class="control-label">Buton Rengi</label>
                                <input type="color" class="form-control" name="button_color" value="#222222">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label class="control-label">Buton Metin Rengi</label>
                                <input type="color" class="form-control" name="button_text_color" value="#ffffff">
                            </div>
                        </div>
                    </div>
                    <div class="row row-form">
                        <div class="col-sm-12" style="padding-left: 7.5px;">
                            <label>Animasyonlar</label>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label>Başlık</label>
                                <select name="animation_title" class="form-control">
                                    <?php foreach ($animationArray as $animation): ?>
                                        <option value="<?= $animation; ?>" <?= $animation == 'fadeInUp' ? 'selected' : ''; ?>><?= $animation; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label>Açıklama</label>
                                <select name="animation_description" class="form-control">
                                    <?php foreach ($animationArray as $animation): ?>
                                        <option value="<?= $animation; ?>" <?= $animation == 'fadeInUp' ? 'selected' : ''; ?>><?= $animation; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label>Buton</label>
                                <select name="animation_button" class="form-control">
                                    <?php foreach ($animationArray as $animation): ?>
                                        <option value="<?= $animation; ?>" <?= $animation == 'fadeInUp' ? 'selected' : ''; ?>><?= $animation; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Resim (1920x600)</label>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                Resim Seç
                                <input type="file" name="file" size="40" accept=".jpg, .jpeg, .webp, .png, .gif" required onchange="showPreviewImage(this);">
                            </a>
                        </div>
                        <img src="<?= IMG_BASE64_1x1; ?>" id="img_preview_file" class="img-file-upload-preview">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Resim&nbsp;(mobil için) (768x500)</label>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                Resim Seç
                                <input type="file" name="file_mobile" size="40" accept=".jpg, .jpeg, .webp, .png, .gif" required onchange="showPreviewImage(this);">
                            </a>
                        </div>
                        <img src="<?= IMG_BASE64_1x1; ?>" id="img_preview_file_mobile" class="img-file-upload-preview">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Slider Öğesi Ekle</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-7 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Öğeleri</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped cs_datatable_lang" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th width="20">ID</th>
                                    <th>Resim</th>
                                    <th>Dil</th>
                                    <th>Sıra</th>
                                    <th class="th-options">Seçenekler</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($sliderItems)):
                                    foreach ($sliderItems as $item): ?>
                                        <tr>
                                            <td><?= esc($item->id); ?></td>
                                            <td><img src="<?= base_url($item->image); ?>" alt="" style="width: 200px;"/></td>
                                            <td>
                                                <?php $language = getLanguage($item->lang_id);
                                                if (!empty($language)) {
                                                    echo $language->name;
                                                } ?>
                                            </td>
                                            <td><?= $item->item_order; ?></td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown">Seçenek Seç<span class="caret"></span></button>
                                                    <ul class="dropdown-menu options-dropdown">
                                                        <li><a href="<?= adminUrl('edit-slider-item/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i>Düzenle</a></li>
                                                        <li><a href="javascript:void(0)" onclick="deleteItem('Admin/deleteSliderItemPost','<?= $item->id; ?>','Bu slider öğesini silmek istediğinizden emin misiniz?');"><i class="fa fa-trash option-icon"></i>Sil</a></li>
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
    <div class="col-lg-5 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Slider Ayarları</h3>
            </div>
            <form action="<?= base_url('Admin/editSliderSettingsPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label>Durum</label>
                        <?= formRadio('slider_status', 1, 0, "Etkinleştir", "Devre Dışı Bırak", $generalSettings->slider_status); ?>
                    </div>
                    <div class="form-group">
                        <label>Tip</label>
                        <?= formRadio('slider_type', 'full_width', 'boxed', "Tam Genişlik", "Kutulu", $generalSettings->slider_type); ?>
                    </div>
                    <div class="form-group">
                        <label>Efekt</label>
                        <?= formRadio('slider_effect', 'fade', 'slide', "Soluk", "Kaydır", $generalSettings->slider_effect); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Değişiklikleri Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>