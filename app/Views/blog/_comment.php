<div class="row">
    <div class="col-12">
        <form id="form_add_blog_comment">
            <input type="hidden" name="post_id" value="<?= $post->id; ?>">
            <?php if (!authCheck()): ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" name="name" id="comment_name" class="form-control form-input" placeholder="<?= "Ad"; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="email" name="email" id="comment_email" class="form-control form-input" placeholder="<?= "E-posta Adresi"; ?>">
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <textarea name="comment" id="comment_text" class="form-control form-input form-textarea" placeholder="<?= "Yorum"; ?>"></textarea>
            </div>
            <?php if(!authCheck()): ?>
            <div class="form-group">
                <?php reCaptcha('generate'); ?>
            </div>
            <?php endif; ?>
            <div class="form-group">
                <button type="submit" class="btn btn-md btn-custom float-right"><?= "Gönder"; ?></button>
            </div>
        </form>
    </div>
    <div class="col-12">
        <div id="comment-result">
            <?= view('blog/_blog_comments', ['commentPostId' => $post->id]); ?>
        </div>
    </div>
</div>