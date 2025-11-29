<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Vergiyi Düzenle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl("payment-settings"); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Ödeme Ayarları"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Admin/editTaxPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $tax->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Vergi Adı"; ?></label>
                        <?php foreach ($activeLanguages as $language): ?>
                            <input type="text" name="tax_name_<?= $language->id; ?>" value="<?= esc(getTaxName($tax->name_data, $language->id)); ?>" class="form-control m-b-5" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Vergi Oranı"; ?>(%)</label>
                        <input type="number" name="tax_rate" class="form-control" min="0" max="100" step="0.01" value="<?= esc($tax->tax_rate); ?>" required>
                    </div>
                    <div class="form-group">
                        <?= formCheckbox('product_sales', 1, 'Ürün Satışlarına Uygula', $tax->product_sales); ?>
                        <?= formCheckbox('service_payments', 1, 'Hizmet Ödemelerine Uygula (Üyelik Ödemeleri, Promosyon Ödemeleri)', $tax->service_payments); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $tax->status); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Konum"; ?></label>
                        <div class="custom-control custom-checkbox" style="margin-bottom: 20px;">
                            <input type="checkbox" name="all_countries" value="1" id="checkboxAllCountries" class="custom-control-input" <?= !empty($tax->is_all_countries) ? 'checked' : ''; ?>>
                            <label for="checkboxAllCountries" class="custom-control-label"><?= "Tüm Konumlar"; ?></label>
                        </div>
                        <?= view('admin/includes/_tax_location_picker', ['tax' => $tax]); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>