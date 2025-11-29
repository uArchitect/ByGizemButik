<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="support">
                    <nav class="nav-breadcrumb" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= langBaseUrl(); ?>"><?= "Ana Sayfa"; ?></a></li>
                            <li class="breadcrumb-item"><a href="<?= generateUrl('help_center'); ?>"><?= "Yardım Merkezi"; ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?= "Talep Gönder"; ?></li>
                        </ol>
                    </nav>
                    <div class="row justify-content-center">
                        <div class="col-lg-10 col-sm-12 m-t-15">
                            <h1 class="page-title text-center m-b-30"><?= "Talep Gönder"; ?></h1>
                        </div>
                        <div class="col-lg-10 col-sm-12">
                            <?= view('partials/_messages'); ?>
                            <form action="<?= base_url('submit-request-post'); ?>" method="post" id="form_validate">
                                <?= csrf_field(); ?>
                                <?php if (!authCheck()): ?>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Ad"; ?></label>
                                        <input type="text" class="form-control form-input" name="name" value="<?= old('name'); ?>" placeholder="<?= "Ad"; ?>" maxlength="255" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "E-posta"; ?></label>
                                        <input type="email" class="form-control form-input" name="email" value="<?= old('email'); ?>" placeholder="<?= "E-posta"; ?>" maxlength="255" required>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label class="control-label"><?= "Konu"; ?></label>
                                    <input type="text" class="form-control form-input" name="subject" value="<?= old('subject'); ?>" placeholder="<?= "Konu"; ?>" maxlength="500" required>
                                </div>
                                <div class="form-group m-0">
                                    <label class="control-label"><?= "Mesaj"; ?></label>
                                </div>
                                <div class="form-group" style="min-height: 400px">
                                    <textarea name="message" class="tinyMCEticket" aria-hidden="true"><?= old('message'); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?= "Ekler"; ?></label>
                                    <div class="dm-uploader-container">
                                        <div id="drag-and-drop-zone" class="dm-uploader text-center mb-2">
                                            <p class="dm-upload-text">
                                                <?= "Dosyayı buraya sürükleyip bırakın"; ?>&nbsp;<span style="text-decoration: underline; font-weight: 600;"><?= "Dosyalara Göz At"; ?>
                                            </p>
                                            <a class='btn btn-md dm-btn-select-files'>
                                                <input type="file" name="file" size="40" multiple="multiple">
                                            </a>
                                        </div>
                                        <ul class="dm-uploaded-files" id="files-file"></ul>
                                    </div>
                                    <script type="text/html" id="files-template-file">
                                        <li class="media">
                                            <div class="media-body">
                                                <div class="progress">
                                                    <div class="dm-progress-waiting"></div>
                                                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </li>
                                    </script>
                                    <div id="response_uploaded_files" class="uploaded-files m-b-15">
                                        <?php $attachments = helperGetSession('ticket_attachments');
                                        if (!empty($attachments)):
                                            foreach ($attachments as $file):
                                                if (!empty($file->uniqid) && !empty($file->name) && !empty($file->ticket_type) && $file->ticket_type == 'client'): ?>
                                                    <div class="item">
                                                        <div class="item-inner">
                                                            <?= esc($file->name); ?>
                                                            <a href="javascript:void(0)" onclick="deleteSupportAttachment('<?= esc($file->uniqid); ?>')"><i class="icon-times"></i></a>
                                                        </div>
                                                    </div>
                                                <?php endif;
                                            endforeach;
                                        endif; ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <?php reCaptcha('generate'); ?>
                                </div>
                                <div class="text-right m-t-20">
                                    <button type="submit" class="btn btn-md btn-custom"><?= "Mesaj Gönder"; ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>