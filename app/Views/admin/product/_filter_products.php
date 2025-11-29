<?php $formAction = adminUrl('products?list=' . esc($list));
if ($list == 'featured') {
    $formAction = adminUrl('featured-products');
} ?>
<div class="row table-filter-container">
    <div class="col-sm-12">
        <button type="button" class="btn btn-default filter-toggle collapsed m-b-10" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false">
            <i class="fa fa-filter"></i>&nbsp;&nbsp;<?= "Filtrele"; ?>
        </button>
        <div class="collapse navbar-collapse" id="collapseFilter">
            <form action="<?= $formAction; ?>" method="submit" id="formFilterProducts">
                <?php if ($list != 'featured'): ?>
                    <input type="hidden" name="list" value="<?= esc($list); ?>">
                <?php endif; ?>
                <div class="item-table-filter" style="width: 80px; min-width: 80px;">
                    <label><?= "Göster"; ?></label>
                    <select name="show" class="form-control">
                        <option value="15" <?= inputGet('show', true) == '15' ? 'selected' : ''; ?>>15</option>
                        <option value="30" <?= inputGet('show', true) == '30' ? 'selected' : ''; ?>>30</option>
                        <option value="60" <?= inputGet('show', true) == '60' ? 'selected' : ''; ?>>60</option>
                        <option value="100" <?= inputGet('show', true) == '100' ? 'selected' : ''; ?>>100</option>
                    </select>
                </div>
                <div class="item-table-filter">
                    <label><?= "İlan Türü"; ?></label>
                    <select name="listing_type" class="form-control custom-select">
                        <option value="" selected><?= "Tümü"; ?></option>
                        <option value="sell_on_site" <?= inputGet('listing_type') == 'sell_on_site' ? 'selected' : ''; ?>><?= "Marketplace - Sitede Ürün Satışı"; ?></option>
                        <option value="ordinary_listing" <?= inputGet('listing_type') == 'ordinary_listing' ? 'selected' : ''; ?>><?= "İlan Sistemi - Ürünü İlan Olarak Ekleme"; ?></option>
                        <option value="bidding" <?= inputGet('listing_type') == 'bidding' ? 'selected' : ''; ?>><?= "Teklif Sistemi - Fiyat Teklifi İsteme"; ?></option>
                        <option value="license_key" <?= inputGet('listing_type') == 'license_key' ? 'selected' : ''; ?>><?= "Lisans Anahtarı Satışı"; ?></option>
                    </select>
                </div>
                <div class="item-table-filter">
                    <label><?= "Ürün Türü"; ?></label>
                    <select name="product_type" class="form-control custom-select">
                        <option value="" selected><?= "Tümü"; ?></option>
                        <option value="physical" <?= inputGet('product_type') == 'physical' ? 'selected' : ''; ?>><?= "Fiziksel"; ?></option>
                        <option value="digital" <?= inputGet('product_type') == 'digital' ? 'selected' : ''; ?>><?= "Dijital"; ?></option>
                    </select>
                </div>
                <div class="item-table-filter">
                    <label><?= "Kategori"; ?></label>
                    <select id="categories" name="category" class="form-control" onchange="getFilterSubCategories(this.value);">
                        <option value=""><?= "Tümü"; ?></option>
                        <?php $categories = $categoryModel->getParentCategories();
                        foreach ($categories as $item): ?>
                            <option value="<?= $item->id; ?>" <?= inputGet('category', true) == $item->id ? 'selected' : ''; ?>>
                                <?= getCategoryName($item, $activeLang->id); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="item-table-filter">
                    <label class="control-label"><?= "Alt Kategori"; ?></label>
                    <select id="subcategories" name="subcategory" class="form-control">
                        <option value=""><?= "Tümü"; ?></option>
                        <?php if (!empty(inputGet('category'))):
                            $subCategories = $categoryModel->getSubCategoriesByParentId(inputGet('category'));
                            if (!empty($subCategories)):
                                foreach ($subCategories as $item):?>
                                    <option value="<?= $item->id; ?>" <?= inputGet('subcategory') == $item->id ? 'selected' : ''; ?>><?= getCategoryName($item, $activeLang->id); ?></option>
                                <?php endforeach;
                            endif;
                        endif; ?>
                    </select>
                </div>
                <div class="item-table-filter">
                    <label><?= "Stok"; ?></label>
                    <select name="stock" class="form-control custom-select">
                        <option value="" selected><?= "Tümü"; ?></option>
                        <option value="in_stock" <?= inputGet("stock") == 'in_stock' ? 'selected' : ''; ?>><?= "Stokta"; ?></option>
                        <option value="out_of_stock" <?= inputGet("stock") == 'out_of_stock' ? 'selected' : ''; ?>><?= "Stokta Yok"; ?></option>
                    </select>
                </div>
                <div class="item-table-filter" style="width: 320px;">
                    <label><?= "Ara"; ?></label>
                    <div class="item-table-filter-search">
                        <input name="q" class="form-control" placeholder="<?= "Ara"; ?>" type="search" value="<?= esc(inputGet('q')); ?>">
                        <button type="submit" class="btn bg-purple"><?= "Filtrele"; ?></button>
                        <div class="btn-group table-export">
                            <button type="button" class="btn btn-default dropdown-toggle btn-table-export" data-toggle="dropdown"><?= "Dışa Aktar"; ?>&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <button type="button" class="btn-export-data" data-export-form="formFilterProducts" data-export-type="products" data-export-file-type="csv">CSV</button>
                                </li>
                                <li>
                                    <button type="button" class="btn-export-data" data-export-form="formFilterProducts" data-export-type="products" data-export-file-type="xml">XML</button>
                                </li>
                                <li>
                                    <button type="button" class="btn-export-data" data-export-form="formFilterProducts" data-export-type="products" data-export-file-type="excel"><?= "Excel"; ?>&nbsp;(.xlsx)</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>