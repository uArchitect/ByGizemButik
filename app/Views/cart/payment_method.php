<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shopping-cart shopping-cart-shipping">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <div class="left">
                                <h1 class="cart-section-title"><?= "Ödeme"; ?></h1>
                                <?php if (!authCheck()): ?>
                                    <div class="row m-b-15">
                                        <div class="col-12 col-md-6">
                                            <p><?= "Misafir olarak ödeme yapıyorsunuz"; ?></p>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <p class="text-right"><?= "Hesabınız var mı?"; ?>&nbsp;<a href="javascript:void(0)" class="link-underlined" data-toggle="modal" data-target="#loginModal"><?= "Giriş Yap"; ?></a></p>
                                        </div>
                                    </div>
                                <?php endif;
                                if (!empty($cartHasPhysicalProduct) && $productSettings->marketplace_shipping == 1 && $mdsPaymentType == 'sale'): ?>
                                    <div class="tab-checkout tab-checkout-closed">
                                        <a href="<?= generateUrl('cart', 'shipping'); ?>"><h2 class="title">1.&nbsp;&nbsp;<?= "Teslimat Bilgileri"; ?></h2></a>
                                        <a href="<?= generateUrl('cart', 'shipping'); ?>" class="link-underlined edit-link"><?= "Düzenle"; ?></a>
                                    </div>
                                <?php endif; ?>
                                    <form action="<?= base_url('payment-method-post'); ?>" method="post" id="form_validate">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="mds_payment_type" value="<?= esc($mdsPaymentType); ?>">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="payment-option-single">
                                                        <div class="option-payment">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input" id="option_cash_on_delivery" name="payment_option" value="cash_on_delivery" required checked>
                                                                <label class="custom-control-label label-payment-option font-600" for="option_cash_on_delivery">
                                                                    <div class="payment-option-content">
                                                                        <div class="payment-icon">
                                                                            <span style="font-size: 24px;">🚚</span>
                                                                        </div>
                                                                        <div class="payment-details">
                                                                            <strong><?= "Kapıda Ödeme"; ?></strong>
                                                                            <p class="payment-description"><?= "Siparişinizi teslim alırken nakit olarak ödeyebilirsiniz"; ?></p>
                                                                            <small class="text-muted"><?= "Güvenli ve kolay ödeme yöntemi"; ?></small>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group m-t-30 text-center">
                                                    <button type="submit" name="submit" value="update" class="btn btn-lg btn-success btn-continue-payment" style="padding: 15px 40px; font-size: 16px; border-radius: 25px;">
                                                        <i class="fa fa-credit-card" style="margin-right: 8px;"></i>
                                                        <?= "Kapıda Ödeme ile Devam Et" ?>
                                                        <i class="fa fa-arrow-right" style="margin-left: 8px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <div class="tab-checkout tab-checkout-closed-bordered">
                                    <h2 class="title">
                                        <?php if (!empty($cartHasPhysicalProduct) && $productSettings->marketplace_shipping == 1 && $mdsPaymentType == 'sale') {
                                            echo '2.';
                                        } else {
                                            echo '1.';
                                        } ?>
                                        &nbsp;<?= "Ödeme Yönetimi"; ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <?php if ($mdsPaymentType == 'service'):
                            echo view('cart/_order_summary_service');
                        else:
                            echo view('cart/_order_summary');
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-option-single {
    background: #f8f9fa;
    border: 2px solid #28a745;
    border-radius: 8px;
    padding: 20px;
    margin: 10px 0;
}

.payment-option-content {
    display: flex;
    align-items: center;
    gap: 15px;
}

.payment-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    background: #28a745;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 24px;
}

.payment-icon span {
    color: white !important;
    font-size: 24px !important;
    display: block;
}

.payment-details {
    flex: 1;
}

.payment-details strong {
    font-size: 18px;
    color: #28a745;
    display: block;
    margin-bottom: 5px;
}

.payment-description {
    margin: 5px 0;
    color: #333;
    font-size: 14px;
}

.payment-details small {
    font-size: 12px;
}

.custom-control-input:checked ~ .custom-control-label .payment-option-single {
    border-color: #007bff;
    background: #e3f2fd;
}

.custom-control-input:checked ~ .custom-control-label .payment-icon {
    background: #007bff;
}

.custom-control-input:checked ~ .custom-control-label .payment-details strong {
    color: #007bff;
}

.btn-continue-payment {
    background: linear-gradient(45deg, #28a745, #20c997);
    border: none;
    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    transition: all 0.3s ease;
}

.btn-continue-payment:hover {
    background: linear-gradient(45deg, #218838, #1ea085);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
}

.btn-continue-payment:active {
    transform: translateY(0);
}
</style>