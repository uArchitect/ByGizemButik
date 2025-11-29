<div class="row">
    <div class="col-sm-12">
        <?= view('dashboard/includes/_messages'); ?>
    </div>
</div>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= esc($title); ?></h3>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <div class="row table-filter-container">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-default filter-toggle collapsed m-b-10" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false">
                                <i class="fa fa-filter"></i>&nbsp;&nbsp;<?= "Filtrele"; ?>
                            </button>
                            <div class="collapse navbar-collapse" id="collapseFilter">
                                <form action="<?= generateDashUrl('sales'); ?>" method="get" id="formVendorSales">
                                    <?php if (!empty(inputGet('st'))): ?>
                                        <input type="hidden" name="st" value="<?= esc(inputGet('st')); ?>">
                                    <?php endif;
                                    if ($page == 'sales'): ?>
                                        <div class="item-table-filter">
                                            <label><?= "Ödeme Durumu"; ?></label>
                                            <select name="payment_status" class="form-control custom-select">
                                                <option value="" selected><?= "Tümü"; ?></option>
                                                <option value="payment_received" <?= inputGet('payment_status') == 'payment_received' ? 'selected' : ''; ?>><?= "Ödeme Alındı"; ?></option>
                                                <option value="awaiting_payment" <?= inputGet('payment_status') == 'awaiting_payment' ? 'selected' : ''; ?>><?= "Ödeme Bekleniyor"; ?></option>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="item-table-filter item-table-filter-large">
                                        <label><?= "Ara"; ?></label>
                                        <div class="item-table-filter-search">
                                            <input name="q" class="form-control" placeholder="<?= "Satış ID"; ?>" type="search" value="<?= strSlug(esc(inputGet('q'))); ?>">
                                            <button type="submit" class="btn bg-purple"><?= "Filtrele"; ?></button>
                                            <div class="btn-group table-export">
                                                <button type="button" class="btn btn-default dropdown-toggle btn-table-export" data-toggle="dropdown"><?= "Dışa Aktar"; ?>&nbsp;&nbsp;<i class="fa fa-caret-down"></i></button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <button type="button" class="btn-export-data" data-export-form="formVendorSales" data-export-type="vendor_sales" data-export-file-type="csv" data-section="vn">CSV</button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="btn-export-data" data-export-form="formVendorSales" data-export-type="vendor_sales" data-export-file-type="xml" data-section="vn">XML</button>
                                                    </li>
                                                    <li>
                                                        <button type="button" class="btn-export-data" data-export-form="formVendorSales" data-export-type="vendor_sales" data-export-file-type="excel" data-section="vn"><?= "Excel"; ?>&nbsp;(.xlsx)</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped" role="grid">
                        <thead>
                        <tr role="row">
                            <th scope="col"><?= "Satış"; ?></th>
                            <th scope="col"><?= "Toplam"; ?></th>
                            <th scope="col"><?= "Ödeme Durumu"; ?></th>
                            <th scope="col"><?= "Durum"; ?></th>
                            <th scope="col"><?= "Tarih"; ?></th>
                            <th scope="col"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($sales)): ?>
                            <?php foreach ($sales as $sale):
                                $finalPrice = getSellerFinalPrice($sale->id);
                                if (!empty($sale)):?>
                                    <tr>
                                        <td>#<?= $sale->order_number; ?></td>
                                        <td><?= priceFormatted($finalPrice, $sale->price_currency); ?></td>
                                        <td>
                                            <?php if ($sale->payment_status == 'payment_received'):
                                                echo "Ödeme Alındı";
                                            else:
                                                echo "Ödeme Bekleniyor";
                                            endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($sale->status == 2): ?>
                                                <label class="label label-danger"><?= "İptal Edildi"; ?></label>
                                            <?php else:
                                                if ($page == 'sales'): ?>
                                                    <label class="label label-success"><?= "Sipariş İşleme"; ?></label>
                                                <?php else: ?>
                                                    <label class="label label-default"><?= "Tamamlandı"; ?></label>
                                                <?php endif;
                                            endif; ?>
                                        </td>
                                        <td><?= formatDate($sale->created_at); ?></td>
                                        <td>
                                            <a href="<?= generateDashUrl('sale'); ?>/<?= esc($sale->order_number); ?>" class="btn btn-sm btn-default btn-details"><i class="fa fa-info-circle" aria-hidden="true"></i><?= "Detaylar"; ?></a>
                                        </td>
                                    </tr>
                                <?php endif;
                            endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (empty($sales)): ?>
                    <p class="text-center">
                        <?= "Kayıt bulunamadı"; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php if (!empty($sales)): ?>
                    <div class="number-of-entries">
                        <span><?= "Kayıt Sayısı"; ?>:</span>&nbsp;&nbsp;<strong><?= $numRows; ?></strong>
                    </div>
                <?php endif; ?>
                <div class="table-pagination">
                    <?= $pager->links; ?>
                </div>
            </div>
        </div>
    </div>
</div>