<?php $activeTab = inputGet('tab');
if (empty($activeTab)):
    $activeTab = '1';
endif; ?>
<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url('Admin/generalSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="active_tab" id="input_active_tab" value="<?= clrNum($activeTab); ?>">
            <input type="hidden" name="lang_id" value="<?= clrNum(inputGet('lang')); ?>">
            <div class="form-group">
                <label>Ayarlar Dili</label>
                <select name="lang_id" class="form-control" onchange="window.location.href = '<?= adminUrl(); ?>/general-settings?lang='+this.value+'&tab=<?= clrNum($activeTab); ?>';" style="max-width: 600px;">
                    <?php foreach ($activeLanguages as $language): ?>
                        <option value="<?= $language->id; ?>" <?= $language->id == $settingsLang ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="<?= $activeTab == '1' ? ' active' : ''; ?>"><a href="#tab_1" data-toggle="tab" onclick="$('#input_active_tab').val('1');">Genel Ayarlar</a></li>
                    <li class="<?= $activeTab == '2' ? ' active' : ''; ?>"><a href="#tab_2" data-toggle="tab" onclick="$('#input_active_tab').val('2');">İletişim Ayarları</a></li>
                    <li class="<?= $activeTab == '3' ? ' active' : ''; ?>"><a href="#tab_3" data-toggle="tab" onclick="$('#input_active_tab').val('3');">Sosyal Medya Ayarları</a></li>
                    <li class="<?= $activeTab == '4' ? ' active' : ''; ?>"><a href="#tab_4" data-toggle="tab" onclick="$('#input_active_tab').val('4');">Facebook Yorumları</a></li>
                    <li class="<?= $activeTab == '5' ? ' active' : ''; ?>"><a href="#tab_5" data-toggle="tab" onclick="$('#input_active_tab').val('5');">Özel Header Kodları</a></li>
                    <li class="<?= $activeTab == '6' ? ' active' : ''; ?>"><a href="#tab_6" data-toggle="tab" onclick="$('#input_active_tab').val('6');">Özel Footer Kodları</a></li>
                    <li class="<?= $activeTab == '7' ? ' active' : ''; ?>"><a href="#tab_7" data-toggle="tab" onclick="$('#input_active_tab').val('7');">Çerez Uyarısı</a></li>
                    <li class="<?= $activeTab == '8' ? ' active' : ''; ?>"><a href="#tab_8" data-toggle="tab" onclick="$('#input_active_tab').val('8');">Toplu Yükleme Dokümantasyonu</a></li>
                </ul>
                <div class="tab-content settings-tab-content">
                    <div class="tab-pane<?= $activeTab == '1' ? ' active' : ''; ?>" id="tab_1">
                        <div class="form-group">
                            <label class="control-label">Uygulama Adı</label>
                            <input type="text" class="form-control" name="application_name" placeholder="Uygulama Adı" value="<?= esc($generalSettings->application_name); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Site Başlığı</label>
                            <input type="text" class="form-control" name="site_title" placeholder="Site Başlığı" value="<?= esc($settings->site_title); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Ana Sayfa Başlığı</label>
                            <input type="text" class="form-control" name="homepage_title" placeholder="Ana Sayfa Başlığı" value="<?= esc($settings->homepage_title); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Site Açıklaması</label>
                            <input type="text" class="form-control" name="site_description" placeholder="Site Açıklaması" value="<?= esc($settings->site_description); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Anahtar Kelimeler</label>
                            <input type="text" class="form-control" name="keywords" placeholder="Anahtar Kelimeler" value="<?= esc($settings->keywords); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Telif Hakkı"; ?></label>
                            <input type="text" class="form-control" name="copyright" placeholder="<?= "Telif Hakkı"; ?>" value="<?= esc($settings->copyright); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Footer Hakkında Bölümü"; ?></label>
                            <textarea class="form-control tinyMCEsmall" name="about_footer" placeholder="<?= "Footer Hakkında Bölümü"; ?>" style="min-height: 140px;"><?= esc($settings->about_footer); ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '2' ? ' active' : ''; ?>" id="tab_2">
                        <div class="form-group">
                            <label class="control-label"><?= "Adres"; ?></label>
                            <input type="text" class="form-control" name="contact_address" placeholder="<?= "Adres"; ?>" value="<?= esc($settings->contact_address); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "E-posta Adresi"; ?></label>
                            <input type="text" class="form-control" name="contact_email" placeholder="<?= "E-posta Adresi"; ?>" value="<?= esc($settings->contact_email); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Telefon"; ?></label>
                            <input type="text" class="form-control" name="contact_phone" placeholder="<?= "Telefon"; ?>" value="<?= esc($settings->contact_phone); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "İletişim Metni"; ?></label>
                            <textarea class="form-control tinyMCEsmall" name="contact_text" placeholder="<?= "İletişim Metni"; ?>"><?= esc($settings->contact_text); ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '3' ? ' active' : ''; ?>" id="tab_3">
                        <?php $socialArray = getSocialLinksArray($settings, false);
                        foreach ($socialArray as $item):?>
                            <div class="form-group">
                                <label class="control-label"><?= $item['inputName']; ?></label>
                                <input type="text" class="form-control" name="<?= $item['inputName']; ?>" placeholder="<?= $item['inputName']; ?>" value="<?= esc($item['value']); ?>" maxlength="1000">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="tab-pane<?= $activeTab == '4' ? ' active' : ''; ?>" id="tab_4">
                        <div class="form-group">
                            <label><?= "Facebook Yorumları"; ?></label>
                            <?= formRadio('facebook_comment_status', 1, 0, "Etkin", "Devre Dışı", $generalSettings->facebook_comment_status); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Facebook Yorumları Kodu"; ?></label>
                            <textarea class="form-control text-area" name="facebook_comment" placeholder="<?= "Facebook Yorumları Kodu"; ?>" style="min-height: 140px;"><?= $generalSettings->facebook_comment; ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '5' ? ' active' : ''; ?>" id="tab_5">
                        <div class="form-group">
                            <label class="control-label"><?= "Özel Header Kodları"; ?></label>&nbsp;<small class="small-title-inline">(<?= "Bu kodlar sayfa başında yüklenecek"; ?>)</small>
                            <textarea class="form-control text-area" name="custom_header_codes" placeholder="<?= "Özel Header Kodları"; ?>" style="min-height: 200px;"><?= $generalSettings->custom_header_codes; ?></textarea>
                        </div>
                        E.g. <?= esc("<style> body {background-color: #00a65a;} </style>"); ?>
                    </div>
                    <div class="tab-pane<?= $activeTab == '6' ? ' active' : ''; ?>" id="tab_6">
                        <div class="form-group">
                            <label class="control-label"><?= "Özel Footer Kodları"; ?></label>&nbsp;<small class="small-title-inline">(<?= "Bu kodlar sayfa sonunda yüklenecek"; ?>)</small>
                            <textarea class="form-control text-area" name="custom_footer_codes" placeholder="<?= "Özel Footer Kodları"; ?>" style="min-height: 200px;"><?= $generalSettings->custom_footer_codes; ?></textarea>
                        </div>
                        E.g. <?= esc("<script> alert('Hello!'); </script>"); ?>
                    </div>
                    <div class="tab-pane<?= $activeTab == '7' ? ' active' : ''; ?>" id="tab_7">
                        <div class="form-group">
                            <label><?= "Çerez Uyarısını Göster"; ?></label>
                            <?= formRadio('cookies_warning', 1, 0, "Evet", "Hayır", $settings->cookies_warning); ?>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Çerez Uyarı Metni"; ?></label>
                            <textarea class="form-control tinyMCEsmall" name="cookies_warning_text"><?= $settings->cookies_warning_text; ?></textarea>
                        </div>
                    </div>
                    <div class="tab-pane<?= $activeTab == '8' ? ' active' : ''; ?>" id="tab_8">
                        <div class="form-group">
                            <label class="control-label"><?= "Toplu Yükleme Dokümantasyonu"; ?></label>
                            <textarea class="form-control tinyMCE" name="bulk_upload_documentation"><?= $settings->bulk_upload_documentation; ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Google reCAPTCHA"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/recaptchaSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="lang_id" value="<?= clrNum(inputGet('lang')); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "Site Anahtarı"; ?></label>
                        <input type="text" class="form-control" name="recaptcha_site_key" placeholder="<?= "Site Anahtarı"; ?>" value="<?= esc($generalSettings->recaptcha_site_key); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                        <input type="text" class="form-control" name="recaptcha_secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($generalSettings->recaptcha_secret_key); ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Bakım Modu"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/maintenanceModePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="lang_id" value="<?= clrNum(inputGet('lang')); ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "Başlık"; ?></label>
                        <input type="text" class="form-control" name="maintenance_mode_title" placeholder="<?= "Başlık"; ?>" value="<?= esc($generalSettings->maintenance_mode_title); ?>">
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Açıklama"; ?></label>
                        <textarea class="form-control text-area" name="maintenance_mode_description" placeholder="<?= "Açıklama"; ?>" style="min-height: 100px;"><?= esc($generalSettings->maintenance_mode_description); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('maintenance_mode_status', 1, 0, "Etkin", "Devre Dışı", $generalSettings->maintenance_mode_status); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Resim"; ?></label>: assets/img/maintenance_bg.jpg
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>