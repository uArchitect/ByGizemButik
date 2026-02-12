<?php

/**
 * PayTR iFrame API Library
 * PayTR iFrame API Entegrasyonu için kütüphane
 * Referans: https://dev.paytr.com/iframe-api/iframe-api-1-adim
 */
class Paytr
{
    private $merchantId;
    private $merchantKey;
    private $merchantSalt;
    private $testMode;

    public function __construct($paytrGateway)
    {
        if (!empty($paytrGateway)) {
            $this->merchantId = trim($paytrGateway->public_key);
            $this->merchantKey = trim($paytrGateway->secret_key);
            $this->merchantSalt = !empty($paytrGateway->merchant_salt) ? trim($paytrGateway->merchant_salt) : '';
            $this->testMode = ($paytrGateway->environment == 'sandbox');
        }
    }

    /**
     * PayTR iFrame API Token Oluşturma
     * Referans: https://dev.paytr.com/iframe-api/iframe-api-1-adim
     */
    public function createToken($data)
    {
        if (empty($this->merchantId) || empty($this->merchantKey) || empty($this->merchantSalt)) {
            return [
                'status' => 'error',
                'reason' => 'PayTR bilgileri eksik!'
            ];
        }

        ## Zorunlu alanlar ##
        $merchant_id    = $this->merchantId;
        $merchant_key   = $this->merchantKey;
        $merchant_salt  = $this->merchantSalt;

        $user_ip        = $data['user_ip'];
        $merchant_oid   = $data['merchant_oid'];
        $email          = $data['email'];
        $payment_amount = intval(round($data['amount'] * 100)); // kuruş cinsinden
        $user_basket    = base64_encode(json_encode($data['basket']));

        $no_installment  = isset($data['no_installment']) ? $data['no_installment'] : 0;
        $max_installment = isset($data['max_installment']) ? $data['max_installment'] : 0;
        $currency        = 'TL';
        // force_test_mode parametresi varsa test modunu zorla
        $test_mode       = !empty($data['force_test_mode']) ? '1' : ($this->testMode ? '1' : '0');

        $user_name       = !empty($data['user_name']) ? $data['user_name'] : 'Misafir';
        $user_address    = !empty($data['user_address']) ? $data['user_address'] : 'Belirtilmedi';
        $user_phone      = !empty($data['user_phone']) ? $data['user_phone'] : '05555555555';
        $merchant_ok_url = $data['merchant_ok_url'];
        $merchant_fail_url = $data['merchant_fail_url'];
        $timeout_limit   = 30;
        $debug_on        = 1;
        $lang            = isset($data['lang']) ? $data['lang'] : 'tr';

        ## Token hesaplama - PayTR resmi dokümantasyona göre ##
        $hash_str = $merchant_id . $user_ip . $merchant_oid . $email . $payment_amount .
            $user_basket . $no_installment . $max_installment . $currency . $test_mode;
        $paytr_token = base64_encode(hash_hmac('sha256', $hash_str . $merchant_salt, $merchant_key, true));

        ## POST değerleri - PayTR resmi örneğine göre ##
        $post_vals = array(
            'merchant_id'      => $merchant_id,
            'user_ip'          => $user_ip,
            'merchant_oid'     => $merchant_oid,
            'email'            => $email,
            'payment_amount'   => $payment_amount,
            'paytr_token'      => $paytr_token,
            'user_basket'      => $user_basket,
            'debug_on'         => $debug_on,
            'no_installment'   => $no_installment,
            'max_installment'  => $max_installment,
            'user_name'        => $user_name,
            'user_address'     => $user_address,
            'user_phone'       => $user_phone,
            'merchant_ok_url'  => $merchant_ok_url,
            'merchant_fail_url'=> $merchant_fail_url,
            'timeout_limit'    => $timeout_limit,
            'currency'         => $currency,
            'test_mode'        => $test_mode,
            'lang'             => $lang,
        );

        ## Debug log ##
        $debugLog = [
            'time'            => date('Y-m-d H:i:s'),
            'merchant_id'     => $merchant_id,
            'merchant_key_3'  => substr($merchant_key, 0, 3) . '***',
            'merchant_salt_3' => substr($merchant_salt, 0, 3) . '***',
            'user_ip'         => $user_ip,
            'merchant_oid'    => $merchant_oid,
            'email'           => $email,
            'payment_amount'  => $payment_amount,
            'no_installment'  => $no_installment,
            'max_installment' => $max_installment,
            'currency'        => $currency,
            'test_mode'       => $test_mode,
            'user_basket_len' => strlen($user_basket),
            'hash_str_len'    => strlen($hash_str),
            'paytr_token_len' => strlen($paytr_token),
            'merchant_ok_url' => $merchant_ok_url,
            'merchant_fail_url' => $merchant_fail_url,
        ];

        ## cURL isteği - PayTR resmi örneğine göre ##
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.paytr.com/odeme/api/get-token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_vals);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            $errorMsg = curl_error($ch);
            curl_close($ch);
            $debugLog['curl_error'] = $errorMsg;
            @file_put_contents(WRITEPATH . 'paytr/debug_log.json', json_encode($debugLog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            return [
                'status' => 'error',
                'reason' => 'cURL Error: ' . $errorMsg
            ];
        }

        curl_close($ch);

        $response = json_decode($result, true);
        $debugLog['raw_response'] = substr($result, 0, 500);
        $debugLog['parsed_response'] = $response;
        @file_put_contents(WRITEPATH . 'paytr/debug_log.json', json_encode($debugLog, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if (empty($response)) {
            return [
                'status' => 'error',
                'reason' => 'PayTR API yanıt vermedi. Yanıt: ' . substr($result, 0, 200),
                'debug' => $debugLog
            ];
        }

        // Hata durumunda debug bilgisini ekle
        if (isset($response['status']) && $response['status'] != 'success') {
            $response['debug'] = $debugLog;
        }

        return $response;
    }

    /**
     * Callback Hash Doğrulama
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

    public function isTestMode()
    {
        return $this->testMode;
    }
}
