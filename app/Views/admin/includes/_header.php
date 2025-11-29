<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= escSls($title); ?> - <?= escSls($generalSettings->application_name); ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="<?= getFavicon(); ?>"/>
    <?= csrf_meta(); ?>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/datatables/dataTables.bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/datatables/jquery.dataTables_themeroller.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/pace/pace.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/vendor/magnific-popup/magnific-popup.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/plugins-2.5.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/AdminLTE.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/_all-skins.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/main-2.5.min.css'); ?>">
    <script>var directionality = 'ltr';</script>
    <?php if ($activeLang->text_direction == 'rtl'): ?>
        <link href="<?= base_url('assets/admin/css/rtl-2.5.min.css'); ?>" rel="stylesheet"/>
        <script>directionality = 'rtl';</script>
    <?php endif; ?>
    <script src="<?= base_url('assets/admin/js/jquery.min.js'); ?>"></script>
    <script>
        var MdsConfig = {
            baseURL: '<?= base_url(); ?>',
            csrfTokenName: '<?= csrf_token() ?>',
            sysLangId: '<?= $activeLang->id; ?>',
            directionality: <?= $baseVars->rtl ? 'true' : 'false'; ?>,
            textOk: "Tamam",
            textCancel: "İptal",
            textNone: "Yok",
            textProcessing: "İşleniyor",
            textSelectImage: "Resim Seç",
            textTagInput: "Etiket yazın",
            backURL: "<?= clrQuotes(getCurrentUrl(false)); ?>"
        }
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <div class="main-header-inner">
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"><i class="fa fa-bars" aria-hidden="true"></i></a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li><a class="btn btn-sm btn-success pull-left btn-site-prev" target="_blank" href="<?= base_url(); ?>"><i class="fa fa-eye"></i> <span class="btn-site-prev-text">Siteyi Görüntüle</span></a></li>
                        <li class="dropdown user-menu">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                <i class="fa fa-globe"></i>&nbsp;
                                <?= esc($activeLang->name); ?>
                                <span class="fa fa-caret-down"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <?php if (!empty($activeLanguages)):
                                    foreach ($activeLanguages as $language): ?>
                                        <li>
                                            <form action="<?= base_url('Admin/setActiveLanguagePost'); ?>" method="post">
                                                <?= csrf_field(); ?>
                                                <button type="submit" value="<?= $language->id; ?>" name="lang_id" class="control-panel-lang-btn"><?= characterLimiter($language->name, 20, '...'); ?></button>
                                            </form>
                                        </li>
                                    <?php endforeach;
                                endif; ?>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <img src="<?= getUserAvatar(user()); ?>" class="user-image" alt="">
                                <span class="hidden-xs"><?= esc(getUsername(user())); ?> <i class="fa fa-caret-down"></i> </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-main pull-right" role="menu" aria-labelledby="user-options">
                                <?php if (isVendor()): ?>
                                    <li>
                                        <a href="<?= dashboardUrl(); ?>">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 24 24">
                                                    <path fill="none" stroke="#747474" stroke-width="1.5" d="M14 20.4v-5.8a.6.6 0 0 1 .6-.6h5.8a.6.6 0 0 1 .6.6v5.8a.6.6 0 0 1-.6.6h-5.8a.6.6 0 0 1-.6-.6Zm-11 0v-5.8a.6.6 0 0 1 .6-.6h5.8a.6.6 0 0 1 .6.6v5.8a.6.6 0 0 1-.6.6H3.6a.6.6 0 0 1-.6-.6Zm11-11V3.6a.6.6 0 0 1 .6-.6h5.8a.6.6 0 0 1 .6.6v5.8a.6.6 0 0 1-.6.6h-5.8a.6.6 0 0 1-.6-.6Zm-11 0V3.6a.6.6 0 0 1 .6-.6h5.8a.6.6 0 0 1 .6.6v5.8a.6.6 0 0 1-.6.6H3.6a.6.6 0 0 1-.6-.6Z"/>
                                                </svg>
                                            </div>Panel
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?= generateProfileUrl(user()->slug); ?>">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="19" height="19" color="#747474" fill="none">
                                                <path d="M6.57757 15.4816C5.1628 16.324 1.45336 18.0441 3.71266 20.1966C4.81631 21.248 6.04549 22 7.59087 22H16.4091C17.9545 22 19.1837 21.248 20.2873 20.1966C22.5466 18.0441 18.8372 16.324 17.4224 15.4816C14.1048 13.5061 9.89519 13.5061 6.57757 15.4816Z" stroke="#747474" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z" stroke="#747474" stroke-width="1.5"/>
                                            </svg>
                                        </div>Profil
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= generateUrl('wallet'); ?>">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18.8" height="18.8" viewBox="0 0 24 24">
                                                <path stroke="#747474" stroke-width="0.5" fill="#747474" d="M19.5 7H18V6a3.003 3.003 0 0 0-3-3H4.5A2.5 2.5 0 0 0 2 5.5V18a3.003 3.003 0 0 0 3 3h14.5a2.5 2.5 0 0 0 2.5-2.5v-9A2.5 2.5 0 0 0 19.5 7m-15-3H15a2.003 2.003 0 0 1 2 2v1H4.5a1.5 1.5 0 1 1 0-3M21 16h-2a2 2 0 0 1 0-4h2zm0-5h-2a3 3 0 1 0 0 6h2v1.5a1.5 1.5 0 0 1-1.5 1.5H5a2.003 2.003 0 0 1-2-2V7.499c.432.326.959.502 1.5.501h15A1.5 1.5 0 0 1 21 9.5z"/>
                                            </svg>
                                        </div>Cüzdan
                                    </a>
                                </li>
                                <?php if (isSaleActive()): ?>
                                    <li>
                                        <a href="<?= generateUrl('orders'); ?>">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="#747474" viewBox="0 0 256 256">
                                                    <path d="M136,120v56a8,8,0,0,1-16,0V120a8,8,0,0,1,16,0Zm36.84-.8-5.6,56A8,8,0,0,0,174.4,184a7.32,7.32,0,0,0,.81,0,8,8,0,0,0,7.95-7.2l5.6-56a8,8,0,0,0-15.92-1.6Zm-89.68,0a8,8,0,0,0-15.92,1.6l5.6,56a8,8,0,0,0,8,7.2,7.32,7.32,0,0,0,.81,0,8,8,0,0,0,7.16-8.76ZM239.93,89.06,224.86,202.12A16.06,16.06,0,0,1,209,216H47a16.06,16.06,0,0,1-15.86-13.88L16.07,89.06A8,8,0,0,1,24,80H68.37L122,18.73a8,8,0,0,1,12,0L187.63,80H232a8,8,0,0,1,7.93,9.06ZM89.63,80h76.74L128,36.15ZM222.86,96H33.14L47,200H209Z"></path>
                                                </svg>
                                            </div>Siparişler
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= generateUrl('my_coupons'); ?>">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="19" height="19" color="#747474" fill="none">
                                                    <circle cx="1.5" cy="1.5" r="1.5" transform="matrix(1 0 0 -1 16 8.00024)" stroke="#747474" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M2.77423 11.1439C1.77108 12.2643 1.7495 13.9546 2.67016 15.1437C4.49711 17.5033 6.49674 19.5029 8.85633 21.3298C10.0454 22.2505 11.7357 22.2289 12.8561 21.2258C15.8979 18.5022 18.6835 15.6559 21.3719 12.5279C21.6377 12.2187 21.8039 11.8397 21.8412 11.4336C22.0062 9.63798 22.3452 4.46467 20.9403 3.05974C19.5353 1.65481 14.362 1.99377 12.5664 2.15876C12.1603 2.19608 11.7813 2.36233 11.472 2.62811C8.34412 5.31646 5.49781 8.10211 2.77423 11.1439Z" stroke="#747474" stroke-width="1.5"/>
                                                    <path d="M7.00002 14.0002L10 17.0002" stroke="#747474" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>Kuponlarım
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li>
                                    <a href="<?= generateUrl('messages'); ?>">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" viewBox="0 0 32 32">
                                                <path fill="#747474" d="M17.74 30L16 29l4-7h6a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h9v2H6a4 4 0 0 1-4-4V8a4 4 0 0 1 4-4h20a4 4 0 0 1 4 4v12a4 4 0 0 1-4 4h-4.84Z"/>
                                                <path fill="#747474" d="M8 10h16v2H8zm0 6h10v2H8z"/>
                                            </svg>
                                        </div>Mesajlar&nbsp;
                                        <?php $unreadMessageCount = getUnreadChatsCount(user()->id);
                                        if ($unreadMessageCount > 0): ?>
                                            (<?= $unreadMessageCount; ?>)
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= generateUrl('settings', 'edit_profile'); ?>">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="#747474" viewBox="0 0 256 256">
                                                <path d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Zm88-29.84q.06-2.16,0-4.32l14.92-18.64a8,8,0,0,0,1.48-7.06,107.21,107.21,0,0,0-10.88-26.25,8,8,0,0,0-6-3.93l-23.72-2.64q-1.48-1.56-3-3L186,40.54a8,8,0,0,0-3.94-6,107.71,107.71,0,0,0-26.25-10.87,8,8,0,0,0-7.06,1.49L130.16,40Q128,40,125.84,40L107.2,25.11a8,8,0,0,0-7.06-1.48A107.6,107.6,0,0,0,73.89,34.51a8,8,0,0,0-3.93,6L67.32,64.27q-1.56,1.49-3,3L40.54,70a8,8,0,0,0-6,3.94,107.71,107.71,0,0,0-10.87,26.25,8,8,0,0,0,1.49,7.06L40,125.84Q40,128,40,130.16L25.11,148.8a8,8,0,0,0-1.48,7.06,107.21,107.21,0,0,0,10.88,26.25,8,8,0,0,0,6,3.93l23.72,2.64q1.49,1.56,3,3L70,215.46a8,8,0,0,0,3.94,6,107.71,107.71,0,0,0,26.25,10.87,8,8,0,0,0,7.06-1.49L125.84,216q2.16.06,4.32,0l18.64,14.92a8,8,0,0,0,7.06,1.48,107.21,107.21,0,0,0,26.25-10.88,8,8,0,0,0,3.93-6l2.64-23.72q1.56-1.48,3-3L215.46,186a8,8,0,0,0,6-3.94,107.71,107.71,0,0,0,10.87-26.25,8,8,0,0,0-1.49-7.06Zm-16.1-6.5a73.93,73.93,0,0,1,0,8.68,8,8,0,0,0,1.74,5.48l14.19,17.73a91.57,91.57,0,0,1-6.23,15L187,173.11a8,8,0,0,0-5.1,2.64,74.11,74.11,0,0,1-6.14,6.14,8,8,0,0,0-2.64,5.1l-2.51,22.58a91.32,91.32,0,0,1-15,6.23l-17.74-14.19a8,8,0,0,0-5-1.75h-.48a73.93,73.93,0,0,1-8.68,0,8,8,0,0,0-5.48,1.74L100.45,215.8a91.57,91.57,0,0,1-15-6.23L82.89,187a8,8,0,0,0-2.64-5.1,74.11,74.11,0,0,1-6.14-6.14,8,8,0,0,0-5.1-2.64L46.43,170.6a91.32,91.32,0,0,1-6.23-15l14.19-17.74a8,8,0,0,0,1.74-5.48,73.93,73.93,0,0,1,0-8.68,8,8,0,0,0-1.74-5.48L40.2,100.45a91.57,91.57,0,0,1,6.23-15L69,82.89a8,8,0,0,0,5.1-2.64,74.11,74.11,0,0,1,6.14-6.14A8,8,0,0,0,82.89,69L85.4,46.43a91.32,91.32,0,0,1,15-6.23l17.74,14.19a8,8,0,0,0,5.48,1.74,73.93,73.93,0,0,1,8.68,0,8,8,0,0,0,5.48-1.74L155.55,40.2a91.57,91.57,0,0,1,15,6.23L173.11,69a8,8,0,0,0,2.64,5.1,74.11,74.11,0,0,1,6.14,6.14,8,8,0,0,0,5.1,2.64l22.58,2.51a91.32,91.32,0,0,1,6.23,15l-14.19,17.74A8,8,0,0,0,199.87,123.66Z"></path>
                                            </svg>
                                        </div>Profil Ayarları
                                    </a>
                                </li>
                                <li>
                                    <form action="<?= base_url('logout'); ?>" method="post" class="form-logout">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="back_url" value="<?= getCurrentUrl(); ?>">
                                        <button type="submit" class="btn-logout" aria-label="btn-logout">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="#747474" viewBox="0 0 256 256">
                                                    <path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z"></path>
                                                </svg>
                                            </div>Çıkış
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>
    <aside class="main-sidebar" style="background-color: #343B4A;">
        <section class="sidebar sidebar-scrollbar">
            <a href="<?= adminUrl(); ?>" class="logo">
                <span class="logo-mini"></span>
                <span class="logo-lg"><b>uCommerce</b> Panel</span>
            </a>
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="<?= getUserAvatar(user()); ?>" class="img-circle" alt="">
                </div>
                <div class="pull-left info">
                    <p><?= esc(getUsername(user())); ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Çevrimiçi</a>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="nav-home">
                    <a href="<?= adminUrl(); ?>"><i class="fa fa-home"></i> <span>Ana Sayfa</span></a>
                </li>
                
                <li class="header">Tasarım</li>
                <?php if (hasPermission('theme')): ?>
                    <li class="nav-theme">
                        <a href="<?= adminUrl('theme'); ?>"><i class="fa fa-th"></i><span>Tema</span></a>
                    </li>
                <?php endif;
                if (hasPermission('slider')):?>
                    <li class="nav-slider">
                        <a href="<?= adminUrl('slider'); ?>"><i class="fa fa-sliders"></i><span>Slider</span></a>
                    </li>
                <?php endif;
                if (hasPermission('homepage_manager')):?>
                    <li class="nav-homepage-manager">
                        <a href="<?= adminUrl('homepage-manager'); ?>"><i class="fa fa-clone"></i><span>Ana Sayfa Yöneticisi</span></a>
                    </li>
                <?php endif; ?>
                
                <li class="header">Siparişler & Satışlar</li>
                <?php if (hasPermission('orders')):?>
                    <li class="nav-orders">
                        <a href="<?= adminUrl('orders'); ?>"><i class="fa fa-shopping-cart"></i><span>Siparişler</span></a>
                    </li>
                    <li class="nav-transactions">
                        <a href="<?= adminUrl('transactions'); ?>"><i class="fa fa-exchange"></i><span>İşlemler</span></a>
                    </li>
                <?php endif;
                if (hasPermission('digital_sales')):?>
                    <li class="nav-digital-sales">
                        <a href="<?= adminUrl('digital-sales'); ?>"><i class="fa fa-shopping-bag"></i><span>Dijital Satışlar</span></a>
                    </li>
                <?php endif;
                if (hasPermission('refund_requests')):?>
                    <li class="nav-refund-requests">
                        <a href="<?= adminUrl('refund-requests'); ?>"><i class="fa fa-flag"></i><span>İade Talepleri</span></a>
                    </li>
                <?php endif; ?>
                
                <li class="header">Ürünler & Kategoriler</li>
                <?php if (hasPermission('products')):?>
                    <li class="nav-products">
                        <a href="<?= adminUrl('products?list=all'); ?>"><i class="fa fa-shopping-basket"></i><span>Ürünler</span></a>
                    </li>
                <?php endif;
                if (hasPermission('categories')):?>
                    <li class="nav-categories">
                        <a href="<?= adminUrl('categories'); ?>"><i class="fa fa-folder-open"></i><span>Kategoriler</span></a>
                    </li>
                <?php endif;
                if (hasPermission('brands')):?>
                    <li class="nav-brands">
                        <a href="<?= adminUrl('brands'); ?>"><i class="fa fa-asterisk"></i><span>Markalar</span></a>
                    </li>
                <?php endif;
                if (hasPermission('custom_fields')):?>
                    <li class="nav-custom-fields">
                        <a href="<?= adminUrl('custom-fields'); ?>"><i class="fa fa-plus-square-o"></i><span>Özel Alanlar</span></a>
                    </li>
                <?php endif;
                if (hasPermission('quote_requests')):?>
                    <li class="nav-quote-requests">
                        <a href="<?= adminUrl('quote-requests'); ?>"><i class="fa fa-tag"></i><span>Teklif Talepleri</span></a>
                    </li>
                <?php endif; ?>
                
                <li class="header">Finansal İşlemler</li>
                <?php if (hasPermission('earnings')):?>
                    <li class="nav-earnings">
                        <a href="<?= adminUrl('earnings'); ?>"><i class="fa fa-money"></i><span>Kazançlar</span></a>
                    </li>
                    <li class="nav-seller-balances">
                        <a href="<?= adminUrl('seller-balances'); ?>"><i class="fa fa-wallet"></i><span>Satıcı Bakiyeleri</span></a>
                    </li>
                <?php endif;
                if (hasPermission('payouts')):?>
                    <li class="nav-payout-requests">
                        <a href="<?= adminUrl('payout-requests'); ?>"><i class="fa fa-usd"></i><span>Ödeme Talepleri</span></a>
                    </li>
                <?php endif; ?>
                
                <li class="header">İçerik</li>
                <?php if (hasPermission('pages')): ?>
                    <li class="nav-pages">
                        <a href="<?= adminUrl('pages'); ?>"><i class="fa fa-file"></i><span>Sayfalar</span></a>
                    </li>
                <?php endif;
                if (hasPermission('blog')):?>
                    <li class="nav-blog-posts">
                        <a href="<?= adminUrl('blog-posts'); ?>"><i class="fa fa-file-text"></i><span>Blog</span></a>
                    </li>
                <?php endif;
                if (hasPermission('location')):?>
                    <li class="nav-countries">
                        <a href="<?= adminUrl('countries'); ?>"><i class="fa fa-map-marker"></i><span>Konum</span></a>
                    </li>
                <?php endif; ?>
                
                <li class="header">Kullanıcılar</li>
                <?php if (hasPermission('membership')):?>
                    <li class="nav-users">
                        <a href="<?= adminUrl('users'); ?>"><i class="fa fa-users"></i><span>Kullanıcılar</span></a>
                    </li>
                    <li class="nav-membership-plans">
                        <a href="<?= adminUrl('membership-plans'); ?>"><i class="fa fa-adjust"></i><span>Üyelik Planları</span></a>
                    </li>
                    <li class="nav-roles-permissions">
                        <a href="<?= adminUrl('roles-permissions'); ?>"><i class="fa fa-key"></i><span>Roller ve İzinler</span></a>
                    </li>
                <?php endif; ?>
                
                <li class="header hide li-mt">Yönetim</li>
                <?php $showMtTools = false;
                if (hasPermission('help_center')):
                    $showMtTools = true; ?>
                    <li class="nav-support-tickets">
                        <a href="<?= adminUrl('support-tickets'); ?>"><i class="fa fa-support"></i><span>Destek Biletleri</span></a>
                    </li>
                <?php endif;
                if (hasPermission('chat_messages')):
                    $showMtTools = true; ?>
                    <li class="nav-chat-messages">
                        <a href="<?= adminUrl('chat-messages'); ?>"><i class="fa fa-comments"></i><span>Sohbet Mesajları</span></a>
                    </li>
                <?php endif;
                if (hasPermission('contact_messages')):
                    $showMtTools = true; ?>
                    <li class="nav-contact-messages">
                        <a href="<?= adminUrl('contact-messages'); ?>"><i class="fa fa-paper-plane"></i><span>İletişim Mesajları</span></a>
                    </li>
                <?php endif;
                if (hasPermission('reviews')):
                    $showMtTools = true; ?>
                    <li class="nav-reviews">
                        <a href="<?= adminUrl('reviews'); ?>"><i class="fa fa-star"></i><span>Değerlendirmeler</span></a>
                    </li>
                <?php endif;
                if (hasPermission('comments')):
                    $showMtTools = true; ?>
                    <li class="nav-product-comments">
                        <a href="<?= adminUrl($generalSettings->comment_approval_system == 1 ? 'pending-product-comments' : 'product-comments'); ?>"><i class="fa fa-comments"></i><span>Yorumlar</span></a>
                    </li>
                <?php endif;
                if (hasPermission('storage')):
                    $showMtTools = true; ?>
                    <li class="nav-storage">
                        <a href="<?= adminUrl('storage'); ?>"><i class="fa fa-cloud-upload"></i><span>Depolama</span></a>
                    </li>
                <?php endif;
                if (hasPermission('cache_system')):
                    $showMtTools = true; ?>
                    <li class="nav-cache-system">
                        <a href="<?= adminUrl('cache-system'); ?>"><i class="fa fa-database"></i><span>Önbellek</span></a>
                    </li>
                <?php endif;
                if (hasPermission('seo_tools')):
                    $showMtTools = true; ?>
                    <li class="nav-seo-tools">
                        <a href="<?= adminUrl('seo-tools'); ?>"><i class="fa fa-wrench"></i><span>SEO Araçları</span></a>
                    </li>
                <?php endif; ?>
                
                <li class="header">Ayarlar</li>
                <?php if (hasPermission('general_settings')): ?>
                    <li class="nav-general-settings">
                        <a href="<?= adminUrl('general-settings'); ?>"><i class="fa fa-cogs"></i><span>Genel Ayarlar</span></a>
                    </li>
                <?php endif;
                if (hasPermission('product_settings')): ?>
                    <li class="nav-product-settings">
                        <a href="<?= adminUrl('product-settings'); ?>"><i class="fa fa-shopping-bag"></i><span>Ürün Ayarları</span></a>
                    </li>
                <?php endif;
                if (hasPermission('payment_settings')):?>
                    <li class="nav-payment-settings">
                        <a href="<?= adminUrl('payment-settings'); ?>"><i class="fa fa-credit-card"></i><span>Ödeme Ayarları</span></a>
                    </li>
                <?php endif;
                if (hasPermission('preferences')): ?>
                    <li class="nav-preferences">
                        <a href="<?= adminUrl('preferences'); ?>"><i class="fa fa-check-square-o"></i><span>Tercihler</span></a>
                    </li>
                <?php endif;
                if (isSuperAdmin()): ?>
                    <li>
                        <div class="database-backup">
                            <form action="<?= base_url('Admin/downloadDatabaseBackup'); ?>" method="post">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-block"><i class="fa fa-download"></i>&nbsp;&nbsp;Veritabanı Yedekleme İndir</button>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="header">&nbsp;</li>
            </ul>
        </section>
    </aside>
    <?php
    $segment2 = $segment = getSegmentValue(2);
    $segment3 = $segment = getSegmentValue(3);
    $uriString = $segment2;
    if (!empty($segment3)) {
        $uriString .= '-' . $segment3;
    } ?>
    <style>
        <?php if(!empty($uriString)):
        echo '.nav-'.$uriString.' > a{color: #fff !important;}';
        else:
        echo '.nav-home > a{color: #fff !important;}';
        endif;
       if ($showMtTools):
        echo '.li-mt {display: block !important;}';
        endif; ?>
    </style>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <?= view('admin/includes/_messages'); ?>
                </div>
            </div>