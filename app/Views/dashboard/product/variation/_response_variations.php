<?php if (!empty($productVariations)): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-product-variations">
                    <thead>
                    <tr>
                        <th scope="col"><?= "ID"; ?></th>
                        <th scope="col"><?= "Etiket"; ?></th>
                        <th scope="col"><?= "Varyasyon Tipi"; ?></th>
                        <th scope="col"></th>
                        <th scope="col"><?= "Görünür"; ?></th>
                        <th scope="col" style="width: 250px;"><?= "Seçenekler"; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($productVariations)):
                        foreach ($productVariations as $variation): ?>
                            <tr>
                                <td><?= $variation->id; ?></td>
                                <td><?= getVariationLabel($variation->label_names, selectedLangId()); ?></td>
                                <td><?= $variation->variation_type; ?></td>
                                <td>
                                    <?php if ($variation->variation_type != 'text' && $variation->variation_type != 'number'): ?>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-variation-table" onclick="addProductVariationOption('<?= $variation->id; ?>');">
                                            <span id="btn-variation-text-add-<?= $variation->id; ?>"><i class="icon-plus"></i><?= "Seçenek Ekle"; ?></span>
                                            <div id="sp-options-add-<?= $variation->id; ?>" class="spinner spinner-btn-variation">
                                                <div class="bounce1"></div>
                                                <div class="bounce2"></div>
                                                <div class="bounce3"></div>
                                            </div>
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-variation-table" onclick="viewProductVariationOptions('<?= $variation->id; ?>');">
                                            <span id="btn-variation-text-options-<?= $variation->id; ?>"><i class="icon-menu"></i><?= "Seçenekleri Görüntüle"; ?></span>
                                            <div id="sp-options-<?= $variation->id; ?>" class="spinner spinner-btn-variation">
                                                <div class="bounce1"></div>
                                                <div class="bounce2"></div>
                                                <div class="bounce3"></div>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($variation->is_visible == 1):
                                        echo "Evet";
                                    else:
                                        echo "Hayır";
                                    endif; ?>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-variation-table" onclick="editProductVariation('<?= $variation->id; ?>');">
                                        <span id="btn-variation-edit-<?= $variation->id; ?>"><i class="icon-edit"></i><?= "Düzenle"; ?></span>
                                        <div id="sp-edit-<?= $variation->id; ?>" class="spinner spinner-btn-variation">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-variation-table" onclick='deleteProductVariation("<?= $variation->id; ?>","<?= "Varyasyonu onayla"; ?>");'><i class="icon-trash"></i><?= "Sil"; ?></a>
                                </td>
                            </tr>
                        <?php endforeach;
                    endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
    $(document).ajaxStop(function () {
        $('#drag-and-drop-zone-variation-image-session').dmUploader({
            url: '<?= base_url('upload-variation-image-session'); ?>',
            maxFileSize: <?= $productSettings->max_file_size_image; ?>,
            queue: true,
            allowedTypes: 'image/*',
            extFilter: ["jpg", "jpeg", "png", "gif"],
            extraData: function (id) {
                return {
                    'file_id': id,
                    '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
                };
            },
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onNewFile: function (id, file) {
                ui_multi_add_file(id, file, "variation-image-session");
                if (typeof FileReader !== "undefined") {
                    var reader = new FileReader();
                    var img = $('#uploaderFile' + id).find('img');

                    reader.onload = function (e) {
                        img.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            },
            onBeforeUpload: function (id) {
                $('#uploaderFile' + id + ' .dm-progress-waiting').hide();
                ui_multi_update_file_progress(id, 0, '', true);
                ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            },
            onUploadProgress: function (id, percent) {
                ui_multi_update_file_progress(id, percent);
            },
            onUploadSuccess: function (id, data) {
                var data = {
                    'file_id': id
                };
                $.ajax({
                    type: 'POST',
                    url: MdsConfig.baseURL + '/get-uploaded-variation-image-session',
                    data: setAjaxData(data),
                    success: function (response) {
                        document.getElementById("uploaderFile" + id).innerHTML = response;
                    }
                });
                ui_multi_update_file_status(id, 'success', 'Upload Complete');
                ui_multi_update_file_progress(id, 100, 'success', false);
            },
            onUploadError: function (id, xhr, status, message) {
                if (message == "Not Acceptable") {
                    $("#uploaderFile" + id).remove();
                    $(".error-message-img-upload").show();
                    setTimeout(function () {
                        $(".error-message-img-upload").fadeOut("slow");
                    }, 4000)
                }
            },
            onFileSizeError: function (file) {
                $(".error-message-img-upload").html("<?= "Dosya çok büyük" . ' ' . formatSizeUnits($productSettings->max_file_size_image); ?>");
                setTimeout(function () {
                    $(".error-message-img-upload").empty();
                }, 4000);
            },
            onFileExtError: function (file) {
                $(".error-message-img-upload").html("<?= "Geçersiz dosya tipi"; ?>");
                setTimeout(function () {
                    $(".error-message-img-upload").empty();
                }, 4000);
            },
        });

        $('#drag-and-drop-zone-variation-image').dmUploader({
            url: '<?= base_url('upload-variation-image'); ?>',
            maxFileSize: <?= $productSettings->max_file_size_image; ?>,
            queue: true,
            allowedTypes: 'image/*',
            extFilter: ["jpg", "jpeg", "png", "gif"],
            extraData: function (id) {
                return {
                    'variation_option_id': $("#drag-and-drop-zone-variation-image #variation_option_id").val(),
                    '<?= csrf_token() ?>': '<?= csrf_hash(); ?>'
                };
            },
            onDragEnter: function () {
                this.addClass('active');
            },
            onDragLeave: function () {
                this.removeClass('active');
            },
            onNewFile: function (id, file) {
                ui_multi_add_file(id, file, "variation-image");
                if (typeof FileReader !== "undefined") {
                    var reader = new FileReader();
                    var img = $('#uploaderFile' + id).find('img');

                    reader.onload = function (e) {
                        img.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            },
            onBeforeUpload: function (id) {
                $('#uploaderFile' + id + ' .dm-progress-waiting').hide();
                ui_multi_update_file_progress(id, 0, '', true);
                ui_multi_update_file_status(id, 'uploading', 'Uploading...');
            },
            onUploadProgress: function (id, percent) {
                ui_multi_update_file_progress(id, percent);
            },
            onUploadSuccess: function (id, data) {
                var obj = JSON.parse(data);
                var data = {
                    'image_id': obj.image_id
                };
                $.ajax({
                    type: 'POST',
                    url: MdsConfig.baseURL + '/get-uploaded-variation-image',
                    data: setAjaxData(data),
                    success: function (response) {
                        document.getElementById("uploaderFile" + id).innerHTML = response;
                    }
                });
            },
            onUploadError: function (id, xhr, status, message) {
                if (message == "Not Acceptable") {
                    $("#uploaderFile" + id).remove();
                    $(".error-message-img-upload").show();
                    setTimeout(function () {
                        $(".error-message-img-upload").fadeOut("slow");
                    }, 4000)
                }
            },
            onFileSizeError: function (file) {
                $(".error-message-img-upload").html("<?= "Dosya çok büyük" . ' ' . formatSizeUnits($productSettings->max_file_size_image); ?>");
                setTimeout(function () {
                    $(".error-message-img-upload").empty();
                }, 4000);
            },
            onFileExtError: function (file) {
                $(".error-message-img-upload").html("<?= "Geçersiz dosya tipi"; ?>");
                setTimeout(function () {
                    $(".error-message-img-upload").empty();
                }, 4000);
            },
        });
    });
</script>