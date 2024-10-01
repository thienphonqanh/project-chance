<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image" href="<?php echo _WEB_ROOT; ?>/public/client/assets/images/Logo-Chance.png">

    <title>Chance-Website tuyển dụng hàng đầu</title>

    <!-- CSS FILES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/client/assets/css/base.css?ver=<?php echo rand(); ?>">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/client/assets/css/main.css?ver=<?php echo rand(); ?>">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/client/assets/css/responsive.css?ver=<?php echo rand(); ?>">

</head>

<body class="<?php echo $page; ?>" id="top">
    <!-- Thanh header -->
    <nav class="navbar p-1 navbar-expand-lg">
    <?php if (isUser() || !isLogin()): ?>
        <div class="container-lg flex-md-row-reverse flex-sm-row-reverse flex-row-reverse flex-lg-row">
    <?php else: ?>
        <div class="container-lg">
    <?php endif; ?>
            <?php 
                if (isLogin() && isUser()): 
            ?>
            <button class="btn d-lg-none d-sm-block d-md-block d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                <div class="avatar-profile-edit text-center">
                    <img src="<?php echo _WEB_ROOT . '/' . getAvatarUserLogin(); ?>" height="38px" width="38px" class="avatar" alt="">
                </div>
            </button>
            <?php elseif (isLogin() && !isUser()): ?>
                <div class="d-none">
                    <a href="<?php echo _WEB_ROOT; ?>/dang-nhap">
                        <i class="text-dark bi bi-person fs-2"></i>
                    </a>
                </div>
            <?php else: ?>
                <div class="d-lg-none d-sm-block d-md-block d-block">
                    <a href="<?php echo _WEB_ROOT; ?>/dang-nhap">
                        <i class="text-dark bi bi-person fs-2"></i>
                    </a>
                </div>
            <?php endif; ?>

            <a class="navbar-brand d-flex align-items-center" href="<?php echo _WEB_ROOT; ?>/cam-nang">
                <div class="d-flex flex-column">
                    <strong class="logo-text">Chance</strong>
                    <small class="logo-slogan">Cẩm nang nghề</small>
                </div>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav align-items-center ms-lg-5">
                    <li class="nav-item">
                        <a class="nav-link p-3 text-dark fw-normal" href="<?php echo _WEB_ROOT; ?>/cam-nang/la-ban-su-nghiep">La bàn sự nghiệp</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-3 text-dark fw-normal" href="<?php echo _WEB_ROOT; ?>/cam-nang/tram-sac-ky-nang">Trạm sạc kỹ năng</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-3 text-dark fw-normal" href="<?php echo _WEB_ROOT; ?>/cam-nang/toa-do-nhan-tai">Toạ độ nhân tài</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-3 text-dark fw-normal" href="<?php echo _WEB_ROOT; ?>/cam-nang/ki-ot-vui-ve">Ki ốt vui vẻ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link p-3 text-dark fw-normal" href="<?php echo _WEB_ROOT; ?>/trang-chu"><i class="bi bi-house"></i></a>
                    </li>

                    <?php if (!isLogin()) : ?>

                        <li class="nav-item ms-lg-auto d-lg-block d-sm-none d-md-none d-none">
                            <a class="nav-link handbook-login text-dark p-2 fw-bold" type="button" href="<?php echo _WEB_ROOT; ?>/dang-nhap"><i class="bi bi-person-circle p-1"></i> Đăng
                                nhập</a>
                        </li>

                    <?php elseif (!isUser()) : ?>

                        <li class="nav-item dropdown ms-lg-auto">
                            <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-profile-edit text-center">
                                    <img src="<?php echo _WEB_ROOT . '/' . getAvatarUserLogin(); ?>" height="34px" width="34px" class="avatar" alt="">
                                </div>
                                <span class="px-2 m-0">
                                    <?php echo getFirstName(); ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/admin">Trang quản trị</a></li>
                                <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/dang-xuat">Đăng xuất</a></li>
                            </ul>
                        </li>

                    <?php else : ?>

                        <li class="nav-item dropdown ms-lg-auto d-none d-sm-none d-md-none d-lg-block">
                            <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="avatar-profile-edit text-center">
                                    <img src="<?php echo _WEB_ROOT . '/' . getAvatarUserLogin(); ?>" height="34px" width="34px" class="avatar" alt="">
                                </div>
                                <span class="px-2 m-0">
                                    <?php echo getFirstName(); ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="#">Đổi mật khẩu</a></li>
                                <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/dang-xuat">Đăng xuất</a></li>
                            </ul>
                        </li>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php
    $this->render($body, $dataView);
    $this->render('block/offcanvas_candidate', [], 'client');
    $this->render('block/footer', [], 'client');

