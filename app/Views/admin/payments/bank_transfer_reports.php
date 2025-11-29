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
                                    <form action="<?= adminUrl('bank-transfer-reports'); ?>" method="get">
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
                                            <select name="status" class="form-control">
                                                <option value="" selected><?= "Tümü"; ?></option>
                                                <option value="pending" <?= inputGet('status') == 'pending' ? 'selected' : ''; ?>><?= "Bekliyor"; ?></option>
                                                <option value="approved" <?= inputGet('status') == 'approved' ? 'selected' : ''; ?>><?= "Onaylandı"; ?></option>
                                                <option value="declined" <?= inputGet('status') == 'declined' ? 'selected' : ''; ?>><?= "Reddedildi"; ?></option>
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
                            <th><?= "Rapor Türü"; ?></th>
                            <th><?= "Kullanıcı"; ?></th>
                            <th><?= "Makbuz"; ?></th>
                            <th><?= "Ödeme Notu"; ?></th>
                            <th><?= "Durum"; ?></th>
                            <th><?= "IP Adresi"; ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($bankTransfers)):
                            foreach ($bankTransfers as $item): ?>
                                <tr>
                                    <td><?= $item->id; ?></td>
                                    <td>
                                        <?= $item->report_type == 'bank_transfer' ? 'Banka Havalesi' : $item->report_type; ?>
                                        <?php if ($item->report_type == 'order'):
                                            $order = getOrderByOrderNumber($item->order_number);
                                            if (!empty($order)): ?>
                                                <a href="<?= adminUrl('order-details/' . $order->id); ?>" class="table-link" target="_blank">&nbsp;(#<?= $item->order_number; ?>)</a>
                                            <?php else: ?>
                                                &nbsp;(#<?= $item->order_number; ?>)
                                            <?php endif;
                                        endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($item->user_id == 0): ?>
                                            <label class="label bg-olive"><?= "Misafir"; ?></label>
                                        <?php else: ?>
                                            <a href="<?= generateProfileUrl($item->user_slug); ?>" target="_blank" class="table-link">
                                                <?= esc($item->user_username); ?>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($item->receipt_path)):
                                            if (pathinfo($item->receipt_path, PATHINFO_EXTENSION) === 'pdf'):?>
                                                <a href="<?= base_url($item->receipt_path); ?>" target="_blank"><?= "PDF Dosyasını Görüntüle"; ?></a>
                                            <?php else: ?>
                                                <a class="magnific-image-popup" href="<?= base_url($item->receipt_path); ?>">
                                                    <img src="<?= base_url($item->receipt_path); ?>" alt="" class="img-thumbnail" style="max-width: 60px; max-height: 60px;">
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td style="max-width: 300px;"><?= esc($item->payment_note); ?></td>
                                    <td>
                                        <?php if ($item->status == 'pending'): ?>
                                            <label class="label label-default"><?= "Bekliyor"; ?></label>
                                        <?php elseif ($item->status == 'approved'): ?>
                                            <label class="label label-success"><?= "Onaylandı"; ?></label>
                                        <?php elseif ($item->status == 'declined'): ?>
                                            <label class="label label-danger"><?= "Reddedildi"; ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $item->ip_address; ?></td>
                                    <td><?= formatDate($item->created_at); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?>
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu options-dropdown">
                                                <?php if ($item->status == 'pending'): ?>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="approveBankTransfer('<?= $item->id; ?>','<?= "Bu işlemi onaylıyor musunuz?"; ?>');"><i class="fa fa-check option-icon"></i><?= "Onayla"; ?></a>
                                                    </li>
                                                    <li>
                                                        <form action="<?= base_url('Admin/bankTransferOptionsPost'); ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="report_id" value="<?= $item->id; ?>">
                                                            <button type="submit" name="option" value="declined" class="btn-list-button"><i class="fa fa-times option-icon"></i><?= "Reddet"; ?></button>
                                                        </form>
                                                    </li>
                                                <?php endif; ?>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="deleteItem('Admin/deleteBankTransferPost','<?= $item->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($bankTransfers)): ?>
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