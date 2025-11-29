<div class="row">
    <div class="col-sm-12 col-lg-8">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Rota Ayarları"; ?></h3>
                </div>
            </div>
            <form action="<?= base_url('Admin/routeSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <?php if (!empty($routes)):
                        foreach ($routes as $route): ?>
                            <div class="row">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="route_key_<?= $route->id; ?>" value="<?= str_replace('_', '-', $route->route_key); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="route_<?= $route->id; ?>" value="<?= $route->route; ?>" maxlength="100" required>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
        <div class="alert alert-danger alert-large">
            <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "Rota ayarları uyarısı"; ?>
        </div>
    </div>
</div>
