<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Para Birimi Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('currency-settings'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Para Birimleri"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Admin/addCurrencyPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Para Birimi Adı"; ?></label>
                        <input type="text" class="form-control" name="name" placeholder="Ex: US Dollar" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label><?= "Para Birimi Kodu"; ?></label>
                        <input type="text" class="form-control" name="code" placeholder="Ex: USD" maxlength="99" required>
                    </div>
                    <div class="form-group">
                        <label><?= "Para Birimi Sembolü"; ?></label>
                        <input type="text" class="form-control" name="symbol" placeholder="Ex: $" maxlength="99" required>
                    </div>
                    <div class="form-group">
                        <label><?= 'Para Birimi Formatı'; ?> (Thousands Seperator)</label>
                        <?= formRadio('currency_format', 'us', 'european', '1,234,567.89','1.234.567,89', 'us'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Para Birimi Sembol Formatı"; ?></label>
                        <?= formRadio('symbol_direction', 'left', 'right', '$100 ('.'Sol'.')', '100$ ('.'Sağ'.')', 'left'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Para ve Sembol Arasında Boşluk Ekle"; ?></label>
                        <?= formRadio('space_money_symbol', 1, 0, "Evet", "Hayır", '0'); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('status', 1, 0, "Aktif", "Pasif", 1); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Para Birimi Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>