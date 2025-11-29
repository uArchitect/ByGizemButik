<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title">Blog Yazıları</h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('blog-add-post'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Yazı Ekle
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <div class="row table-filter-container">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-default filter-toggle collapsed m-b-10" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false">
                                    <i class="fa fa-filter"></i>&nbsp;&nbsp;Filtrele
                                </button>
                                <div class="collapse navbar-collapse" id="collapseFilter">
                                    <form action="<?= adminUrl('blog-posts'); ?>" method="get">
                                        <div class="item-table-filter" style="width: 80px; min-width: 80px;">
                                            <label>Göster</label>
                                            <select name="show" class="form-control">
                                                <option value="15" <?= inputGet('show', true) == '15' ? 'selected' : ''; ?>>15</option>
                                                <option value="30" <?= inputGet('show', true) == '30' ? 'selected' : ''; ?>>30</option>
                                                <option value="60" <?= inputGet('show', true) == '60' ? 'selected' : ''; ?>>60</option>
                                                <option value="100" <?= inputGet('show', true) == '100' ? 'selected' : ''; ?>>100</option>
                                            </select>
                                        </div>
                                        <div class="item-table-filter">
                                            <label>Dil</label>
                                            <select name="lang_id" class="form-control" onchange="getParentCategoriesByLang(this.value);">
                                                <option value="">Tümü</option>
                                                <?php foreach ($activeLanguages as $language): ?>
                                                    <option value="<?= $language->id; ?>" <?= inputGet('lang_id') == $language->id ? 'selected' : ''; ?>><?= esc($language->name); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="item-table-filter">
                                            <label>Ara</label>
                                            <input name="q" class="form-control" placeholder="Ara" type="search" value="<?= esc(inputGet('q', true)); ?>">
                                        </div>
                                        <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
                                            <label style="display: block">&nbsp;</label>
                                            <button type="submit" class="btn bg-purple">Filtrele</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <thead>
                        <tr role="row">
                            <th width="20"><?= "ID"; ?></th>
                            <th><?= "Başlık"; ?></th>
                            <th><?= "Dil"; ?></th>
                            <th><?= "Kategori"; ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th class="th-options"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($posts)):
                            $model = new \App\Models\BlogModel();
                            foreach ($posts as $item):
                                $category = $model->getCategory($item->category_id);
                                $baseUrl = generateBaseURLByLangId($item->lang_id);
                                $postUrl = $baseUrl. getRoute('blog', true) . $category->slug . '/' . $item->slug; ?>
                                <tr>
                                    <td><?= esc($item->id); ?></td>
                                    <td class="td-product td-blog">
                                        <?php if (!empty($category)): ?>
                                            <a href="<?= $postUrl; ?>" target="_blank" class="a-table">
                                                <div class="img-table">
                                                    <img src="<?= getBlogImageURL($item, 'image_small'); ?>" alt=""/>
                                                </div>
                                                <?= esc($item->title); ?>
                                            </a>
                                        <?php else: ?>
                                            <div class="img-table">
                                                <img src="<?= getBlogImageURL($item, 'image_small'); ?>" alt=""/>
                                            </div>
                                            <?= esc($item->title);
                                        endif; ?>
                                    </td>
                                    <td>
                                        <?php $language = getLanguage($item->lang_id);
                                        if (!empty($language)):
                                            echo $language->name;
                                        endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($category)):
                                            echo esc($category->name);
                                        endif; ?>
                                    </td>
                                    <td><?= formatDate($item->created_at); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li><a href="<?= adminUrl('edit-blog-post/' . $item->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Düzenle"; ?></a></li>
                                                <li><a href="javascript:void(0)" onclick="deleteItem('Blog/deletePostPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($posts)): ?>
                        <p class="text-center"><?= "Kayıt bulunamadı"; ?></p>
                    <?php endif; ?>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="pull-right">
                                <?= $pager->links; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>