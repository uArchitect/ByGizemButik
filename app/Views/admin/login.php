<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= esc($title); ?> - <?= esc($generalSettings->application_name); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" type="image/png" href="<?= getFavicon(); ?>"/>
    <!-- Yeni & Modern CSS Frameworkleri (Bootstrap 5, Google Fonts, FontAwesome) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #1a2980 0%, #26d0ce 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: #fff;
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: 1.25rem;
            box-shadow: 0 8px 32px 0 rgba(44,62,80,0.2);
            max-width: 380px;
            width: 100%;
        }
        .login-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.9rem;
        }
        .login-logo i {
            font-size: 2.2rem;
            color: #2264e9;
            margin-right: 0.5rem;
        }
        .login-title {
            text-align: center;
            font-size: 1.4rem;
            font-weight: 700;
            color: #363b47;
            margin-bottom: 1.2rem;
        }
        .form-control {
            border-radius: 0.7rem;
            padding: 0.65rem 1rem;
            font-size: 1rem;
        }
        .form-group {
            margin-bottom: 1.1rem;
            position: relative;
        }
        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #188eea;
            font-size: 1.1rem;
        }
        .form-control {
            padding-left: 2.3rem;
            background: #f2f4fd;
        }
        .btn-primary {
            border-radius: 0.7rem;
            font-weight: 600;
            background: linear-gradient(90deg, #1e5799 0%, #2989d8 100%);
            border: none;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg, #1177cb 0%, #3a6cf0 100%);
        }
        .go-home {
            color: #3750f0;
            text-decoration: none;
            font-weight: 600;
            margin-top: 1.4rem;
            display: inline-block;
            transition: color 0.18s;
        }
        .go-home:hover {
            color: #0bc4ea;
        }
        .alert {
            border-radius: 0.7rem!important;
            font-size: 15px;
        }
    </style>
</head>
<body>
    <main class="login-container">
        <div class="login-logo">
            <i class="fa fa-store"></i>
            <a href="<?= adminUrl('login'); ?>" style="font-weight:700;color:#2264e9;text-decoration:none;font-size:1.23rem;">uCommerce&nbsp;Panel</a>
        </div>
        <div class="login-title mb-1">Giriş Yap</div>
        <?= view('admin/includes/_messages'); ?>
        <form action="<?= adminUrl('login-post'); ?>" method="post" autocomplete="off">
            <?= csrf_field(); ?>
            <div class="form-group position-relative">
                <span class="input-icon"><i class="fa fa-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="E-posta" value="<?= old('email'); ?>" required autofocus>
            </div>
            <div class="form-group position-relative">
                <span class="input-icon"><i class="fa fa-lock"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Şifre" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Giriş Yap</button>
        </form>
        <div class="text-center">
            <a class="go-home" href="<?= langBaseUrl(); ?>"><i class="fa fa-arrow-left"></i> Ana Sayfaya Git</a>
        </div>
    </main>
    <!-- Bootstrap JS (isteğe bağlı) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
