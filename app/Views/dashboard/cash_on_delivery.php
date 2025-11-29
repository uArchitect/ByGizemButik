<div class="row">
    <div class="col-sm-12">
        <?= view('dashboard/includes/_messages'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= 'Kapıda Ödeme'; ?><br>
            <small><?= "Kapıda ödeme satıcı açıklaması"; ?></small>
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "İşlemler"; ?></h3>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table class="table table-striped" role="grid">
                                <thead>
                                <tr role="row">
                                    <th scope="col"><?= "Sipariş"; ?></th>
                                    <th scope="col"><?= "Komisyon"; ?></th>
                                    <th scope="col"><?= "Tarih"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($earnings)):
                                    foreach ($earnings as $earning):
                                        if (!empty($earning)):?>
                                            <tr>
                                                <td>#<?= $earning->order_number; ?></td>
                                                <td class="text-danger">
                                                    <?= priceFormatted($earning->commission, $earning->currency); ?>&nbsp;<?= !empty($earning->commission_rate) ? '(' . $earning->commission_rate . '%)' : ''; ?>
                                                </td>
                                                <td><?= formatDate($earning->created_at); ?></td>
                                            </tr>
                                        <?php endif;
                                    endforeach; ?>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if (empty($earnings)): ?>
                            <p class="text-center">
                                <?= "Kayıt bulunamadı"; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php if (!empty($earnings)): ?>
                            <div class="number-of-entries">
                                <span><?= "Kayıt Sayısı"; ?>:</span>&nbsp;&nbsp;<strong><?= $numRows; ?></strong>
                            </div>
                        <?php endif; ?>
                        <div class="table-pagination">
                            <?= $pager->links; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-success alert-large">
            <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "Komisyon borç limiti açıklaması"; ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Komisyon Borcu"; ?></h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group">
                    <div class="m-b-5">
                        <?php if (user()->commission_debt > 0): ?>
                            <strong class="text-danger" style="font-size: 24px;"><?= priceFormatted(user()->commission_debt, $paymentSettings->default_currency); ?>    </strong>
                        <?php else: ?>
                            <span class="text-success"><?= "Borçunuz yok"; ?></span>
                        <?php endif; ?>
                    </div>
                    <small><?= "Komisyon Borç Limiti"; ?>:&nbsp;<b style="color: #777;"><?= priceFormatted($paymentSettings->cash_on_delivery_debt_limit, $paymentSettings->default_currency); ?></b></small>
                </div>
                <?php if (user()->commission_debt > 0): ?>
                    <div class="alert alert-info alert-large">
                        <?= "Fon ekle borç öde"; ?>
                    </div>
                    <div class="form-group text-right">
                        <a href="<?= generateUrl('wallet'); ?>?tab=deposits" class="btn btn-md btn-success"><?= "Cüzdan" ?>&nbsp;&nbsp;<i class="fa fa-long-arrow-right"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Durum"; ?></h3>
                </div>
            </div>
            <div class="box-body">
                <?php if (user()->commission_debt >= $paymentSettings->cash_on_delivery_debt_limit): ?>
                    <div class="alert alert-danger alert-large">
                        <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "Kapıda ödeme seçeneği devre dışı"; ?>
                    </div>
                <?php else: ?>
                    <form action="<?= base_url('Dashboard/cashOnDeliverySettingsPost'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="cash_on_delivery" value="1" id="cash_on_delivery_1" class="custom-control-input" <?= user()->cash_on_delivery == 1 ? 'checked' : ''; ?>>
                                        <label for="cash_on_delivery_1" class="custom-control-label"><?= "Etkin"; ?></label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" name="cash_on_delivery" value="0" id="cash_on_delivery_2" class="custom-control-input" <?= user()->cash_on_delivery != 1 ? 'checked' : ''; ?>>
                                        <label for="cash_on_delivery_2" class="custom-control-label"><?= "Devre Dışı"; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-md btn-success"><?= "Değişiklikleri Kaydet" ?></button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

