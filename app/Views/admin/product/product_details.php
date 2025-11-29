<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Ürün Detayları"; ?></h3>
            </div>
            <div class="box-body">
                <?php $images = getProductImages($product->id);
                if (!empty($images)):?>
                    <div class="row row-product-details row-product-images">
                        <div class="col-sm-12">
                            <?php foreach ($images as $image): ?>
                                <div class="image m-b-10">
                                    <img src="<?= getProductImageURL($image, 'image_small'); ?>" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Satıcı"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php $user = getUser($product->user_id);
                        if (!empty($user)): ?>
                            <a href="<?= generateProfileUrl($user->slug); ?>" target="_blank"><strong><?= esc(getUsername($user)); ?></strong></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Link"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <a href="<?= generateProductUrl($product); ?>" target="_blank"><?= generateProductUrl($product); ?></a>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Durum"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if ($product->status == 1): ?>
                            <label class="label label-success"><?= "Aktif"; ?></label>
                        <?php else: ?>
                            <?php if ($product->is_rejected == 1): ?>
                                <label class="label label-danger"><?= "Reddedildi"; ?></label>
                                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalReason"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<?= "Sebebi Göster"; ?></button>
                                <div id="modalReason" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"><?= "Sebep"; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <p class="m-t-10"><?= esc($product->reject_reason); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= "Kapat"; ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <label class="label label-default"><?= "Bekliyor"; ?></label>
                            <?php endif;
                        endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Görünürlük"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if ($product->visibility == 1): ?>
                            <label class="label label-success"><?= "Görünür"; ?></label>
                        <?php else: ?>
                            <label class="label label-danger"><?= "Gizli"; ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "ID"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= $product->id; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Başlık"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= esc($productDetails->title); ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Slug"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= esc($product->slug); ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Kısa Açıklama"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= esc($productDetails->short_description); ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "SKU"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= esc($product->sku); ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Ürün Türü"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= $product->product_type == 'physical' ? 'Fiziksel' : ($product->product_type == 'digital' ? 'Dijital' : $product->product_type); ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "İlan Türü"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= getProductListingType($product); ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Kategori"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php $category = getCategory($product->category_id);
                        if (!empty($category)) {
                            $i = 0;
                            $categories = getCategoryParentTree($category, false);
                            if (!empty($categories)) {
                                foreach ($categories as $category) {
                                    if ($i != 0) {
                                        echo ', ';
                                    }
                                    echo getCategoryName($category, $activeLang->id);
                                    $i++;
                                }
                            }
                        } ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Fiyat"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= priceFormatted($product->price, $product->currency) . ' ' . $product->currency; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "İndirimli Fiyat"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= priceFormatted($product->price_discounted, $product->currency) . ' ' . $product->currency; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "İndirim Oranı"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= $product->discount_rate; ?><?= $product->discount_rate > 0 ? '%' : ''; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "KDV"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= $product->vat_rate; ?><?= $product->vat_rate > 0 ? '%' : ''; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Stok"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if ($product->product_type == 'digital'):
                            echo "Stokta";
                        else:
                            echo $product->stock;
                        endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Konum"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= getLocation($product); ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Ürün Tanıtımı"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if ($product->is_promoted == 1): ?>
                            <label class="label label-success"><?= "Evet"; ?></label><br><br>
                            <label><?= "Satın Alınan Plan" . ': ' . esc($product->promote_plan); ?></label><br>
                            <label><?= "Başlangıç"; ?>: &nbsp;<?= $product->promote_start_date; ?></label><br>
                            <label><?= "Bitiş"; ?>: &nbsp;<?= $product->promote_end_date; ?></label><br>
                            <label><?= "Kalan Günler"; ?>: &nbsp;<strong><?= dateDifference($product->promote_end_date, date('Y-m-d H:i:s')); ?></strong></label>
                        <?php else: ?>
                            <label class="label label-danger"><?= "Hayır"; ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Yorumlar"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= view('admin/includes/_review_stars', ['review' => $product->rating]); ?>
                        <span>(<?= $reviewsCount; ?>)</span>
                        <style>
                            .rating {
                                float: left;
                                display: inline-block;
                                margin-right: 10px;
                            }
                        </style>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Özel Teklifler"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if ($product->is_special_offer == 1): ?>
                            <label class="label label-success"><?= "Evet"; ?></label>
                        <?php else: ?>
                            <label class="label label-danger"><?= "Hayır"; ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Sayfa Görüntülemeleri"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= $product->pageviews; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Demo URL"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if (!empty($product->demo_url)): ?>
                            <a href="<?= $product->demo_url; ?>" target="_blank"><?= $product->demo_url; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Dış Link"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if (!empty($product->external_link)): ?>
                            <a href="<?= $product->external_link; ?>" target="_blank" rel="nofollow"><?= $product->external_link; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($product->product_type == 'digital'): ?>
                    <div class="row row-product-details">
                        <div class="col-md-3 col-sm-12">
                            <label class="control-label"><?= "Dahil Edilen Dosyalar"; ?></label>
                        </div>
                        <div class="col-md-9 col-sm-12 right">
                            <?= $product->files_included; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Taslak"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if ($product->is_draft == 1): ?>
                            <label class="label label-success"><?= "Evet"; ?></label>
                        <?php else: ?>
                            <label class="label label-danger"><?= "Hayır"; ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Video Önizleme"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if (!empty($video)): ?>
                            <div style="width: 500px; max-width: 100%;">
                                <video controls style="width: 100%;">
                                    <source src="<?= getProductVideoUrl($video); ?>" type="video/mp4">
                                </video>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Ses Önizleme"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if (!empty($audio)): ?>
                            <div style="width: 500px; max-width: 100%;">
                                <audio controls style="width: 100%;">
                                    <source src="<?= getProductAudioUrl($audio); ?>" type="audio/mp3"/>
                                </audio>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Dijital Dosyalar"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?php if (!empty($product->digital_file_download_link)): ?>
                            <p>
                                <a href="<?= esc($product->digital_file_download_link); ?>" target="_blank"><?= esc($product->digital_file_download_link); ?></a>
                            </p>
                        <?php endif; ?>
                        <?php if (!empty($digitalFile)): ?>
                            <form action="<?= base_url('File/downloadDigitalFile'); ?>" method="post" id="form_download_digital_file">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="file_id" value="<?= $digitalFile->id; ?>">
                                <div class="dm-uploaded-digital-file">
                                    <button type="submit" class="btn btn-sm btn-primary color-white float-right m-r-5">
                                        <?= esc($digitalFile->file_name); ?>
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Açıklama"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right description">
                        <?= $productDetails->description; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Güncellendi"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= !empty($product->updated_at) ? timeAgo($product->updated_at) : ''; ?>
                    </div>
                </div>
                <div class="row row-product-details">
                    <div class="col-md-3 col-sm-12">
                        <label class="control-label"><?= "Tarih"; ?></label>
                    </div>
                    <div class="col-md-9 col-sm-12 right">
                        <?= formatDate($product->created_at); ?>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a href="<?= generateDashUrl('edit_product') . '/' . $product->id; ?>" target="_blank" class="btn btn-info pull-right"><i class="fa fa-edit"></i>&nbsp;&nbsp;<?= "Düzenle"; ?></a>
                <button type="button" class="btn btn-danger pull-right m-r-5" data-toggle="modal" data-target="#modalReject"><i class="fa fa-ban"></i>&nbsp;&nbsp;<?= "Reddet"; ?></button>
                <form action="<?= base_url('Product/approveProduct'); ?>" method="post" style="display: inline-block !important; float: right;">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $product->id; ?>">
                    <?php if ($product->status != 1): ?>
                        <button type="submit" name="option" value="approve" class="btn btn-success pull-right m-r-5"><i class="fa fa-check"></i>&nbsp;&nbsp;<?= "Onayla"; ?></button>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modalReject" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Product/rejectProduct'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $product->id; ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= "Reddet"; ?></h4>
                </div>
                <div class="modal-body">
                    <textarea name="reject_reason" class="form-control form-textarea" placeholder="<?= "Sebep"; ?>.." style="min-height: 150px;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success"><?= "Gönder"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>