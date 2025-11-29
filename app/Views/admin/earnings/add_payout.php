<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Ödeme Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('payout-requests'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Ödeme Talepleri"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Earnings/addPayoutPost'); ?>" method="post" class="validate_price">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Kullanıcı"; ?></label>
                        <select name="user_id" class="form-control select2" required>
                            <option value="" selected><?= "Seç"; ?></option>
                            <?php if (!empty($users)):
                                foreach ($users as $user): ?>
                                    <option value="<?= $user->id; ?>"><?= "ID"; ?>:&nbsp;<?= $user->id; ?>&nbsp;-&nbsp;<?= "Kullanıcı Adı"; ?>:&nbsp;<?= esc(getUsername($user)); ?>&nbsp;-&nbsp;<?= "Bakiye"; ?>:&nbsp;<?= priceFormatted($user->balance, $paymentSettings->default_currency); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= "Çekim Yöntemi"; ?></label>
                        <select name="payout_method" class="form-control select2" required>
                            <option value="" selected><?= "Seç"; ?></option>
                            <option value="paypal"><?= "PayPal"; ?></option>
                            <option value="bitcoin"><?= "Bitcoin"; ?></option>
                            <option value="iban"><?= "IBAN"; ?></option>
                            <option value="swift"><?= "SWIFT"; ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= "Çekim Tutarı"; ?>&nbsp;(<?= $paymentSettings->default_currency; ?>)</label>
                        <input type="text" name="amount" class="form-control form-input price-input" placeholder="<?= $baseVars->inputInitialPrice; ?>" onpaste="return false;" maxlength="32" required>
                    </div>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <select name="status" class="form-control select2" required>
                            <option value="" selected><?= "Seç"; ?></option>
                            <option value="0"><?= "Bekliyor"; ?></option>
                            <option value="1"><?= "Tamamlandı"; ?></option>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Ödeme Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>