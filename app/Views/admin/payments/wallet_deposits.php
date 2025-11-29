<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= $title; ?></h3>
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
                                <form action="<?= adminUrl('wallet-deposits'); ?>" method="get">
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
                                        <label><?= "Ödeme Durumu"; ?></label>
                                        <select name="payment_status" class="form-control custom-select">
                                            <option value="" selected><?= "Tümü"; ?></option>
                                            <option value="payment_received" <?= inputGet('payment_status') == 'payment_received' ? 'selected' : ''; ?>><?= "Ödeme Alındı"; ?></option>
                                            <option value="awaiting_payment" <?= inputGet('payment_status') == 'awaiting_payment' ? 'selected' : ''; ?>><?= "Ödeme Bekleniyor"; ?></option>
                                        </select>
                                    </div>
                                    <div class="item-table-filter">
                                        <label><?= "Ödeme ID"; ?></label>
                                        <input name="q" class="form-control" placeholder="<?= "Ödeme ID"; ?>" type="search" value="<?= esc(inputGet('q')); ?>">
                                    </div>
                                    <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
                                        <label style="display: block">&nbsp;</label>
                                        <button type="submit" class="btn bg-purple"><?= "Filtrele"; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped" role="grid">
                        <thead>
                        <tr role="row">
                            <th><?= "ID"; ?></th>
                            <th><?= "Ödeme ID"; ?></th>
                            <th><?= "Ödeme Yöntemi"; ?></th>
                            <th><?= "Yatırım Tutarı"; ?></th>
                            <th><?= "Ödeme Durumu"; ?></th>
                            <th><?= "Kullanıcı"; ?></th>
                            <th><?= "IP Adresi"; ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($transactions)):
                            foreach ($transactions as $item): ?>
                                <tr>
                                    <td><?= $item->id; ?></td>
                                    <td><?= esc($item->payment_id); ?></td>
                                    <td><?= getPaymentMethod($item->payment_method); ?></td>
                                    <td> <?= priceCurrencyFormat($item->deposit_amount, $item->currency); ?>&nbsp;(<?= esc($item->currency); ?>)</td>
                                    <td>
                                        <?php if ($item->payment_status == 1):
                                            echo "Ödeme Alındı";
                                        else:
                                            echo "Ödeme Bekleniyor"; ?>
                                            <form action="<?= base_url('Admin/approveWalletDepositPaymentPost'); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?= $item->id; ?>">
                                                <button type="submit" class="btn btn-sm btn-success m-t-5"><i class="fa fa-check"></i>&nbsp;<?= "Onayla"; ?></button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= generateProfileUrl($item->user_slug); ?>" target="_blank" class="table-link">
                                            <?= esc($item->user_username); ?>
                                        </a>
                                    </td>
                                    <td><?= $item->ip_address; ?></td>
                                    <td><?= formatDate($item->created_at); ?></td>
                                    <td>
                                        <div class="btn-group btn-group-option">
                                            <a href="<?= base_url('invoice-wallet-deposit/' . $item->id); ?>" class="btn btn-sm btn-default btn-edit" target="_blank"><i class="fa fa-file-text"></i>&nbsp;&nbsp;<?= "Faturayı Görüntüle"; ?></a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-delete" onclick="deleteItem('Admin/deleteWalletDepositPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($transactions)): ?>
                        <p class="text-center">
                            <?= "Kayıt bulunamadı"; ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-12">
                <?php if (!empty($transactions)): ?>
                    <div class="number-of-entries">
                        <span><?= "Kayıt Sayısı"; ?>:</span>&nbsp;&nbsp;<strong><?= $numRows; ?></strong>
                    </div>
                <?php endif; ?>
                <div class="pull-right">
                    <?= $pager->links; ?>
                </div>
            </div>
        </div>
    </div>
</div>