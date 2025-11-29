<?php $activeTab = inputGet('tab');
if (empty($activeTab)):
    $activeTab = '1';
endif; ?>
<div class="row" style="margin-bottom: 15px;">
    <div class="col-sm-12">
        <h3 style="font-size: 18px; font-weight: 600;margin-top: 10px;"><?= "Tercihler"; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-9">
        <form action="<?= base_url('Admin/preferencesPost'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="active_tab" id="input_active_tab" value="<?= clrNum($activeTab); ?>">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="<?= $activeTab == '1' ? ' active' : ''; ?>"><a href="#tab_1" data-toggle="tab" onclick="$('#input_active_tab').val('1');"><?= "Sistem"; ?></a></li>
                    <li class="<?= $activeTab == '2' ? ' active' : ''; ?>"><a href="#tab_2" data-toggle="tab" onclick="$('#input_active_tab').val('2');"><?= "Genel"; ?></a></li>
                    <li class="<?= $activeTab == '3' ? ' active' : ''; ?>"><a href="#tab_3" data-toggle="tab" onclick="$('#input_active_tab').val('3');"><?= "Ürünler"; ?></a></li>
                    <li class="<?= $activeTab == '4' ? ' active' : ''; ?>"><a href="#tab_4" data-toggle="tab" onclick="$('#input_active_tab').val('4');"><?= "Mağaza"; ?></a></li>
                    <li class="<?= $activeTab == '5' ? ' active' : ''; ?>"><a href="#tab_5" data-toggle="tab" onclick="$('#input_active_tab').val('5');"><?= "Cüzdan"; ?></a></li>
                    <li class="<?= $activeTab == '6' ? ' active' : ''; ?>"><a href="#tab_6" data-toggle="tab" onclick="$('#input_active_tab').val('6');"><?= "Dosya Yükleme"; ?></a></li>
                </ul>
                <div class="tab-content settings-tab-content">
                    <div class="tab-pane<?= $activeTab == '1' ? ' active' : ''; ?>" id="tab_1">
                        <div class="form-group">
                            <label><?= "Fiziksel Ürünler"; ?></label>
                            <?= formRadio('physical_products_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->physical_products_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Dijital Ürünler"; ?></label>
                            <?= formRadio('digital_products_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->digital_products_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Marketplace - Sitede Ürün Satışı"; ?></label>
                            <?= formRadio('marketplace_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->marketplace_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "İlan Sistemi - Ürünü İlan Olarak Ekleme"; ?></label>
                            <?= formRadio('classified_ads_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->classified_ads_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Teklif Sistemi - Fiyat Teklifi İsteme"; ?></label>
                            <?= formRadio('bidding_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->bidding_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Lisans Anahtarı Satışı"; ?></label>
                            <?= formRadio('selling_license_keys_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->selling_license_keys_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Çoklu Satıcı Sistemi"; ?></label>
                            <small style="font-size: 13px;">(<?= "Çoklu satıcı sistemi açıklaması"; ?>)</small>
                            <?= formRadio('multi_vendor_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->multi_vendor_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Saat Dilimi"; ?></label>
                            <select name="timezone" class="form-control max-700">
                                <?php $timezones = timezone_identifiers_list();
                                if (!empty($timezones)):
                                    foreach ($timezones as $timezone):?>
                                        <option value="<?= $timezone; ?>" <?= $timezone == $generalSettings->timezone ? 'selected' : ''; ?>><?= $timezone; ?></option>
                                    <?php endforeach;
                                endif; ?>
                            </select>
                        </div>
                        <div class="form-group text-right m-t-30">
                            <button type="submit" name="submit" value="system" class="btn btn-primary"><?= "Değişiklikleri Kaydet"; ?></button>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '2' ? ' active' : ''; ?>" id="tab_2">
                        <div class="form-group">
                            <label><?= "Çoklu Dil Sistemi"; ?></label>
                            <?= formRadio('multilingual_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->multilingual_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "RSS Sistemi"; ?></label>
                            <?= formRadio('rss_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->rss_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Satıcı Doğrulama Sistemi"; ?></label>
                            <small><?= "(" . "Satıcıların hesaplarını açmadan önce doğrulanması gerekir" . ")"; ?></small>
                            <?= formRadio('vendor_verification_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->vendor_verification_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Satıcı İletişim Bilgilerini Göster"; ?></label>
                            <?= formRadio('show_vendor_contact_information', 1, 0, "Evet", "Hayır", $generalSettings->show_vendor_contact_information, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Misafir Siparişi"; ?></label>
                            <?= formRadio('guest_checkout', 1, 0, "Etkin", "Devre Dışı", $generalSettings->guest_checkout, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Konuma Göre Arama"; ?></label>
                            <?= formRadio('location_search_header', 1, 0, "Etkin", "Devre Dışı", $generalSettings->location_search_header, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "PWA"; ?></label>
                            <?= formRadio('pwa_status', 1, 0, "Etkin", "Devre Dışı", $generalSettings->pwa_status, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "PWA Logo"; ?></label>
                            <?php if (!empty(getPwaLogo($generalSettings, 'md'))): ?>
                                <div class="display-block m-b-10">
                                    <img src="<?= base_url(getPwaLogo($generalSettings, 'md')); ?>?t=<?= uniqid(); ?>" width="100">
                                </div>
                            <?php endif; ?>
                            <div class="display-block">
                                <a class='btn btn-success btn-sm btn-file-upload'>
                                    <?= "Logo Seç"; ?>
                                    <input type="file" name="pwa_logo" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info-pwa').html($(this).val().replace(/.*[\/\\]/, ''));">
                                </a>
                                (PNG, 512x512 px)
                            </div>
                            <span class='label label-info' id="upload-file-info-pwa"></span>
                        </div>
                        <div class="alert alert-info alert-large m-t-10">
                            <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "PWA aktif olduğunda sitenizin mobil uygulamaya dönüşmesini sağlar"; ?>
                        </div>
                        <div class="form-group text-right m-t-30">
                            <button type="submit" name="submit" value="general" class="btn btn-primary"><?= "Değişiklikleri Kaydet"; ?></button>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '3' ? ' active' : ''; ?>" id="tab_3">
                        <div class="form-group">
                            <label><?= "Yeni Ürünler İçin Ürün Onayı"; ?></label>
                            <?= formRadio('approve_before_publishing', 1, 0, "Etkin", "Devre Dışı", $generalSettings->approve_before_publishing, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Düzenlenmiş Ürünler İçin Ürün Onayı"; ?></label>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 col-lg-4 m-b-5">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="approve_after_editing" value="1" id="pr_app_edited_products_1" class="custom-control-input" <?= $generalSettings->approve_after_editing == 1 ? 'checked' : ''; ?>>
                                        <label for="pr_app_edited_products_1" class="custom-control-label"><?= "Etkin - Ürünleri Gizleme"; ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-lg-4 m-b-5">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="approve_after_editing" value="2" id="pr_app_edited_products_2" class="custom-control-input" <?= $generalSettings->approve_after_editing == 2 ? 'checked' : ''; ?>>
                                        <label for="pr_app_edited_products_2" class="custom-control-label"><?= "Etkin - Ürünleri Gizle"; ?></label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-lg-4 m-b-5">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="approve_after_editing" value="0" id="pr_app_edited_products_3" class="custom-control-input" <?= empty($generalSettings->approve_after_editing) ? 'checked' : ''; ?>>
                                        <label for="pr_app_edited_products_3" class="custom-control-label"><?= "Devre Dışı"; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= "Öne Çıkan Ürünler Sistemi"; ?></label>
                            <?= formRadio('promoted_products', 1, 0, "Etkin", "Devre Dışı", $generalSettings->promoted_products, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Satıcı Toplu Ürün Yükleme"; ?></label>
                            <?= formRadio('vendor_bulk_product_upload', 1, 0, "Etkin", "Devre Dışı", $generalSettings->vendor_bulk_product_upload, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Satılan Ürünleri Sitede Göster"; ?></label>
                            <?= formRadio('show_sold_products', 1, 0, "Evet", "Hayır", $generalSettings->show_sold_products, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Ürün Link Yapısı"; ?></label>
                            <?= formRadio('product_link_structure', 'slug-id', 'id-slug', 'domain.com/slug-id', 'domain.com/id-slug', $generalSettings->product_link_structure, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Yorumlar"; ?></label>
                            <?= formRadio('reviews', 1, 0, "Etkin", "Devre Dışı", $generalSettings->reviews, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Ürün Yorumları"; ?></label>
                            <?= formRadio('product_comments', 1, 0, "Etkin", "Devre Dışı", $generalSettings->product_comments, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Blog Yorumları"; ?></label>
                            <?= formRadio('blog_comments', 1, 0, "Etkin", "Devre Dışı", $generalSettings->blog_comments, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Yorum Onay Sistemi"; ?></label>
                            <?= formRadio('comment_approval_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->comment_approval_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group text-right m-t-30">
                            <button type="submit" name="submit" value="products" class="btn btn-primary"><?= "Değişiklikleri Kaydet"; ?></button>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '4' ? ' active' : ''; ?>" id="tab_4">
                        <div class="form-group">
                            <label><?= "İade Sistemi"; ?></label>
                            <?= formRadio('refund_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->refund_system, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Profilde Satış Sayısını Göster"; ?></label>
                            <?= formRadio('profile_number_of_sales', 1, 0, "Evet", "Hayır", $generalSettings->profile_number_of_sales, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Satıcıların Mağaza Adını Değiştirmesine İzin Ver"; ?></label>
                            <?= formRadio('vendors_change_shop_name', 1, 0, "Evet", "Hayır", $generalSettings->vendors_change_shop_name, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Müşteri E-postasını Satıcıya Göster"; ?></label>
                            <?= formRadio('show_customer_email_seller', 1, 0, "Evet", "Hayır", $generalSettings->show_customer_email_seller, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Müşteri Telefonunu Satıcıya Göster"; ?></label>
                            <?= formRadio('show_customer_phone_seller', 1, 0, "Evet", "Hayır", $generalSettings->show_customer_phone_seller, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group radio-affiliate-approve">
                            <label><?= "Siparişleri Otomatik Onayla"; ?></label>
                            <?= formRadio('auto_approve_orders', 1, 0, "Evet", "Hayır", $generalSettings->auto_approve_orders, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group" id="auto_approve_orders_days_cont" style="<?= $generalSettings->auto_approve_orders == 1 ? '' : 'display:none;'; ?>">
                            <label><?= "Gün Sayısı"; ?></label>
                            <input type="number" name="auto_approve_orders_days" value="<?= esc($generalSettings->auto_approve_orders_days); ?>" class="form-control max-700" min="1" max="9999" required>
                            <hr>
                        </div>
                        <div class="form-group request_documents_vendors">
                            <label><?= "Satıcılardan Belge İste"; ?></label>
                            <?= formRadio('request_documents_vendors', 1, 0, "Evet", "Hayır", $generalSettings->request_documents_vendors, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group" id="request_documents_vendors_cont" style="<?= $generalSettings->request_documents_vendors == 1 ? '' : 'display:none;'; ?>">
                            <label class="control-label"><?= "Açıklama Girin"; ?>&nbsp;(E.g. ID Card)</label>
                            <textarea class="form-control max-700" name="explanation_documents_vendors"><?= str_replace('<br/>', '\n', $generalSettings->explanation_documents_vendors); ?></textarea>
                        </div>
                        <div class="form-group text-right m-t-30">
                            <button type="submit" name="submit" value="shop" class="btn btn-primary"><?= "Değişiklikleri Kaydet"; ?></button>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '5' ? ' active' : ''; ?>" id="tab_5">
                        <div class="form-group">
                            <label><?= "Cüzdan Yatırma"; ?></label>
                            <?= formRadio('wallet_deposit', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->wallet_deposit, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label><?= "Cüzdan Bakiyesi ile Ödeme"; ?></label>
                            <?= formRadio('pay_with_wallet_balance', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->pay_with_wallet_balance, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group text-right m-t-30">
                            <button type="submit" name="submit" value="wallet" class="btn btn-primary"><?= "Değişiklikleri Kaydet"; ?></button>
                        </div>

                    </div>
                    <div class="tab-pane<?= $activeTab == '6' ? ' active' : ''; ?>" id="tab_6">
                        <div class="form-group">
                            <label><?= "Resim Dosya Formatı"; ?></label>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 col-lg-4 m-b-5">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="image_file_format" value="JPG" id="image_file_format_1" class="custom-control-input" <?= $productSettings->image_file_format == 'JPG' ? 'checked' : ''; ?>>
                                        <label for="image_file_format_1" class="custom-control-label">JPG</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-lg-4 m-b-5">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="image_file_format" value="WEBP" id="image_file_format_2" class="custom-control-input" <?= $productSettings->image_file_format == 'WEBP' ? 'checked' : ''; ?>>
                                        <label for="image_file_format_2" class="custom-control-label">WEBP</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12 col-lg-4 m-b-5">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="image_file_format" value="PNG" id="image_file_format_3" class="custom-control-input" <?= $productSettings->image_file_format == 'PNG' ? 'checked' : ''; ?>>
                                        <label for="image_file_format_3" class="custom-control-label">PNG</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12 col-lg-4 m-b-5">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="image_file_format" value="original" id="image_file_format_4" class="custom-control-input" <?= $productSettings->image_file_format == 'original' ? 'checked' : ''; ?>>
                                        <label for="image_file_format_4" class="custom-control-label"><?= "Orijinal Dosya Formatını Koru"; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= "Ürün Resmi Yükleme"; ?></label>
                            <?= formRadio('is_product_image_required', 1, 0, "Zorunlu", "İsteğe Bağlı", $productSettings->is_product_image_required, 'col-lg-4'); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= 'Ürün Resmi Yükleme Limiti'; ?></label>
                            <input type="number" name="product_image_limit" class="form-control max-700" value="<?= $productSettings->product_image_limit; ?>" min="1" required>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= 'Maksimum Dosya Boyutu' . ' (' . "Resim" . ')'; ?></label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group max-700">
                                        <input type="number" name="max_file_size_image" value="<?= round(($productSettings->max_file_size_image / 1048576), 2); ?>" min="1" class="form-control" aria-describedby="basic-addon1" required>
                                        <span class="input-group-addon" id="basic-addon1">MB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= 'Maksimum Dosya Boyutu' . ' (' . "Video" . ')'; ?></label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group max-700">
                                        <input type="number" name="max_file_size_video" value="<?= round(($productSettings->max_file_size_video / 1048576), 2); ?>" min="1" class="form-control" aria-describedby="basic-addon2" required>
                                        <span class="input-group-addon" id="basic-addon2">MB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= 'Maksimum Dosya Boyutu' . ' (' . "Ses" . ')'; ?></label>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group max-700">
                                        <input type="number" name="max_file_size_audio" value="<?= round(($productSettings->max_file_size_audio / 1048576), 2); ?>" min="1" class="form-control" aria-describedby="basic-addon3" required>
                                        <span class="input-group-addon" id="basic-addon3">MB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right m-t-30">
                            <button type="submit" name="submit" value="file_upload" class="btn btn-primary"><?= "Değişiklikleri Kaydet"; ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).on("change", ".radio-affiliate-approve input", function () {
        var val = $('input[name="auto_approve_orders"]:checked').val();
        if (val == 1) {
            $('#auto_approve_orders_days_cont').show();
        } else {
            $('#auto_approve_orders_days_cont').hide();
        }
    });
    $(document).on("change", ".request_documents_vendors input", function () {
        var val = $('input[name="request_documents_vendors"]:checked').val();
        if (val == 1) {
            $('#request_documents_vendors_cont').show();
        } else {
            $('#request_documents_vendors_cont').hide();
        }
    });
</script>