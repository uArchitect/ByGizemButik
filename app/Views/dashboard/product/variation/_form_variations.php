<div class="modal fade" id="addVariationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-custom modal-variation" role="document">
        <div class="modal-content">
            <form id="form_add_product_variation" novalidate>
                <input type="hidden" name="product_id" value="<?= $product->id; ?>">
                <div class="modal-header">
                    <h5 class="modal-title"><?= "Varyasyon Ekle"; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12 tab-variation">
                            <div class="form-group m-b-10">
                                <label class="control-label"><?= 'Etiket'; ?></label>
                                <?php foreach ($activeLanguages as $language): ?>
                                    <?php if ($language->id == selectedLangId()): ?>
                                        <input type="text" id="input_variation_label" class="form-control form-input input-variation-label" name="label_lang_<?= $language->id; ?>" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                                    <?php else: ?>
                                        <input type="text" class="form-control form-input input-variation-label" name="label_lang_<?= $language->id; ?>" placeholder="<?= esc($language->name) . ' (' . "İsteğe Bağlı" . ')'; ?>" maxlength="255">
                                    <?php endif;
                                endforeach; ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= 'Varyasyon Tipi'; ?></label>
                                <select name="variation_type" class="form-control custom-select" onchange="showHideFormOptionImages(this.value);" required>
                                    <option value="radio_button"><?= 'Radyo Butonu'; ?></option>
                                    <option value="dropdown"><?= 'Açılır Menü'; ?></option>
                                    <option value="checkbox"><?= 'Onay Kutusu'; ?></option>
                                    <option value="text" checked><?= 'Metin'; ?></option>
                                    <option value="number"><?= 'Sayı'; ?></option>
                                </select>
                            </div>
                            <div class="form-group display-none form-group-parent-variation">
                                <label class="control-label"><?= "Ana Varyasyon"; ?></label>
                                <select name="parent_id" class="form-control custom-select">
                                    <option value=""><?= "Yok"; ?></option>
                                    <?php if (!empty($productVariations)):
                                        foreach ($productVariations as $variation):
                                            if ($variation->variation_type == 'dropdown'): ?>
                                                <option value="<?= $variation->id; ?>"><?= $variation->id . ' - ' . esc(getVariationLabel($variation->label_names, selectedLangId())) . ' - ' . $variation->variation_type; ?></option>
                                            <?php endif;
                                        endforeach;
                                    endif; ?>
                                </select>
                            </div>
                            <div class="form-group m-0 form-group-display-type">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label"><?= "Seçenek görüntüleme tipi"; ?></label>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="option_display_type" value="text" id="option_display_type_1" class="custom-control-input" checked>
                                            <label for="option_display_type_1" class="custom-control-label"><?= 'Metin'; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="option_display_type" value="image" id="option_display_type_2" class="custom-control-input">
                                            <label for="option_display_type_2" class="custom-control-label"><?= "Resim"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="option_display_type" value="color" id="option_display_type_3" class="custom-control-input">
                                            <label for="option_display_type_3" class="custom-control-label"><?= "Renk"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-group-show-option-images">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label"><?= "Seçenek resimlerini kaydırıcıda göster"; ?></label>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="show_images_on_slider" value="1" id="show_images_on_slider_when_selected_1" class="custom-control-input">
                                            <label for="show_images_on_slider_when_selected_1" class="custom-control-label"><?= "Evet"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="show_images_on_slider" value="0" id="show_images_on_slider_when_selected_2" class="custom-control-input" checked>
                                            <label for="show_images_on_slider_when_selected_2" class="custom-control-label"><?= "Hayır"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if (empty(isVariationsUseDifferentPrice($product->id)) && $product->listing_type != 'bidding'): ?>
                                <div class="form-group form-group-show-option-images">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label"><?= "Seçenekler için farklı fiyat kullan"; ?></label>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="use_different_price" value="1" id="use_different_price_1" class="custom-control-input">
                                                <label for="use_different_price_1" class="custom-control-label"><?= "Evet"; ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="use_different_price" value="0" id="use_different_price_2" class="custom-control-input" checked>
                                                <label for="use_different_price_2" class="custom-control-label"><?= "Hayır"; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="form-group m-0">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label"><?= "Görünür"; ?></label>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="is_visible" value="1" id="edit_visible_1" class="custom-control-input" checked>
                                            <label for="edit_visible_1" class="custom-control-label"><?= "Evet"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="is_visible" value="0" id="edit_visible_2" class="custom-control-input">
                                            <label for="edit_visible_2" class="custom-control-label"><?= "Hayır"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success btn-variation float-right"><?= "Varyasyon Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editVariationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-custom modal-variation" role="document">
        <div class="modal-content">
            <form id="form_edit_product_variation" novalidate>
                <div id="response_product_variation_edit"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addVariationOptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-custom modal-variation" role="document">
        <div class="modal-content">
            <div id="response_product_add_variation_option"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewVariationOptionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-custom modal-variation modal-variation-options" role="document">
        <div class="modal-content">
            <div id="response_product_variation_options_edit"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="editVariationOptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-custom modal-variation" role="document">
        <div class="modal-content">
            <div id="response_product_edit_variation_option"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="variationModalSelect" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-custom modal-variation" role="document">
        <div class="modal-content">
            <form id="form_select_product_variation" novalidate>
                <div class="modal-header">
                    <h5 class="modal-title"><?= "Oluşturulan Varyasyonlar"; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php if (empty($userVariations)): ?>
                        <p class="text-center m-t-20"><?= "Oluşturulan varyasyon yok mesajı"; ?></p>
                    <?php else: ?>
                        <input type="hidden" name="product_id" value="<?= $product->id; ?>">
                        <div class="form-group">
                            <label class="control-label"><?= "Varyasyon Seç"; ?></label>
                            <select name="variation_id" class="form-control custom-select" required>
                                <?php foreach ($userVariations as $userVariation):
                                    if ($userVariation->insert_type == 'new'): ?>
                                        <option value="<?= $userVariation->id; ?>"><?= $userVariation->id . ' - ' . esc(getVariationLabel($userVariation->label_names, selectedLangId())) . ' - ' . $userVariation->variation_type . ' - ' . "Seçenek görüntüleme tipi" . ": " . $userVariation->option_display_type; ?></option>
                                    <?php endif;
                                endforeach; ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <?php if (!empty($userVariations)): ?>
                        <button type="submit" class="btn btn-md btn-success btn-variation"><?= "Seç"; ?></button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view("dashboard/product/variation/_js_variations"); ?>