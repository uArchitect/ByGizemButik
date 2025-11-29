<?php $animationArray = ['none', 'bounce', 'flash', 'pulse', 'rubberBand', 'shake', 'swing', 'tada', 'wobble', 'jello', 'heartBeat', 'bounceIn', 'bounceInDown', 'bounceInLeft',
    'bounceInRight', 'bounceInUp', 'fadeIn', 'fadeInDown', 'fadeInDownBig', 'fadeInLeft', 'fadeInLeftBig', 'fadeInRight', 'fadeInRightBig', 'fadeInUp', 'fadeInUpBig', 'flip',
    'flipInX', 'flipInY', 'lightSpeedIn', 'rotateIn', 'rotateInDownLeft', 'rotateInDownRight', 'rotateInUpLeft', 'rotateInUpRight', 'slideInUp', 'slideInDown', 'slideInLeft',
    'slideInRight', 'zoomIn', 'zoomInDown', 'zoomInLeft', 'zoomInRight', 'zoomInUp', 'hinge', 'jackInTheBox', 'rollIn']; ?>
<div class="row">
    <div class="col-lg-7 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title">Slider Öğesini Güncelle</h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('slider'); ?>" class="btn btn-success btn-add-new"><i class="fa fa-bars"></i>Slider</a>
                </div>
            </div>
            <form action="<?= base_url('Admin/editSliderItemPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $item->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label>Dil</label>
                        <select name="lang_id" class="form-control">
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= $item->lang_id == $language->id ? 'selected' : ''; ?>><?= $language->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Başlık</label>
                        <input type="text" class="form-control" name="title" placeholder="Başlık" value="<?= esc($item->title); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Açıklama</label>
                        <textarea name="description" class="form-control" placeholder="Açıklama"><?= esc($item->description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Link</label>
                        <input type="text" class="form-control" name="link" placeholder="Link" value="<?= $item->link; ?>">
                    </div>

                    <div class="row row-form">
                        <div class="col-sm-12 col-md-6 col-form">
                            <div class="form-group">
                                <label class="control-label">Sıra</label>
                                <input type="number" class="form-control" name="item_order" placeholder="Sıra" value="<?= $item->item_order; ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-form">
                            <div class="form-group">
                                <label class="control-label">Buton Metni</label>
                                <input type="text" class="form-control" name="button_text" placeholder="Buton Metni" value="<?= esc($item->button_text); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row row-form">
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label class="control-label">Metin Rengi</label>
                                <input type="color" class="form-control" name="text_color" value="<?= esc($item->text_color); ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label class="control-label">Buton Rengi</label>
                                <input type="color" class="form-control" name="button_color" value="<?= esc($item->button_color); ?>">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label class="control-label">Buton Metin Rengi</label>
                                <input type="color" class="form-control" name="button_text_color" value="<?= esc($item->button_text_color); ?>">
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
                                        <option value="<?= $animation; ?>" <?= $item->animation_title == $animation ? 'selected' : ''; ?>><?= $animation; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label>Açıklama</label>
                                <select name="animation_description" class="form-control">
                                    <?php foreach ($animationArray as $animation): ?>
                                        <option value="<?= $animation; ?>" <?= $item->animation_description == $animation ? 'selected' : ''; ?>><?= $animation; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-form">
                            <div class="form-group">
                                <label>Buton</label>
                                <select name="animation_button" class="form-control">
                                    <?php foreach ($animationArray as $animation): ?>
                                        <option value="<?= $animation; ?>" <?= $item->animation_button == $animation ? 'selected' : ''; ?>><?= $animation; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Resim (1920x600)</label>
                        <div class="display-block m-b-15">
                            <img src="<?= base_url($item->image); ?>" alt="" class="img-responsive" style="max-width: 300px; max-height: 300px;">
                        </div>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                Resim Seç
                                <input type="file" name="file" accept=".jpg, .jpeg, .webp, .png, .gif" onchange="showPreviewImage(this);">
                            </a>
                        </div>
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" id="img_preview_file" class="img-file-upload-preview">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Resim&nbsp;(for mobile) (768x500)</label>
                        <div class="display-block m-b-15">
                            <img src="<?= base_url($item->image_mobile); ?>" alt="" class="img-responsive" style="max-width: 300px; max-height: 300px;">
                        </div>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                Resim Seç
                                <input type="file" name="file_mobile" accept=".jpg, .jpeg, .webp, .png, .gif" onchange="showPreviewImage(this);">
                            </a>
                        </div>
                        <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" id="img_preview_file_mobile" class="img-file-upload-preview">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right">Değişiklikleri Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>