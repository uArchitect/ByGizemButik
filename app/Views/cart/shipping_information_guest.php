<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="shopping-cart shopping-cart-shipping">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8">
                            <div class="left">
                                <h1 class="cart-section-title"><?= "Ödeme"; ?></h1>
                                <div class="tab-checkout tab-checkout-open m-t-0">
                                    <p class="font-600 text-center m-b-30">
                                        <?= "Misafir olarak ödeme yapıyorsunuz"; ?>.&nbsp;<?= "Hesabınız var mı?"; ?>&nbsp;
                                        <a href="javascript:void(0)" class="link" data-toggle="modal" data-target="#loginModal">
                                            <strong class="link-underlined"><?= "Giriş Yap"; ?></strong>
                                        </a>
                                    </p>
                                    <h2 class="title">1.&nbsp;&nbsp;<?= "Teslimat Bilgileri"; ?></h2>
                                    <form action="<?= base_url('shipping-post'); ?>" method="post" id="form-guest-shipping" class="validate-form">
                                        <?= csrf_field(); ?>
                                        <div class="row">
                                            <div class="col-12 cart-form-shipping-address">
                                                <p class="text-shipping-address"><?= "Teslimat Adresi" ?></p>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 m-b-sm-15">
                                                            <label class="control-label"><?= "Ad"; ?></label>
                                                            <input type="text" name="shipping_first_name" class="form-control form-input" value="<?= !empty($sessShippingData->sFirstName) ? esc($sessShippingData->sFirstName) : ''; ?>" maxlength="250" placeholder="<?= "Ad"; ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="control-label"><?= "Soyad"; ?></label>
                                                            <input type="text" name="shipping_last_name" class="form-control form-input" value="<?= !empty($sessShippingData->sLastName) ? esc($sessShippingData->sLastName) : ''; ?>" maxlength="250" placeholder="<?= "Soyad"; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 m-b-sm-15">
                                                            <label class="control-label"><?= "E-posta"; ?></label>
                                                            <input type="email" name="shipping_email" class="form-control form-input" value="<?= !empty($sessShippingData->sEmail) ? esc($sessShippingData->sEmail) : ''; ?>" maxlength="250" placeholder="<?= "E-posta"; ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="control-label"><?= "Telefon Numarası"; ?></label>
                                                            <input type="text" name="shipping_phone_number" class="form-control form-input" value="<?= !empty($sessShippingData->sPhoneNumber) ? esc($sessShippingData->sPhoneNumber) : ''; ?>" maxlength="100" placeholder="<?= "Telefon Numarası"; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php if ($generalSettings->single_country_mode != 1): ?>
                                                            <div class="col-12 col-md-6 m-b-sm-15">
                                                                <label class="control-label"><?= "Ülke"; ?></label>
                                                                <select id="select_countries_guest_address" name="shipping_country_id" class="select2 select2-req form-control form-input" data-placeholder="<?= "Ülke"; ?>" onchange="getStates(this.value,'guest_address'); $('.cart-seller-shipping-options').empty();" required>
                                                                    <option></option>
                                                                    <?php if (!empty($activeCountries)):
                                                                        foreach ($activeCountries as $item): ?>
                                                                            <option value="<?= $item->id; ?>" <?= !empty($sessShippingData->sCountryId) && $sessShippingData->sCountryId == $item->id ? 'selected' : ''; ?>><?= esc($item->name); ?></option>
                                                                        <?php endforeach;
                                                                    endif; ?>
                                                                </select>
                                                            </div>
                                                            <?php if (!empty($sessShippingData->sCountryId)):
                                                                $states = getStatesByCountry($sessShippingData->sCountryId);
                                                            endif;
                                                        else: ?>
                                                            <input type="hidden" name="shipping_country_id" value="<?= $generalSettings->single_country_id; ?>">
                                                            <?php $states = getStatesByCountry($generalSettings->single_country_id);
                                                        endif; ?>
                                                        <div id="get_states_container_guest_address" class="col-12 <?= $generalSettings->single_country_mode == 1 ? 'col-md-12' : 'col-md-6'; ?>">
                                                            <label class="control-label"><?= "İl"; ?></label>
                                                            <select id="select_states_guest_address" name="shipping_state_id" class="select2 select2-req form-control" data-placeholder="<?= "İl"; ?>" onchange="getShippingMethodsByLocation(this.value);" required>
                                                                <option></option>
                                                                <?php if (!empty($states)):
                                                                    foreach ($states as $item): ?>
                                                                        <option value="<?= $item->id; ?>" <?= !empty($sessShippingData->sStateId) && $sessShippingData->sStateId == $item->id ? 'selected' : ''; ?>><?= esc($item->name); ?></option>
                                                                    <?php endforeach;
                                                                endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 m-b-sm-15">
                                                            <label class="control-label"><?= "İlçe"; ?></label>
                                                            <input type="text" name="shipping_city" class="form-control form-input" value="<?= !empty($sessShippingData->sCity) ? esc($sessShippingData->sCity) : ''; ?>" maxlength="250" placeholder="<?= "İlçe"; ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="control-label"><?= "Posta Kodu"; ?></label>
                                                            <input type="text" name="shipping_zip_code" class="form-control form-input" value="<?= !empty($sessShippingData->sZipCode) ? esc($sessShippingData->sZipCode) : ''; ?>" maxlength="90" placeholder="<?= "Posta Kodu"; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"><?= "Adres"; ?></label>
                                                    <input type="text" name="shipping_address" class="form-control form-input" value="<?= !empty($sessShippingData->sAddress) ? esc($sessShippingData->sAddress) : ''; ?>" maxlength="250" placeholder="<?= "Adres"; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12 cart-form-billing-address" <?= empty($selectedSameAddressForBilling) ? 'style="display: block;"' : ''; ?>>
                                                <p class="text-shipping-address"><?= "Fatura Adresi" ?></p>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 m-b-sm-15">
                                                            <label class="control-label"><?= "Ad"; ?></label>
                                                            <input type="text" name="billing_first_name" class="form-control form-input" value="<?= !empty($sessShippingData->bFirstName) ? esc($sessShippingData->bFirstName) : ''; ?>" maxlength="250" placeholder="<?= "Ad"; ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="control-label"><?= "Soyad"; ?></label>
                                                            <input type="text" name="billing_last_name" class="form-control form-input" value="<?= !empty($sessShippingData->bLastName) ? esc($sessShippingData->bLastName) : ''; ?>" maxlength="250" placeholder="<?= "Soyad"; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 m-b-sm-15">
                                                            <label class="control-label"><?= "E-posta"; ?></label>
                                                            <input type="email" name="billing_email" class="form-control form-input" value="<?= !empty($sessShippingData->bEmail) ? esc($sessShippingData->bEmail) : ''; ?>" maxlength="250" placeholder="<?= "E-posta"; ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="control-label"><?= "Telefon Numarası"; ?></label>
                                                            <input type="text" name="billing_phone_number" class="form-control form-input" value="<?= !empty($sessShippingData->bPhoneNumber) ? esc($sessShippingData->bPhoneNumber) : ''; ?>" maxlength="100" placeholder="<?= "Telefon Numarası"; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <?php if ($generalSettings->single_country_mode != 1): ?>
                                                            <div class="col-12 col-md-6 m-b-sm-15">
                                                                <label class="control-label"><?= "Ülke"; ?></label>
                                                                <select id="select_countries_guest_billing" name="billing_country_id" class="select2 form-control <?= empty($selectedSameAddressForBilling) ? 'select2-req' : ''; ?>" data-placeholder="<?= "Ülke"; ?>" onchange="getStates(this.value,'guest_billing');" required>
                                                                    <option></option>
                                                                    <?php if (!empty($activeCountries)):
                                                                        foreach ($activeCountries as $item): ?>
                                                                            <option value="<?= $item->id; ?>" <?= !empty($sessShippingData->bCountryId) && $sessShippingData->bCountryId == $item->id ? 'selected' : ''; ?>><?= esc($item->name); ?></option>
                                                                        <?php endforeach;
                                                                    endif; ?>
                                                                </select>
                                                            </div>
                                                            <?php if (!empty($sessShippingData->bCountryId)):
                                                                $states = getStatesByCountry($sessShippingData->bCountryId);
                                                            endif;
                                                        else: ?>
                                                            <input type="hidden" name="billing_country_id" value="<?= $generalSettings->single_country_id; ?>">
                                                            <?php $states = getStatesByCountry($generalSettings->single_country_id);
                                                        endif; ?>
                                                        <div class="col-12 <?= $generalSettings->single_country_mode == 1 ? 'col-md-12' : 'col-md-6'; ?>">
                                                            <label class="control-label"><?= "İl"; ?></label>
                                                            <div id="get_states_container_guest_billing">
                                                                <select id="select_states_guest_billing" name="billing_state_id" class="select2 form-control <?= empty($selectedSameAddressForBilling) == 1 ? 'select2-req' : ''; ?>" data-placeholder="<?= "İl"; ?>" required>
                                                                    <option></option>
                                                                    <?php if (!empty($states)):
                                                                        foreach ($states as $item): ?>
                                                                            <option value="<?= $item->id; ?>" <?= !empty($sessShippingData->bStateId) && $sessShippingData->bStateId == $item->id ? 'selected' : ''; ?>><?= esc($item->name); ?></option>
                                                                        <?php endforeach;
                                                                    endif; ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 m-b-sm-15">
                                                            <label class="control-label"><?= "İlçe"; ?></label>
                                                            <input type="text" name="billing_city" class="form-control form-input" value="<?= !empty($sessShippingData->bCity) ? esc($sessShippingData->bCity) : ''; ?>" maxlength="250" placeholder="<?= "İlçe"; ?>" required>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <label class="control-label"><?= "Posta Kodu"; ?></label>
                                                            <input type="text" name="billing_zip_code" class="form-control form-input" value="<?= !empty($sessShippingData->bZipCode) ? esc($sessShippingData->bZipCode) : ''; ?>" maxlength="90" placeholder="<?= "Posta Kodu"; ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label"><?= "Adres"; ?></label>
                                                    <input type="text" name="billing_address" class="form-control form-input" value="<?= !empty($sessShippingData->bAddress) ? esc($sessShippingData->bAddress) : ''; ?>" maxlength="250" placeholder="<?= "Adres"; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="use_same_address_for_billing" value="1" id="use_same_address_for_billing" <?= $selectedSameAddressForBilling == 1 ? 'checked' : ''; ?>>
                                                        <label for="use_same_address_for_billing" class="custom-control-label"><?= "Fatura için aynı adresi kullan"; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div id="cart_shipping_methods_container" class="shipping-methods-container">
                                                    <?= view("cart/_shipping_methods"); ?>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="cart-shipping-loader">
                                                            <div class="spinner">
                                                                <div class="bounce1"></div>
                                                                <div class="bounce2"></div>
                                                                <div class="bounce3"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-checkout tab-checkout-closed-bordered">
                                    <h2 class="title">2.&nbsp;&nbsp;<?= "Ödeme Yöntemi"; ?></h2>
                                </div>
                                <div class="tab-checkout tab-checkout-closed-bordered border-top-0">
                                    <h2 class="title">3.&nbsp;&nbsp;<?= "Ödeme"; ?></h2>
                                </div>
                            </div>
                        </div>
                        <?php if ($mdsPaymentType == 'promote'):
                            echo view('cart/_order_summary_promote');
                        else:
                            echo view('cart/_order_summary');
                        endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>