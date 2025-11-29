<!-- Hızlı İşlemler -->
<div class="row m-t-10">
    <div class="col-lg-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-bolt"></i> Hızlı İşlemler</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <?php if (hasPermission('products')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= generateDashUrl('add_product'); ?>" target="_blank" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px;">
                                <i class="fa fa-plus-circle fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Ürün Ekle</span>
                            </a>
                        </div>
                    <?php endif;
                    if (hasPermission('categories')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= adminUrl('add-category'); ?>" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px; background-color: #00a65a; color: white;">
                                <i class="fa fa-folder-plus fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Kategori Ekle</span>
                            </a>
                        </div>
                    <?php endif;
                    if (hasPermission('pages')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= adminUrl('add-page'); ?>" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px; background-color: #3c8dbc; color: white;">
                                <i class="fa fa-file-text fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Sayfa Ekle</span>
                            </a>
                        </div>
                    <?php endif;
                    if (hasPermission('blog')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= adminUrl('blog-add-post'); ?>" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px; background-color: #f39c12; color: white;">
                                <i class="fa fa-pencil fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Blog Yazısı Ekle</span>
                            </a>
                        </div>
                    <?php endif;
                    if (hasPermission('brands')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= adminUrl('add-brand'); ?>" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px; background-color: #9c27b0; color: white;">
                                <i class="fa fa-asterisk fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Marka Ekle</span>
                            </a>
                        </div>
                    <?php endif;
                    if (hasPermission('slider')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= adminUrl('slider'); ?>" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px; background-color: #dd4b39; color: white;">
                                <i class="fa fa-sliders fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Slider Yönet</span>
                            </a>
                        </div>
                    <?php endif;
                    if (hasPermission('membership')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= adminUrl('users'); ?>" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px; background-color: #00c0ef; color: white;">
                                <i class="fa fa-user-plus fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Kullanıcı Ekle</span>
                            </a>
                        </div>
                    <?php endif;
                    if (hasPermission('custom_fields')): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                            <a href="<?= adminUrl('add-custom-field'); ?>" class="btn btn-app btn-block" style="min-height: 80px; padding: 15px; background-color: #605ca8; color: white;">
                                <i class="fa fa-plus-square fa-2x"></i>
                                <span style="font-size: 14px; font-weight: bold;">Özel Alan Ekle</span>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row m-t-10">
    <?php if (hasPermission('orders')): ?>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box admin-small-box bg-success">
                <div class="inner">
                    <h3 id="counterOrderCount" class="increase-count">
                        <?php if (!empty($counters)):
                            echo $counters['orderCount']; ?>
                        <?php else: ?>
                            <div class="circular-spinner-inline"></div>
                        <?php endif; ?>
                    </h3>
                    <a href="<?= adminUrl('orders'); ?>"><p>Siparişler</p></a>
                </div>
                <div class="icon">
                    <a href="<?= adminUrl('orders'); ?>"><i class="fa fa-shopping-cart"></i></a>
                </div>
            </div>
        </div>
    <?php endif;
    if (hasPermission('products')): ?>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box admin-small-box bg-purple">
                <div class="inner">
                    <h3 id="counterProductsCount" class="increase-count">
                        <?php if (!empty($counters)):
                            echo $counters['productsCount']; ?>
                        <?php else: ?>
                            <div class="circular-spinner-inline"></div>
                        <?php endif; ?>
                    </h3>
                    <a href="<?= adminUrl('products'); ?>"><p>Ürünler</p></a>
                </div>
                <div class="icon">
                    <a href="<?= adminUrl('products'); ?>"><i class="fa fa-shopping-basket"></i></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box admin-small-box bg-danger">
                <div class="inner">
                    <h3 id="counterPendingProductCount" class="increase-count">
                        <?php if (!empty($counters)):
                            echo $counters['pendingProductCount']; ?>
                        <?php else: ?>
                            <div class="circular-spinner-inline"></div>
                        <?php endif; ?>
                    </h3>
                    <a href="<?= adminUrl('products'); ?>?list=pending">
                        <p>Bekleyen Ürünler</p>
                    </a>
                </div>
                <div class="icon">
                    <a href="<?= adminUrl('products'); ?>?list=pending"><i class="fa fa-low-vision"></i></a>
                </div>
            </div>
        </div>
    <?php endif;
    if (hasPermission('membership')): ?>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box admin-small-box bg-warning">
                <div class="inner">
                    <h3 id="counterMembersCount" class="increase-count">
                        <?php if (!empty($counters)):
                            echo $counters['membersCount']; ?>
                        <?php else: ?>
                            <div class="circular-spinner-inline"></div>
                        <?php endif; ?>
                    </h3>
                    <a href="<?= adminUrl('users'); ?>"><p>Üyeler</p></a>
                </div>
                <div class="icon">
                    <a href="<?= adminUrl('users'); ?>"><i class="fa fa-users"></i></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if (hasPermission('orders')): ?>
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title">Son Siparişler</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body index-table">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Sipariş</th>
                                <th>Toplam</th>
                                <th>Durum</th>
                                <th>Tarih</th>
                                <th>Detaylar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($latestOrders)):
                                foreach ($latestOrders as $item): ?>
                                    <tr>
                                        <td>#<?= $item->order_number; ?></td>
                                        <td><?= priceFormatted($item->price_total, $item->price_currency); ?></td>
                                        <td>
                                            <?php if ($item->status == 1):
                                                echo "Tamamlandı";
                                            elseif ($item->status == 2):
                                                echo "İptal Edildi";
                                            else:
                                                echo "Sipariş İşleniyor";
                                            endif; ?>
                                        </td>
                                        <td><?= formatDate($item->created_at); ?></td>
                                        <td style="width: 10%">
                                            <a href="<?= adminUrl('order-details') . '/' . esc($item->id); ?>" class="btn btn-xs btn-info">Detaylar</a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?= adminUrl('orders'); ?>" class="btn btn-sm btn-default pull-right">Tümünü Görüntüle</a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title">Son İşlemler</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body index-table">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sipariş</th>
                                <th>Ödeme Tutarı</th>
                                <th>Ödeme Yöntemi</th>
                                <th>Durum</th>
                                <th>Tarih</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($latestTransactions)):
                                foreach ($latestTransactions as $item): ?>
                                    <tr>
                                        <td style="width: 10%"><?= esc($item->id); ?></td>
                                        <td style="white-space: nowrap">#<?= $item->order_id + 10000; ?></td>
                                        <td><?= priceCurrencyFormat($item->payment_amount, $item->currency); ?></td>
                                        <td><?= getPaymentMethod($item->payment_method); ?></td>
                                        <td><?= $item->payment_status == 'completed' ? 'Tamamlandı' : ($item->payment_status == 'pending' ? 'Beklemede' : 'İptal Edildi'); ?></td>
                                        <td><?= formatDate($item->created_at); ?></td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?= adminUrl('transactions'); ?>" class="btn btn-sm btn-default pull-right">Tümünü Görüntüle</a>
                </div>
            </div>
        </div>
    </div>
<?php endif;
if (hasPermission('products')): ?>
    <div class="row">
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title">Son Ürünler</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body index-table">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>İsim</th>
                                <th>Detaylar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($latestProducts)):
                                foreach ($latestProducts as $item): ?>
                                    <tr>
                                        <td style="width: 10%"><?= esc($item->id); ?></td>
                                        <td class="td-product-small">
                                            <div class="img-table">
                                                <a href="<?= generateProductUrl($item); ?>" target="_blank">
                                                    <img src="<?= getProductItemImage($item); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
                                                </a>
                                            </div>
                                            <a href="<?= generateProductUrl($item); ?>" target="_blank" class="table-product-title"><?= getProductTitle($item); ?></a>
                                            <br>
                                            <div class="table-sm-meta"><?= timeAgo($item->created_at); ?></div>
                                        </td>
                                        <td style="width: 10%">
                                            <a href="<?= adminUrl('product-details') . '/' . esc($item->id); ?>" class="btn btn-xs btn-info"><?= "Detaylar"; ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?= adminUrl('products'); ?>" class="btn btn-sm btn-default pull-right"><?= "Tümünü Görüntüle"; ?></a>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Son Bekleyen Ürünler"; ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body index-table">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th><?= "ID"; ?></th>
                                <th><?= "Ad"; ?></th>
                                <th><?= "Detaylar"; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($latestPendingProducts)):
                                foreach ($latestPendingProducts as $item): ?>
                                    <tr>
                                        <td style="width: 10%"><?= esc($item->id); ?></td>
                                        <td class="td-product-small">
                                            <div class="img-table">
                                                <a href="<?= generateProductUrl($item); ?>" target="_blank">
                                                    <img src="<?= getProductItemImage($item); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
                                                </a>
                                            </div>
                                            <a href="<?= generateProductUrl($item); ?>" target="_blank" class="table-product-title"><?= getProductTitle($item); ?></a>
                                            <br>
                                            <div class="table-sm-meta">
                                                <?= timeAgo($item->created_at); ?>
                                            </div>
                                        </td>
                                        <td style="width: 10%;vertical-align: center !important;">
                                            <a href="<?= adminUrl('product-details') . '/' . esc($item->id); ?>" class="btn btn-xs btn-info"><?= "Detaylar"; ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?= adminUrl('products'); ?>?list=pending" class="btn btn-sm btn-default pull-right"><?= "Tümünü Görüntüle"; ?></a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="row">
    <?php if (hasPermission('products')): ?>
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Son İşlemler"; ?>&nbsp;<small style="font-size: 13px;">(<?= "Öne Çıkan Ürünler"; ?>)</small>
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body index-table">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th><?= "ID"; ?></th>
                                <th><?= "Ödeme Yöntemi"; ?></th>
                                <th><?= "Ödeme Tutarı"; ?></th>
                                <th><?= "Durum"; ?></th>
                                <th><?= "Tarih"; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($latestPromotedTransactions)):
                                foreach ($latestPromotedTransactions as $item): ?>
                                    <tr>
                                        <td style="width: 10%"><?= esc($item->id); ?></td>
                                        <td><?= getPaymentMethod($item->payment_method); ?></td>
                                        <td><?= priceCurrencyFormat($item->payment_amount, $item->currency); ?></td>
                                        <td><?= $item->payment_status == 'payment_received' ? 'Ödeme Alındı' : ($item->payment_status == 'awaiting_payment' ? 'Ödeme Bekleniyor' : $item->payment_status); ?></td>
                                        <td><?= formatDate($item->created_at); ?></td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?= adminUrl('promotion-payments'); ?>" class="btn btn-sm btn-default pull-right"><?= "Tümünü Görüntüle"; ?></a>
                </div>
            </div>
        </div>
    <?php endif;
    if (hasPermission('reviews')): ?>
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Son Yorumlar"; ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body index-table">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th><?= "ID"; ?></th>
                                <th><?= "Kullanıcı Adı"; ?></th>
                                <th style="width: 60%"><?= "Yorum"; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($latestReviews)):
                                foreach ($latestReviews as $item): ?>
                                    <tr>
                                        <td style="width: 10%"><?= esc($item->id); ?></td>
                                        <td style="width: 25%" class="break-word"><?= esc($item->user_username); ?></td>
                                        <td style="width: 65%" class="break-word">
                                            <div><?= view('admin/includes/_review_stars', ['review' => $item->rating]); ?></div>
                                            <?= characterLimiter($item->review, 100); ?>
                                            <div class="table-sm-meta"><?= timeAgo($item->created_at); ?></div>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?= adminUrl('reviews'); ?>" class="btn btn-sm btn-default pull-right"><?= "Tümünü Görüntüle"; ?></a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="row">
    <?php if (hasPermission('reviews')): ?>
        <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="box box-primary box-sm">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= "Son Yorumlar"; ?></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body index-table">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th><?= "ID"; ?></th>
                                <th><?= "Kullanıcı"; ?></th>
                                <th style="width: 60%"><?= "Yorum"; ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($latestComments)):
                                foreach ($latestComments as $item): ?>
                                    <tr>
                                        <td style="width: 10%"><?= esc($item->id); ?></td>
                                        <td style="width: 25%" class="break-word"><?= esc($item->name); ?></td>
                                        <td style="width: 65%" class="break-word">
                                            <?= characterLimiter($item->comment, 100); ?>
                                            <div class="table-sm-meta"><?= timeAgo($item->created_at); ?></div>
                                        </td>
                                    </tr>
                                <?php endforeach;
                            endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer clearfix">
                    <a href="<?= adminUrl('product-comments'); ?>" class="btn btn-sm btn-default pull-right"><?= "Tümünü Görüntüle"; ?></a>
                </div>
            </div>
        </div>
    <?php endif;
    if (hasPermission('membership')): ?>
        <div class="no-padding margin-bottom-20">
            <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="box box-primary box-sm">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= "Son Üyeler"; ?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <div class="box-body">
                        <ul class="users-list clearfix">
                            <?php if (!empty($latestMembers)):
                                foreach ($latestMembers as $item):?>
                                    <li>
                                        <a href="<?= generateProfileUrl($item->slug); ?>">
                                            <img src="<?= getUserAvatar($item); ?>" alt="user" class="img-responsive">
                                        </a>
                                        <a href="<?= generateProfileUrl($item->slug); ?>" class="users-list-name"><?= esc(getUsername($item)); ?></a>
                                        <span class="users-list-date"><?= timeAgo($item->created_at); ?></span>
                                    </li>
                                <?php endforeach;
                            endif; ?>
                        </ul>
                    </div>
                    <div class="box-footer text-center">
                        <a href="<?= adminUrl('users'); ?>" class="btn btn-sm btn-default btn-flat pull-right"><?= "Tümünü Görüntüle"; ?></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .small-box h3 {
        height: 42px;
    }
    .btn-app {
        margin-bottom: 10px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .btn-app:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .btn-app i {
        margin-bottom: 5px;
    }
</style>

<?php if (empty($counters)): ?>
    <script>
        $(document).ready(function () {
            var data = {};
            $.ajax({
                type: 'POST',
                url: MdsConfig.baseURL + '/Admin/loadCountersPost',
                data: setAjaxData(data),
                success: function (response) {
                    var obj = JSON.parse(response);
                    if (obj.status == 1) {
                        document.getElementById("counterOrderCount").innerHTML = obj.orderCount;
                        document.getElementById("counterProductsCount").innerHTML = obj.productsCount;
                        document.getElementById("counterPendingProductCount").innerHTML = obj.pendingProductCount;
                        document.getElementById("counterMembersCount").innerHTML = obj.membersCount;
                    }
                }
            });
        });
    </script>
<?php else: ?>
    <script>
        $('.increase-count').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 1000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>
<?php endif; ?>