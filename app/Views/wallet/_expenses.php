<div class="wallet-container wallet-container-table">
    <div class="table-responsive table-custom">
        <table class="table">
            <thead>
            <tr role="row">
                <th scope="col"><?= "Ödeme ID"; ?></th>
                <th scope="col"><?= "Harcama"; ?></th>
                <th scope="col"><?= "Harcama Tutarı"; ?></th>
                <th scope="col"><?= "Tarih"; ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($expenses)): ?>
                <?php foreach ($expenses as $expense): ?>
                    <tr>
                        <td><?= esc($expense->payment_id); ?></td>
                        <td>
                            <?php if ($expense->expense_type == 'sale'): ?>
                                <?= "Satın Alma"; ?>&nbsp;(<?= "Sipariş" . ' #' . esc($expense->expense_item_id); ?>)
                            <?php elseif ($expense->expense_type == 'membership'): ?>
                                <?= "Üyelik Planı"; ?>&nbsp;(<?= esc($expense->expense_detail); ?>)
                            <?php elseif ($expense->expense_type == 'commission_debt'):
                                echo "Komisyon Borcu";
                            elseif ($expense->expense_type == 'promote'):
                                echo "Ürün Tanıtımı";
                                $promote = unserializeData($expense->expense_detail);
                                if (!empty($promote) && !empty($promote['product_id']) && !empty($promote['plan_type']) && !empty($promote['day_count'])) {
                                    echo '&nbsp;(' . "Ürün" . ' #' . $promote['product_id'] . ' | ' . "Satın Alınan Plan" . ': ' . $promote['plan_type'] . ', ' . $promote['day_count'] . ' ' . "Gün" . ')';
                                } ?>
                            <?php endif; ?>
                        </td>
                        <td><strong class="text-danger font-600"><?= priceFormatted($expense->expense_amount, $expense->currency); ?>&nbsp;(<?= $expense->currency; ?>)</strong></td>
                        <td class="no-wrap"><?= formatDate($expense->created_at); ?>
                            <?php if ($expense->expense_type == 'sale'): ?>
                                <div><a href="<?= langBaseUrl('invoice/' . esc($expense->expense_item_id)); ?>?type=buyer" class="text-info link-underlined" target="_blank"><?= "Faturayı Görüntüle"; ?></a></div>
                            <?php elseif ($expense->expense_type == 'membership'): ?>
                                <div><a href="<?= langBaseUrl('invoice-membership/' . esc($expense->expense_item_id)); ?>" class="text-info link-underlined" target="_blank"><?= "Faturayı Görüntüle"; ?></a></div>
                            <?php elseif ($expense->expense_type == 'commission_debt'): ?>
                                <div><a href="<?= langBaseUrl('invoice-expense/' . esc($expense->id)); ?>" class="text-info link-underlined" target="_blank"><?= "Faturayı Görüntüle"; ?></a></div>
                            <?php elseif ($expense->expense_type == 'promote'): ?>
                                <div><a href="<?= langBaseUrl('invoice-promotion/' . esc($expense->expense_item_id)); ?>" class="text-info link-underlined" target="_blank"><?= "Faturayı Görüntüle"; ?></a></div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach;
            endif; ?>
            </tbody>
        </table>
    </div>
    <?php if (empty($expenses)): ?>
        <p class="text-center m-t-15">
            <?= "Kayıt bulunamadı"; ?>
        </p>
    <?php endif; ?>
    <div class="d-flex justify-content-center m-t-30">
        <?= $pager->links; ?>
    </div>
</div>