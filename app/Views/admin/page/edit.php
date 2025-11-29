<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Sayfayı Güncelle"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/editPagePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $page->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "Başlık"; ?></label>
                        <input type="text" class="form-control" name="title" placeholder="<?= "Başlık"; ?>" value="<?= esc($page->title); ?>" required>
                    </div>
                    <?php if (empty($page->page_default_name)): ?>
                        <div class="form-group">
                            <label class="control-label"><?= "Slug"; ?>
                                <small>(<?= "Slug açıklaması"; ?>)</small>
                            </label>
                            <input type="text" class="form-control" name="slug" placeholder="<?= "Slug"; ?>" value="<?= esc($page->slug); ?>">
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="slug" value="<?= esc($page->slug); ?>">
                    <?php endif; ?>
                    <div class="form-group">
                        <label class="control-label"><?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="description" placeholder="<?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)" value="<?= esc($page->description); ?>">
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)" value="<?= esc($page->keywords); ?>">
                    </div>

                    <div class="form-group">
                        <label><?= "Dil"; ?></label>
                        <select name="lang_id" class="form-control" style="max-width: 600px;">
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= $page->lang_id == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?= "Sıra"; ?></label>
                        <input type="number" class="form-control" name="page_order" placeholder="<?= "Sıra"; ?>" value="<?= $page->page_order; ?>" min="1" style="max-width: 600px;">
                    </div>

                    <div class="form-group">
                        <label><?= "Konum"; ?></label>
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="top_menu" id="location_1" class="custom-control-input" <?= $page->location == 'top_menu' ? 'checked' : ''; ?>>
                                    <label for="location_1" class="custom-control-label"><?= "Üst Menü"; ?></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="quick_links" id="location_2" class="custom-control-input" <?= $page->location == 'quick_links' ? 'checked' : ''; ?>>
                                    <label for="location_2" class="custom-control-label"><?= "Footer Hızlı Linkler"; ?></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="information" id="location_3" class="custom-control-input" <?= $page->location == 'information' ? 'checked' : ''; ?>>
                                    <label for="location_3" class="custom-control-label"><?= "Footer Bilgi"; ?></label>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="location" value="footer_bottom" id="location_4" class="custom-control-input" <?= $page->location == 'footer_bottom' ? 'checked' : ''; ?>>
                                    <label for="location_4" class="custom-control-label"><?= "Footer Alt"; ?></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><?= "Görünürlük"; ?></label>
                        <?= formRadio('visibility', 1, 0, "Göster", "Gizle", $page->visibility, 'col-md-2'); ?>
                    </div>

                    <?php if ($page->page_default_name != 'blog' && $page->page_default_name != 'contact' && $page->page_default_name != 'shops'): ?>
                        <div class="form-group">
                            <label><?= "Başlığı Göster"; ?></label>
                            <?= formRadio('title_active', 1, 0, "Evet", "Hayır", $page->title_active, 'col-md-2'); ?>
                        </div>
                    <?php else: ?>
                        <input type="hidden" value="1" name="title_active">
                    <?php endif;
                    if ($page->page_default_name != 'blog' && $page->page_default_name != 'contact' && $page->page_default_name != 'shops'): ?>
                        <div class="form-group" style="margin-top: 30px;">
                            <label><?= "İçerik"; ?></label>
                            <div class="row">
                                <div class="col-sm-12 m-b-5">
                                    <button type="button" class="btn btn-success btn-file-manager" data-image-type="editor" data-toggle="modal" data-target="#imageFileManagerModal"><i class="fa fa-image"></i>&nbsp;&nbsp;<?= "Resim Ekle"; ?></button>
                                </div>
                            </div>
                            <textarea class="form-control tinyMCE" name="page_content"><?= $page->page_content; ?></textarea>
                        </div>
                    <?php else: ?>
                        <input type="hidden" value="" name="page_content">
                    <?php endif; ?>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('admin/includes/_image_file_manager'); ?>