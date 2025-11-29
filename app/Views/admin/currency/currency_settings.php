<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Para Birimi Ayarları</h3>
            </div>
            <form action="<?= base_url('Admin/currencySettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label">Varsayılan Para Birimi</label>
                        <select name="default_currency" class="form-control" required>
                            <option value="">Seçin</option>
                            <?php if (!empty($currencies)):
                                foreach ($currencies as $item):
                                    if ($item->status == 1):?>
                                        <option value="<?= $item->code; ?>" <?= $paymentSettings->default_currency == $item->code ? 'selected' : ''; ?>><?= $item->name . ' (' . $item->symbol . ')'; ?></option>
                                    <?php endif;
                                endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tüm Para Birimlerine İzin Ver</label>
                        <?= formRadio('allow_all_currencies_for_classied', 1, 0, "Evet", "Hayır", $paymentSettings->allow_all_currencies_for_classied); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Para Birimi Dönüştürücü</h3>
            </div>
            <form action="<?= base_url('Admin/currencyConverterPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label>Durum</label>
                        <?= formRadio('currency_converter', 1, 0, "Etkinleştir", "Devre Dışı Bırak", $paymentSettings->currency_converter); ?>
                    </div>
                    <div class="form-group">
                        <label>Döviz Kurlarını Otomatik Güncelle</label>
                        <?= formRadio('auto_update_exchange_rates', 1, 0, "Evet", "Hayır", $paymentSettings->auto_update_exchange_rates); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Para Birimi Dönüştürücü API"; ?></label>
                        <select name="currency_converter_api" class="form-control">
                            <option value=""><?= "Seç"; ?></option>
                            <option value="fixer" <?= $paymentSettings->currency_converter_api == 'fixer' ? 'selected' : ''; ?>>Fixer.io</option>
                            <option value="currencyapi" <?= $paymentSettings->currency_converter_api == 'currencyapi' ? 'selected' : ''; ?>>Currencyapi.net</option>
                            <option value="openexchangerates" <?= $paymentSettings->currency_converter_api == 'openexchangerates' ? 'selected' : ''; ?>>Openexchangerates.org</option>
                        </select>
                        <input type="text" name="currency_converter_api_key" value="<?= $paymentSettings->currency_converter_api_key; ?>" class="form-control m-t-5" placeholder="<?= "Erişim Anahtarı"; ?>">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-12 col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Para Birimleri"; ?></h3>
                </div>
                <div class="right">
                    <?php if ($paymentSettings->currency_converter == 1): ?>
                        <form action="<?= base_url('Admin/updateCurrencyRates'); ?>" method="post" class="display-inline-block">
                            <?= csrf_field(); ?>
                            <button class="btn btn-info btn-add-new"><i class="fa fa-refresh"></i>&nbsp;&nbsp;<?= "Döviz Kurlarını Güncelle"; ?></button>
                        </form>
                    <?php endif; ?>
                    <a href="<?= adminUrl('add-currency'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;<?= "Para Birimi Ekle"; ?>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="table-responsive">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped" id="cs_datatable_currency" role="grid">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?= "ID"; ?></th>
                                    <th><?= "Para Birimi"; ?></th>
                                    <th><?= "Para Birimi Kodu"; ?></th>
                                    <th><?= "Para Birimi Sembolü"; ?></th>
                                    <th><?= "Döviz Kuru"; ?></th>
                                    <th class="th-options"><?= "Seçenekler"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($currencies)):
                                    foreach ($currencies as $item): ?>
                                        <tr>
                                            <td><?= esc($item->id); ?></td>
                                            <td>
                                                <?= esc($item->name); ?>&nbsp;
                                                <?php if ($item->status == 1): ?>
                                                    <label class="label label-success pull-right"><?= "Aktif"; ?></label>
                                                <?php else: ?>
                                                    <label class="label label-default pull-right"><?= "Pasif"; ?></label>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= esc($item->code); ?></td>
                                            <td><?= esc($item->symbol); ?></td>
                                            <td>
                                                <?php if ($paymentSettings->default_currency == $item->code):
                                                    echo "Varsayılan"; ?>
                                                <?php else: ?>
                                                    <input type="number" class="form-control input-exchange-rate" value="<?= $item->exchange_rate; ?>" data-currency-id="<?= $item->id; ?>" min="0" max="999999999" step="0.00001" placeholder="<?= "Döviz Kuru"; ?>" style="width: 150px;">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?><span class="caret"></span></button>
                                                    <ul class="dropdown-menu options-dropdown">
                                                        <li><a href="<?= adminUrl('edit-currency/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Düzenle"; ?></a></li>
                                                        <li><a href="javascript:void(0)" onclick="deleteItem('Admin/deleteCurrencyPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>