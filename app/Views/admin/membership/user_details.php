<div class="row">
    <div class="col-sm-12 col-lg-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Kullanıcı Detayları"; ?></h3>
                </div>
            </div>
            <div class="box-body box-body-info">
                <div class="row">
                    <div class="col-sm-12 col-profile">
                        <img src="<?= getUserAvatar($user); ?>" alt="avatar" class="thumbnail img-responsive img-update" style="max-width: 200px;">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Rol"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <?php $role = getRoleById($user->role_id);
                        if (!empty($role)): ?>
                            <label class="label label-success"><?= esc(getRoleName($role)); ?></label>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Mağaza Adı"; ?>&nbsp;(<?= "Kullanıcı Adı"; ?>)</strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc(getUsername($user)); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Ad"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc($user->first_name); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Soyad"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc($user->last_name); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Slug"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc($user->slug); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "E-posta"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc($user->email); ?></strong>
                        <?php if ($user->email_status == 1): ?>
                            <small class="text-success">(<?= "Onaylandı"; ?>)</small>
                        <?php else: ?>
                            <small class="text-danger">(<?= "Onaylanmadı"; ?>)</small>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Telefon Numarası"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc($user->phone_number); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Üyelik Planı"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600">
                            <?php $membershipModel = new \App\Models\MembershipModel();
                            $membershipPlan = $membershipModel->getUserPlanByUserId($user->id, false);
                            echo !empty($membershipPlan) ? esc($membershipPlan->plan_title) : ''; ?>
                        </strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Konum"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc(getLocation($user)); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Satışlar"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= $user->number_of_sales; ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Bakiye"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= priceFormatted($user->balance, $paymentSettings->default_currency); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Komisyon Borcu"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= priceFormatted($user->commission_debt, $paymentSettings->default_currency); ?></strong>
                    </div>
                </div>
                <?php $socialArray = getSocialLinksArray($user);
                foreach ($socialArray as $item):?>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <strong><?= $item['inputName']; ?></strong>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <strong class="font-600"><?= esc($item['value']); ?></strong>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Son Görülme"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= !empty($user->last_seen) ? timeAgo($user->last_seen) : ''; ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Yasaklandı"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= $user->banned == 1 ? "Evet" : "Hayır"; ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Ortaklık Programı"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= $user->is_affiliate == 1 ? "Evet" : "Hayır"; ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Açıklama"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc($user->about_me); ?></strong>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <strong><?= "Üye Olma Tarihi"; ?></strong>
                    </div>
                    <div class="col-sm-12 col-md-8">
                        <strong class="font-600"><?= esc(formatDate($user->created_at)); ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-lg-7">
        <div class="box">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Kullanıcı Giriş Aktiviteleri"; ?></h3>
                </div>
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
                                            <form action="<?= adminUrl('user-details'); ?>/<?= $user->id; ?>" method="get">
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
                                                    <label><?= "Ara"; ?></label>
                                                    <input name="q" class="form-control" placeholder="<?= "Ara"; ?>" type="search" value="<?= esc(inputGet('q')); ?>">
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
                                    <th><?= "IP Adresi"; ?></th>
                                    <th><?= "Kullanıcı Aracı"; ?></th>
                                    <th><?= "Tarih"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($activities)):
                                    foreach ($activities as $item): ?>
                                        <tr>
                                            <td><?= esc($item->ip_address); ?></td>
                                            <td><?= esc($item->user_agent); ?></td>
                                            <td><?= formatDate($item->created_at); ?></td>
                                        </tr>
                                    <?php endforeach;
                                endif; ?>
                                </tbody>
                            </table>
                            <?php if (empty($activities)): ?>
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
    </div>
</div>

<style>
    .box-body-info .row {
        padding-bottom: 10px;
        margin-bottom: 10px;
        border-bottom: 1px dashed #e4e4e4;
    }
</style>