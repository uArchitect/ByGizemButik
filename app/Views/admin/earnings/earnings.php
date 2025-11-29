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
                                    <form action="<?= adminUrl('earnings'); ?>" method="get">
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
                                            <label><?= "Ara"; ?></label>
                                            <input name="q" class="form-control" placeholder="<?= "Sipariş Numarası"; ?>" type="search" value="<?= esc(inputGet('q')); ?>">
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
                            <th><?= "ID"; ?></th>
                            <th><?= "Sipariş"; ?></th>
                            <th><?= "Kullanıcı"; ?></th>
                            <th><?= "Toplam"; ?></th>
                            <th><?= "KDV"; ?></th>
                            <th><?= "Komisyonlar/İndirimler"; ?></th>
                            <th><?= "Kargo Ücreti"; ?></th>
                            <th><?= "Kazanılan Tutar"; ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($earnings)):
                            foreach ($earnings as $item): ?>
                                <tr>
                                    <td><?= $item->id; ?></td>
                                    <td>#<?= $item->order_number; ?></td>
                                    <td>
                                        <a href="<?= generateProfileUrl($item->user_slug); ?>" target="_blank" class="table-link"><?= esc($item->user_username); ?></a>
                                    </td>
                                    <td><?= priceFormatted($item->sale_amount, $item->currency); ?></td>
                                    <td><?= priceFormatted($item->vat_amount, $item->currency); ?>&nbsp;<?= !empty($item->vat_rate) ? '(' . $item->vat_rate . '%)' : ''; ?></td>
                                    <td>
                                        <div class="font-size-13">
                                            <?= "Komisyon"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($item->commission, $item->currency); ?>&nbsp;<?= !empty($item->commission_rate) ? '(' . $item->commission_rate . '%)' : ''; ?></span>
                                        </div>
                                        <?php if (!empty($item->affiliate_commission)): ?>
                                            <div class="font-size-13 m-t-5">
                                                <?= "Yönlendiren Komisyonu"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($item->affiliate_commission, $item->currency); ?>&nbsp;(<?= $item->affiliate_commission_rate; ?>%)</span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($item->affiliate_discount)): ?>
                                            <div class="font-size-13 m-t-5">
                                                <?= "Yönlendirme İndirimi"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($item->affiliate_discount, $item->currency); ?>&nbsp;(<?= $item->affiliate_discount_rate; ?>%)</span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($item->coupon_discount)): ?>
                                            <div class="font-size-13 m-t-5">
                                                <?= "İndirim Kuponu"; ?>:&nbsp;<span class="text-danger"><?= priceFormatted($item->coupon_discount, $item->currency); ?></span>
                                                <?php if (!empty($order) && !empty($order->coupon_code)):
                                                    echo ' (' . $order->coupon_code . ')';
                                                endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>



                                    <td><?= priceFormatted($item->shipping_cost, $item->currency); ?></td>
                                    <td>
                                        <?= priceFormatted($item->earned_amount, $item->currency);
                                        $order = getOrderByOrderNumber($item->order_number);
                                        if (!empty($order) && $order->payment_method == 'Cash On Delivery'):?>
                                            <span class="text-danger">(-<?= priceFormatted($item->earned_amount, $item->currency); ?>)</span><br><small class="text-danger"><?= "Kapıda Ödeme"; ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= formatDate($item->created_at); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <li>
                                                    <a href="javascript:void(0)" onclick="deleteItem('Earnings/deleteEarningPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($earnings)): ?>
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