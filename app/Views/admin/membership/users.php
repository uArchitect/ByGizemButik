<?php $session = session();
$userLoginSess = $session->getFlashdata('user-login-pass-wrong'); ?>
<div class="box">
    <div class="box-header with-border">
        <div class="left">
            <h3 class="box-title">Kullanıcılar</h3>
        </div>
        <div class="right">
            <a href="<?= adminUrl('add-user'); ?>" class="btn btn-success btn-add-new">
                <i class="fa fa-plus"></i>&nbsp;&nbsp;Kullanıcı Ekle
            </a>
        </div>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <div class="row table-filter-container">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-default filter-toggle collapsed m-b-10" data-toggle="collapse" data-target="#collapseFilter" aria-expanded="false">
                                <i class="fa fa-filter"></i>&nbsp;&nbsp;Filtrele
                            </button>
                            <div class="collapse navbar-collapse" id="collapseFilter">
                                <form action="<?= adminUrl('users'); ?>" method="get">
                                    <div class="item-table-filter" style="width: 80px; min-width: 80px;">
                                        <label>Göster</label>
                                        <select name="show" class="form-control">
                                            <option value="15" <?= inputGet('show') == '15' ? 'selected' : ''; ?>>15</option>
                                            <option value="30" <?= inputGet('show') == '30' ? 'selected' : ''; ?>>30</option>
                                            <option value="60" <?= inputGet('show') == '60' ? 'selected' : ''; ?>>60</option>
                                            <option value="100" <?= inputGet('show') == '100' ? 'selected' : ''; ?>>100</option>
                                        </select>
                                    </div>
                                    <div class="item-table-filter">
                                        <label>Rol</label>
                                        <select name="role" class="form-control">
                                            <option value="">Tümü</option>
                                            <?php if (!empty($roles)):
                                                foreach ($roles as $item):?>
                                                    <option value="<?= $item->id; ?>" <?= inputGet('role') == $item->id ? 'selected' : ''; ?>><?= esc(getRoleName($item)); ?></option>
                                                <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="item-table-filter">
                                        <label>Durum</label>
                                        <select name="status" class="form-control">
                                            <option value="">Tümü</option>
                                            <option value="active" <?= inputGet('status') == 'active' ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="banned" <?= inputGet('status') == 'banned' ? 'selected' : ''; ?>>Yasaklı</option>
                                        </select>
                                    </div>
                                    <div class="item-table-filter">
                                        <label><?= "E-posta Durumu"; ?></label>
                                        <select name="email_status" class="form-control">
                                            <option value=""><?= "Tümü"; ?></option>
                                            <option value="confirmed" <?= inputGet('email_status') == 'confirmed' ? 'selected' : ''; ?>><?= "Onaylandı"; ?></option>
                                            <option value="unconfirmed" <?= inputGet('email_status') == 'unconfirmed' ? 'selected' : ''; ?>><?= "Onaylanmadı"; ?></option>
                                        </select>
                                    </div>
                                    <div class="item-table-filter item-table-filter-long">
                                        <label><?= "Ara"; ?></label>
                                        <input name="q" class="form-control" placeholder="<?= "Ara" ?>" type="search" value="<?= esc(inputGet('q')); ?>">
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
                            <th><?= "E-posta"; ?></th>
                            <th><?= "Üyelik Planı"; ?></th>
                            <th><?= "Durum"; ?></th>
                            <th><?= str_replace(':', '', "Son Görülme"); ?></th>
                            <th><?= "Tarih"; ?></th>
                            <th class="max-width-120"><?= "Seçenekler"; ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $membershipModel = new \App\Models\MembershipModel();
                        if (!empty($users)):
                            foreach ($users as $user):
                                $membershipPlan = $membershipModel->getUserPlanByUserId($user->id, false);
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
                                    <td style="max-width: 200px;"><?= !empty($membershipPlan) ? esc($membershipPlan->plan_title) : ''; ?></td>
                                    <td>
                                        <?php if ($user->banned == 0): ?>
                                            <label class="label label-success"><?= "Aktif"; ?></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><?= "Yasaklandı"; ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= timeAgo($user->last_seen); ?></td>
                                    <td><?= formatDate($user->created_at); ?></td>
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
                                                    <?php if (isAdmin() && hasPermission('membership')): ?>
                                                        <li>
                                                            <button type="button" class="btn-list-button btn-change-role" data-toggle="modal" data-target="#loginModal" onclick="setLoginFormData(<?= $user->id; ?>, '<?= clrQuotes(getUsername($user)); ?>')">
                                                                <i class="fa fa-user option-icon"></i><?= "Giriş Yap"; ?>
                                                            </button>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <button type="button" class="btn-list-button btn-change-role" data-toggle="modal" data-target="#modalRole<?= $user->id; ?>">
                                                            <i class="fa fa-key option-icon"></i><?= "Kullanıcı Rolünü Değiştir"; ?>
                                                        </button>
                                                    </li>
                                                    <?php if (!empty($membershipPlans) && $userRole->is_vendor): ?>
                                                        <li>
                                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAssign<?= $user->id; ?>"><i class="fa fa-check-circle-o option-icon"></i><?= "Üyelik Planı Ata"; ?></a>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <?php if ($user->email_status != 1): ?>
                                                            <a href="javascript:void(0)" onclick="confirmUserEmail(<?= $user->id; ?>);"><i class="fa fa-check option-icon"></i><?= "Kullanıcı E-postasını Onayla"; ?></a>
                                                        <?php endif; ?>
                                                    </li>
                                                    <li>
                                                        <?php if ($user->banned == 0): ?>
                                                            <a href="javascript:void(0)" onclick="banRemoveBanUser(<?= $user->id; ?>);"><i class="fa fa-stop-circle option-icon"></i><?= "Kullanıcıyı Yasakla"; ?></a>
                                                        <?php else: ?>
                                                            <a href="javascript:void(0)" onclick="banRemoveBanUser(<?= $user->id; ?>);"><i class="fa fa-circle option-icon"></i><?= "Kullanıcı Yasağını Kaldır"; ?></a>
                                                        <?php endif; ?>
                                                    </li>
                                                    <?php if ($generalSettings->affiliate_status == 1): ?>
                                                        <li>
                                                            <?php if ($user->is_affiliate == 1): ?>
                                                                <a href="javascript:void(0)" onclick="addDeleteUserAffiliateProgram(<?= $user->id; ?>);"><i class="fa fa-times option-icon"></i><?= "Ortaklık Programından Sil"; ?></a>
                                                            <?php else: ?>
                                                                <a href="javascript:void(0)" onclick="addDeleteUserAffiliateProgram(<?= $user->id; ?>);"><i class="fa fa-plus option-icon"></i><?= "Ortaklık Programına Ekle"; ?></a>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endif; ?>
                                                    <li>
                                                        <a href="<?= adminUrl('edit-user/' . $user->id); ?>"><i class="fa fa-edit option-icon"></i><?= "Kullanıcıyı Düzenle"; ?></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" onclick="deleteItem('Membership/deleteUserPost','<?= $user->id; ?>','<?= "Bu kullanıcıyı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash option-icon"></i><?= "Sil"; ?></a>
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
        <div id="modalAssign<?= $user->id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= base_url('Membership/assignMembershipPlanPost'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="user_id" value="<?= $user->id; ?>">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?= "Üyelik Planı Ata"; ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label><?= "Üyelik Planı"; ?></label>
                                <?php if (!empty($membershipPlans)): ?>
                                    <select class="form-control" name="plan_id" required>
                                        <option value=""><?= "Seç"; ?></option>
                                        <?php foreach ($membershipPlans as $plan): ?>
                                            <option value="<?= $plan->id; ?>"><?= getMembershipPlanName($plan->title_array, selectedLangId()); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><?= "Gönder"; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="modalRole<?= $user->id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= "Kullanıcı Rolünü Değiştir"; ?></h4>
                    </div>
                    <form action="<?= base_url('Membership/changeUserRolePost'); ?>" method="post">
                        <?= csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row">
                                    <input type="hidden" name="user_id" value="<?= $user->id; ?>">
                                    <?php if (!empty($roles)):
                                        foreach ($roles as $item):
                                            $rdId = uniqid(); ?>
                                            <div class="col-sm-6 m-b-15">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" name="role_id" value="<?= $item->id; ?>" id="<?= $rdId; ?>" class="custom-control-input" <?= $user->role_id == $item->id ? 'checked' : ''; ?> required>
                                                    <label for="<?= $rdId; ?>" class="custom-control-label"><?= esc(getRoleName($item)); ?></label>
                                                </div>
                                            </div>
                                        <?php endforeach;
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"><?= "Değişiklikleri Kaydet"; ?></button>
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= "Kapat"; ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach;
endif; ?>

<?php if (isAdmin() && hasPermission('membership')): ?>
    <div id="loginModal" class="modal fade" role="dialog">
        <div class="modal-dialog" style="max-width: 480px;">
            <div class="modal-content">
                <form action="<?= base_url('Membership/loginToUserAccountPost'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="user_id" id="formLoginUserId">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= "Giriş Yap"; ?></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" style="margin-bottom: 30px;">
                            <div class="alert alert-info">
                                <i class="fa fa-exclamation-circle"></i>&nbsp;&nbsp;<?= "Bu kullanıcının hesabına giriş yapacaksınız"; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Kullanıcı"; ?>:&nbsp;&nbsp;<span id="formLoginUsername"></span></label>
                        </div>
                        <div class="form-group">
                            <label class="control-label"><?= "Şifrenizi Girin"; ?></label>
                            <input type="password" name="password" class="form-control auth-form-input" placeholder="<?= "Şifre"; ?>" minlength="4" maxlength="255" required>
                        </div>
                        <?php if (!empty($userLoginSess)): ?>
                            <div class="form-group">
                                <div class="alert alert-danger" style="width: 100%;">
                                    <i class="fa fa-times"></i>&nbsp;&nbsp;<?= "Yanlış şifre"; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block"><?= "Giriş Yap"; ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function setLoginFormData(id, username) {
            $('#formLoginUserId').val(id);
            document.getElementById("formLoginUsername").innerHTML = username;
        }
    </script>
<?php endif; ?>

<?php if (!empty($userLoginSess)): ?>
    <script>
        $(document).ready(function () {
            $("#loginModal").modal();
        });
    </script>
<?php endif; ?>


