<div class="form-box">
    <div class="form-box-head">
        <h4 class="title">
            <?= "Lisans Anahtarları"; ?><br>
            <small><?= "Lisans anahtarları sistemi açıklaması"; ?></small>
        </h4>
    </div>
    <div class="form-box-body">
        <button type="button" class="btn btn-md btn-info" data-toggle="modal" data-target="#addLicenseKeysModal"><?= "Lisans Anahtarları Ekle"; ?></button>
        <button type="button" class="btn btn-md btn-secondary" data-toggle="modal" data-target="#viewLicenseKeysModal"><?= "Lisans Anahtarlarını Görüntüle"; ?></button>
    </div>
</div>
<div class="modal fade" id="addLicenseKeysModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= "Lisans Anahtarları Ekle"; ?></h5>
                <p class="modal-title-exp"><?= "Lisans anahtarları ekleme açıklaması"; ?></p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="result-add-license-keys"></div>
                <div class="form-group">
                    <textarea name="license_keys" id="textarea_license_keys" class="form-control form-textarea" placeholder="<?= "Lisans Anahtarları"; ?>"></textarea>
                </div>
                <div class="form-group m-0">
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <label class="control-label-small"><?= "Tekrarlanan lisans anahtarlarına izin ver"; ?></label>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="allow_duplicate_license_keys" value="1" id="allow_duplicate_1" class="custom-control-input">
                                <label for="allow_duplicate_1" class="custom-control-label"><?= "Evet"; ?></label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="custom-control custom-radio">
                                <input type="radio" name="allow_duplicate_license_keys" value="0" id="allow_duplicate_2" class="custom-control-input" checked>
                                <label for="allow_duplicate_2" class="custom-control-label"><?= "Hayır"; ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="loader-license-keys">
                        <div class="spinner">
                            <div class="bounce1"></div>
                            <div class="bounce2"></div>
                            <div class="bounce3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-success btn-add-license-keys" onclick="addLicenseKeys('<?= $product->id; ?>');"><?= "Lisans Anahtarları Ekle"; ?></button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewLicenseKeysModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-custom modal-variation" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= "Lisans Anahtarları"; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-close"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="license_key_list_product_id" value="<?= $product->id; ?>">
                <div id="response_license_key" class="modal-license-key-list">
                    <?= view("dashboard/product/license/_license_keys_list", ['product' => $product, 'licenseKeys' => $licenseKeys]); ?>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
