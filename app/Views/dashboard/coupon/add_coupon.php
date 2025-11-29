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
                    <h3 class="box-title"><?= esc($title); ?></h3>
                </div>
                <div class="right">
                    <a href="<?= generateDashUrl('coupons'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Kuponlar"; ?>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <form action="<?= base_url('add-coupon-post'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label class="control-label"><?= "Kupon Kodu"; ?>&nbsp;&nbsp;<small>(<?= "Özel karakterler açıklaması"; ?> E.g: #, *, % ..)</small></label>
                        <div class="position-relative">
                            <input type="text" name="coupon_code" id="input_coupon_code" value="<?= old("coupon_code"); ?>" class="form-control form-input" placeholder="<?= "Kupon Kodu"; ?>" maxlength="49" required>
                            <button type="button" class="btn btn-default btn-generate-sku" onclick="$('#input_coupon_code').val(Math.random().toString(36).substr(2,8).toUpperCase());"><?= "Oluştur"; ?></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "İndirim Oranı"; ?></label>
                        <div class="input-group">
                            <span class="input-group-addon">%</span>
                            <input type="number" name="discount_rate" id="input_discount_rate" value="<?= old("discount_rate"); ?>" aria-describedby="basic-addon-discount" class="form-control form-input" placeholder="E.g: 5" min="0" max="99" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Kupon Sayısı"; ?>&nbsp;<small>(<?= "Kupon sayısı açıklaması"; ?>)</small></label>
                        <input type="number" name="coupon_count" value="<?= old("coupon_count"); ?>" class="form-control form-input" placeholder="E.g: 100" min="1" max="99999999" required>
                    </div>
                    <div class="form-group">
                        <label class="font-600"><?= "Minimum Sipariş Tutarı"; ?>&nbsp;<small>(<?= "Kupon minimum sepet tutarı açıklaması"; ?>)</small></label>
                        <div class="input-group">
                            <span class="input-group-addon"><?= $defaultCurrency->symbol; ?></span>
                            <input type="hidden" name="currency" value="<?= $defaultCurrency->code; ?>">
                            <input type="text" name="minimum_order_amount" id="product_price_input" value="<?= old("minimum_order_amount"); ?>" aria-describedby="basic-addon1" class="form-control form-input price-input validate-price-input" placeholder="<?= $baseVars->inputInitialPrice; ?>" onpaste="return false;" maxlength="32">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <label><?= "Kupon kullanım tipi"; ?></label>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="usage_type" value="single" id="usage_type_1" class="custom-control-input" <?= old("usage_type") != 'multiple' ? 'checked' : ''; ?>>
                                    <label for="usage_type_1" class="custom-control-label"><?= "Kupon kullanım tipi 1"; ?></label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="usage_type" value="multiple" id="usage_type_2" class="custom-control-input" <?= old('usage_type') == 'multiple' ? 'checked' : ''; ?>>
                                    <label for="usage_type_2" class="custom-control-label"><?= "Kupon kullanım tipi 2"; ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= "Genel Kupon"; ?>&nbsp;<small>(<?= "Genel kupon açıklaması"; ?>)</small></label>
                        <?= formRadio('is_public', 1, 0, "Evet", "Hayır", 1, 'col-lg-4'); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 max-600">
                                <label><?= "Son Kullanma Tarihi"; ?></label>
                                <div class='input-group date' id='datetimepicker'>
                                    <input type='text' class="form-control" name="expiry_date" value="<?= old("expiry_date"); ?>" placeholder="<?= "Son Kullanma Tarihi"; ?>" required>
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="submit" value="update" class="btn btn-md btn-success"><?= "Kupon Ekle" ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= base_url('assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css'); ?>">
<script src="<?= base_url('assets/vendor/bootstrap-datetimepicker/moment.min.js'); ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js'); ?>"></script>
<script>
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
    });
</script>