<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Vergi Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl("payment-settings"); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Ödeme Ayarları"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Admin/addTaxPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Vergi Adı"; ?></label>
                        <?php foreach ($activeLanguages as $language): ?>
                            <input type="text" name="tax_name_<?= $language->id; ?>" class="form-control m-b-5" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Vergi Oranı"; ?>(%)</label>
                        <input type="number" name="tax_rate" value="1" class="form-control" min="0" max="99.99" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <?= formCheckbox('product_sales', 1, 'Ürün Satışlarına Uygula', 1); ?>
                        <?= formCheckbox('service_payments', 1, 'Hizmet Ödemelerine Uygula (Üyelik Ödemeleri, Promosyon Ödemeleri)', 1); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Durum"; ?></label>
                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", 1); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Konum"; ?></label>
                        <div class="custom-control custom-checkbox" style="margin-bottom: 20px;">
                            <input type="checkbox" name="all_countries" value="1" id="checkboxAllCountries" class="custom-control-input">
                            <label for="checkboxAllCountries" class="custom-control-label"><?= "Tüm Konumlar"; ?></label>
                        </div>
                        <?= view('admin/includes/_tax_location_picker'); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Vergi Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>