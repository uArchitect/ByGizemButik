<?= view('email/_header', ['title' => "İletişim Mesajı"]); ?>
<?php $emailData = unserializeData($emailRow->email_data); ?>
<table role="presentation" class="main">
    <tr>
        <td class="wrapper">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <h1 style="text-decoration: none; font-size: 24px;line-height: 28px;font-weight: bold"><?= "İletişim Mesajı"; ?></h1>
                        <div class="mailcontent" style="line-height: 26px;font-size: 14px;">
                            <p style='text-align: left'>
                                <?= "Ad"; ?>:&nbsp;<?= !empty($emailData['messageName']) ? esc($emailData['messageName']) : ''; ?><br>
                                <?= "E-posta Adresi"; ?>:&nbsp;<?= !empty($emailData['messageEmail']) ? esc($emailData['messageEmail']) : ''; ?><br><br>
                                <?= !empty($emailData['messageText']) ? esc($emailData['messageText']) : ''; ?>
                            </p>
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<?= view('email/_footer'); ?>
