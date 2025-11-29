<div class="row">
    <div class="col-sm-12">
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
                                            <form action="<?= adminUrl('user-login-activities'); ?>" method="get">
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
                                    <th><?= "Kullanıcı"; ?></th>
                                    <th><?= "IP Adresi"; ?></th>
                                    <th><?= "Kullanıcı Aracı"; ?></th>
                                    <th><?= "Tarih"; ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($activities)):
                                    foreach ($activities as $item): ?>
                                        <tr>
                                            <td>
                                                <a href="<?= adminUrl('user-details'); ?>/<?= $item->user_id; ?>" target="_blank" class="table-link">
                                                    <?= esc($item->first_name) . ' ' . esc($item->last_name); ?>&nbsp;<?= !empty($item->username) ? '(' . $item->username . ')' : ''; ?>
                                                </a>
                                            </td>
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