<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= "Ödeme Ayarları"; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "PayPal"; ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('payout_paypal_enabled', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->payout_paypal_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Minimum Ödeme Tutarı"; ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_paypal" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_paypal, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="paypal" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Bitcoin"; ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('payout_bitcoin_enabled', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->payout_bitcoin_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Minimum Ödeme Tutarı"; ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_bitcoin" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_bitcoin, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="bitcoin" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "IBAN"; ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('payout_iban_enabled', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->payout_iban_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Minimum Ödeme Tutarı"; ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_iban" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_iban, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="iban" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "SWIFT"; ?></h3>
            </div>
            <form action="<?= base_url('Earnings/payoutSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('payout_swift_enabled', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->payout_swift_enabled); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Minimum Ödeme Tutarı"; ?> (<?= $defaultCurrency->symbol; ?>)</label>
                        <input type="text" name="min_payout_swift" class="form-control form-input price-input" value="<?= getPrice($paymentSettings->min_payout_swift, 'input'); ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="submit" value="swift" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>