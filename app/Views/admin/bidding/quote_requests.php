<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <div class="row table-filter-container">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-default filter-toggle collapsed m-b-10" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false">
                                    <i class="fa fa-filter"></i>&nbsp;&nbsp;<?= "Filtrele"; ?>
                                </button>
                                <div class="collapse navbar-collapse" id="collapseFilter">
                                    <form action="<?= adminUrl('quote-requests') ?>" method="get">
                                        <div class="item-table-filter" style="width: 80px; min-width: 80px;">
                                            <label><?= "Göster"; ?></label>
                                            <select name="show" class="form-control">
                                                <option value="15" <?= inputGet('show') == '15' ? 'selected' : ''; ?>>15</option>
                                                <option value="30" <?= inputGet('show') == '30' ? 'selected' : ''; ?>>30</option>
                                                <option value="60" <?= inputGet('show') == '60' ? 'selected' : ''; ?>>60</option>
                                                <option value="100" <?= inputGet('show') == '100' ? 'selected' : ''; ?>>100</option>
                                            </select>
                                        </div>
                                        <div class="item-table-filter">
                                            <label><?= "Durum"; ?></label>
                                            <select name="status" class="form-control custom-select">
                                                <option value="" selected><?= "Tümü"; ?></option>
                                                <option value="new_quote_request" <?= inputGet('status') == 'new_quote_request' ? 'selected' : ''; ?>><?= "Yeni Teklif Talebi"; ?></option>
                                                <option value="pending_quote" <?= inputGet('status') == 'pending_quote' ? 'selected' : ''; ?>><?= "Bekleyen Teklif"; ?></option>
                                                <option value="pending_payment" <?= inputGet('status') == 'pending_payment' ? 'selected' : ''; ?>><?= "Bekleyen Ödeme"; ?></option>
                                                <option value="rejected_quote" <?= inputGet('status') == 'rejected_quote' ? 'selected' : ''; ?>><?= "Reddedilen Teklif"; ?></option>
                                                <option value="closed" <?= inputGet('status') == 'closed' ? 'selected' : ''; ?>><?= "Kapatıldı"; ?></option>
                                                <option value="completed" <?= inputGet('status') == 'completed' ? 'selected' : ''; ?>><?= "Tamamlandı"; ?></option>
                                            </select>
                                        </div>
                                        <div class="item-table-filter">
                                            <label><?= "Ara"; ?></label>
                                            <input name="q" class="form-control" placeholder="<?= "Ara"; ?>" type="search" value="<?= esc(inputGet('q')); ?>">
                                        </div>
                                        <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
                                            <label style="display: block">&nbsp;</label>
                                            <button type="submit" class="btn bg-purple"><?= "Filtrele"; ?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <thead>
                        <tr role="row">
                            <th><?= "Teklif"; ?></th>
                            <th><?= "Ürün"; ?></th>
                            <th><?= "Satıcı"; ?></th>
                            <th><?= "Alıcı"; ?></th>
                            <th><?= "Durum"; ?></th>
                            <th><?= "Satıcı Teklifi"; ?></th>
                            <th><?= "Güncellendi"; ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($quoteRequests)):
                            foreach ($quoteRequests as $item): ?>
                                <tr>
                                    <td>#<?= $item->id; ?></td>
                                    <td class="td-product">
                                        <?php $product = getProduct($item->product_id);
                                        if (!empty($product)):?>
                                            <div class="img-table">
                                                <a href="<?= generateProductUrl($product); ?>" target="_blank">
                                                    <img src="<?= getProductMainImage($product->id, 'image_small'); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
                                                </a>
                                            </div>
                                            <a href="<?= generateProductUrl($product); ?>" target="_blank" class="table-product-title">
                                                <?= esc($item->product_title); ?>
                                            </a><br>
                                            <?= "Miktar" . ': ' . $item->product_quantity; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= generateProfileUrl($item->seller_slug); ?>" target="_blank" class="table-link"><?= esc($item->seller_username); ?></a>
                                    </td>
                                    <td>
                                        <a href="<?= generateProfileUrl($item->buyer_slug); ?>" target="_blank" class="table-link"><?= esc($item->buyer_username); ?></a>
                                    </td>
                                    <td><?= $item->status == 'new_quote_request' ? 'Yeni Teklif Talebi' : ($item->status == 'pending_quote' ? 'Bekleyen Teklif' : ($item->status == 'pending_payment' ? 'Bekleyen Ödeme' : ($item->status == 'rejected_quote' ? 'Reddedilen Teklif' : ($item->status == 'closed' ? 'Kapatıldı' : ($item->status == 'completed' ? 'Tamamlandı' : $item->status))))); ?></td>
                                    <td>
                                        <?php if ($item->status != 'new_quote_request' && $item->price_offered != 0): ?>
                                            <div class="table-seller-bid">
                                                <p><strong><?= priceFormatted($item->price_offered, $item->price_currency); ?></strong></p>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= timeAgo($item->updated_at); ?></td>
                                    <td><?= formatDate($item->created_at); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li><a href="javascript:void(0)" onclick="deleteItem('Product/deleteQuoteRequestPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($quoteRequests)): ?>
                        <p class="text-center">
                            <?= "Kayıt bulunamadı"; ?>
                        </p>
                    <?php endif; ?>
                    <div class="col-sm-12 table-ft">
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