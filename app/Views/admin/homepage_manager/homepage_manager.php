<div class="row">
    <div class="col-sm-12 title-section">
        <h3><?= $title; ?></h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?= "Öne Çıkan Kategoriler"; ?><br>
                    <small><?= "Ana sayfada öne çıkan kategorileri seçin"; ?></small>
                </h3>
            </div>
            <form action="<?= base_url('Admin/homepageManagerPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="is_form" value="1">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "Kategori"; ?></label>
                        <select id="categories" name="category_id[]" class="form-control select2" onchange="getSubCategories(this.value, 0,'category_cnt1');" required>
                            <option value=""><?= "Kategori Seç"; ?></option>
                            <?php if (!empty($parentCategories)):
                                foreach ($parentCategories as $item): ?>
                                    <option value="<?= esc($item->id); ?>"><?= getCategoryName($item, $activeLang->id); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                        <div id="category_cnt1"></div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="submit" value="featured_categories" class="btn btn-primary"><?= "Kategori Seç"; ?></button>
                    </div>
                    <hr>
                    <div class="form-group">
                        <table class="table table-bordered table-striped" role="grid">
                            <tbody>
                            <?php if (!empty($featuredCategories)):
                                foreach ($featuredCategories as $item):
                                    if (!empty($item)):
                                        $categoriesTree = getCategoryParentTree($item, false);
                                        if (!empty($categoriesTree)):?>
                                            <tr>
                                                <td style="vertical-align: middle">
                                                    <?php $count = 0;
                                                    foreach ($categoriesTree as $itemTree):
                                                        if (!empty($itemTree)):
                                                            if ($count == 0) {
                                                                echo getCategoryName($itemTree, $activeLang->id);
                                                            } else {
                                                                echo ' / ' . getCategoryName($itemTree, $activeLang->id);
                                                            }
                                                        endif;
                                                        $count++;
                                                    endforeach; ?>
                                                    <button type="button" class="btn btn-xs btn-default pull-right" onclick='removeItemHomepageManager(<?= $item->id; ?>,"featured_categories");' style="height: 24px;"><?= "Sil"; ?></button>
                                                    <input type="number" class="form-control input-featured-categories-order m-r-5 pull-right" value="<?= $item->featured_order; ?>" data-category-id="<?= $item->id; ?>" min="1" max="9999999" placeholder="<?= "Sıra"; ?>" style="width: 80px; display: inline-block; height: 24px;">
                                                </td>
                                            </tr>
                                        <?php endif;
                                    endif;
                                endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-12 col-lg-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?= "Kategoriye Göre Ürünler"; ?><br>
                    <small><?= "Kategoriye göre ürünler açıklaması"; ?></small>
                </h3>
            </div>
            <form action="<?= base_url('Admin/homepageManagerPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="is_form" value="1">
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "Kategori"; ?></label>
                        <select id="categories2" name="category_id[]" class="form-control select2" onchange="getSubCategories(this.value, 0,'category_cnt2');" required>
                            <option value=""><?= "Kategori Seç"; ?></option>
                            <?php if (!empty($parentCategories)):
                                foreach ($parentCategories as $item): ?>
                                    <option value="<?= esc($item->id); ?>"><?= getCategoryName($item, $activeLang->id); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                        <div id="category_cnt2"></div>
                    </div>
                    <div class="form-group">
                        <?= formCheckbox('show_subcategory_products', 1, "Alt Kategori Ürünlerini Göster"); ?>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" name="submit" value="products_by_category" class="btn btn-primary"><?= "Kategori Seç"; ?></button>
                    </div>
                    <hr>
                    <div class="form-group">
                        <table class="table table-bordered table-striped" role="grid">
                            <tbody>
                            <?php if (!empty($indexCategories)):
                                foreach ($indexCategories as $item):
                                    if (!empty($item)):
                                        $categoriesTree = getCategoryParentTree($item, false);
                                        if (!empty($categoriesTree)):?>
                                            <tr>
                                                <td>
                                                    <?php $count = 0;
                                                    foreach ($categoriesTree as $itemTree):
                                                        if (!empty($itemTree)):
                                                            if ($count == 0) {
                                                                echo getCategoryName($itemTree, $activeLang->id);
                                                            } else {
                                                                echo ' / ' . getCategoryName($itemTree, $activeLang->id);
                                                            }
                                                        endif;
                                                        $count++;
                                                    endforeach; ?>
                                                    <button type="button" class="btn btn-xs btn-default pull-right" onclick='removeItemHomepageManager(<?= $item->id; ?>,"products_by_category");' style="height: 24px;"><?= "Sil"; ?></button>
                                                    <input type="number" class="form-control input-index-categories-order m-r-5 pull-right" value="<?= $item->homepage_order; ?>" data-category-id="<?= $item->id; ?>" min="1" max="9999999" placeholder="<?= "Sıra"; ?>" style="width: 80px; display: inline-block; height: 24px;">
                                                    <?php if ($item->show_subcategory_products == 1): ?>
                                                        <a data-toggle="tooltip" data-placement="top" title="<?= "Alt kategori ürünlerini göster"; ?>" class="m-r-5 pull-right" style="line-height: 24px;"><i class="fa fa-th"></i></a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif;
                                    endif;
                                endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="section_banners" class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title">
                        <?= "Ana Sayfa Bannerları"; ?><br>
                        <small><?= "Ana sayfa bannerları açıklaması"; ?></small>
                    </h3>
                </div>
                <div class="right">
                    <button type="button" class="btn btn-success btn-add-new" data-toggle="modal" data-target="#addBannerModal"><i class="fa fa-plus"></i>&nbsp;&nbsp;<?= "Banner Ekle"; ?></button>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                            <table data-page-length="8" class="table table-bordered table-striped data_table table-no-sort" role="grid">
                                <thead>
                                <tr role="row">
                                    <th width="20"><?= "ID"; ?></th>
                                    <th><?= "Banner"; ?></th>
                                    <th><?= "URL"; ?></th>
                                    <th><?= "Dil"; ?></th>
                                    <th><?= "Sıra"; ?></th>
                                    <th><?= "Banner Genişliği"; ?></th>
                                    <th><?= "Konum"; ?></th>
                                    <th class="th-options"><?= "Seçenekler"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($indexBanners)):
                                    foreach ($indexBanners as $item):
                                        if (!empty($item)): ?>
                                            <tr>
                                                <td><?= $item->id; ?></td>
                                                <td>
                                                    <img src="<?= base_url($item->banner_image_path); ?>" style="max-width: 160px; max-height: 160px;">
                                                </td>
                                                <td><?= $item->banner_url; ?></td>
                                                <td><?php $lang = getLanguage($item->lang_id);
                                                    if (!empty($lang)) {
                                                        echo esc($lang->name);
                                                    } ?></td>
                                                <td><?= $item->banner_order; ?></td>
                                                <td><?= $item->banner_width; ?>%</td>
                                                <td><?= $item->banner_location; ?></td>
                                                <td>
                                                    <div class="btn-group btn-group-option">
                                                        <a href="<?= adminUrl('edit-banner/' . $item->id); ?>" class="btn btn-sm btn-default btn-edit"><?= "Düzenle"; ?></a>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-default btn-delete" onclick="deleteItem('Admin/deleteIndexBannerPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif;
                                    endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                            <?php if (empty($indexBanners)): ?>
                                <p class="text-center">
                                    <?= "Kayıt bulunamadı"; ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Ayarlar"; ?></h3>
            </div>
            <form action="<?= base_url('Admin/homepageManagerSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Öne Çıkan Kategoriler"; ?></label>
                        <?= formRadio('featured_categories', 1, 0, "Göster", "Gizle", $generalSettings->featured_categories); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Öne Çıkan Ürünler"; ?></label>
                        <?= formRadio('index_promoted_products', 1, 0, "Göster", "Gizle", $generalSettings->index_promoted_products); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Son Ürünler"; ?></label>
                        <?= formRadio('index_latest_products', 1, 0, "Göster", "Gizle", $generalSettings->index_latest_products); ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Blog Slider"; ?></label>
                        <?= formRadio('index_blog_slider', 1, 0, "Göster", "Gizle", $generalSettings->index_blog_slider); ?>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <label class="control-label"><?= "Öne Çıkan Ürün Sayısı"; ?></label>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <input type="number" class="form-control" name="index_promoted_products_count" value="<?= esc($generalSettings->index_promoted_products_count); ?>" min="1" required style="max-width: 600px;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <label class="control-label"><?= "Son Ürün Sayısı"; ?></label>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <input type="number" class="form-control" name="index_latest_products_count" value="<?= esc($generalSettings->index_latest_products_count); ?>" min="1" required style="max-width: 600px;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="addBannerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?= base_url('Admin/addIndexBannerPost'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= "Banner Ekle"; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label><?= "Dil"; ?></label>
                                <select name="lang_id" class="form-control">
                                    <?php foreach ($activeLanguages as $language): ?>
                                        <option value="<?= $language->id; ?>" <?= selectedLangId() == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="banner_url" class="form-control" placeholder="<?= "Banner"; ?>&nbsp;<?= "URL"; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="banner_order" min="1" max="9999999" class="form-control" placeholder="<?= "Sıra"; ?>" required>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="number" name="banner_width" min="1" max="100" step="0.01" class="form-control" placeholder="<?= "Banner Genişliği"; ?>&nbsp;(E.g: 50)" required>
                                    <span class="input-group-addon"><strong>%</strong></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label><?= "Konum"; ?>&nbsp;<small>(<?= "Banner konumu açıklaması"; ?>)</small></label>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="banner_location" value="featured_categories" id="banner_location_1" class="custom-control-input" checked>
                                            <label for="banner_location_1" class="custom-control-label"><?= "Öne Çıkan Kategoriler"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="banner_location" value="special_offers" id="banner_location_2" class="custom-control-input">
                                            <label for="banner_location_2" class="custom-control-label"><?= "Özel Teklifler"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="banner_location" value="featured_products" id="banner_location_3" class="custom-control-input">
                                            <label for="banner_location_3" class="custom-control-label"><?= "Öne Çıkan Ürünler"; ?></label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="banner_location" value="new_arrivals" id="banner_location_4" class="custom-control-input">
                                            <label for="banner_location_4" class="custom-control-label"><?= "Yeni Gelenler"; ?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label"><?= "Banner"; ?></label>
                                <div class="display-block">
                                    <a class='btn btn-default btn-sm btn-file-upload'>
                                        <i class="fa fa-image text-muted"></i>&nbsp;&nbsp;<?= "Resim Seç"; ?>
                                        <input type="file" name="file" size="40" accept=".png, .jpg, .jpeg, .webp, .gif" onchange="$('#upload-file-info').html($(this).val().replace(/.*[\/\\]/, ''));" required>
                                    </a>
                                    <br>
                                    <span class='label label-default label-file-upload' id="upload-file-info"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><?= "Banner Ekle"; ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<style>
    .dataTables_length, .dataTables_filter, .dataTables_empty, .dataTables_info, .pagination .disabled {
        display: none !important;
    }
</style>