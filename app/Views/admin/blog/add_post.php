<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Gönderi Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('blog-posts'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Gönderiler"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Blog/addPostPost'); ?>" method="post" enctype="multipart/form-data">
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
                        <label class="control-label"><?= "Özet"; ?> & <?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <textarea class="form-control text-area" name="summary" placeholder="<?= "Özet"; ?> & <?= "Açıklama"; ?> (<?= "Meta Etiket"; ?>)"><?= old('summary'); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)</label>
                        <input type="text" class="form-control" name="keywords" placeholder="<?= "Anahtar Kelimeler"; ?> (<?= "Meta Etiket"; ?>)" value="<?= old('keywords'); ?>">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label"><?= "Etiketler"; ?></label>
                                <div class="tags-input-container">
                                    <input type="text" name="tags" class="tags-input form-control" placeholder="<?= "Etiket yazın"; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><?= "Dil"; ?></label>
                        <select name="lang_id" class="form-control max-600" onchange="getBlogCategoriesByLang(this.value);">
                            <?php foreach ($activeLanguages as $language): ?>
                                <option value="<?= $language->id; ?>" <?= selectedLangId() == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Kategori"; ?></label>
                        <select id="categories" name="category_id" class="form-control max-600" required>
                            <option value=""><?= "Kategori Seç"; ?></option>
                            <?php if (!empty($categories)):
                                foreach ($categories as $item): ?>
                                    <option value="<?= $item->id; ?>"><?= esc($item->name); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Resim"; ?></label>
                        <div class="row">
                            <div class="col-sm-12">
                                <div id="blog_select_image_container" class="post-select-image-container">
                                    <a class="btn-select-image btn-file-manager" data-image-type="main" data-toggle="modal" data-target="#imageFileManagerModal">
                                        <div class="btn-select-image-inner">
                                            <i class="fa fa-image"></i>
                                            <button class="btn"><?= "Resim Seç"; ?></button>
                                        </div>
                                    </a>
                                </div>
                                <input type="hidden" name="blog_image_id" id="blog_image_id">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label class="control-label"><?= "İçerik"; ?></label>
                                <div class="row">
                                    <div class="col-sm-12 m-b-5">
                                        <button type="button" class="btn btn-success btn-file-manager" data-image-type="editor" data-toggle="modal" data-target="#imageFileManagerModal"><i class="fa fa-image"></i>&nbsp;&nbsp;<?= "Resim Ekle"; ?></button>
                                    </div>
                                </div>
                                <textarea class="form-control tinyMCE" name="content"><?= old('content'); ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Gönderi Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= view('admin/includes/_image_file_manager'); ?>

