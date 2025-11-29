<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= "Bilgi Bankası"; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= $title; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('knowledge-base?lang=' . clrNum(inputGet('lang'))); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Bilgi Bankası"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('SupportAdmin/addCategoryPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Dil"; ?></label>
                        <select name="lang_id" class="form-control" required>
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= inputGet('lang') == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Ad"; ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= "Ad"; ?>" value="<?= old('name'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Slug"; ?>
                            <small>(<?= "URL'de görünecek isim"; ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug" placeholder="<?= "Slug"; ?>" value="<?= old('slug'); ?>">
                    </div>
                    <div class="form-group">
                        <label><?= "Sıra"; ?></label>
                        <input type="number" class="form-control" name="category_order" placeholder="<?= "Sıra"; ?>" value="1" min="1" style="max-width: 300px;">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Kategori Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>