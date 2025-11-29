<div class="modal-license-key-list">
    <div class="table-responsive">
        <?php if (!empty($licenseKeys)): ?>
            <table class="table table-striped table-custom-modal">
                <thead>
                <tr>
                    <th scope="col"><?= "Lisans Anahtarı"; ?></th>
                    <th scope="col"><?= "Kullanıldı"; ?></th>
                    <th scope="col"><?= "Seçenekler"; ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($licenseKeys)):
                    foreach ($licenseKeys as $licenseKey): ?>
                        <tr id="tr_license_key_<?= $licenseKey->id; ?>">
                            <td><?= $licenseKey->license_key; ?></td>
                            <td style="width: 50px;">
                                <?php if ($licenseKey->is_used == 1):
                                    echo "Evet";
                                else:
                                    echo "Hayır";
                                endif; ?>
                            </td>
                            <td style="width: 80px;">
                                <a href="javascript:void(0)" class="btn btn-xs btn-danger" onclick="deleteLicenseKey('<?= $licenseKey->id; ?>','<?= $product->id; ?>');"><?= "Sil"; ?></a>
                            </td>
                        </tr>
                    <?php endforeach;
                endif; ?>
                </tbody>
            </table>
        <?php endif;
        if (empty($licenseKeys)): ?>
            <p class="text-center">
                <?= "Kayıt bulunamadı"; ?>
            </p>
        <?php endif; ?>
    </div>
</div>