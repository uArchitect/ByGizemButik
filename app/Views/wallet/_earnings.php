<div class="wallet-container wallet-container-table">
    <div class="table-responsive table-custom">
        <table class="table">
            <thead>
            <tr role="row">
                <th scope="col"><?= "Sipariş"; ?></th>
                <th scope="col"><?= "Toplam"; ?></th>
                <th scope="col"><?= "KDV"; ?></th>
                <th scope="col"><?= "Komisyonlar/İndirimler"; ?></th>
                <th scope="col"><?= "Kargo Ücreti"; ?></th>
                <th scope="col"><?= "Kazanılan Tutar"; ?></th>
                <th scope="col"><?= "Tarih"; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($earnings)): ?>
                <?php foreach ($earnings as $earning):
                    $order = getOrderByOrderNumber($earning->order_number); ?>
                    <tr>
                        <td>#<?= $earning->order_number; ?></td>
                        <td><?= priceFormatted($earning->sale_amount, $earning->currency); ?>&nbsp;(<?= esc($earning->currency); ?>)</td>
                        <td><?= priceFormatted($earning->vat_amount, $earning->currency); ?>&nbsp;<?= !empty($earning->vat_rate) ? '(' . $earning->vat_rate . '%)' : ''; ?></td>
                        <td>
                            <div class="font-size-13">
                                <?= "Komisyon"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($earning->commission, $earning->currency); ?>&nbsp;<?= !empty($earning->commission_rate) ? '(' . $earning->commission_rate . '%)' : ''; ?></span>
                            </div>
                            <?php if (!empty($earning->affiliate_commission)): ?>
                                <div class="font-size-13 m-t-5">
                                    <?= "Yönlendiren Komisyonu"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($earning->affiliate_commission, $earning->currency); ?>&nbsp;(<?= $earning->affiliate_commission_rate; ?>%)</span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($earning->affiliate_discount)): ?>
                                <div class="font-size-13 m-t-5">
                                    <?= "Yönlendirme İndirimi"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($earning->affiliate_discount, $earning->currency); ?>&nbsp;(<?= $earning->affiliate_discount_rate; ?>%)</span>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($earning->coupon_discount)): ?>
                                <div class="font-size-13 m-t-5">
                                    <?= "İndirim Kuponu"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($earning->coupon_discount, $earning->currency); ?></span>
                                    <?php if (!empty($order) && !empty($order->coupon_code)):
                                        echo ' (' . $order->coupon_code . ')';
                                    endif; ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td><?= priceFormatted($earning->shipping_cost, $earning->currency); ?></td>
                        <td>
                            <?php if (!empty($order) && $order->payment_method == 'Cash On Delivery'): ?>
                                <span class="text-danger"><?= "Kapıda Ödeme"; ?></span>
                            <?php else: ?>
                                <strong class="text-success font-600"><?= priceFormatted($earning->earned_amount, $earning->currency); ?>&nbsp;(<?= $earning->currency; ?>)</strong>

                                <?php if ($paymentSettings->currency_converter == 1 && $earning->exchange_rate > 0 && $earning->exchange_rate != 1):
                                    $totalEarned = getPrice($earning->earned_amount, 'decimal');
                                    $totalEarned = $totalEarned / $earning->exchange_rate;
                                    $totalEarned = number_format($totalEarned, 2, '.', ''); ?>
                                    <span>(<?= $totalEarned . ' ' . $defaultCurrency->code; ?>)</span>
                                <?php endif;
                            endif;
                            if ($earning->is_refunded == 1): ?>
                                <br><span class="text-danger">(<?= "İade"; ?>)</span>
                            <?php endif; ?>
                        </td>
                        <td class="no-wrap"><?= formatDate($earning->created_at); ?></td>
                    </tr>
                <?php endforeach;
            endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (empty($earnings)): ?>
        <p class="text-center m-t-15">
            <?= "Kayıt bulunamadı"; ?>
        </p>
    <?php endif; ?>
    <div class="d-flex justify-content-center m-t-30">
        <?= $pager->links; ?>
    </div>
</div>