<div class="row">
    <div class="col-sm-10">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Rol Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('roles-permissions'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Roller"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Membership/addRolePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <?php foreach ($activeLanguages as $language): ?>
                        <div class="form-group">
                            <label><?= "Rol Adı"; ?> (<?= esc($language->name); ?>)</label>
                            <input type="text" class="form-control" name="role_name_<?= $language->id; ?>" placeholder="<?= "Rol Adı"; ?>" maxlength="255" required>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group">
                        <label class="m-b-15"><?= "İzinler"; ?></label>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <?php $permissions = getPermissionsArray();
                                if (!empty($permissions)):
                                    $i = 0;
                                    foreach ($permissions as $key => $value):
                                        if ($i <= 17):?>
                                            <div class="m-b-15">
                                                <?= formCheckbox('permissions[]', $key, $value); ?>
                                            </div>
                                        <?php endif;
                                        $i++;
                                    endforeach;
                                endif; ?>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <?php if (!empty($permissions)):
                                    $i = 0;
                                    foreach ($permissions as $key => $value):
                                        if ($i > 17):?>
                                            <div class="m-b-15">
                                                <?= formCheckbox('permissions[]', $key, $value); ?>
                                            </div>
                                        <?php endif;
                                        $i++;
                                    endforeach;
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Rol Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>