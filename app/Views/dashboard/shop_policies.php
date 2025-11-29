<div class="row">
    <div class="col-sm-12">
        <?= view('dashboard/includes/_messages'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Mağaza Politikaları"; ?></h3>
                </div>
            </div>
            <div class="box-body">
                <form action="<?= base_url('Dashboard/shopPoliciesPost'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('status_shop_policies', 1, 0, "Etkin", "Devre Dışı", $pages->status_shop_policies); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "İçerik"; ?></label>
                        <textarea name="content_shop_policies" class="tinyMCE"><?= $pages->content_shop_policies; ?></textarea>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-md btn-success"><?= "Değişiklikleri Kaydet" ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .nav-tabs-custom > .nav-tabs > li > a {
        font-size: 14px !important;
        font-weight: 600 !important;
        padding: 12px 30px;
    }

    .nav-tabs-custom > .nav-tabs > li.active {
        border-top-color: #19bb9b;
    }
</style>