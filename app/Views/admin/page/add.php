<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Sayfa Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl("pages"); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Sayfalar"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Admin/addPagePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "Başlık"; ?></label>
                        <input type="text" class="form-control" name="title" placeholder="<?= "Başlık"; ?>" value="<?= old('title'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= "Slug"; ?>
                            <small>(<?= "Slug açıklaması"; ?>)</small>
                        </label>
                        <input type="text" class="form-control" name="slug" placeholder="<?= "Slug"; ?>" value="<?= old('slug'); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="description" placeholder="<?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)" value="<?= old('description'); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)" value="<?= old('keywords'); ?>">
                    </div>
                    <div class="form-group">
                        <label><?= "Dil"; ?></label>
                        <select name="lang_id" class="form-control" style="max-width: 600px;">
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= selectedLangId() == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= "Sıra"; ?></label>
                        <input type="number" class="form-control" name="page_order" placeholder="<?= "Sıra"; ?>" value="1" min="1" style="max-width: 600px;">
                    </div>

                    <div class="form-group">
                        <label><?= "Konum"; ?></label>
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="top_menu" id="location_1" class="custom-control-input" checked>
                                    <label for="location_1" class="custom-control-label"><?= "Üst Menü"; ?></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="quick_links" id="location_2" class="custom-control-input">
                                    <label for="location_2" class="custom-control-label"><?= "Footer Hızlı Linkler"; ?></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="information" id="location_3" class="custom-control-input">
                                    <label for="location_3" class="custom-control-label"><?= "Footer Bilgi"; ?></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="footer_bottom" id="location_4" class="custom-control-input">
                                    <label for="location_4" class="custom-control-label"><?= "Footer Alt"; ?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?= "Görünürlük"; ?></label>
                        <?= formRadio('visibility', 1, 0, "Göster", "Gizle", 1, 'col-md-2'); ?>
                    </div>

                    <div class="form-group">
                        <label><?= "Başlığı Göster"; ?></label>
                        <?= formRadio('title_active', 1, 0, "Evet", "Hayır", 1, 'col-md-2'); ?>
                    </div>

                    <div class="form-group" style="margin-top: 30px;">
                        <label><?= "İçerik"; ?></label>
                        <div class="row">
                            <div class="col-sm-12 m-b-5">
                                <button type="button" class="btn btn-success btn-file-manager" data-image-type="editor" data-toggle="modal" data-target="#imageFileManagerModal"><i class="fa fa-image"></i>&nbsp;&nbsp;<?= "Resim Ekle"; ?></button>
                            </div>
                        </div>
                        <textarea class="form-control tinyMCE" name="page_content"><?= old('page_content'); ?></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Sayfa Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('admin/includes/_image_file_manager'); ?>