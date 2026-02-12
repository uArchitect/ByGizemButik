<?php if (!empty($paymentGateway) && $paymentGateway->name_key == "paytr"):
    loadLibrary('Paytr');
    $paytrLib = new \Paytr($paymentGateway);

    $customer = getCartCustomerData();
    $merchantOid = 'SP' . time() . rand(100000, 999999);

    // Sepet bilgilerini hazırla
    $basket = [];
    if ($mdsPaymentType == 'service') {
        $servicePayment = helperGetSession('mds_service_payment');
        if (!empty($servicePayment)) {
            $basket[] = [
                $servicePayment->paymentName,
                number_format($totalAmount, 2, '.', ''),
                1
            ];
        }
    } else {
        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                $basket[] = [
                    !empty($item->product_title) ? $item->product_title : 'Urun',
                    number_format($item->total_price, 2, '.', ''),
                    $item->quantity
                ];
            }
        }
    }

    // Boş sepet kontrolü
    if (empty($basket)) {
        $basket[] = ['Siparis', number_format($totalAmount, 2, '.', ''), 1];
    }

    $ip = getIPAddress();
    if (empty($ip) || $ip == '0.0.0.0') {
        $ip = '127.0.0.1';
    }

    // Dil bilgisini güvenli şekilde al
    $langShort = 'tr';
    if (isset($activeLang) && !empty($activeLang->short_form)) {
        $langShort = $activeLang->short_form;
    }

    // Merchant OK ve Fail URL'leri
    $merchantOkUrl = base_url() . '/paytr-payment-post?status=success&payment_type=' . $mdsPaymentType . '&lang=' . $langShort . '&merchant_oid=' . $merchantOid . '&mds_token=' . $mdsPaymentToken;
    $merchantFailUrl = base_url() . '/paytr-payment-post?status=failed&payment_type=' . $mdsPaymentType . '&lang=' . $langShort . '&merchant_oid=' . $merchantOid . '&mds_token=' . $mdsPaymentToken;
    // Ödeme bilgileri - PayTR resmi iFrame API dokümantasyonuna göre
    $paymentData = [
        'email' => !empty($customer->email) ? $customer->email : 'musteri@bygizembutik.com',
        'amount' => $totalAmount,
        'merchant_oid' => $merchantOid,
        'user_name' => trim(($customer->first_name ?? '') . ' ' . ($customer->last_name ?? '')),
        'user_address' => !empty($customer->address) ? $customer->address : 'Turkiye',
        'user_phone' => !empty($customer->phone_number) ? $customer->phone_number : '05555555555',
        'basket' => $basket,
        'user_ip' => $ip,
        'merchant_ok_url' => $merchantOkUrl,
        'merchant_fail_url' => $merchantFailUrl,
        'no_installment' => 0,
        'max_installment' => 0,
        'lang' => 'tr',
    ];

    // merchant_oid'yi session'a kaydet
    $paytrSession = new stdClass();
    $paytrSession->merchant_oid = $merchantOid;
    $paytrSession->mds_payment_token = $mdsPaymentToken;
    $paytrSession->payment_type = $mdsPaymentType;
    $paytrSession->total_amount = $totalAmount;
    $paytrSession->currency = $currency;
    helperSetSession('mds_paytr_data', $paytrSession);

    // Token oluştur - önce test modunu dene
    $paymentData['force_test_mode'] = true;
    $tokenResponse = $paytrLib->createToken($paymentData);

    if (!empty($tokenResponse) && isset($tokenResponse['status']) && $tokenResponse['status'] == 'success' && !empty($tokenResponse['token'])):
        ?>
        <div class="row">
            <div class="col-12">
                <?= view('partials/_messages'); ?>
            </div>
        </div>
        <div class="paytr-payment-container">
            <script src="https://www.paytr.com/js/iframeResizer.min.js"></script>
            <iframe src="https://www.paytr.com/odeme/guvenli/<?= esc($tokenResponse['token']); ?>" id="paytriframe" frameborder="0" scrolling="no" style="width: 100%; min-height: 600px;"></iframe>
            <script>iFrameResize({}, '#paytriframe');</script>
        </div>
    <?php else:
        $errorMessage = !empty($tokenResponse['reason']) ? $tokenResponse['reason'] : 'PayTR token oluşturulamadı!';
        setErrorMessage($errorMessage);
        ?>
        <div class="row">
            <div class="col-12">
                <?= view('partials/_messages'); ?>
                <div class="alert alert-warning">
                    <strong>PayTR Entegrasyon Hatası</strong><br>
                    <?= esc($errorMessage); ?>
                </div>
                <?php if (!empty($tokenResponse['debug'])): ?>
                <div class="alert alert-info">
                    <strong>Debug Bilgisi:</strong><br>
                    <pre style="font-size: 11px; max-height: 400px; overflow-y: auto;"><?= esc(json_encode($tokenResponse['debug'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); ?></pre>
                </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif;
else: ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                <strong>Hata!</strong> Ödeme yöntemi yüklenemedi. Lütfen geri dönüp tekrar deneyin.
            </div>
        </div>
    </div>
<?php endif;
resetFlashData(); ?>
