<div class="row">
    <div class="col-lg-8 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title"><?= "İli Güncelle"; ?></h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('states'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-list-ul"></i>&nbsp;&nbsp;<?= "İller"; ?>
                    </a>
                </div>
            </div>
            <form action="<?= base_url('Admin/editStatePost'); ?>" method="post">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" value="<?= $state->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label><?= "Ülke"; ?></label>
                        <select name="country_id" class="form-control select2" required>
                            <option value=""><?= "Seç"; ?></option>
                            <?php if (!empty($countries)):
                                foreach ($countries as $item): ?>
                                    <option value="<?= $item->id; ?>" <?= $state->country_id == $item->id ? 'selected' : ''; ?>>
                                        <?= esc($item->name); ?>
                                    </option>
                                <?php endforeach;
                            endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?= "Ad"; ?></label>
                        <input type="text" class="form-control" name="name" value="<?= esc($state->name); ?>" placeholder="<?= "Ad"; ?>" maxlength="200" required>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Eyaleti Güncelle"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>