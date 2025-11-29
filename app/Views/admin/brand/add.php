<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Marka Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl("brands"); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Markalar"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Category/addBrandPost'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Ad"; ?></label>
                        <?php foreach ($activeLanguages as $language): ?>
                            <input type="text" class="form-control m-b-5" name="name_lang_<?= $language->id; ?>" placeholder="<?= esc($language->name); ?>" maxlength="255" required>
                        <?php endforeach; ?>
                    </div>
                    <div class="form-group">
                        <?= view("admin/includes/_category_picker", ['strCategoryIds' => '']); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Kaydırıcıda Göster"; ?></label>
                        <?= formRadio('show_on_slider', 1, 0, "Evet", "Hayır", 0, 'col-lg-4'); ?>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= 'Logo'; ?>&nbsp;(<?= "İsteğe Bağlı"; ?>)</label>
                        <div class="display-block">
                            <a class='btn btn-success btn-sm btn-file-upload'>
                                <?= "Logo Seç"; ?>
                                <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .gif" onchange="$('#upload-file-info-add').html($(this).val().replace(/.*[\/\\]/, ''));">
                            </a>
                            (.png, .jpg, .jpeg, .gif)
                        </div>
                        <span class='label label-info' id="upload-file-info-add"></span>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Marka Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>