<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "Kullanıcı Ekle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('users'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "Kullanıcılar"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Membership/addUserPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <label class="control-label"><?= "Ad"; ?></label>
                        <input type="text" name="first_name" class="form-control auth-form-input" placeholder="<?= "Ad"; ?>" value="<?= old("first_name"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Soyad"; ?></label>
                        <input type="text" name="last_name" class="form-control auth-form-input" placeholder="<?= "Soyad"; ?>" value="<?= old("last_name"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "E-posta Adresi"; ?></label>
                        <input type="email" name="email" class="form-control auth-form-input" placeholder="<?= "E-posta Adresi"; ?>" value="<?= old("email"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Şifre"; ?></label>
                        <input type="password" name="password" class="form-control auth-form-input" placeholder="<?= "Şifre"; ?>" value="<?= old("password"); ?>" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label"><?= "Rol"; ?></label>
                        <select name="role_id" class="form-control" required>
                            <option value=""><?= "Seç"; ?></option>
                            <?php if (!empty($roles)):
                                foreach ($roles as $item): ?>
                                    <option value="<?= $item->id; ?>"><?= esc(getRoleName($item)); ?></option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Kullanıcı Ekle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>