# PayTR Ödeme Entegrasyonu - Teknik Dokümantasyon

## 📋 İçindekiler
1. [Gereksinimler ve Ön Hazırlık](#gereksinimler-ve-ön-hazırlık)
2. [Veritabanı İşlemleri](#veritabanı-işlemleri)
3. [Library Oluşturma](#library-oluşturma)
4. [View Dosyası Oluşturma](#view-dosyası-oluşturma)
5. [Controller Method Ekleme](#controller-method-ekleme)
6. [Admin Ayarları Ekleme](#admin-ayarları-ekleme)
7. [Routes Ekleme](#routes-ekleme)
8. [Callback İşleme (Common.php)](#callback-işleme-commonphp)
9. [Test Adımları](#test-adımları)
10. [PayTR API Bilgileri](#paytr-api-bilgileri)

---

## 🔧 Gereksinimler ve Ön Hazırlık

### PayTR Panel İşlemleri
1. **PayTR Mağaza Paneline Giriş Yapın**
   - https://www.paytr.com adresinden giriş yapın

2. **Direkt API Yetkisi Talep Edin**
   - Mağaza Paneli > Destek & Kurulum > Direkt API Yetkisi
   - Yetki talebi gönderin (onay süreci 1-2 iş günü sürebilir)

3. **Entegrasyon Bilgilerini Alın**
   - Mağaza Paneli > Destek & Kurulum > Entegrasyon Bilgileri
   - Şu bilgileri not edin:
     - **Merchant ID** (Mağaza No)
     - **Merchant Key** (Mağaza Parola)
     - **Merchant Salt** (Mağaza Gizli Anahtar)

4. **Test Ortamı Bilgileri**
   - Test ortamı için ayrı bilgiler verilecektir
   - Test URL: `https://www.paytr.com/odeme/test`

---

## 💾 Veritabanı İşlemleri

### 1. payment_gateways Tablosuna PayTR Kaydı Ekleme

**SQL Sorgusu:**
```sql
INSERT INTO `payment_gateways` 
(`name_key`, `name`, `public_key`, `secret_key`, `environment`, `status`, `base_currency`, `transaction_fee`, `created_at`) 
VALUES 
('paytr', 'PayTR', '', '', 'sandbox', 0, 'TRY', 0.00, NOW());
```

**Açıklama:**
- `name_key`: `paytr` (küçük harf, önemli!)
- `name`: `PayTR` (görünen isim)
- `public_key`: PayTR Merchant ID buraya eklenecek
- `secret_key`: PayTR Merchant Key buraya eklenecek
- `environment`: `sandbox` (test için) veya `production` (canlı için)
- `status`: `0` (pasif, admin panelden aktif edilecek)
- `base_currency`: `TRY` (PayTR sadece TRY kabul eder)

**Not:** `secret_key` alanına Merchant Key, ayrıca Merchant Salt için ek bir alan gerekebilir. Eğer `secret_key` alanı yeterli değilse, `SettingsModel.php`'de ek alan eklenebilir.

---

## 📚 Library Oluşturma

### Dosya: `app/Libraries/Paytr.php`

```php
<?php

/**
 * PayTR PHP Library
 * PayTR Direkt API Entegrasyonu için kütüphane
 */
class Paytr
{
    private $merchantId;
    private $merchantKey;
    private $merchantSalt;
    private $environment;

    /**
     * Constructor
     *
     * @param object $paytrGateway - Veritabanından gelen gateway bilgisi
     */
    public function __construct($paytrGateway)
    {
        if (!empty($paytrGateway)) {
            $this->merchantId = $paytrGateway->public_key; // Merchant ID
            $this->merchantKey = $paytrGateway->secret_key; // Merchant Key
            // Merchant Salt için secret_key alanı kullanılıyor, gerekirse ayrı alan eklenebilir
            $this->merchantSalt = $paytrGateway->secret_key; // Veya ayrı bir alan: merchant_salt
            $this->environment = $paytrGateway->environment ?? 'sandbox';
        }
    }

    /**
     * Token Oluşturma (1. Adım)
     * PayTR'ye ödeme isteği gönderir ve token alır
     *
     * @param array $paymentData - Ödeme bilgileri
     * @return array - Token ve form HTML'i
     */
    public function createToken($paymentData)
    {
        // PayTR API URL
        $apiUrl = 'https://www.paytr.com/odeme/api/get-token';
        
        // Ödeme bilgilerini hazırla
        $postData = [
            'merchant_id' => $this->merchantId,
            'merchant_key' => $this->merchantKey,
            'merchant_salt' => $this->merchantSalt,
            'email' => $paymentData['email'],
            'payment_amount' => $paymentData['amount'] * 100, // Kuruş cinsinden
            'currency' => 'TL',
            'installment_count' => $paymentData['installment'] ?? 0, // 0 = tek çekim
            'payment_type' => 'card',
            'test_mode' => $this->environment == 'sandbox' ? '1' : '0',
            'non_3d' => '0', // 3D Secure aktif
            'cc_owner' => $paymentData['cc_owner'] ?? '',
            'card_number' => $paymentData['card_number'] ?? '',
            'expiry_month' => $paymentData['expiry_month'] ?? '',
            'expiry_year' => $paymentData['expiry_year'] ?? '',
            'cvv' => $paymentData['cvv'] ?? '',
            'merchant_oid' => $paymentData['merchant_oid'], // Sipariş numarası
            'user_name' => $paymentData['user_name'],
            'user_address' => $paymentData['user_address'] ?? '',
            'user_phone' => $paymentData['user_phone'] ?? '',
            'user_basket' => base64_encode(json_encode($paymentData['basket'])), // Sepet bilgileri
            'user_ip' => $paymentData['user_ip'],
            'callback_url' => $paymentData['callback_url'],
            'fail_url' => $paymentData['fail_url'] ?? $paymentData['callback_url'],
        ];

        // Hash oluştur
        $hash = base64_encode(hash_hmac('sha256', 
            $this->merchantId . 
            $postData['merchant_oid'] . 
            $postData['payment_amount'] . 
            $this->merchantSalt, 
            $this->merchantKey, 
            true
        ));
        
        $postData['hash'] = $hash;

        // cURL ile istek gönder
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        
        $result = curl_exec($ch);
        
        if (curl_errno($ch)) {
            return [
                'status' => 'error',
                'message' => 'cURL Error: ' . curl_error($ch)
            ];
        }
        
        curl_close($ch);
        
        $response = json_decode($result, true);
        
        return $response;
    }

    /**
     * Ödeme Doğrulama (2. Adım)
     * PayTR'den gelen callback'i doğrular
     *
     * @param array $postData - PayTR'den gelen POST verileri
     * @return array - Doğrulama sonucu
     */
    public function verifyPayment($postData)
    {
        // Hash kontrolü
        $hash = base64_encode(hash_hmac('sha256', 
            $postData['merchant_oid'] . 
            $this->merchantSalt . 
            $postData['status'] . 
            $postData['total_amount'], 
            $this->merchantKey, 
            true
        ));

        if ($hash != $postData['hash']) {
            return [
                'status' => 'error',
                'message' => 'Hash doğrulama hatası!'
            ];
        }

        // Ödeme durumu kontrolü
        if ($postData['status'] == 'success') {
            return [
                'status' => 'success',
                'merchant_oid' => $postData['merchant_oid'],
                'payment_id' => $postData['payment_id'] ?? $postData['merchant_oid'],
                'total_amount' => $postData['total_amount'] / 100, // TL'ye çevir
                'currency' => 'TRY'
            ];
        } else {
            return [
                'status' => 'failed',
                'message' => $postData['failed_reason_msg'] ?? 'Ödeme başarısız'
            ];
        }
    }

    /**
     * Test Modu Kontrolü
     */
    public function isTestMode()
    {
        return $this->environment == 'sandbox';
    }
}
```

---

## 🎨 View Dosyası Oluşturma

### Dosya: `app/Views/cart/payment_methods/_paytr.php`

```php
<?php 
if (!empty($paymentGateway) && $paymentGateway->name_key == "paytr"):
    loadLibrary('Paytr');
    $paytrLib = new \Paytr($paymentGateway);
    
    $customer = getCartCustomerData();
    $merchantOid = generateToken();
    
    // Sepet bilgilerini hazırla
    $basket = [];
    if ($mdsPaymentType == 'service') {
        $servicePayment = helperGetSession('mds_service_payment');
        if (!empty($servicePayment)) {
            $basket[] = [
                $servicePayment->paymentName,
                $totalAmount,
                1
            ];
        }
    } else {
        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                $basket[] = [
                    $item->product_title,
                    $item->price,
                    $item->quantity
                ];
            }
        }
    }
    
    // Ödeme bilgileri
    $paymentData = [
        'email' => $customer->email,
        'amount' => $totalAmount,
        'installment' => 0, // Tek çekim
        'merchant_oid' => $merchantOid,
        'user_name' => $customer->first_name . ' ' . $customer->last_name,
        'user_address' => $customer->address ?? '',
        'user_phone' => $customer->phone_number ?? '',
        'basket' => $basket,
        'user_ip' => getIPAddress(),
        'callback_url' => base_url() . '/mds-paytr-payment-callback?payment_type=' . $mdsPaymentType . '&base_url=' . base_url() . '&lang=' . $activeLang->short_form . '&merchant_oid=' . $merchantOid . '&mds_token=' . $mdsPaymentToken,
        'fail_url' => base_url() . '/mds-paytr-payment-callback?payment_type=' . $mdsPaymentType . '&base_url=' . base_url() . '&lang=' . $activeLang->short_form . '&merchant_oid=' . $merchantOid . '&mds_token=' . $mdsPaymentToken . '&status=failed',
    ];
    
    // Token oluştur
    $tokenResponse = $paytrLib->createToken($paymentData);
    
    if (!empty($tokenResponse) && $tokenResponse['status'] == 'success') {
        // Token başarılı, formu göster
        ?>
        <div class="row">
            <div class="col-12">
                <?= view('partials/_messages'); ?>
            </div>
        </div>
        
        <div class="paytr-payment-form">
            <form method="post" action="https://www.paytr.com/odeme/guvenli" id="paytr-form">
                <input type="hidden" name="token" value="<?= esc($tokenResponse['token']); ?>">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="paytr-submit-btn">
                        <i class="fa fa-credit-card"></i> PayTR ile Ödeme Yap
                    </button>
                </div>
            </form>
        </div>
        
        <script>
        $(document).ready(function() {
            // Form otomatik submit edilir
            $('#paytr-submit-btn').on('click', function(e) {
                e.preventDefault();
                $('#paytr-form').submit();
            });
            
            // Sayfa yüklendiğinde otomatik submit (opsiyonel)
            // $('#paytr-form').submit();
        });
        </script>
        <?php
    } else {
        // Hata durumu
        $errorMessage = !empty($tokenResponse['reason']) ? $tokenResponse['reason'] : 'Token oluşturulamadı!';
        setErrorMessage($errorMessage);
        ?>
        <div class="row">
            <div class="col-12">
                <?= view('partials/_messages'); ?>
            </div>
        </div>
        <?php
    }
endif;
resetFlashData(); 
?>
```

---

## 🎮 Controller Method Ekleme

### Dosya: `app/Controllers/CartController.php`

**Eklenecek Method (iyzicoPaymentPost method'undan sonra):**

```php
/**
 * Payment with PayTR
 */
public function paytrPaymentPost()
{
    $lang = inputGet('lang');
    $langBaseUrl = langBaseUrl();
    if ($lang != $this->activeLang->short_form) {
        $langBaseUrl = base_url() . '/' . $lang;
    }
    
    $paytr = getPaymentGateway('paytr');
    if (empty($paytr)) {
        setErrorMessage("Payment method not found!");
        $this->redirectBackToPayment($langBaseUrl);
    }
    
    $paymentSession = helperGetSession('mds_payment_cart_data');
    if (empty($paymentSession) || empty($paymentSession->mds_payment_token) || inputGet('mds_token') != $paymentSession->mds_payment_token) {
        setErrorMessage(trans("invalid_attempt"));
        $this->redirectBackToPayment($langBaseUrl);
    }
    
    loadLibrary('Paytr');
    $paytrLib = new \Paytr($paytr);
    
    // PayTR'den gelen POST verilerini al
    $postData = [
        'merchant_oid' => inputPost('merchant_oid'),
        'status' => inputPost('status'),
        'total_amount' => inputPost('total_amount'),
        'hash' => inputPost('hash'),
        'failed_reason_code' => inputPost('failed_reason_code'),
        'failed_reason_msg' => inputPost('failed_reason_msg'),
        'payment_id' => inputPost('payment_id') ?? inputPost('merchant_oid'),
    ];
    
    // Ödeme doğrulama
    $verification = $paytrLib->verifyPayment($postData);
    
    if ($verification['status'] == 'success') {
        $dataTransaction = [
            'payment_method' => 'PayTR',
            'payment_id' => $verification['payment_id'],
            'currency' => 'TRY',
            'payment_amount' => $verification['total_amount'],
            'payment_status' => 'Succeeded'
        ];
        
        $paymentType = inputGet('payment_type');
        if (empty($paymentType)) {
            $paymentType = $paymentSession->payment_type ?? 'sale';
        }
        
        // Ödemeyi işle
        $response = $this->executePayment($dataTransaction, $paymentType, $langBaseUrl);
        
        if ($response->result == 1) {
            setSuccessMessage($response->message);
        } else {
            setErrorMessage($response->message);
        }
        
        return redirect()->to($response->redirectUrl);
    } else {
        setErrorMessage($verification['message'] ?? trans("msg_error"));
        $this->redirectBackToPayment($langBaseUrl);
    }
}
```

---

## ⚙️ Admin Ayarları Ekleme

### Dosya: `app/Views/admin/settings/payment_settings.php`

**PayTR sekmesini ekleyin (paytabs sekmesinden sonra):**

```php
<div class="tab-pane<?= $activeTab == 'paytr' ? ' active' : ''; ?>">
    <?php if ($activeTab == 'paytr'):
        $paytr = getPaymentGateway('paytr');
        if (!empty($paytr)):?>
            <input type="hidden" name="name_key" value="paytr">
            <img src="<?= base_url('assets/img/payment/paytr.svg'); ?>" alt="paytr" class="img-payment-logo">
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
                    <label class="control-label">Ana Para Birimi</label>
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
                <label>İşlem Ücreti (%)</label>
                <input type="number" name="transaction_fee" class="form-control" min="0" max="100" step="0.01" value="<?= $paytr->transaction_fee; ?>" placeholder="0.00">
                <small>* Bu ücret her işlemde alınacak komisyon oranıdır</small>
            </div>
            <div class="alert alert-info alert-large">
                <strong>Uyarı!</strong>&nbsp;&nbsp;PayTR Direkt API kullanmanız gerekiyor. 
                <a href="https://dev.paytr.com/direkt-api" target="_blank" style="color: #0c5460;font-weight: bold">PayTR Direkt API Dokümantasyonu</a>
            </div>
        <?php endif;
    endif; ?>
</div>
```

**Nav tabs kısmına PayTR sekmesini ekleyin:**

```php
<li class="<?= $activeTab == 'paytr' ? ' active' : ''; ?>"><a href="<?= adminUrl('payment-settings'); ?>?gateway=paytr">PayTR</a></li>
```

**Not:** Eğer `merchant_salt` için ayrı bir veritabanı alanı gerekiyorsa, `SettingsModel.php`'de `updatePaymentGateway` method'unu güncelleyin.

---

## 🛣️ Routes Ekleme

### Dosya: `app/Config/RoutesStatic.php`

**Eklenecek route:**

```php
$routes->get('paytr-payment-post', 'CartController::paytrPaymentPost');
```

---

## 🔄 Callback İşleme (Common.php)

### Dosya: `app/Common.php`

**Dosyanın sonuna ekleyin (iyzico callback'inden sonra):**

```php
if (strpos($_SERVER['REQUEST_URI'], '/mds-paytr-payment-callback') !== false) {
    $urlArray = parse_url($_SERVER['REQUEST_URI'] ?? '');
    if (!empty($urlArray['query'])) {
        parse_str($urlArray['query'], $paramArray);
        
        $paymentType = isset($paramArray['payment_type']) ? $paramArray['payment_type'] : '';
        $baseUrl = isset($paramArray['base_url']) ? $paramArray['base_url'] : '';
        $merchantOid = isset($paramArray['merchant_oid']) ? $paramArray['merchant_oid'] : '';
        $lang = isset($paramArray['lang']) ? $paramArray['lang'] : '';
        $mdsToken = isset($paramArray['mds_token']) ? $paramArray['mds_token'] : '';
        $status = isset($paramArray['status']) ? $paramArray['status'] : '';
        
        // PayTR'den gelen POST verilerini query string'e ekle
        $postParams = [];
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $postParams[] = $key . '=' . urlencode($value);
            }
        }
        $postQuery = !empty($postParams) ? '&' . implode('&', $postParams) : '';
        
        if (!empty($status)) {
            $postQuery .= '&status=' . urlencode($status);
        }
        
        header('Location: ' . $baseUrl . '/paytr-payment-post?payment_type=' . $paymentType . '&merchant_oid=' . $merchantOid . '&lang=' . $lang . '&mds_token=' . $mdsToken . $postQuery);
        exit();
    }
    redirectToUrl(base_url());
}
```

---

## 🧪 Test Adımları

### 1. Veritabanı Kontrolü
```sql
SELECT * FROM payment_gateways WHERE name_key = 'paytr';
```

### 2. Admin Panel Kontrolü
- Admin Panel > Ayarlar > Ödeme Ayarları
- PayTR sekmesine gidin
- Test bilgilerini girin:
  - Merchant ID (test)
  - Merchant Key (test)
  - Merchant Salt (test)
  - Mod: Test
  - Durum: Etkin

### 3. Test Kartları (PayTR Test Ortamı)
PayTR test ortamında kullanılacak test kartları PayTR dokümantasyonunda belirtilir. Genellikle:
- **Başarılı Ödeme:** 4355 08XX XXXX XXXX (son 4 hane değişken)
- **Başarısız Ödeme:** Farklı kart numaraları

### 4. Test Senaryoları
1. **Başarılı Ödeme Testi:**
   - Sepete ürün ekleyin
   - Ödeme sayfasına gidin
   - PayTR'yi seçin
   - Test kartı ile ödeme yapın
   - Başarılı yönlendirme kontrolü

2. **Başarısız Ödeme Testi:**
   - Başarısız test kartı ile ödeme deneyin
   - Hata mesajı kontrolü

3. **Callback Testi:**
   - PayTR callback URL'sinin çalıştığını kontrol edin
   - Log dosyalarını kontrol edin

### 5. Log Kontrolü
```php
// CartController::paytrPaymentPost() içine log ekleyin
log_message('debug', 'PayTR Payment Post: ' . json_encode($_POST));
log_message('debug', 'PayTR Verification: ' . json_encode($verification));
```

---

## 📖 PayTR API Bilgileri

### API Endpoint'leri

**Token Oluşturma:**
- URL: `https://www.paytr.com/odeme/api/get-token`
- Method: POST
- Content-Type: application/x-www-form-urlencoded

**Ödeme Sayfası:**
- URL: `https://www.paytr.com/odeme/guvenli`
- Method: POST
- Parametre: `token` (1. adımdan gelen)

**Test Ortamı:**
- Test URL: `https://www.paytr.com/odeme/test` (eğer varsa)

### Önemli Notlar

1. **Hash Hesaplama:**
   - Hash her zaman HMAC-SHA256 ile hesaplanır
   - Base64 encode edilir
   - Hash doğrulaması mutlaka yapılmalıdır

2. **Para Birimi:**
   - PayTR sadece TRY (Türk Lirası) kabul eder
   - Tutarlar kuruş cinsinden gönderilir (örn: 100.00 TL = 10000)

3. **3D Secure:**
   - PayTR 3D Secure zorunludur
   - `non_3d` parametresi `0` olmalıdır

4. **Callback URL:**
   - Callback URL mutlaka HTTPS olmalıdır
   - PayTR panelinde callback URL tanımlanmalıdır

5. **Timeout:**
   - API istekleri için timeout 20 saniye önerilir

### PayTR Dokümantasyon Linkleri

- **Direkt API Dokümantasyonu:** https://dev.paytr.com/direkt-api
- **Test Araçları:** https://dev.paytr.com/servis-test-araclari
- **Entegrasyon Süreci:** https://dev.paytr.com/direkt-api-entegrasyon-sureci

---

## 🔒 Güvenlik Önerileri

1. **Hash Doğrulama:**
   - Her callback'te hash mutlaka doğrulanmalıdır
   - Hash doğrulaması başarısızsa ödeme reddedilmelidir

2. **Merchant Salt:**
   - Merchant Salt asla frontend'de görünmemelidir
   - Sadece backend'de kullanılmalıdır

3. **HTTPS:**
   - Tüm ödeme işlemleri HTTPS üzerinden yapılmalıdır
   - Callback URL'leri HTTPS olmalıdır

4. **IP Kontrolü:**
   - PayTR IP'lerinden gelen istekler kontrol edilebilir (opsiyonel)
   - PayTR IP listesi: PayTR destekten alınabilir

5. **Loglama:**
   - Tüm ödeme işlemleri loglanmalıdır
   - Hassas bilgiler (kart numarası, CVV) loglanmamalıdır

---

## ✅ Kontrol Listesi

Entegrasyon tamamlandıktan sonra kontrol edin:

- [ ] Veritabanına PayTR kaydı eklendi
- [ ] Library dosyası oluşturuldu (`app/Libraries/Paytr.php`)
- [ ] View dosyası oluşturuldu (`app/Views/cart/payment_methods/_paytr.php`)
- [ ] Controller method eklendi (`CartController::paytrPaymentPost()`)
- [ ] Admin ayarları eklendi (`payment_settings.php`)
- [ ] Route eklendi (`RoutesStatic.php`)
- [ ] Callback işleme eklendi (`Common.php`)
- [ ] Test ortamında test edildi
- [ ] Hash doğrulama çalışıyor
- [ ] Başarılı ödeme test edildi
- [ ] Başarısız ödeme test edildi
- [ ] Callback URL çalışıyor
- [ ] Log dosyaları kontrol edildi
- [ ] Canlı ortam için bilgiler güncellendi

---

## 🆘 Sorun Giderme

### Sorun: Token oluşturulamıyor
**Çözüm:**
- Merchant ID, Key ve Salt'ın doğru olduğunu kontrol edin
- API URL'sinin doğru olduğunu kontrol edin
- cURL hatalarını kontrol edin
- PayTR panelinde Direkt API yetkisinin olduğunu kontrol edin

### Sorun: Hash doğrulama başarısız
**Çözüm:**
- Hash hesaplama formülünü kontrol edin
- Merchant Salt'ın doğru olduğunu kontrol edin
- POST verilerinin tam olarak alındığını kontrol edin

### Sorun: Callback çalışmıyor
**Çözüm:**
- Callback URL'in HTTPS olduğunu kontrol edin
- PayTR panelinde callback URL'in tanımlı olduğunu kontrol edin
- Common.php'deki callback kodunu kontrol edin
- Log dosyalarını kontrol edin

### Sorun: Ödeme sayfası açılmıyor
**Çözüm:**
- Token'ın başarıyla oluşturulduğunu kontrol edin
- Form action URL'sinin doğru olduğunu kontrol edin
- JavaScript hatalarını kontrol edin

---

## 📞 Destek

- **PayTR Destek:** https://www.paytr.com/iletisim
- **PayTR Dokümantasyon:** https://dev.paytr.com
- **Proje Dokümantasyonu:** Bu dosya

---

**Son Güncelleme:** 2024
**Versiyon:** 1.0
**Hazırlayan:** Development Team
