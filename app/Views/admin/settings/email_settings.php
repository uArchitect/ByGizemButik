<div class="row">
    <div class="col-sm-12 col-lg-6">
        <form action="<?= base_url('Admin/emailSettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "E-posta Ayarları"; ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "E-posta Servisi"; ?></label>
                        <select name="mail_service" class="form-control" onchange="window.location.href = '<?= adminUrl(); ?>/email-settings?service='+this.value+'&protocol=<?= esc($protocol); ?>';">
                            <option value="codeigniter" <?= $service == "codeigniter" ? "selected" : ""; ?>>CodeIgniter Mail</option>
                            <option value="swift" <?= $service == "swift" ? "selected" : ""; ?>>Swift Mailer</option>
                            <option value="php" <?= $service == "php" ? "selected" : ""; ?>>PHP Mailer</option>
                            <option value="mailjet" <?= $service == "mailjet" ? "selected" : ""; ?>>Mailjet</option>
                        </select>
                    </div>
                    <?php if ($service == 'mailjet'): ?>
                        <div class="form-group">
                            <label class="control-label"><?= "API Anahtarı"; ?></label>
                            <input type="text" class="form-control" name="mailjet_api_key" placeholder="<?= "API Anahtarı"; ?>" value="<?= esc($generalSettings->mailjet_api_key); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                            <input type="text" class="form-control" name="mailjet_secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($generalSettings->mailjet_secret_key); ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Mailjet E-posta Adresi"; ?>&nbsp;(<small><?= "Mailjet e-posta adresi açıklaması"; ?></small>)</label>
                            <input type="text" class="form-control" name="mailjet_email_address" placeholder="<?= "Mailjet E-posta Adresi"; ?>" value="<?= esc($generalSettings->mailjet_email_address); ?>">
                        </div>
                        <input type="hidden" name="mail_protocol" value="<?= esc($generalSettings->mail_protocol); ?>">
                        <input type="hidden" name="mail_encryption" value="<?= esc($generalSettings->mail_encryption); ?>">
                        <input type="hidden" name="mail_host" value="<?= esc($generalSettings->mail_host); ?>">
                        <input type="hidden" name="mail_port" value="<?= esc($generalSettings->mail_port); ?>">
                        <input type="hidden" name="mail_username" value="<?= esc($generalSettings->mail_username); ?>">
                        <input type="hidden" name="mail_password" value="<?= esc($generalSettings->mail_password); ?>">
                        <input type="hidden" name="mail_reply_to" value="<?= esc($generalSettings->mail_reply_to); ?>">
                    <?php else: ?>
                        <input type="hidden" name="mailjet_api_key" value="<?= esc($generalSettings->mailjet_api_key); ?>">
                        <input type="hidden" name="mailjet_secret_key" value="<?= esc($generalSettings->mailjet_secret_key); ?>">
                        <input type="hidden" name="mailjet_email_address" value="<?= esc($generalSettings->mailjet_email_address); ?>">
                        <div class="form-group">
                            <label class="control-label"><?= "E-posta Protokolü"; ?></label>
                            <select name="mail_protocol" class="form-control" onchange="window.location.href = '<?= adminUrl(); ?>/email-settings?service=<?= esc($service); ?>&protocol='+this.value;">
                                <option value="smtp" <?= $protocol == 'smtp' ? "selected" : ""; ?>><?= "SMTP"; ?></option>
                                <option value="mail" <?= $protocol == 'mail' ? "selected" : ""; ?>><?= "Mail"; ?></option>
                            </select>
                        </div>
                        <?php if ($protocol == 'smtp'): ?>
                            <div class="form-group">
                                <label class="control-label"><?= "Şifreleme"; ?></label>
                                <select name="mail_encryption" class="form-control">
                                    <option value="tls" <?= $generalSettings->mail_encryption == "tls" ? "selected" : ""; ?>>TLS</option>
                                    <option value="ssl" <?= $generalSettings->mail_encryption == "ssl" ? "selected" : ""; ?>>SSL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= "E-posta Sunucusu"; ?></label>
                                <input type="text" class="form-control" name="mail_host" placeholder="<?= "E-posta Sunucusu"; ?>" value="<?= esc($generalSettings->mail_host); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= "E-posta Portu"; ?></label>
                                <input type="text" class="form-control" name="mail_port" placeholder="<?= "E-posta Portu"; ?>" value="<?= esc($generalSettings->mail_port); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= "E-posta Kullanıcı Adı"; ?></label>
                                <input type="text" class="form-control" name="mail_username" placeholder="<?= "E-posta Kullanıcı Adı"; ?>" value="<?= esc($generalSettings->mail_username); ?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?= "E-posta Şifresi"; ?></label>
                                <input type="password" class="form-control" name="mail_password" placeholder="<?= "E-posta Şifresi"; ?>" value="<?= esc($generalSettings->mail_password); ?>">
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="mail_encryption" value="<?= esc($generalSettings->mail_encryption); ?>">
                            <input type="hidden" name="mail_host" value="<?= esc($generalSettings->mail_host); ?>">
                            <input type="hidden" name="mail_port" value="<?= esc($generalSettings->mail_port); ?>">
                            <input type="hidden" name="mail_username" value="<?= esc($generalSettings->mail_username); ?>">
                            <input type="hidden" name="mail_password" value="<?= esc($generalSettings->mail_password); ?>">
                        <?php endif;
                    endif; ?>
                    <div class="form-group">
                        <label class="control-label"><?= "E-posta Başlığı"; ?></label>
                        <input type="text" class="form-control" name="mail_title" placeholder="<?= "E-posta Başlığı"; ?>" value="<?= esc($generalSettings->mail_title); ?>">
                    </div>
                    <?php if ($service != 'mailjet'): ?>
                        <div class="form-group">
                            <label class="control-label"><?= "Yanıt Adresi"; ?></label>
                            <input type="email" class="form-control" name="mail_reply_to" placeholder="<?= "Yanıt Adresi"; ?>" value="<?= esc($generalSettings->mail_reply_to); ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="email" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>

        <form action="<?= base_url('Admin/sendTestEmailPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Test E-postası Gönder"; ?></h3><br>
                    <small class="small-title"><?= "Test e-postası gönderme açıklaması"; ?></small>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "E-posta Adresi"; ?></label>
                        <input type="text" class="form-control" name="email" placeholder="<?= "E-posta Adresi"; ?>" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="contact" class="btn btn-primary pull-right"><?= "E-posta Gönder"; ?></button>
                </div>
            </div>
        </form>
    </div>

    <div class="col-sm-12 col-lg-6">
        <form action="<?= base_url('Admin/emailOptionsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= 'E-posta Seçenekleri'; ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "E-posta Doğrulama"; ?></label>
                        <?= formRadio('email_verification', 1, 0, "Etkin", "Devre Dışı", $generalSettings->email_verification); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Yeni Ürün E-posta Seçeneği"; ?></label>
                        <?= formRadio('new_product', 1, 0, "Evet", "Hayır", getEmailOptionStatus($generalSettings, 'new_product')); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Alıcıya Sipariş E-postası Gönder"; ?></label>
                        <?= formRadio('new_order', 1, 0, "Evet", "Hayır", getEmailOptionStatus($generalSettings, 'new_order')); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Kargo E-postası Gönder"; ?></label>
                        <?= formRadio('order_shipped', 1, 0, "Evet", "Hayır", getEmailOptionStatus($generalSettings, 'order_shipped')); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "İletişim Mesajları E-postası"; ?></label>
                        <?= formRadio('contact_messages', 1, 0, "Evet", "Hayır", getEmailOptionStatus($generalSettings, 'contact_messages')); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Mağaza Açma Talebi E-postası"; ?></label>
                        <?= formRadio('shop_opening_request', 1, 0, "Evet", "Hayır", getEmailOptionStatus($generalSettings, 'shop_opening_request')); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Teklif Sistemi E-postası"; ?></label>
                        <?= formRadio('bidding_system', 1, 0, "Etkin", "Devre Dışı", getEmailOptionStatus($generalSettings, 'bidding_system')); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Destek Sistemi E-postası"; ?></label>
                        <?= formRadio('support_system', 1, 0, "Etkin", "Devre Dışı", getEmailOptionStatus($generalSettings, 'support_system')); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "E-posta Adresi"; ?> (<?= "Admin e-postaları bu adrese gönderilecek"; ?>)</label>
                        <input type="email" class="form-control" name="mail_options_account" placeholder="<?= "E-posta Adresi"; ?>" value="<?= esc($generalSettings->mail_options_account); ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="verification" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>