<div class="row">
    <div class="col-sm-8 col-sm-offset-2 m-t-30">
        <div class="alert alert-danger alert-large">
            <?php if (empty(getUserPlanByUserId(user()->id))): ?>
                <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "Üyelik planınız yok"; ?>
            <?php else: ?>
                <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "İlan limitine ulaştınız"; ?>
            <?php endif; ?>
        </div>
        <a href="<?= generateUrl('select_membership_plan'); ?>" class="btn btn-md btn-block btn-slate m-t-30" style="padding: 10px 12px;"><?= "Planınızı Seçin" ?></a>
    </div>
</div>