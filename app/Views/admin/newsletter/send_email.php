<div class="row" style="margin-bottom: 30px;">
    <div class="col-sm-12">
        <div class="alert alert-success alert-large m-t-10">
            <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "Çok sayıda e-posta gönderme açıklaması"; ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= 'Abonelere E-posta Gönder'; ?></h3>
            </div>
            <form id="form_send_email">
                <div class="box-body">
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label><?= "Kime"; ?></label>
                        <?php if (!empty($emails)): ?>
                            <p style="max-height: 150px; overflow-y: auto">
                                <?php foreach ($emails as $email): ?>
                                    <label class="label-newsletter-email"><?= esc($email); ?></label>
                                <?php endforeach; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label><?= "Konu"; ?></label>
                        <input type="text" name="subject" id="newsletter_subject" class="form-control" placeholder="<?= "Konu"; ?>" maxlength="255" required>
                    </div>
                    <div class="form-group">
                        <label><?= "İçerik"; ?></label>
                        <div class="row">
                            <div class="col-sm-12 m-b-5">
                                <button type="button" class="btn btn-success btn-file-manager" data-image-type="editor" data-toggle="modal" data-target="#imageFileManagerModal"><i class="fa fa-image"></i>&nbsp;&nbsp;<?= "Resim Ekle"; ?></button>
                            </div>
                        </div>
                        <textarea class="tinyMCE form-control" name="body"></textarea>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="<?= adminUrl('newsletter'); ?>" id="btn_newsletter_back" class="btn btn-danger"><?= "Geri"; ?></a>
                    <button type="submit" id="btn_send_newsletter" class="btn btn-primary pull-right"><?= "E-posta Gönder"; ?>&nbsp;&nbsp;<i class="fa fa-send"></i></button>
                    <div class="col-sm-12 m-t-30">
                        <div class="row">
                            <div id="newsletter_spinner" class="newsletter-spinner">
                                <strong class="newsletter-sending"><?= "E-posta gönderiliyor"; ?></strong>
                                <strong class="text-newsletter-completed"><?= "Tamamlandı"; ?>!</strong>
                                <div class="spinner" style="margin-top: 15px;">
                                    <div class="bounce1"></div>
                                    <div class="bounce2"></div>
                                    <div class="bounce3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="newsletter-email-container">
                                <ul id="newsletter_sent_emails" class="list-group csv-uploaded-files"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= view('admin/includes/_image_file_manager'); ?>

<style>
    .label-newsletter-email {
        display: inline-block;
        padding: 3px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 300 !important;
        color: #41464b !important;
        background-color: #e2e3e5 !important;
        border-color: #d3d6d8 !important;
    }

    .newsletter-email-container {
        max-height: 300px;
        overflow-y: auto;
        margin-top: 15px;
    }

    .newsletter-spinner {
        display: none;
        text-align: center;
        font-size: 16px;
    }

    .text-newsletter-completed {
        display: none;
    }
</style>

<script>
    var arrayEmails = "";
    var arraySent = [];
    <?php if(!empty($emails)): ?>var arrayEmails = <?= json_encode($emails); ?>;<?php endif; ?>
    var subject = '';
    var body = '';
    var sentCount = 0;
    $("#form_send_email").submit(function (event) {
        event.preventDefault();
        $("#newsletter_spinner").show();
        document.getElementById("btn_newsletter_back").disabled = true;
        document.getElementById("btn_send_newsletter").disabled = true;
        body = tinyMCE.activeEditor.getContent();
        subject = $("#newsletter_subject").val();
        sendNewsletterEmail();
    });

    function sendNewsletterEmail() {
        var email = getNextEmail();
        if (email != "") {
            var data = {
                'subject': subject,
                'body': body,
                'email': email,
                'email_receiver_type': '<?= $emailReceiverType; ?>'
            };
            $.ajax({
                type: 'POST',
                url: MdsConfig.baseURL + '/Admin/newsletterSendEmailPost',
                cache: false,
                data: setAjaxData(data),
                success: function (response) {
                    var obj = JSON.parse(response);
                    if (obj.result == 1) {
                        removeItemFromArray(arrayEmails, email);
                        arraySent.push(email);
                        sentCount = sentCount + 1;
                        $("#newsletter_sent_emails").prepend('<li class="list-group-item list-group-item-success"><i class="fa fa-check"></i>&nbsp;' + sentCount + '. ' + email + '</li>');
                        sendNewsletterEmail();
                    }
                }
            });
        } else {
            $("#newsletter_spinner .newsletter-sending").hide();
            $("#newsletter_spinner .spinner").hide();
            $("#newsletter_spinner .text-newsletter-completed").css('display', 'block');
        }
    }

    function getNextEmail() {
        var nextEmail = '';
        var i;
        for (i = 0; i < arrayEmails.length; i++) {
            if (arraySent.indexOf(arrayEmails[i]) < 0) {
                nextEmail = arrayEmails[i];
                break;
            }
        }
        return nextEmail;
    }

    function removeItemFromArray(array, item) {
        var index = array.indexOf(item);
        while (index > -1) {
            array.splice(index, 1);
            index = array.indexOf(item);
        }
    }
</script>
