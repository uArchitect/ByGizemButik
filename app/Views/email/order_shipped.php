<?= view('email/_header', ['title' => "Siparişiniz kargoya verildi"]); ?>
<?php $emailData = unserializeData($emailRow->email_data); ?>
<table role="presentation" class="main">
    <?php if (!empty($emailData['orderProductId'])):
        $orderProduct = getOrderProduct($emailData['orderProductId']);
        if (!empty($orderProduct)):
            $order = getOrder($orderProduct->order_id);
            if (!empty($order)): ?>
                <tr>
                    <td class="wrapper">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <h1 style="text-decoration: none; font-size: 24px;line-height: 28px;font-weight: bold"><?= "Siparişiniz kargoya verildi"; ?></h1>
                                    <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
                                        <h2 style="margin-bottom: 10px; font-size: 16px;font-weight: 600;"><?= "Sipariş Bilgileri"; ?></h2>
                                        <p style="color: #555;">
                                            <?= "Sipariş"; ?>:&nbsp;#<?= esc($order->order_number); ?><br>
                                            <?= "Ödeme Durumu"; ?>:&nbsp;<?= $order->payment_status; ?><br>
                                            <?= "Ödeme Yöntemi"; ?>:&nbsp;<?= getPaymentMethod($order->payment_method); ?><br>
                                            <?= "Tarih"; ?>:&nbsp;<?= formatDate($order->created_at); ?><br>
                                        </p>
                                    </div>
                                    <?php if (!empty($orderProduct)): ?>
                                        <br>
                                        <p>
                                        <h2 style="margin-bottom: 10px; font-size: 16px;font-weight: 600;"><?= "Kargo"; ?></h2>
                                        <?= "Takip Kodu"; ?>:&nbsp;<?= $orderProduct->shipping_tracking_number; ?><br>
                                        <?= "Takip URL'si"; ?>:&nbsp;<?= $orderProduct->shipping_tracking_url; ?><br>
                                        </p>
                                    <?php endif; ?>
                                    <h3 style="margin-bottom: 10px;font-size: 16px;font-weight: 600;border-bottom: 1px solid #d1d1d1;padding-bottom: 5px; margin-top: 45px;"><?= "Kargoya Verilen Ürün"; ?></h3>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="text-align: left" class="table-products">
                                        <tr>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Ürün"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Birim Fiyat"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Miktar"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "KDV"; ?></th>
                                            <th style="padding: 10px 0; border-bottom: 2px solid #ddd;"><?= "Toplam"; ?></th>
                                        </tr>
                                        <?php if (!empty($orderProduct)): ?>
                                            <tr>
                                                <td style="width: 40%; padding: 12px 2px; border-bottom: 1px solid #ddd;"><?= esc($orderProduct->product_title); ?></td>
                                                <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;"><?= priceFormatted($orderProduct->product_unit_price, $orderProduct->product_currency); ?></td>
                                                <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;"><?= $orderProduct->product_quantity; ?></td>
                                                <?php if (!empty($order->price_vat)): ?>
                                                    <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;">
                                                        <?php if (!empty($orderProduct->product_vat)): ?>
                                                            <?= priceFormatted($orderProduct->product_vat, $orderProduct->product_currency); ?>&nbsp;(<?= $orderProduct->product_vat_rate; ?>%)
                                                        <?php endif; ?>
                                                    </td>
                                                <?php else: ?>
                                                    <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;">-</td>
                                                <?php endif; ?>
                                                <td style="padding: 12px 2px; border-bottom: 1px solid #ddd;"><?= priceFormatted($orderProduct->product_total_price, $orderProduct->product_currency); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                    <br>
                                    <br>
                                    <p style="color: #555;"></p>
                                    <p style='text-align: center;margin-top: 40px;'>
                                        <a href="<?= generateUrl('order_details') . '/' . $order->order_number; ?>" style='font-size: 14px;text-decoration: none;padding: 14px 40px;background-color: <?= $generalSettings->site_color; ?>;color: #ffffff !important; border-radius: 3px;'>
                                            <?= "Sipariş Detaylarını Gör"; ?>
                                        </a>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endif;
        endif;
    endif; ?>
</table>
<?= view('email/_footer'); ?>
