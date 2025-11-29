<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Depolama"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/storagePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Depolama"; ?></label>
                        <?= formRadio('storage', 'local', 'aws_s3', "Yerel Depolama", "AWS Depolama", $storageSettings->storage); ?>
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" name="action" value="save" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "AWS Depolama"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/awsS3Post'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "AWS Anahtarı"; ?></label>
                        <input type="text" class="form-control" name="aws_key" placeholder="<?= "AWS Anahtarı"; ?>" value="<?= esc($storageSettings->aws_key); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "AWS Gizli Anahtarı"; ?></label>
                        <input type="text" class="form-control" name="aws_secret" placeholder="<?= "AWS Gizli Anahtarı"; ?>" value="<?= esc($storageSettings->aws_secret); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Bucket Adı"; ?></label>
                        <input type="text" class="form-control" name="aws_bucket" placeholder="<?= "Bucket Adı"; ?>" value="<?= esc($storageSettings->aws_bucket); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Bölge"; ?></label>
                        <input type="text" class="form-control" name="aws_region" placeholder="E.g: us-east-1" value="<?= esc($storageSettings->aws_region); ?>" required>
                    </div>
                    <div class="box-footer" style="padding-left: 0; padding-right: 0;">
                        <button type="submit" name="action" value="save" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>