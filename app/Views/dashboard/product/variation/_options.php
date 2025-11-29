<div class="modal-header">
    <h5 class="modal-title"><?= "Seçenekler"; ?>&nbsp;(<?= esc(getVariationLabel($variation->label_names, selectedLangId())); ?>)</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"><i class="icon-close"></i></span>
    </button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="variation-options-container">
                <?php if (!empty($variationOptions)): ?>
                    <ul>
                        <?php foreach ($variationOptions as $option): ?>
                            <li>
                                <div class="pull-left">
                                    <strong class="font-500"><?= esc(getVariationOptionName($option->option_names, selectedLangId())); ?></strong>
                                    <?php if ($option->is_default != 1): ?>
                                        <span><?= "Stok"; ?>:&nbsp;<strong><?= $option->stock; ?></strong></span>
                                    <?php endif;
                                    if ($option->is_default == 1): ?>
                                        <label class="label label-success"><?= "Varsayılan"; ?></label>
                                    <?php endif; ?>
                                </div>
                                <div class="pull-right">
                                    <button type="button" class="btn btn-sm btn-default btn-variation-table" onclick='editProductVariationOption("<?= $variation->id; ?>","<?= $option->id; ?>");'><i class="icon-edit"></i><?= 'Düzenle'; ?></button>
                                    <button type="button" class="btn btn-sm btn-danger btn-variation-table" onclick='deleteProductVariationOption("<?= $variation->id; ?>","<?= $option->id; ?>","<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>");'><i class="icon-trash"></i><?= 'Sil'; ?></button>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted text-center m-t-15"> <?= "Kayıt bulunamadı"; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row-custom">
        <button type="submit" class="btn btn-md btn-secondary color-white pull-right" data-dismiss="modal"><?= "Kapat"; ?></button>
    </div>
</div>