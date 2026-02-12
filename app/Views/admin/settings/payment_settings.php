<?php $activeTab = inputGet('gateway');
if (empty($activeTab)):
    $activeTab = 'paypal';
endif;

$stripeLocales = ['auto' => 'Auto', 'ar' => 'Arabic', 'bg' => 'Bulgarian (Bulgaria)', 'cs' => 'Czech (Czech Republic)', 'da' => 'Danish', 'de' => 'German (Germany)', 'el' => 'Greek (Greece)',
    'en' => 'English', 'en-GB' => 'English (United Kingdom)', 'es' => 'Spanish (Spain)', 'es-419' => 'Spanish (Latin America)', 'et' => 'Estonian (Estonia)', 'fi' => 'Finnish (Finland)',
    'fr' => 'French (France)', 'fr-CA' => 'French (Canada)', 'he' => 'Hebrew (Israel)', 'id' => 'Indonesian (Indonesia)', 'it' => 'Italian (Italy)', 'ja' => 'Japanese', 'lt' => 'Lithuanian (Lithuania)',
    'lv' => 'Latvian (Latvia)', 'ms' => 'Malay (Malaysia)', 'nb' => 'Norwegian Bokmål', 'nl' => 'Dutch (Netherlands)', 'pl' => 'Polish (Poland)', 'pt' => 'Portuguese (Brazil)', 'ru' => 'Russian (Russia)',
    'sk' => 'Slovak (Slovakia)', 'sl' => 'Slovenian (Slovenia)', 'sv' => 'Swedish (Sweden)', 'zh' => 'Chinese Simplified (China)']; ?>
<div class="row">
    <div class="col-sm-12 title-section">
        <h3>Ödeme Ayarları</h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form action="<?= base_url('Admin/paymentGatewaySettingsPost'); ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="active_tab" id="input_active_tab" value="<?= clrNum($activeTab); ?>">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php if (!empty($paymentGateways)):
                        foreach ($paymentGateways as $gateway):?>
                            <li class="<?= $activeTab == $gateway->name_key ? ' active' : ''; ?>"><a href="<?= adminUrl('payment-settings'); ?>?gateway=<?= $gateway->name_key; ?>"><?= esc($gateway->name); ?></a></li>
                        <?php endforeach;
                    endif; ?>
                    <li class="<?= $activeTab == 'bank_transfer' ? ' active' : ''; ?>"><a href="<?= adminUrl('payment-settings'); ?>?gateway=bank_transfer">Banka Havalesi</a></li>
                </ul>
                <form action="<?= base_url('Admin/paymentGatewaySettingsPost'); ?>" method="post">
                    <?= csrf_field(); ?>
                    <div class="tab-content settings-tab-content">
                        <div class="tab-pane<?= $activeTab == 'paypal' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'paypal'):
                                $paypal = getPaymentGateway('paypal');
                                if (!empty($paypal)):?>
                                    <input type="hidden" name="name_key" value="paypal">
                                    <img src="<?= base_url('assets/img/payment/paypal.svg'); ?>" alt="paypal" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $paypal->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Mod</label>
                                        <?= formRadio('environment', 'production', 'sandbox', "Üretim", "Test", $paypal->environment, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Müşteri ID</label>
                                        <input type="text" class="form-control" name="public_key" placeholder="Müşteri ID" value="<?= esc($paypal->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($paypal->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $paypal->base_currency == 'all' ? 'selected' : ''; ?>><?= "Tüm Aktif Para Birimleri"; ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $paypal->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $paypal->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'stripe' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'stripe'):
                                $stripe = getPaymentGateway('stripe');
                                if (!empty($stripe)):?>
                                    <input type="hidden" name="name_key" value="stripe">
                                    <img src="<?= base_url('assets/img/payment/stripe.svg'); ?>" alt="stripe" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $stripe->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Yayınlanabilir Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "Yayınlanabilir Anahtar"; ?>" value="<?= esc($stripe->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($stripe->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $stripe->base_currency == 'all' ? 'selected' : ''; ?>><?= "Tüm Aktif Para Birimleri"; ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $stripe->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $stripe->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'paystack' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'paystack'):
                                $paystack = getPaymentGateway('paystack');
                                if (!empty($paystack)):?>
                                    <input type="hidden" name="name_key" value="paystack">
                                    <img src="<?= base_url('assets/img/payment/paystack.svg'); ?>" alt="paystack" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $paystack->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Genel Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "Genel Anahtar"; ?>" value="<?= esc($paystack->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($paystack->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $paystack->base_currency == 'all' ? 'selected' : ''; ?>><?= "Tüm Aktif Para Birimleri"; ?></option>
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'NGN' || $currency->code == 'USD' || $currency->code == 'GHS' || $currency->code == 'ZAR'):?>
                                                        <option value="<?= $currency->code; ?>" <?= $paystack->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $paystack->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'razorpay' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'razorpay'):
                                $razorpay = getPaymentGateway('razorpay');
                                if (!empty($razorpay)):?>
                                    <input type="hidden" name="name_key" value="razorpay">
                                    <img src="<?= base_url('assets/img/payment/razorpay.svg'); ?>" alt="razorpay" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $razorpay->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "API Anahtarı"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "API Anahtarı"; ?>" value="<?= esc($razorpay->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($razorpay->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $razorpay->base_currency == 'all' ? 'selected' : ''; ?>><?= "Tüm Aktif Para Birimleri"; ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $razorpay->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $razorpay->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'flutterwave' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'flutterwave'):
                                $flutterwave = getPaymentGateway('flutterwave');
                                if (!empty($flutterwave)):?>
                                    <input type="hidden" name="name_key" value="flutterwave">
                                    <img src="<?= base_url('assets/img/payment/flutterwave.svg'); ?>" alt="flutterwave" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $flutterwave->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Genel Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "Genel Anahtar"; ?>" value="<?= esc($flutterwave->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($flutterwave->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $flutterwave->base_currency == 'all' ? 'selected' : ''; ?>><?= "Tüm Aktif Para Birimleri"; ?></option>
                                                <?php foreach ($currencies as $currency): ?>
                                                    <option value="<?= $currency->code; ?>" <?= $flutterwave->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $flutterwave->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'iyzico' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'iyzico'):
                                $iyzico = getPaymentGateway('iyzico');
                                if (!empty($iyzico)):?>
                                    <input type="hidden" name="name_key" value="iyzico">
                                    <img src="<?= base_url('assets/img/payment/iyzico.svg'); ?>" alt="iyzico" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $iyzico->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Mod</label>
                                        <?= formRadio('environment', 'production', 'sandbox', "Üretim", "Test", $iyzico->environment, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "API Anahtarı"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "API Anahtarı"; ?>" value="<?= esc($iyzico->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Gizli Anahtar"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($iyzico->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == "TRY"):?>
                                                        <option value="<?= $currency->code; ?>" <?= $iyzico->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $iyzico->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif; ?>
                                <div class="alert alert-info alert-large">
                                    <strong><?= "Uyarı"; ?>!</strong>&nbsp;&nbsp;<?= "Iyzico Checkout Form kullanmanız gerekiyor"; ?> <a href="https://dev.iyzipay.com/en/checkout-form" target="_blank" style="color: #0c5460;font-weight: bold">Iyzico Checkout Form</a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'midtrans' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'midtrans'):
                                $midtrans = getPaymentGateway('midtrans');
                                if (!empty($midtrans)):?>
                                    <input type="hidden" name="name_key" value="midtrans">
                                    <img src="<?= base_url('assets/img/payment/midtrans.svg'); ?>" alt="midtrans" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $midtrans->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Mod</label>
                                        <?= formRadio('environment', 'production', 'sandbox', "Üretim", "Test", $midtrans->environment, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "API Anahtarı"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "API Anahtarı"; ?>" value="<?= esc($midtrans->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Sunucu Anahtarı"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Sunucu Anahtarı"; ?>" value="<?= esc($midtrans->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'IDR'):?>
                                                        <option value="<?= $currency->code; ?>" <?= $midtrans->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $midtrans->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'mercado_pago' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'mercado_pago'):
                                $mercadoPago = getPaymentGateway('mercado_pago');
                                if (!empty($mercadoPago)):?>
                                    <input type="hidden" name="name_key" value="mercado_pago">
                                    <img src="<?= base_url('assets/img/payment/mercado_pago.svg'); ?>" alt="mercado pago" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $mercadoPago->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "API Anahtarı"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "API Anahtarı"; ?>" value="<?= esc($mercadoPago->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Gizli Anahtar"; ?> (Token)</label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($mercadoPago->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'ARS' || $currency->code == 'BRL' || $currency->code == 'CLP' || $currency->code == 'COP' || $currency->code == 'MXN' || $currency->code == 'PEN' || $currency->code == 'UYU'):?>
                                                        <option value="<?= $currency->code; ?>" <?= $mercadoPago->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $mercadoPago->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'paytabs' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'paytabs'):
                                $payTabs = getPaymentGateway('paytabs');
                                if (!empty($payTabs)): ?>
                                    <input type="hidden" name="name_key" value="paytabs">
                                    <img src="<?= base_url('assets/img/payment/paytabs.svg'); ?>" alt="paytabs" class="img-payment-logo">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $payTabs->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Profil ID"; ?></label>
                                        <input type="text" class="form-control" name="public_key" placeholder="<?= "Profil ID"; ?>" value="<?= esc($payTabs->public_key); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"><?= "Sunucu Anahtarı"; ?></label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="<?= "Gizli Anahtar"; ?>" value="<?= esc($payTabs->secret_key); ?>">
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <option value="all" <?= $payTabs->base_currency == 'all' ? 'selected' : ''; ?>><?= "Tüm Aktif Para Birimleri"; ?>&nbsp;(PayTabs&nbsp;<?= "Küresel"; ?>)</option>
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'AED' || $currency->code == 'SAR' || $currency->code == 'OMR' || $currency->code == 'JOD' || $currency->code == 'EGP'): ?>
                                                        <option value="<?= $currency->code; ?>" <?= $payTabs->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $payTabs->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'paytr' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'paytr'):
                                $paytr = getPaymentGateway('paytr');
                                if (!empty($paytr)):?>
                                    <input type="hidden" name="name_key" value="paytr">
                                    <div class="form-group">
                                        <label>Durum</label>
                                        <?= formRadio('status', 1, 0, "Etkin", "Devre Dışı", $paytr->status, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Mod</label>
                                        <?= formRadio('environment', 'production', 'sandbox', "Üretim", "Test", $paytr->environment, 'col-md-4'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mağaza No (Merchant ID)</label>
                                        <input type="text" class="form-control" name="public_key" placeholder="Mağaza No" value="<?= esc($paytr->public_key); ?>">
                                        <small class="text-muted">PayTR Mağaza Paneli > Entegrasyon Bilgileri'nden alınır</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mağaza Parola (Merchant Key)</label>
                                        <input type="text" class="form-control" name="secret_key" placeholder="Mağaza Parola" value="<?= esc($paytr->secret_key); ?>">
                                        <small class="text-muted">PayTR Mağaza Paneli > Entegrasyon Bilgileri'nden alınır</small>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mağaza Gizli Anahtar (Merchant Salt)</label>
                                        <input type="text" class="form-control" name="merchant_salt" placeholder="Mağaza Gizli Anahtar" value="<?= esc($paytr->merchant_salt ?? ''); ?>">
                                        <small class="text-muted">PayTR Mağaza Paneli > Entegrasyon Bilgileri'nden alınır</small>
                                    </div>
                                    <?php if (!empty($currencies)): ?>
                                        <div class="form-group">
                                            <label class="control-label"><?= "Ana Para Birimi"; ?></label>
                                            <select name="base_currency" class="form-control">
                                                <?php foreach ($currencies as $currency):
                                                    if ($currency->code == 'TRY'):?>
                                                        <option value="<?= $currency->code; ?>" <?= $paytr->base_currency == $currency->code ? 'selected' : ''; ?>><?= $currency->code; ?>&nbsp;(<?= $currency->name; ?>)</option>
                                                    <?php endif;
                                                endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                    <div class="form-group max-400">
                                        <label><?= "İşlem Ücreti"; ?>&nbsp;(%)</label>
                                        <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $paytr->transaction_fee; ?>" placeholder="0.00">
                                        <small>* <?= "Bu ücret her işlemde alınacak komisyon oranıdır"; ?></small>
                                    </div>
                                    <div class="alert alert-info alert-large">
                                        <strong>Uyarı!</strong>&nbsp;&nbsp;PayTR iFrame API kullanılmaktadır. Bildirim URL'sini PayTR Mağaza Panelinde ayarlamanız gerekir:
                                        <br><strong>Bildirim URL:</strong> <code><?= base_url('/mds-paytr-notification'); ?></code>
                                        <br><br><a href="https://dev.paytr.com" target="_blank" style="color: #0c5460;font-weight: bold">PayTR Geliştirici Dokümantasyonu</a>
                                    </div>
                                <?php endif;
                            endif; ?>
                        </div>

                        <div class="tab-pane<?= $activeTab == 'bank_transfer' ? ' active' : ''; ?>">
                            <?php if ($activeTab == 'bank_transfer'): ?>
                                <input type="hidden" name="name_key" value="bank_transfer">
                                <div class="form-group">
                                    <label>Durum</label>
                                    <?= formRadio('bank_transfer_enabled', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->bank_transfer_enabled, 'col-md-4'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?= "Banka Hesapları"; ?></label>
                                    <textarea class="form-control tinyMCEsmall" name="bank_transfer_accounts"><?= $paymentSettings->bank_transfer_accounts; ?></textarea>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Kapıda ödeme devre dışı bırakıldı -->
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                    </div>
                </form>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Komisyon"; ?>&nbsp;&&nbsp;<?= "Vergi Ayarları"; ?></h3><br>
            </div>
            <form action="<?= base_url('Admin/commissionSettingsPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 col-xs-12 m-b-10">
                                <label><?= "Komisyon"; ?></label>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="commission" value="1" id="commission_1" class="custom-control-input radio-commission" <?= $paymentSettings->commission_rate > 0 ? 'checked' : ''; ?>>
                                    <label for="commission_1" class="custom-control-label">Etkinleştir</label>
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="commission" value="0" id="commission_2" class="custom-control-input radio-commission" <?= $paymentSettings->commission_rate <= 0 ? 'checked' : ''; ?>>
                                    <label for="commission_2" class="custom-control-label">Devre Dışı Bırak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="commissionRateContainer" class="form-group" <?= $paymentSettings->commission_rate <= 0 ? 'style="display:none;"' : ''; ?>>
                        <label><?= "Komisyon Oranı"; ?>(%)</label>
                        <input type="number" name="commission_rate" class="form-control" min="0" max="100" step="0.01" value="<?= $paymentSettings->commission_rate; ?>">
                    </div>
                    <div class="form-group">
                        <div class="m-b-10">
                            <label><?= "KDV"; ?>&nbsp;(<?= "KDV Açıklaması"; ?>)</label><br>
                            <small style="font-size: 13px;"><?= "Satıcılar için KDV açıklaması"; ?></small>
                        </div>
                        <?= formRadio('vat_status', 1, 0, "Etkin", "Devre Dışı", $paymentSettings->vat_status); ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><?= "Fatura"; ?></h3><br>
            </div>
            <form action="<?= base_url('Admin/additionalInvoiceInfoPost'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="box-body">
                    <div class="form-group" style="max-height: 300px; overflow-y: scroll">
                        <div class="m-b-15">
                            <label class="m-0"><?= "Ek Fatura Bilgileri"; ?></label>
                            <br><small><?= "Ek fatura bilgileri açıklaması"; ?></small>
                        </div>
                        <?php foreach ($activeLanguages as $language):
                            $infoInvoice = getAdditionalInvoiceInfo($language->id); ?>
                            <textarea name="info_<?= $language->id; ?>" class="form-control form-textarea m-b-15" placeholder="<?= esc($language->name); ?>"><?= !empty($infoInvoice) ? esc(str_replace("<br>", "\n", $infoInvoice)) : ''; ?></textarea>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary pull-right"><?= "Değişiklikleri Kaydet"; ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="left">
                    <h3 class="box-title">
                        <?= "Küresel Vergiler"; ?><br>
                        <small><?= "Küresel vergiler açıklaması"; ?></small>
                    </h3>
                </div>
                <div class="right">
                    <a href="<?= adminUrl('add-tax'); ?>" class="btn btn-success btn-add-new">
                        <i class="fa fa-plus"></i>&nbsp;&nbsp;<?= "Vergi Ekle"; ?>
                    </a>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group" style="max-height: 500px; overflow-y: scroll;">
                    <table class="table">
                        <tr>
                            <th><?= "ID"; ?></th>
                            <th><?= "Vergi Adı"; ?></th>
                            <th><?= "Vergi Oranı"; ?></th>
                            <th><?= "Durum"; ?></th>
                            <th><?= "Seçenekler"; ?></th>
                        </tr>
                        <?php if (!empty($taxes)):
                            foreach ($taxes as $tax): ?>
                                <tr>
                                    <td style="width: 50px;"><?= esc($tax->id); ?></td>
                                    <td><?= esc(getTaxName($tax->name_data, selectedLangId())); ?></td>
                                    <td><?= esc($tax->tax_rate); ?>%</td>
                                    <td>
                                        <?php if ($tax->status == 1): ?>
                                            <label class="label label-success"><?= "Aktif"; ?></label>
                                        <?php else: ?>
                                            <label class="label label-danger"><?= "Pasif"; ?></label>
                                        <?php endif; ?>
                                    </td>
                                    <td style="width: 100px;">
                                        <div class="btn-group btn-group-option">
                                            <a href="<?= adminUrl('edit-tax/' . $tax->id); ?>" class="btn btn-sm btn-default btn-edit"><i class="fa fa-edit"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-sm btn-default btn-delete" onclick="deleteItem('Admin/deleteTaxPost','<?= $tax->id; ?>','<?= "Bu kaydı silmek istediğinizden emin misiniz?"; ?>');"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach;
                        endif; ?>
                    </table>
                    <?php if (empty($taxes)): ?>
                        <p class="text-center m-t-30"><?= "Kayıt bulunamadı"; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .tab-pane {
        position: relative;
        padding-top: 30px;
    }

    .nav-tabs li a {
        font-weight: 600;
        padding: 12px 24px !important;
    }

    .nav-tabs li a:hover {
        color: #111 !important;
    }

    .img-payment-logo {
        height: 40px;
        max-height: 40px;
        position: absolute;
        right: 15px;
        top: 15px;
    }
</style>

<script>
    $(document).on("change", ".radio-commission", function () {
        var val = $('input[name="commission"]:checked').val();
        if (val == '1') {
            $('#commissionRateContainer').show();
        } else {
            $('#commissionRateContainer').hide();
        }
    });
</script>