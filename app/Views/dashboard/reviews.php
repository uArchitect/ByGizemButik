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
                    <table class="table table-striped" role="grid">
                        <thead>
                        <tr role="row">
                            <th scope="col"><?= "ID"; ?></th>
                            <th scope="col"><?= "Kullanıcı"; ?></th>
                            <th scope="col"><?= 'Değerlendirme'; ?></th>
                            <th scope="col"><?= "Ürün"; ?></th>
                            <th scope="col"><?= "Tarih"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($reviews)):
                            foreach ($reviews as $review): ?>
                                <tr>
                                    <td style="width: 5%;"><?= $review->id; ?></td>
                                    <td style="width: 10%;">
                                        <a href="<?= generateProfileUrl($review->user_slug); ?>" class="link-black" target="_blank"><?= esc($review->user_username); ?></a>
                                    </td>
                                    <td class="break-word">
                                        <div class="pull-left" style="width: 100%;">
                                            <?= view('admin/includes/_review_stars', ['review' => $review->rating]); ?>
                                        </div>
                                        <p class="pull-left"><?= esc($review->review); ?></p>
                                    </td>
                                    <td style="width: 30%;">
                                        <a href="<?= langBaseUrl($review->product_slug); ?>" class="link-black" target="_blank"><?= getProductTitle($review); ?></a>
                                    </td>
                                    <td class="white-space-nowrap" style="width: 15%"><?= formatDate($review->created_at); ?></td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (empty($reviews)): ?>
                    <p class="text-center">
                        <?= "Kayıt bulunamadı"; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php if (!empty($reviews)): ?>
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