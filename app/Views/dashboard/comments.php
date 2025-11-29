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
                    <table class="table table-striped">
                        <thead>
                        <tr role="row">
                            <th scope="col"><?= "ID"; ?></th>
                            <th scope="col"><?= "Kullanıcı Adı"; ?></th>
                            <th scope="col"><?= "Yorum"; ?></th>
                            <th scope="col"><?= "Ürün"; ?></th>
                            <th scope="col"><?= "Tarih"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($comments)):
                            foreach ($comments as $comment): ?>
                                <tr>
                                    <td style="width: 5%;"><?= $comment->id; ?></td>
                                    <td style="width: 10%;">
                                        <a href="<?= generateProfileUrl($comment->user_slug); ?>" class="link-black" target="_blank"><?= esc($comment->name); ?></a>
                                    </td>
                                    <td style="width: 40%;"><?= esc($comment->comment); ?></td>
                                    <td style="width: 30%;">
                                        <a href="<?= langBaseUrl($comment->product_slug); ?>" class="link-black" target="_blank"><?= getProductTitle($comment); ?></a>
                                    </td>
                                    <td class="white-space-nowrap" style="width: 15%"><?= formatDate($comment->created_at); ?></td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (empty($comments)): ?>
                    <p class="text-center">
                        <?= "Kayıt bulunamadı"; ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php if (!empty($comments)): ?>
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