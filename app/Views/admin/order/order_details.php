<?php $shipping = unserializeData($order->shipping); ?>
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Sipariş Detayları"; ?></h3>
                </div>
                <div class="right">
                    <?php if ($order->status != 2): ?>
                        <a href="<?= langBaseUrl('invoice/' . esc($order->order_number) . '?type=admin'); ?>" target="_blank" class="btn btn-sm btn-info btn-sale-options btn-view-invoice"><i class="fa fa-file-text-o"></i>&nbsp;&nbsp;&nbsp;<?= "Faturayı Görüntüle"; ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="box-body">
                <div class="row" style="margin-bottom: 30px;">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <h4 class="sec-title"><?= "Sipariş"; ?>#<?= esc($order->order_number); ?></h4>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?= "Durum"; ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <?php if ($order->status == 1): ?>
                                    <label class="label label-success"><?= "Tamamlandı"; ?></label>
                                <?php elseif ($order->status == 2): ?>
                                    <label class="label label-danger"><?= "İptal Edildi"; ?></label>
                                <?php else: ?>
                                    <label class="label label-default"><?= "Sipariş İşleniyor"; ?></label>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?= "Sipariş ID"; ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?= $order->id; ?></strong>
                            </div>
                        </div>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?= "Sipariş Numarası"; ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?= esc($order->order_number); ?></strong>
                            </div>
                        </div>
                        <?php if ($order->status != 2): ?>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Ödeme Yöntemi"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right">
                                        <?= getPaymentMethod($order->payment_method); ?>
                                    </strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Para Birimi"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= $order->price_currency; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Ödeme Durumu"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= $order->payment_status == 'payment_received' ? 'Ödeme Alındı' : ($order->payment_status == 'awaiting_payment' ? 'Ödeme Bekleniyor' : $order->payment_status); ?></strong>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?= "Güncellendi"; ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?= formatDate($order->updated_at); ?>&nbsp;(<?= timeAgo($order->updated_at); ?>)</strong>
                            </div>
                        </div>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-4 col-right">
                                <strong> <?= "Tarih"; ?></strong>
                            </div>
                            <div class="col-sm-8">
                                <strong class="font-right"><?= formatDate($order->created_at); ?>&nbsp;(<?= timeAgo($order->created_at); ?>)</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <h4 class="sec-title"><?= "Alıcı"; ?></h4>
                        <?php if ($order->buyer_id == 0): ?>
                            <div class="row row-details">
                                <div class="col-xs-12">
                                    <div class="table-orders-user">
                                        <img src="<?= getUserAvatar(null); ?>" alt="" class="img-responsive" style="height: 120px;">
                                    </div>
                                </div>
                            </div>
                            <?php if (!empty($shipping)): ?>
                                <div class="row row-details">
                                    <div class="col-xs-12 col-sm-4 col-right">
                                        <strong> <?= "Alıcı"; ?></strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <strong class="font-right">
                                            <?= !empty($shipping->sFirstName) ? esc($shipping->sFirstName) : ''; ?>
                                            <?= !empty($shipping->sLastName) ? esc($shipping->sLastName) : ''; ?>
                                            <label class="label bg-olive"><?= "Misafir"; ?></label>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row row-details">
                                    <div class="col-xs-12 col-sm-4 col-right">
                                        <strong> <?= "Telefon Numarası"; ?></strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <strong class="font-right"><?= !empty($shipping->sPhoneNumber) ? esc($shipping->sPhoneNumber) : ''; ?></strong>
                                    </div>
                                </div>
                                <div class="row row-details">
                                    <div class="col-xs-12 col-sm-4 col-right">
                                        <strong> <?= "E-posta"; ?></strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <strong class="font-right"><?= !empty($shipping->sEmail) ? esc($shipping->sEmail) : ''; ?></strong>
                                    </div>
                                </div>
                            <?php endif;
                        else:
                            $buyer = getUser($order->buyer_id);
                            if (!empty($buyer)):?>
                                <div class="row row-details">
                                    <div class="col-xs-12">
                                        <div class="table-orders-user">
                                            <a href="<?= generateProfileUrl($buyer->slug); ?>" target="_blank">
                                                <img src="<?= getUserAvatar($buyer); ?>" alt="" class="img-responsive" style="height: 120px;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-details">
                                    <div class="col-xs-12 col-sm-4 col-right">
                                        <strong> <?= "Kullanıcı Adı"; ?></strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <strong class="font-right">
                                            <a href="<?= generateProfileUrl($buyer->slug); ?>" target="_blank"><?= esc(getUsername($buyer)); ?></a>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row row-details">
                                    <div class="col-xs-12 col-sm-4 col-right">
                                        <strong> <?= "Telefon Numarası"; ?></strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <strong class="font-right"><?= esc($buyer->phone_number); ?></strong>
                                    </div>
                                </div>
                                <div class="row row-details">
                                    <div class="col-xs-12 col-sm-4 col-right">
                                        <strong> <?= "E-posta"; ?></strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <strong class="font-right"><?= esc($buyer->email); ?></strong>
                                    </div>
                                </div>
                            <?php endif;
                        endif; ?>
                    </div>
                </div>
                <?php if (!empty($shipping)): ?>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <h4 class="sec-title"><?= "Fatura Adresi"; ?></h4>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Ad"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bFirstName) ? esc($shipping->bFirstName) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Soyad"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bLastName) ? esc($shipping->bLastName) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "E-posta"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bEmail) ? esc($shipping->bEmail) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Telefon Numarası"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bPhoneNumber) ? esc($shipping->bPhoneNumber) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Adres"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bAddress) ? esc($shipping->bAddress) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Ülke"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bCountry) ? esc($shipping->bCountry) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "İl"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bState) ? esc($shipping->bState) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "İlçe"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bCity) ? esc($shipping->bCity) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Posta Kodu"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->bZipCode) ? esc($shipping->bZipCode) : ''; ?></strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <h4 class="sec-title"><?= "Teslimat Adresi"; ?></h4>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Ad"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sFirstName) ? esc($shipping->sFirstName) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Soyad"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sLastName) ? esc($shipping->sLastName) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "E-posta"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sEmail) ? esc($shipping->sEmail) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Telefon Numarası"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sPhoneNumber) ? esc($shipping->sPhoneNumber) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Adres"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sAddress) ? esc($shipping->sAddress) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Ülke"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sCountry) ? esc($shipping->sCountry) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "İl"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sState) ? esc($shipping->sState) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "İlçe"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sCity) ? esc($shipping->sCity) : ''; ?></strong>
                                </div>
                            </div>
                            <div class="row row-details">
                                <div class="col-xs-12 col-sm-4 col-right">
                                    <strong> <?= "Posta Kodu"; ?></strong>
                                </div>
                                <div class="col-sm-8">
                                    <strong class="font-right"><?= !empty($shipping->sZipCode) ? esc($shipping->sZipCode) : ''; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Ürünler"; ?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="table-responsive" id="t_product">
                            <table class="table table-bordered" role="grid">
                                <thead>
                                <tr role="row">
                                    <th><?= "Ürün ID"; ?></th>
                                    <th><?= "Ürün"; ?></th>
                                    <th><?= "Birim Fiyat"; ?></th>
                                    <th><?= "Miktar"; ?></th>
                                    <th><?= "KDV"; ?></th>
                                    <th><?= "Kargo Ücreti"; ?></th>
                                    <th><?= "Toplam"; ?></th>
                                    <th><?= "Durum"; ?></th>
                                    <th><?= "Güncellendi"; ?></th>
                                    <th class="max-width-120"><?= "Seçenekler"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $isOrderHasPhysicalProduct = false;
                                if (!empty($orderProducts)):
                                    foreach ($orderProducts as $item):
                                        $product = getProduct($item->product_id);
                                        if ($item->product_type == 'physical') {
                                            $isOrderHasPhysicalProduct = true;
                                        } ?>
                                        <tr class="tr-order">
                                        <td style="width: 80px;">
                                            <?= esc($item->product_id); ?>
                                        </td>
                                        <td>
                                            <div class="img-table">
                                                <a href="<?= generateProductUrlBySlug($item->product_slug); ?>" target="_blank">
                                                    <img src="<?= getProductVariationImage($item->variation_option_ids, $item->product_id); ?>" data-src="" alt="" class="lazyload img-responsive post-image"/>
                                                </a>
                                            </div>
                                            <p>
                                                <?php if ($item->product_type == 'digital'): ?>
                                                    <label class="label bg-black"><i class="icon-cloud-download"></i><?= "Anlık İndirme"; ?></label>
                                                <?php endif; ?>
                                            </p>
                                            <a href="<?= generateProductUrlBySlug($item->product_slug); ?>" target="_blank" class="table-product-title"><?= esc($item->product_title); ?></a>
                                            <?php if (!empty($product) && !empty($product->sku)): ?>
                                                <div><?= "SKU"; ?>:&nbsp;<?= esc($product->sku); ?></div>
                                            <?php endif; ?>
                                            <p>
                                                <span><?= "tarafından"; ?></span>
                                                <?php $seller = getUser($item->seller_id);
                                                if (!empty($seller)): ?>
                                                    <a href="<?= generateProfileUrl($seller->slug); ?>" target="_blank" class="table-product-title"><strong><?= esc(getUsername($seller)); ?></strong></a>
                                                <?php endif; ?>
                                            </p>
                                        </td>
                                        <td><?= priceFormatted($item->product_unit_price, $item->product_currency); ?></td>
                                        <td><?= $item->product_quantity; ?></td>
                                        <td>
                                            <?php if ($item->product_vat):
                                                echo priceFormatted($item->product_vat, $item->product_currency); ?>&nbsp;(<?= $item->product_vat_rate; ?>%)
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($item->product_type == 'physical'):
                                                echo priceFormatted($item->seller_shipping_cost, $item->product_currency);
                                            endif; ?>
                                        </td>
                                        <td><?= priceFormatted($item->product_total_price, $item->product_currency); ?></td>
                                        <td>
                                            <strong><?= $item->order_status == 'completed' ? 'Tamamlandı' : ($item->order_status == 'cancelled' ? 'İptal Edildi' : ($item->order_status == 'shipped' ? 'Kargoda' : $item->order_status)); ?></strong>
                                            <?php if ($item->buyer_id == 0):
                                                if ($item->is_approved == 0): ?>
                                                    <br>
                                                    <form action="<?= base_url('OrderAdmin/approveGuestOrderProduct'); ?>" method="post">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="order_product_id" value="<?= $item->id; ?>">
                                                        <button type="submit" class="btn btn-xs btn-primary m-t-5"><?= "Onayla"; ?></button>
                                                    </form>
                                                <?php endif;
                                            endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($item->product_type == 'physical'):
                                                echo timeAgo($item->updated_at);
                                            endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($order->status != 2):
                                                if (($item->product_type == 'digital' && $item->order_status != 'completed') || $item->product_type == 'physical'): ?>
                                                    <div class="dropdown">
                                                        <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?>
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu options-dropdown">
                                                            <?php if ($item->order_status != 'refund_approved'): ?>
                                                                <li>
                                                                    <a href="#" data-toggle="modal" data-target="#updateStatusModal_<?= $item->id; ?>"><i class="fa fa-edit option-icon"></i><?= "Sipariş Durumunu Güncelle"; ?></a>
                                                                </li>
                                                            <?php endif; ?>
                                                            <li>
                                                                <a href="javascript:void(0)" onclick="deleteItem('OrderAdmin/deleteOrderProductPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-times option-icon"></i><?= "Sil"; ?></a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php endif;
                                            endif; ?>
                                        </td>
                                        <?php if ($item->product_type != "digital"): ?>
                                        <tr class="tr-shipping" style="background-color: #F3F6F9 !important;">
                                            <td colspan="10">
                                                <div class="order-shipping-tracking-number">
                                                    <p><strong><?= "Kargo" ?></strong></p>
                                                    <p class="font-600 m-t-5"><?= "Kargo Yöntemi" ?>:&nbsp;<?= esc($item->shipping_method); ?></p>
                                                    <?php if ($item->order_status == 'shipped' || $item->order_status == 'completed'): ?>
                                                        <p class="font-600 m-t-15 m-b-5"><?= "Sipariş Kargoya Verildi"; ?></p>
                                                        <p class="m-b-5"><?= "Takip Kodu" ?>:&nbsp;<?= esc($item->shipping_tracking_number); ?></p>
                                                        <p class="m-0"><?= "Takip URL" ?>: <a href="<?= esc($item->shipping_tracking_url); ?>" target="_blank" class="link-underlined"><?= esc($item->shipping_tracking_url); ?></a></p>
                                                    <?php else: ?>
                                                        <p><?= "Sipariş Henüz Kargoya Verilmedi"; ?></p>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                            <?php if (empty($orderProducts)): ?>
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

    <div class="col-sm-12">
        <div class="box-payment-total">
            <div class="row row-details">
                <div class="col-xs-12 col-sm-6 col-left">
                    <strong> <?= "Ara Toplam"; ?></strong>
                </div>
                <div class="col-xs-12 col-sm-6 col-right text-right">
                    <strong class="font-right"><?= priceFormatted($order->price_subtotal, $order->price_currency); ?></strong>
                </div>
            </div>
            <?php $affiliate = unserializeData($order->affiliate_data);
            if (!empty($affiliate) && !empty($affiliate['discount'])): ?>
                <div class="row row-details">
                    <div class="col-xs-12 col-sm-6 col-left">
                        <strong><?= "Yönlendirme İndirimi"; ?>&nbsp;(<?= $affiliate['discountRate']; ?>%)</strong>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-right text-right">
                        <strong class="font-right">-&nbsp;<?= priceCurrencyFormat($affiliate['discount'], $order->price_currency); ?></strong>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (!empty($order->price_vat)): ?>
                <div class="row row-details">
                    <div class="col-xs-12 col-sm-6 col-left">
                        <strong><?= "KDV"; ?></strong>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-right text-right">
                        <strong class="font-right"><?= priceFormatted($order->price_vat, $order->price_currency); ?></strong>
                    </div>
                </div>
            <?php endif;
            if ($isOrderHasPhysicalProduct): ?>
                <div class="row row-details">
                    <div class="col-xs-12 col-sm-6 col-left">
                        <strong><?= "Kargo"; ?></strong>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-right text-right">
                        <strong class="font-right"><?= priceFormatted($order->price_shipping, $order->price_currency); ?></strong>
                    </div>
                </div>
            <?php endif;
            if ($order->coupon_discount > 0): ?>
                <div class="row row-details">
                    <div class="col-xs-12 col-sm-6 col-left">
                        <strong><?= "Kupon"; ?>&nbsp;&nbsp;[<?= esc($order->coupon_code); ?>]</strong>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-right text-right">
                        <strong class="font-right">-&nbsp;<?= priceFormatted($order->coupon_discount, $order->price_currency); ?></strong>
                    </div>
                </div>
            <?php endif;
            if (!empty($order->global_taxes_data)):
                $globalTaxesArray = unserializeData($order->global_taxes_data);
                if (!empty($globalTaxesArray)):
                    foreach ($globalTaxesArray as $taxItem):?>
                        <div class="row row-details">
                            <div class="col-xs-12 col-sm-6 col-left">
                                <strong><?= esc(getTaxName($taxItem['taxNameArray'], selectedLangId())); ?>&nbsp;(<?= $taxItem['taxRate']; ?>%)</strong>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-right text-right">
                                <strong class="font-right"><?= priceDecimal($taxItem['taxTotal'], $order->price_currency); ?></strong>
                            </div>
                        </div>
                    <?php endforeach;
                endif;
            endif;
            if (!empty($order->transaction_fee)): ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-left">
                        <strong><?= "İşlem Ücreti"; ?><?= $order->transaction_fee_rate ? ' (' . $order->transaction_fee_rate . '%)' : ''; ?></strong>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-right text-right">
                        <strong class="font-right"><?= priceFormatted($order->transaction_fee, $order->price_currency); ?></strong>
                    </div>
                </div>
            <?php endif; ?>
            <hr>
            <div class="row row-details">
                <div class="col-xs-12 col-sm-6 col-left">
                    <strong><?= "Toplam"; ?></strong>
                </div>
                <div class="col-xs-12 col-sm-6 col-right text-right">
                    <?php $priceSecondCurrency = "";
                    if (!empty($transaction) && $transaction->currency != $order->price_currency):
                        $priceSecondCurrency = priceCurrencyFormat($transaction->payment_amount, $transaction->currency);
                    endif; ?>
                    <strong class="font-600">
                        <?= priceFormatted($order->price_total, $order->price_currency);
                        if (!empty($priceSecondCurrency)):?>
                            <br><span style="font-weight: 400;white-space: nowrap;">(<?= "Ödendi"; ?>:&nbsp;<?= $priceSecondCurrency; ?>&nbsp;<?= $transaction->currency; ?>)</span>
                        <?php endif; ?>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($orderProducts)):
    foreach ($orderProducts as $item): ?>
        <div id="updateStatusModal_<?= $item->id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('OrderAdmin/updateOrderProductStatusPost'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="id" value="<?= $item->id; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?= "Sipariş Durumunu Güncelle"; ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="table-order-status">
                                <div class="form-group">
                                    <label class="control-label"><?= "Durum"; ?></label>
                                    <select name="order_status" class="form-control">
                                        <?php if ($item->product_type == 'physical'): ?>
                                            <option value="awaiting_payment" <?= $item->order_status == 'awaiting_payment' ? 'selected' : ''; ?>><?= "Ödeme Bekleniyor"; ?></option>
                                            <option value="payment_received" <?= $item->order_status == 'payment_received' ? 'selected' : ''; ?>><?= "Ödeme Alındı"; ?></option>
                                            <option value="order_processing" <?= $item->order_status == 'order_processing' ? 'selected' : ''; ?>><?= "Sipariş İşleniyor"; ?></option>
                                            <option value="shipped" <?= $item->order_status == 'shipped' ? 'selected' : ''; ?>><?= "Kargoda"; ?></option>
                                        <?php endif; ?>
                                        <?php if ($item->buyer_id != 0 && $item->order_status != 'completed'): ?>
                                            <option value="completed" <?= $item->order_status == 'completed' ? 'selected' : ''; ?>><?= "Tamamlandı"; ?></option>
                                        <?php endif; ?>
                                        <option value="refund_approved" <?= $item->order_status == 'refund_approved' ? 'selected' : ''; ?>><?= "İade Onaylandı"; ?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><?= "Değişiklikleri Kaydet"; ?></button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><?= "Kapat"; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach;
endif; ?>

<style>
    .sec-title {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        font-weight: 600;
    }

    .font-right {
        font-weight: 600;
        margin-left: 5px;
    }

    .font-right a {
        color: #55606e;
    }

    .row-details {
        margin-bottom: 10px;
    }

    .col-right {
        max-width: 240px;
    }

    .label {
        font-size: 12px !important;
    }

    .box-payment-total {
        width: 480px;
        max-width: 100%;
        float: right;
        background-color: #fff;
        padding: 30px;
    }

    .tr-order td {
        padding: 15px 8px !important;
    }

    @media (max-width: 768px) {
        .col-right {
            width: 100%;
            max-width: none;
        }

        .col-sm-8 strong {
            margin-left: 0;
        }
    }
</style>


