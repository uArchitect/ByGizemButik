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
        <div class="right">
            <a href="<?= generateDashUrl('add_coupon'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;<?= "Kupon Ekle"; ?>
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" role="grid">
                        <thead>
                        <tr role="row">
                            <th><?= "Kupon Kodu"; ?></th>
                            <th><?= "İndirim Oranı"; ?></th>
                            <th><?= "Kupon Sayısı"; ?></th>
                            <th><?= "Son Kullanma Tarihi"; ?></th>
                            <th><?= "Durum"; ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th><?= "Ürünler"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($coupons)):
                            foreach ($coupons as $item): ?>
                                <tr>
                                    <td><?= esc($item->coupon_code); ?></td>
                                    <td><?= esc($item->discount_rate); ?>%</td>
                                    <td><?= esc($item->coupon_count); ?>&nbsp;<small class="text-danger">(<?= "Kullanıldı"; ?>:&nbsp;<b><?= getUsedCouponsCount($item->coupon_code); ?></b>)</small></td>
                                    <td><?= formatDate($item->expiry_date); ?>&nbsp;<span class="text-danger"></td>
                                    <td>
                                        <?php if (date('Y-m-d H:i:s') > $item->expiry_date): ?>
                                            <label class="label label-danger"><?= "Süresi Doldu"; ?></label>
                                        <?php else: ?>
                                            <label class="label label-success"><?= "Aktif"; ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= formatDate($item->created_at); ?></td>
                                    <td>
                                        <a href="<?= generateDashUrl('coupon_products'); ?>/<?= $item->id; ?>" class="btn btn-sm btn-primary"><?= "Ürünleri Seç"; ?></a>
                                    </td>
                                    <td style="width: 120px;">
                                        <div class="btn-group btn-group-option">
                                            <a href="<?= generateDashUrl('edit_coupon') . '/' . $item->id; ?>" class="btn btn-sm btn-default btn-edit" data-toggle="tooltip" title="<?= "Düzenle"; ?>"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-delete" data-toggle="tooltip" title="<?= "Sil"; ?>" onclick='deleteItem("Dashboard/deleteCouponPost","<?= $item->id; ?>","<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>");'><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (empty($coupons)): ?>
                    <p class="text-center">
                        <?= "Kayıt bulunamadı"; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php if (!empty($coupons)): ?>
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
