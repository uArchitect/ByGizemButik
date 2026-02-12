<?php

/**
 * PayTR iFrame API Library
 * PayTR iFrame API Entegrasyonu için kütüphane
 */
class Paytr
{
    private $merchantId;
    private $merchantKey;
    private $merchantSalt;
    private $testMode;

    /**
     * Constructor
     *
     * @param object $paytrGateway - Veritabanından gelen gateway bilgisi
     */
    public function __construct($paytrGateway)
    {
        if (!empty($paytrGateway)) {
            $this->merchantId = $paytrGateway->public_key;
            $this->merchantKey = $paytrGateway->secret_key;
            $this->merchantSalt = !empty($paytrGateway->merchant_salt) ? $paytrGateway->merchant_salt : '';
            $this->testMode = ($paytrGateway->environment == 'sandbox');
        }
    }

    /**
     * Token Oluşturma
     * PayTR iFrame API için token oluşturur
     *
     * @param array $data - Ödeme bilgileri
     * @return array - Token yanıtı
     */
    public function createToken($data)
    {
        // Gerekli bilgilerin kontrolü
        if (empty($this->merchantId) || empty($this->merchantKey) || empty($this->merchantSalt)) {
            return [
                'status' => 'error',
                'reason' => 'PayTR bilgileri eksik! Lütfen admin panelinden PayTR ayarlarını kontrol edin.'
            ];
        }

        $merchantOid = $data['merchant_oid'];
        $email = $data['email'];
        $paymentAmount = intval(round($data['amount'] * 100));
        $userName = $data['user_name'];
        $userAddress = !empty($data['user_address']) ? $data['user_address'] : 'Belirtilmedi';
        $userPhone = !empty($data['user_phone']) ? $data['user_phone'] : 'Belirtilmedi';
        $merchantOkUrl = $data['merchant_ok_url'];
        $merchantFailUrl = $data['merchant_fail_url'];
        $notificationUrl = $data['notification_url'];
        $userBasket = base64_encode(json_encode($data['basket']));
        $userIp = $data['user_ip'];
        $timeoutLimit = 30;
        $debugOn = 1;
        $testMode = $this->testMode ? '1' : '0';
        $noInstallment = isset($data['no_installment']) ? $data['no_installment'] : 0;
        $maxInstallment = isset($data['max_installment']) ? $data['max_installment'] : 0;
        $currency = 'TL';
        $lang = isset($data['lang']) ? $data['lang'] : 'tr';

        // PayTR iFrame API hash hesaplama
        $hashStr = $this->merchantId . $userIp . $merchantOid . $email . $paymentAmount .
            $userBasket . $noInstallment . $maxInstallment . $currency . $testMode;
        $paytrToken = base64_encode(hash_hmac('sha256', $hashStr . $this->merchantSalt, $this->merchantKey, true));

        $postVals = [
            'merchant_id' => $this->merchantId,
            'user_ip' => $userIp,
            'merchant_oid' => $merchantOid,
            'email' => $email,
            'payment_amount' => $paymentAmount,
            'paytr_token' => $paytrToken,
            'user_basket' => $userBasket,
            'debug_on' => $debugOn,
            'no_installment' => $noInstallment,
            'max_installment' => $maxInstallment,
            'user_name' => $userName,
            'user_address' => $userAddress,
            'user_phone' => $userPhone,
            'merchant_ok_url' => $merchantOkUrl,
            'merchant_fail_url' => $merchantFailUrl,
            'notification_url' => $notificationUrl,
            'timeout_limit' => $timeoutLimit,
            'currency' => $currency,
            'test_mode' => $testMode,
            'lang' => $lang,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.paytr.com/odeme/api/get-token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postVals);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $errorMsg = curl_error($ch);
            curl_close($ch);
            return [
                'status' => 'error',
                'reason' => 'cURL Error: ' . $errorMsg
            ];
        }

        curl_close($ch);

        $response = json_decode($result, true);

        if (empty($response)) {
            return [
                'status' => 'error',
                'reason' => 'PayTR API yanıt vermedi. Yanıt: ' . substr($result, 0, 200)
            ];
        }

        // PayTR hata mesajlarını daha anlaşılır hale getir
        if (isset($response['status']) && $response['status'] == 'failed') {
            $reason = !empty($response['reason']) ? $response['reason'] : 'Bilinmeyen hata';
            if (strpos($reason, 'Geçersiz istek') !== false || strpos($reason, 'mağaza aktif değil') !== false) {
                $reason .= ' - Lütfen PayTR mağaza panelinden hesabınızın aktif olduğundan ve entegrasyon bilgilerinin doğru olduğundan emin olun.';
            }
            $response['reason'] = $reason;
        }

        return $response;
    }

    /**
     * Callback Hash Doğrulama
     * PayTR bildirim callback'ini doğrular
     *
     * @param array $post - PayTR'den gelen POST verileri
     * @return bool - Hash geçerli mi
     */
    public function verifyCallback($post)
    {
        $hash = base64_encode(hash_hmac('sha256',
            $post['merchant_oid'] . $this->merchantSalt . $post['status'] . $post['total_amount'],
            $this->merchantKey,
            true
        ));

        return ($hash == $post['hash']);
    }

    /**
     * Statik hash doğrulama (Common.php'den kullanım için)
     *
     * @param array $post
     * @param string $merchantKey
     * @param string $merchantSalt
     * @return bool
     */
    public static function verifyCallbackStatic($post, $merchantKey, $merchantSalt)
    {
        $hash = base64_encode(hash_hmac('sha256',
            $post['merchant_oid'] . $merchantSalt . $post['status'] . $post['total_amount'],
            $merchantKey,
            true
        ));

        return ($hash == $post['hash']);
    }

    /**
     * Test Modu Kontrolü
     */
    public function isTestMode()
    {
        return $this->testMode;
    }
}
