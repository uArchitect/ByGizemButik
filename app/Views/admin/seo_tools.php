<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= "SEO Araçları"; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Site Haritası"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/generateSitemapPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="label-sitemap"><?= "Sıklık"; ?></label>
                        <small class="small-sitemap"> (<?= "Sıklık açıklaması"; ?>)</small>
                        <select name="frequency" class="form-control">
                            <option value="none" <?= $productSettings->sitemap_frequency == 'none' ? 'selected' : ''; ?>><?= "Yok"; ?></option>
                            <option value="always" <?= $productSettings->sitemap_frequency == 'always' ? 'selected' : ''; ?>><?= "Her Zaman"; ?></option>
                            <option value="hourly" <?= $productSettings->sitemap_frequency == 'hourly' ? 'selected' : ''; ?>><?= "Saatlik"; ?></option>
                            <option value="daily" <?= $productSettings->sitemap_frequency == 'daily' ? 'selected' : ''; ?>><?= "Günlük"; ?></option>
                            <option value="weekly" <?= $productSettings->sitemap_frequency == 'weekly' ? 'selected' : ''; ?>><?= "Haftalık"; ?></option>
                            <option value="monthly" <?= $productSettings->sitemap_frequency == 'monthly' ? 'selected' : ''; ?>><?= "Aylık"; ?></option>
                            <option value="yearly" <?= $productSettings->sitemap_frequency == 'yearly' ? 'selected' : ''; ?>><?= "Yıllık"; ?></option>
                            <option value="never" <?= $productSettings->sitemap_frequency == 'never' ? 'selected' : ''; ?>><?= "Asla"; ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="label-sitemap"><?= "Son Değişiklik"; ?></label>
                        <small class="small-sitemap"> (<?= "Son değişiklik açıklaması"; ?>)</small>
                        <?= formRadio('last_modification', 'none', 'server_response', "Yok", "Sunucu Yanıtı", $productSettings->sitemap_last_modification); ?>
                    </div>
                    <div class="form-group">
                        <label class="label-sitemap"><?= "Öncelik"; ?></label>
                        <small class="small-sitemap"> (<?= "Öncelik açıklaması"; ?>)</small>
                        <?= formRadio('priority', 'none', 'automatically', "Yok", "Öncelik Yok", $productSettings->sitemap_priority); ?>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Site Haritası Oluştur"; ?></button>
                </div>
            </form>

            <?php $files = glob(FCPATH . '*.xml');
            if (!empty($files)): ?>
                <div style="padding: 20px">
                    <h3 style="font-size: 18px; font-weight: 500;"><?= "Oluşturulan Site Haritaları" ?></h3>
                    <hr>
                    <?php foreach ($files as $file):
                        if (strpos(basename($file), 'sitemap') !== false):?>
                            <div style="font-size: 16px; font-weight: 600;margin-bottom: 10px;">
                                <a href="<?= base_url(basename($file)); ?>" target="_blank"><?= basename($file); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <form action="<?= base_url('Admin/downloadSitemapPost'); ?>" method="post" style="display: inline-block">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="file_name" value="<?= basename($file); ?>">
                                    <button type="submit" name="file_type" value="sitemap" class="btn btn-xs btn-success"><i class="fa fa-cloud-download"></i></button>
                                </form>
                                <form action="<?= base_url('Admin/deleteSitemapPost'); ?>" method="post" style="display: inline-block">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="file_name" value="<?= basename($file); ?>">
                                    <button type="submit" name="file_type" value="sitemap" class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                </form>
                            </div>
                        <?php endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="callout" style="margin-top: 30px;background-color: #fff; border-color:#00c0ef;max-width: 600px;">
            <h4>Cron Job</h4>
            <p><strong>http://domain.com/cron/update-sitemap</strong></p>
            <small><?= 'Cron job açıklaması'; ?></small>
        </div>
    </div>
    <form action="<?= base_url('Admin/seoToolsPost'); ?>" method="post">
        <?= csrf_field(); ?>
        <div class="col-lg-6 col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= 'Google Analytics'; ?></h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <textarea class="form-control text-area" name="google_analytics" placeholder="<?= 'Google Analytics'; ?>" style="min-height: 100px;"><?= esc($generalSettings->google_analytics); ?></textarea>
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" class="btn btn-primary pull-right"><?= 'Değişiklikleri Kaydet'; ?></button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>