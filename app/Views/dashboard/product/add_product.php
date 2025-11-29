<div class="row">
    <div class="col-sm-12">
        <div class="wizard-product">
            <h1 class="product-form-title"><?= esc($title); ?></h1>
            <div class="row">
                <div class="col-md-12 wizard-add-product">
                    <ul class="wizard-progress">
                        <li class="active" id="step_general"><strong><?= "Genel Bilgiler"; ?></strong></li>
                        <li id="step_dedails"><strong><?= "Detaylar"; ?></strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-add-product">
            <div class="box-body">
                <div class="alert-message-lg">
                    <?= view('dashboard/includes/_messages'); ?>
                </div>
                <div class="row">
                    <div class="col-sm-12 clearfix m-b-30">
                        <label class="control-label"><?= "Resimler"; ?></label>
                        <?= view('dashboard/product/_image_upload'); ?>
                    </div>
                </div>
                <form action="<?= base_url('add-product-post'); ?>" method="post" id="form_validate">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="back_url" value="<?= getCurrentUrl(); ?>">
                    <div class="form-group">
                        <label class="control-label"><?= 'Ürün Tipi'; ?></label>
                        <div class="row">
                            <?php if ($generalSettings->physical_products_system == 1): ?>
                                <div class="col-12 col-sm-6 col-custom-field">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="product_type" value="physical" id="product_type_1" class="custom-control-input" required <?= $generalSettings->digital_products_system != 1 ? 'checked' : ''; ?>>
                                        <label for="product_type_1" class="custom-control-label"><?= 'Fiziksel'; ?></label>
                                        <p class="form-element-exp"><?= "Fiziksel açıklama"; ?></p>
                                    </div>
                                </div>
                            <?php endif;
                            if ($generalSettings->digital_products_system == 1): ?>
                                <div class="col-12 col-sm-6 col-custom-field">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="product_type" value="digital" id="product_type_2" class="custom-control-input" required <?= $generalSettings->physical_products_system != 1 ? 'checked' : ''; ?>>
                                        <label for="product_type_2" class="custom-control-label"><?= 'Dijital'; ?></label>
                                        <p class="form-element-exp"><?= "Dijital açıklama"; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= 'İlan Tipi'; ?></label>
                        <div class="row">
                            <?php if ($generalSettings->marketplace_system == 1): ?>
                                <div class="col-12 col-sm-6 col-custom-field listing_sell_on_site">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="listing_type" value="sell_on_site" id="listing_type_1" class="custom-control-input" required>
                                        <label for="listing_type_1" class="custom-control-label"><?= "Satış için ürün ekle"; ?></label><br>
                                        <p class="form-element-exp"><?= "Satış için ürün ekleme açıklaması"; ?></p>
                                    </div>
                                </div>
                            <?php endif;
                            if ($generalSettings->classified_ads_system == 1 && $generalSettings->physical_products_system == 1): ?>
                                <div class="col-12 col-sm-6 col-custom-field listing_ordinary_listing">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="listing_type" value="ordinary_listing" id="listing_type_2" class="custom-control-input" required>
                                        <label for="listing_type_2" class="custom-control-label"><?= "Ürün hizmetleri listesi ekle"; ?></label>
                                        <p class="form-element-exp"><?= "Ürün hizmetleri listesi ekleme açıklaması"; ?></p>
                                    </div>
                                </div>
                            <?php endif;
                            if ($generalSettings->bidding_system == 1 && $generalSettings->physical_products_system == 1): ?>
                                <div class="col-12 col-sm-6 col-custom-field listing_bidding">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="listing_type" value="bidding" id="listing_type_3" class="custom-control-input" required>
                                        <label for="listing_type_3" class="custom-control-label"><?= "Ürün fiyat talepleri ekle"; ?></label>
                                        <p class="form-element-exp"><?= "Ürün fiyat talepleri ekleme açıklaması"; ?></p>
                                    </div>
                                </div>
                            <?php endif;
                            if ($generalSettings->digital_products_system == 1 && $generalSettings->selling_license_keys_system == 1): ?>
                                <div class="col-12 col-sm-6 col-custom-field listing_license_keys">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="listing_type" value="license_key" id="listing_type_4" class="custom-control-input" required>
                                        <label for="listing_type_4" class="custom-control-label"><?= "Lisans anahtarları satış ürünü ekle"; ?></label>
                                        <p class="form-element-exp"><?= "Lisans anahtarları satış ürünü ekleme açıklaması"; ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group form-group-category">
                        <label class="control-label"><?= "Kategori"; ?></label>
                        <select id="categories" name="category_id[]" class="select2 form-control subcategory-select m-0" onchange="getSubCategoriesDashboard(this.value, 1, <?= selectedLangId(); ?>);" required>
                            <option value=""><?= "Kategori Seç"; ?></option>
                            <?php if (!empty($parentCategories)):
                                foreach ($parentCategories as $item): ?>
                                    <option value="<?= esc($item->id); ?>"><?= getCategoryName($item, $activeLang->id); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                        <div id="category_select_container"></div>
                    </div>

                    <div class="panel-group panel-group-product">
                        <?php $languages = array();
                        array_push($languages, $activeLang);
                        if (!empty($activeLanguages)):
                            foreach ($activeLanguages as $language):
                                if (!empty($language->id != selectedLangId())) {
                                    array_push($languages, $language);
                                }
                            endforeach;
                        endif;
                        if (!empty($languages)):
                            foreach ($languages as $language):?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" href="#collapse_<?= $language->id; ?>"><?= "Detaylar"; ?><?= $activeLanguages > 1 ? ':&nbsp;' . esc($language->name) : ''; ?>&nbsp;<?= selectedLangId() != $language->id ? '(' . "İsteğe Bağlı" . ')' : ''; ?><i class="fa fa-caret-down pull-right"></i></a>
                                        </h4>
                                    </div>
                                    <div id="collapse_<?= $language->id; ?>" class="panel-collapse collapse <?= selectedLangId() == $language->id ? 'in' : ''; ?>">
                                        <div class="panel-body">
                                            <div class="form-group m-b-15">
                                                <label class="control-label"><?= "Başlık"; ?></label>
                                                <input type="text" name="title_<?= $language->id; ?>" class="form-control form-input" placeholder="<?= "Başlık"; ?>" <?= selectedLangId() == $language->id ? 'required' : ''; ?> maxlength="499">
                                            </div>
                                            <div class="form-group m-b-15">
                                                <label class="control-label"><?= "Kısa Açıklama"; ?></label>
                                                <input type="text" name="short_description_<?= $language->id; ?>" class="form-control form-input" placeholder="<?= "Kısa Açıklama"; ?>" maxlength="499">
                                            </div>
                                            <div class="form-group m-b-15">
                                                <label class="control-label"><?= "Etiketler"; ?>&nbsp;<small>(<?= "Ürün etiketleri açıklaması"; ?>)</small></label>
                                                <input type="text" name="tags_<?= $language->id; ?>" value="" class="tags-input form-control" placeholder="<?= "Etiket yazın"; ?>">
                                            </div>
                                            <div class="form-group m-b-15">
                                                <label class="control-label"><?= "Açıklama"; ?></label>
                                                <div class="row">
                                                    <div class="col-sm-12 m-b-5">
                                                        <button type="button" id="btn_add_image_editor" class="btn btn-sm btn-info" data-editor-id="editor_<?= $language->id; ?>" data-toggle="modal" data-target="#fileManagerModal"><i class="icon-image"></i>&nbsp;&nbsp;<?= "Resim Ekle"; ?></button>
                                                    </div>
                                                </div>
                                                <textarea name="description_<?= $language->id; ?>" id="editor_<?= $language->id; ?>" class="tinyMCE text-editor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;
                        endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 m-t-30 buttons-product-form">
                            <button type="submit" class="btn btn-lg btn-success pull-right"><i class="fa fa-check"></i>&nbsp;&nbsp;<?= "Kaydet ve Devam Et"; ?></button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="fileManagerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-file-manager" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= "Resimler"; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="file-manager">
                    <div class="file-manager-left">
                        <div class="dm-uploader-container">
                            <div id="drag-and-drop-zone-file-manager" class="dm-uploader text-center">
                                <p class="file-manager-file-types">
                                    <span>JPG</span>
                                    <span>JPEG</span>
                                    <span>PNG</span>
                                </p>
                                <p class="dm-upload-icon">
                                    <i class="icon-upload"></i>
                                </p>
                                <p class="dm-upload-text"><?= "Resimleri buraya sürükleyip bırakın"; ?></p>
                                <p class="text-center">
                                    <button class="btn btn-default btn-browse-files"><?= "Dosyalara Göz At"; ?></button>
                                </p>
                                <a class='btn btn-md dm-btn-select-files'>
                                    <input type="file" name="file" size="40" multiple="multiple">
                                </a>
                                <ul class="dm-uploaded-files" id="files-file-manager"></ul>
                                <button type="button" id="btn_reset_upload_image" class="btn btn-reset-upload"><?= "Sıfırla"; ?></button>
                            </div>
                        </div>
                    </div>
                    <div class="file-manager-right">
                        <div class="file-manager-content">
                            <div id="ckimage_file_upload_response">
                                <?php if (!empty($fileManagerImages)):
                                    foreach ($fileManagerImages as $image): ?>
                                        <div class="col-file-manager" id="fm_img_col_id_<?= $image->id; ?>">
                                            <div class="file-box" data-file-id="<?= $image->id; ?>" data-file-path="<?= getFileManagerImageUrl($image); ?>">
                                                <div class="image-container">
                                                    <img src="<?= getFileManagerImageUrl($image); ?>" alt="" class="img-responsive">
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                endif; ?>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="selected_fm_img_file_id">
                    <input type="hidden" id="selected_fm_img_file_path">
                </div>
            </div>
            <div class="modal-footer">
                <div class="file-manager-footer">
                    <button type="button" id="btn_fm_img_delete" class="btn btn-sm btn-danger color-white pull-left btn-file-delete m-r-3"><i class="icon-trash"></i>&nbsp;&nbsp;<?= "Sil"; ?></button>
                    <button type="button" id="btn_fm_img_select" class="btn btn-sm btn-info color-white btn-file-select"><i class="icon-check"></i>&nbsp;&nbsp;<?= "Resim Seç"; ?></button>
                    <button type="button" class="btn btn-sm btn-secondary color-white" data-dismiss="modal"><?= "Kapat"; ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= view('dashboard/product/_product_part'); ?>