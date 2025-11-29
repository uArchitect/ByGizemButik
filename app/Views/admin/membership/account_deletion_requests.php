<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title"><?= "Hesap Silme Talepleri"; ?></h3>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr role="row">
                            <th width="20"><?= "ID"; ?></th>
                            <th><?= "Kullanıcı"; ?></th>
                            <th><?= "E-posta"; ?></th>
                            <th><?= "Durum"; ?></th>
                            <th><?= "Son Görülme"; ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($users)):
                            foreach ($users as $user):
                                $userRole = getRoleById($user->role_id);
                                $roleColor = 'bg-gray';
                                if (!empty($userRole)) {
                                    if ($userRole->is_super_admin) {
                                        $roleColor = 'bg-maroon';
                                    } elseif ($userRole->is_admin) {
                                        $roleColor = 'bg-info';
                                    } elseif ($userRole->is_vendor) {
                                        $roleColor = 'bg-purple';
                                    }
                                } ?>
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
                                                <div class="m-b-5" style="word-break: break-word">
                                                    <a href="<?= generateProfileUrl($user->slug); ?>" target="_blank" class="table-link">
                                                        <?= esc($user->first_name) . ' ' . esc($user->last_name); ?>&nbsp;<?= !empty($user->username) ? '(' . $user->username . ')' : ''; ?>
                                                    </a>
                                                </div>
                                                <label class="label <?= $roleColor; ?>">
                                                    <?= esc(getRoleName($userRole)); ?>
                                                </label>
                                                <?php if ($generalSettings->affiliate_status == 1 && $user->is_affiliate == 1): ?>
                                                    &nbsp;&nbsp;<label class="label bg-blue"><?= "Ortak"; ?></label>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?= esc($user->email);
                                        if ($user->email_status == 1): ?>
                                            <small class="text-success">(<?= "Onaylandı"; ?>)</small>
                                        <?php else: ?>
                                            <small class="text-danger">(<?= "Onaylanmadı"; ?>)</small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($user->banned == 0): ?>
                                            <label class="label label-success"><?= "Aktif"; ?></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><?= "Yasaklandı"; ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= timeAgo($user->last_seen); ?></td>
                                    <td><?= !empty($user->account_delete_req_date) ? formatDate($user->account_delete_req_date) : ''; ?></td>
                                    <td>
                                        <?php $showOptions = true;
                                        if ($userRole->is_super_admin) {
                                            $showOptions = false;
                                            $activeUserRole = getRoleById(user()->role_id);
                                            if (!empty($activeUserRole) && $activeUserRole->is_super_admin) {
                                                $showOptions = true;
                                            }
                                        }
                                        if ($showOptions): ?>
                                            <div class="dropdown">
                                                <button class="btn bg-purple dropdown-toggle btn-select-option" type="button" data-toggle="dropdown"><?= "Seçenek Seç"; ?><span class="caret"></span></button>
                                                <ul class="dropdown-menu options-dropdown">
                                                    <li>
                                                        <a href="<?= adminUrl('user-details/' . $user->id); ?>"><i class="fa fa-info-circle option-icon"></i><?= "Kullanıcı Detayları"; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="performAction('Membership/cancelAccountDeleteRequestPost','<?= $user->id; ?>','Bu işlemi gerçekleştirmek istediğinizden emin misiniz?');"><i class="fa fa-times option-icon"></i><?= "İptal Et"; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteItem('Membership/deleteUserPost','<?= $user->id; ?>','Bu kullanıcıyı silmek istediğinizden emin misiniz?');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
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
        </div>
    </div>
</div>