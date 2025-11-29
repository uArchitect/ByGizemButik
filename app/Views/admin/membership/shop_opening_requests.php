<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= "Mağaza Açma Talepleri"; ?></h3>
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
                                <form action="<?= adminUrl('shop-opening-requests'); ?>" method="get">
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
                                            <option value=""><?= "Seç"; ?></option>
                                            <option value="1" <?= inputGet('status') == '1' ? 'selected' : ''; ?>><?= "Aktif"; ?></option>
                                            <option value="2" <?= inputGet('status') == '2' ? 'selected' : ''; ?>><?= "Reddedildi"; ?></option>
                                            <option value="3" <?= inputGet('status') == '3' ? 'selected' : ''; ?>><?= "Kalıcı Olarak Reddedildi"; ?></option>
                                        </select>
                                    </div>
                                    <div class="item-table-filter md-top-10" style="width: 65px; min-width: 65px;">
                                        <label style="display: block">&nbsp;</label>
                                        <button type="submit" class="btn bg-purple"><?= "Filtrele"; ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th width="20"><?= "ID"; ?></th>
                            <th><?= "Kullanıcı"; ?></th>
                            <th><?= "Gerekli Dosyalar"; ?></th>
                            <th><?= "Durum"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $membershipModel = new \App\Models\MembershipModel();
                        if (!empty($users)):
                            foreach ($users as $user):
                                $membershipPlan = $membershipModel->getUserPlanByUserId($user->id, false); ?>
                                <tr>
                                    <td><?= esc($user->id); ?></td>
                                    <td>
                                        <div class="tbl-table">
                                            <div class="left">
                                                <a href="<?= generateProfileUrl($user->slug); ?>" target="_blank" class="table-link">
                                                    <img src="<?= getUserAvatar($user); ?>" alt="user" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="right">
                                                <div class="m-b-5">
                                                    <a href="<?= generateProfileUrl($user->slug); ?>" target="_blank" class="table-link"><?= esc(getUsername($user)); ?></a>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalDetails<?= $user->id; ?>"><?= "Detayları Gör"; ?></button>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php $files = unserializeData($user->vendor_documents);
                                        if (!empty($files)):?>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="ticket-attachments">
                                                        <?php foreach ($files as $file):
                                                            $fileName = '';
                                                            if (!empty($file['path'])) {
                                                                $fileName = str_replace('uploads/support/', '', $file['path']);
                                                            } ?>
                                                            <form action="<?= base_url('Support/downloadAttachmentPost'); ?>" method="post">
                                                                <?= csrf_field(); ?>
                                                                <input type="hidden" name="orj_name" value="<?= $file['name']; ?>">
                                                                <input type="hidden" name="name" value="<?= $fileName; ?>">
                                                                <p class="font-600 text-info">
                                                                    <button type="submit" class="button-link"><i class="fa fa-file"></i>&nbsp;&nbsp;<span><?= esc($file['name']); ?></span></button>
                                                                </p>
                                                            </form>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td style="min-width: 100px;">
                                        <?php if ($user->is_active_shop_request == 1): ?>
                                            <label class="label label-success"><?= "Aktif"; ?></label>
                                        <?php elseif ($user->is_active_shop_request == 2 || $user->is_active_shop_request == 3):
                                            if ($user->is_active_shop_request == 2): ?>
                                                <label class="label label-warning"><?= "Reddedildi"; ?></label>
                                            <?php elseif ($user->is_active_shop_request == 3): ?>
                                                <label class="label label-danger"><?= "Kalıcı Olarak Reddedildi"; ?></label>
                                            <?php endif; ?>
                                            <div class="m-t-5">
                                                <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modalReason<?= $user->id; ?>"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;<?= "Sebebi Göster"; ?></button>
                                                <div id="modalReason<?= $user->id; ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><i class="icon-close"></i></button>
                                                                <h4 class="modal-title"><?= "Sebep"; ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="m-t-10"><?= esc($user->shop_request_reject_reason); ?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= "Kapat"; ?></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form action="<?= base_url('Membership/approveShopOpeningRequest'); ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $user->id; ?>">
                                            <div class="dropdown">
                                                <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?>
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu options-dropdown">
                                                    <li>
                                                        <button type="submit" name="submit" value="1" class="btn-list-button"><i class="fa fa-check option-icon"></i><?= "Onayla"; ?></button>
                                                    </li>
                                                    <?php if ($user->is_active_shop_request != 2): ?>
                                                        <li>
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalReject" onclick="$('#reject_user_id').val(<?= $user->id; ?>);"><i class="fa fa-ban option-icon"></i><?= "Reddet"; ?></a>
                                                        </li>
                                                    <?php endif;
                                                    if ($user->is_active_shop_request != 3): ?>
                                                        <li>
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalRejectPermanently" onclick="$('#reject_permanently_user_id').val(<?= $user->id; ?>);"><i class="fa fa-ban option-icon"></i><?= "Kalıcı Olarak Reddet"; ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                        </tbody>
                    </table>
                    <?php if (empty($users)): ?>
                        <p class="text-center text-muted"><?= "Kayıt bulunamadı"; ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="pull-right">
                    <?= $pager->links; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($users)):
    foreach ($users as $user): ?>
        <div id="modalDetails<?= $user->id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= "Detaylar"; ?></h4>
                    </div>
                    <div class="modal-body" style="font-size: 16px;">
                        <p class="m-b-10 m-t-10"><strong class="lbl-user-info"><?= "Mağaza Adı" ?>:</strong>&nbsp;&nbsp;<?= esc($user->username); ?></p>
                        <p class="m-b-10"><strong class="lbl-user-info"><?= "Ad" ?>:</strong>&nbsp;&nbsp;<?= esc($user->first_name); ?></p>
                        <p class="m-b-10"><strong class="lbl-user-info"><?= "Soyad" ?>:</strong>&nbsp;&nbsp;<?= esc($user->last_name); ?></p>
                        <p class="m-b-10"><strong class="lbl-user-info"><?= "E-posta" ?>:</strong>&nbsp;&nbsp;<?= esc($user->email); ?></p>
                        <p class="m-b-10"><strong class="lbl-user-info"><?= "Telefon" ?>:</strong>&nbsp;&nbsp;<?= esc($user->phone_number); ?></p>
                        <p class="m-b-10"><strong class="lbl-user-info"><?= "Konum" ?>:</strong>&nbsp;&nbsp;<?= getLocation($user); ?></p>
                        <div class="m-b-10"><strong><?= "Mağaza Açıklaması"; ?>:</strong>
                            <p class="m-t-10"><?= esc($user->about_me); ?></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" data-dismiss="modal"><?= "Kapat"; ?></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
endif; ?>

<div id="modalReject" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Membership/rejectShopOpeningRequest'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" id="reject_user_id">
                <input type="hidden" name="is_permanently" value="0">
                <input type="hidden" name="back_url" value="<?= getCurrentUrl(); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= "Reddet"; ?></h4>
                </div>
                <div class="modal-body">
                    <textarea name="reject_reason" class="form-control form-textarea" placeholder="<?= "Sebep"; ?>..(<?= "İsteğe Bağlı"; ?>)" maxlength="999" style="min-height: 150px;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success"><?= "Gönder"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalRejectPermanently" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('Membership/rejectShopOpeningRequest'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" id="reject_permanently_user_id">
                <input type="hidden" name="is_permanently" value="1">
                <input type="hidden" name="back_url" value="<?= getCurrentUrl(); ?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= "Kalıcı Olarak Reddet"; ?></h4>
                </div>
                <div class="modal-body">
                    <textarea name="reject_reason" class="form-control form-textarea" placeholder="<?= "Sebep"; ?>..(<?= "İsteğe Bağlı"; ?>)" maxlength="999" style="min-height: 150px;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-md btn-success"><?= "Gönder"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .lbl-user-info {
        display: inline-block;
        min-width: 145px;
    }
</style>