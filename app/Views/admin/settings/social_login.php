<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= "Sosyal Giriş"; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Facebook Girişi"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/socialLoginSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="label-sitemap"><?= "Uygulama ID"; ?></label>
                        <input type="text" class="form-control" name="facebook_app_id" placeholder="<?= "Uygulama ID"; ?>" value="<?= esc($generalSettings->facebook_app_id); ?>">
                    </div>
                    <div class="form-group">
                        <label class="label-sitemap"><?= "Uygulama Gizli Anahtarı"; ?></label>
                        <input type="text" class="form-control" name="facebook_app_secret" placeholder="<?= "Uygulama Gizli Anahtarı"; ?>" value="<?= esc($generalSettings->facebook_app_secret); ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="facebook" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Google Girişi"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/socialLoginSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="label-sitemap"><?= "İstemci ID"; ?></label>
                        <input type="text" class="form-control" name="google_client_id" placeholder="<?= "İstemci ID"; ?>" value="<?= esc($generalSettings->google_client_id); ?>">
                    </div>
                    <div class="form-group">
                        <label class="label-sitemap"><?= "İstemci Gizli Anahtarı"; ?></label>
                        <input type="text" class="form-control" name="google_client_secret" placeholder="<?= "İstemci Gizli Anahtarı"; ?>" value="<?= esc($generalSettings->google_client_secret); ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="google" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "VK Girişi"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/socialLoginSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="label-sitemap"><?= "Uygulama ID"; ?></label>
                        <input type="text" class="form-control" name="vk_app_id" placeholder="<?= "Uygulama ID"; ?>" value="<?= esc($generalSettings->vk_app_id); ?>">
                    </div>
                    <div class="form-group">
                        <label class="label-sitemap"><?= "Güvenli Anahtar"; ?></label>
                        <input type="text" class="form-control" name="vk_secure_key" placeholder="<?= "Güvenli Anahtar"; ?>" value="<?= esc($generalSettings->vk_secure_key); ?>">
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" name="submit" value="vk" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
