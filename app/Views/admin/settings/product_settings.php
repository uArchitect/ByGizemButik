<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= "Ürün Ayarları"; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Marketplace"; ?><br><small><?= "Satış için ürün ekle"; ?></small></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= "SKU"; ?></label>
                        <?= formCheckbox('marketplace_sku', 1, "Etkin", $productSettings->marketplace_sku); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Varyasyonlar"; ?></label>
                        <?= formCheckbox('marketplace_variations', 1, "Etkin", $productSettings->marketplace_variations); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Kargo"; ?></label>
                        <?= formCheckbox('marketplace_shipping', 1, "Etkin", $productSettings->marketplace_shipping); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Konum"; ?></label>
                        <?= formCheckbox('marketplace_product_location', 1, "Etkin", $productSettings->marketplace_product_location); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="marketplace" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "İlanlar"; ?><br><small><?= "Ürün/hizmet ilanı ekle"; ?></small></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= "Fiyat"; ?></label>
                        <?= formCheckbox('classified_price', 1, "Etkin", $productSettings->classified_price); ?>
                        <?= formCheckbox('classified_price_required', 1, "Zorunlu", $productSettings->classified_price_required); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Dış Bağlantı"; ?></label>
                        <?= formCheckbox('classified_external_link', 1, "Etkin", $productSettings->classified_external_link); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Konum"; ?></label>
                        <?= formCheckbox('classified_product_location', 1, "Etkin", $productSettings->classified_product_location); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="classified_ads" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Fiziksel Ürünler"; ?></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= "Demo URL"; ?></label>
                        <?= formCheckbox('physical_demo_url', 1, "Etkin", $productSettings->physical_demo_url); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Video Önizleme"; ?></label>
                        <?= formCheckbox('physical_video_preview', 1, "Etkin", $productSettings->physical_video_preview); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Ses Önizleme"; ?></label>
                        <?= formCheckbox('physical_audio_preview', 1, "Etkin", $productSettings->physical_audio_preview); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="physical_products" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Dijital Ürünler"; ?></h3>
                </div>
                <div class="box-body" style="min-height: 320px;">
                    <div class="form-group">
                        <label class="control-label"><?= "Demo URL"; ?></label>
                        <?= formCheckbox('digital_demo_url', 1, "Etkin", $productSettings->digital_demo_url); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Video Önizleme"; ?></label>
                        <?= formCheckbox('digital_video_preview', 1, "Etkin", $productSettings->digital_video_preview); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Ses Önizleme"; ?></label>
                        <?= formCheckbox('digital_audio_preview', 1, "Etkin", $productSettings->digital_audio_preview); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Dış İndirme Bağlantısı"; ?></label>
                        <?= formCheckbox('digital_external_link', 1, "Etkin", $productSettings->digital_external_link); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "İzin Verilen Dosya Uzantıları"; ?></label>
                        <div class="row">
                            <div class="col-sm-12">
                                <input id="input_digital_allowed_file_extensions" type="text" name="digital_allowed_file_extensions" value="<?= str_replace('"', '', $productSettings->digital_allowed_file_extensions); ?>" class="form-control tags"/>
                                <small>(<?= "Uzantı yazın"; ?>&nbsp;E.g. zip, jpg, doc, pdf..)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="digital_products" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-lg-4 col-md-12 col-sm-12">
        <form action="<?= base_url('Admin/productSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Ürün Arama Listesi"; ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <?= formCheckbox('sort_by_featured_products', 1, "Aramada öne çıkan ürünleri önce göster", $productSettings->sort_by_featured_products); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Sayfalama Ürün"; ?></label>
                        <input type="number" name="pagination_per_page" class="form-control max-700" value="<?= $productSettings->pagination_per_page; ?>" min="4" max="1000" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="search_listing" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .form-group .option-label {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        font-weight: normal !important;
    }

    #input_digital_allowed_file_extensions_tag {
        width: auto !important;
    }
</style>

<script>
    $(function () {
        $('#input_digital_allowed_file_extensions').tagsInput({width: 'auto', 'defaultText': ''});
    });
</script>
