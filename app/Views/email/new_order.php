<?= view('email/_header', ['title' => "Sipariş için teşekkür e-posta metni"]); ?>
<?php $emailData = unserializeData($emailRow->email_data); ?>
    <table role="presentation" class="main">
        <?php if (!empty($emailData['orderId'])):
            $order = getOrder($emailData['orderId']);
            if (!empty($order)):
                $orderProducts = getOrderProducts($order->id); ?>
                <tr>
                    <td class="wrapper">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <h1 style="text-decoration: none; font-size: 24px;line-height: 28px;font-weight: bold"><?= "Sipariş için teşekkür e-posta metni"; ?></h1>
                                    <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
                                        <p style='text-align: left;color: #555;'><?= "Yeni sipariş e-posta metni"; ?></p><br>
                                        <h2 style="margin-bottom: 10px; font-size: 16px;font-weight: 600;"><?= "Sipariş Bilgileri"; ?></h2>
                                        <p style="color: #555;">
                                            <?= "Sipariş"; ?>:&nbsp;#<?= $order->order_number; ?><br>
                                            <?= "Ödeme Durumu"; ?>:&nbsp;<?= $order->payment_status; ?><br>
                                            <?= "Ödeme Yöntemi"; ?>:&nbsp;<?= getPaymentMethod($order->payment_method); ?>
                                            <br>
                                            <?= "Tarih"; ?>:&nbsp;<?= formatDate($order->created_at); ?><br>
                                        </p>
                                    </div>
                                    <?php $shipping = unserializeData($order->shipping);
                                    if (!empty($shipping)):?>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="margin-top: 30px;">
                                            <tr>
                                                <td>
                                                    <h3 style="margin-bottom: 10px; font-size: 16px;font-weight: 600;"><?= "Teslimat Adresi"; ?></h3>
                                                    <p style="color: #555; padding-right: 10px;">
                                                        <?= "Ad"; ?>:&nbsp;<?= !empty($shipping->sFirstName) ? esc($shipping->sFirstName) : ''; ?><br>
                                                        <?= "Soyad"; ?>:&nbsp;<?= !empty($shipping->sLastName) ? esc($shipping->sLastName) : ''; ?><br>
                                                        <?= "E-posta"; ?>:&nbsp;<?= !empty($shipping->sEmail) ? esc($shipping->sEmail) : ''; ?><br>
                                                        <?= "Telefon Numarası"; ?>:&nbsp;<?= !empty($shipping->sPhoneNumber) ? esc($shipping->sPhoneNumber) : ''; ?><br>
                                                        <?= "Adres"; ?>:&nbsp;<?= !empty($shipping->sAddress) ? esc($shipping->sAddress) : ''; ?><br>
                                                        <?= "Ülke"; ?>:&nbsp;<?= !empty($shipping->sCountry) ? esc($shipping->sCountry) : ''; ?><br>
                                                        <?= "İl"; ?>:&nbsp;<?= !empty($shipping->sState) ? esc($shipping->sState) : ''; ?><br>
                                                        <?= "İlçe"; ?>:&nbsp;<?= !empty($shipping->sCity) ? esc($shipping->sCity) : ''; ?><br>
                                                        <?= "Posta Kodu"; ?>:&nbsp;<?= !empty($shipping->sZipCode) ? esc($shipping->sZipCode) : ''; ?><br>
                                                    </p>
                                                </td>
                                                <td>
                                                    <h3 style="margin-bottom: 10px; font-size: 16px;font-weight: 600;"><?= "Fatura Adresi"; ?></h3>
                                                    <p style="color: #555; padding-right: 10px;">
                                                        <?= "Ad"; ?>:&nbsp;<?= !empty($shipping->bFirstName) ? esc($shipping->bFirstName) : ''; ?><br>
                                                        <?= "Soyad"; ?>:&nbsp;<?= !empty($shipping->bLastName) ? esc($shipping->bLastName) : ''; ?><br>
                                                        <?= "E-posta"; ?>:&nbsp;<?= !empty($shipping->bEmail) ? esc($shipping->bEmail) : ''; ?><br>
                                                        <?= "Telefon Numarası"; ?>:&nbsp;<?= !empty($shipping->bPhoneNumber) ? esc($shipping->bPhoneNumber) : ''; ?><br>
                                                        <?= "Adres"; ?>:&nbsp;<?= !empty($shipping->bAddress) ? esc($shipping->bAddress) : ''; ?><br>
                                                        <?= "Ülke"; ?>:&nbsp;<?= !empty($shipping->bCountry) ? esc($shipping->bCountry) : ''; ?><br>
                                                        <?= "İl"; ?>:&nbsp;<?= !empty($shipping->bState) ? esc($shipping->bState) : ''; ?><br>
                                                        <?= "İlçe"; ?>:&nbsp;<?= !empty($shipping->bCity) ? esc($shipping->bCity) : ''; ?><br>
                                                        <?= "Posta Kodu"; ?>:&nbsp;<?= !empty($shipping->bZipCode) ? esc($shipping->bZipCode) : ''; ?><br>
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    <?php endif; ?>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="text-align: left" class="table-products">
                                        <tr>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Ürün"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Birim Fiyat"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Miktar"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "KDV"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Toplam"; ?></th>
                                        </tr>
                                        <?php if (!empty($orderProducts)):
                                            foreach ($orderProducts as $item): ?>
                                                <tr>
                                                    <td style="width: 40%; padding: 15px 0; border-bottom: 1px solid #ddd;"><?= esc($item->product_title); ?></td>
                                                    <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;"><?= priceFormatted($item->product_unit_price, $item->product_currency); ?></td>
                                                    <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;"><?= $item->product_quantity; ?></td>
                                                    <?php if (!empty($order->price_vat)): ?>
                                                        <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;">
                                                            <?php if (!empty($item->product_vat)): ?>
                                                                <?= priceFormatted($item->product_vat, $item->product_currency); ?>&nbsp;(<?= $item->product_vat_rate; ?>%)
                                                            <?php endif; ?>
                                                        </td>
                                                    <?php else: ?>
                                                        <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;">-</td>
                                                    <?php endif; ?>
                                                    <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;"><?= priceFormatted($item->product_total_price, $item->product_currency); ?></td>
                                                </tr>
                                            <?php endforeach;
                                        endif; ?>
                                    </table>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="text-align: right;margin-top: 40px;">
                                        <tr>
                                            <td style="width: 70%"><?= "Ara Toplam"; ?></td>
                                            <td style="width: 30%;padding-right: 15px;font-weight: 600;"><?= priceFormatted($order->price_subtotal, $order->price_currency); ?></td>
                                        </tr>
                                        <?php $affiliate = unserializeData($order->affiliate_data);
                                        if (!empty($affiliate) && !empty($affiliate['discount'])): ?>
                                            <tr>
                                                <td style="width: 70%"><?= "Yönlendirme İndirimi"; ?>&nbsp;(<?= $affiliate['discountRate']; ?>%)</td>
                                                <td style="width: 30%;padding-right: 15px;font-weight: 600;"><?= priceFormatted($affiliate['discount'], $order->price_currency); ?></td>
                                            </tr>
                                        <?php endif;
                                        if (!empty($order->price_vat)): ?>
                                            <tr>
                                                <td style="width: 70%"><?= "KDV"; ?></td>
                                                <td style="width: 30%;padding-right: 15px;font-weight: 600;"><?= priceFormatted($order->price_vat, $order->price_currency); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td style="width: 70%"><?= "Kargo"; ?></td>
                                            <td style="width: 30%;padding-right: 15px;font-weight: 600;"><?= priceFormatted($order->price_shipping, $order->price_currency); ?></td>
                                        </tr>
                                        <?php if ($order->coupon_discount > 0): ?>
                                            <tr>
                                                <td style="width: 70%"><?= "Kupon"; ?>&nbsp;&nbsp;[<?= esc($order->coupon_code); ?>]</td>
                                                <td style="width: 30%;padding-right: 15px;font-weight: 600;">-<?= priceFormatted($order->coupon_discount, $order->price_currency); ?></td>
                                            </tr>
                                        <?php endif;
                                        if (!empty($order->global_taxes_data)):
                                            $globalTaxesArray = unserializeData($order->global_taxes_data);
                                            if (!empty($globalTaxesArray)):
                                                foreach ($globalTaxesArray as $taxItem):
                                                    if (!empty($taxItem['taxNameArray']) && !empty($taxItem['taxTotal']) && !empty($taxItem['taxRate'])):?>
                                                        <tr>
                                                            <td style="width: 70%"><?= esc(getTaxName($taxItem['taxNameArray'], selectedLangId())); ?>&nbsp;(<?= $taxItem['taxRate']; ?>%)</td>
                                                            <td style="width: 30%;padding-right: 15px;font-weight: 600;"><?= priceDecimal($taxItem['taxTotal'], $order->price_currency); ?></td>
                                                        </tr>
                                                    <?php endif;
                                                endforeach;
                                            endif;
                                        endif;
                                        if (!empty($order->transaction_fee)): ?>
                                            <tr>
                                                <td style="width: 70%"><?= "İşlem Ücreti"; ?><?= $order->transaction_fee_rate ? ' (' . $order->transaction_fee_rate . '%)' : ''; ?></td>
                                                <td style="width: 30%;padding-right: 15px;font-weight: 600;"><?= priceFormatted($order->transaction_fee, $order->price_currency); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <?php $priceSecondCurrency = '';
                                            $transaction = getTransactionByOrderId($order->id);
                                            if (!empty($transaction) && $transaction->currency != $order->price_currency):
                                                $priceSecondCurrency = priceCurrencyFormat($transaction->payment_amount, $transaction->currency);
                                            endif; ?>
                                            <td style="width: 70%;font-weight: bold"><?= "Toplam"; ?></td>
                                            <td style="width: 30%;padding-right: 15px;font-weight: 600;">
                                                <?= priceFormatted($order->price_total, $order->price_currency);
                                                if (!empty($priceSecondCurrency)):?>
                                                    <br><span style="font-weight: 400;white-space: nowrap;">(<?= "Ödendi"; ?>:&nbsp;<?= $priceSecondCurrency; ?>&nbsp;<?= $transaction->currency; ?>)</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php if ($order->buyer_type != 'guest'): ?>
                                        <p style='text-align: center;margin-top: 40px;'>
                                            <a href="<?= generateUrl('order_details') . '/' . $order->order_number; ?>" style='font-size: 14px;text-decoration: none;padding: 14px 40px;background-color: <?= $generalSettings->site_color; ?>;color: #ffffff !important; border-radius: 3px;'>
                                                <?= "Sipariş Detaylarını Gör"; ?>
                                            </a>
                                        </p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endif;
        endif; ?>
    </table>
<?= view('email/_footer'); ?>