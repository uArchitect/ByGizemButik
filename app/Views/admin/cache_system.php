<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Önbellek Sistemi"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/cacheSystemPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('cache_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->cache_system); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Veritabanı Değişikliklerinde Önbelleği Yenile"; ?></label>
                        <?= formRadio('refresh_cache_database_changes', 1, 0, "Evet", "Hayır", $generalSettings->refresh_cache_database_changes); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= 'Önbellek Yenileme Süresi'; ?></label>&nbsp;
                        <small>(<?= "Dakika cinsinden"; ?>)</small>
                        <input type="number" class="form-control" name="cache_refresh_time" placeholder="<?= 'Önbellek Yenileme Süresi'; ?>" value="<?= $generalSettings->cache_refresh_time / 60; ?>">
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" name="action" value="save" class="btn btn-primary pull-right"><?= 'Değişiklikleri Kaydet'; ?></button>
                        <button type="submit" name="action" value="reset" class="btn btn-warning pull-right m-r-10"><?= 'Önbelleği Sıfırla'; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Statik Önbellek Sistemi"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/cacheSystemPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('cache_static_system', 1, 0, "Etkin", "Devre Dışı", $generalSettings->cache_static_system); ?>
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" name="action" value="save_static" class="btn btn-primary pull-right"><?= 'Değişiklikleri Kaydet'; ?></button>
                        <button type="submit" name="action" value="reset_static" class="btn btn-warning pull-right m-r-10"><?= 'Önbelleği Sıfırla'; ?></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="alert alert-info">
            <strong><?= "Uyarı"; ?>!</strong>&nbsp;<?= "Statik önbellek sistemi açıklaması"; ?>
        </div>
    </div>
</div>