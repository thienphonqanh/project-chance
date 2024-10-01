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

<body id="top">
    <!-- Thanh header -->
    <nav class="navbar p-1 navbar-expand-lg">
        <?php if (isUser() || (!isLogin() || isEmployer())) : ?>
            <div class="container-lg flex-md-row-reverse flex-sm-row-reverse flex-row-reverse flex-lg-row">
            <?php else : ?>
                <div class="container-lg">
                <?php endif; ?>
                <?php
                if (isLogin() && isUser()) :
                ?>
                    <button class="btn d-lg-none d-sm-block d-md-block d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                        <div class="avatar-profile-edit text-center">
                            <img src="<?php echo _WEB_ROOT . '/' . getAvatarUserLogin(); ?>" height="38px" width="38px" class="avatar" alt="">
                        </div>
                    </button>
                <?php elseif ((!isLogin() && !isUser()) || (isLogin() && !isUser()) && !isAdmin()) : ?>
                    <div class="d-lg-none d-sm-block d-md-block d-block">
                        <a href="<?php echo _WEB_ROOT; ?>/dang-nhap">
                            <i class="text-dark bi bi-person fs-2"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <a class="navbar-brand d-flex align-items-center" href="<?php echo _WEB_ROOT; ?>/trang-chu">
                    <?php if (isUser() || (!isLogin() || isEmployer())) : ?>
                        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/logos/Logo-Chance.png" class="img-fluid logo-image d-lg-block d-md-mone d-sm-none d-none">
                    <?php else : ?>
                        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/logos/Logo-Chance.png" class="img-fluid logo-image">
                    <?php endif; ?>
                    <div class="d-flex flex-column">
                        <strong class="logo-text">Chance</strong>
                        <small class="logo-slogan">Online Job Portal</small>
                    </div>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav align-items-center ms-lg-5">
                        <li class="nav-item">
                            <a class="nav-link <?php echo handleActiveLink('trang-chu') ? 'active' : false; ?>" href="<?php echo _WEB_ROOT; ?>/trang-chu">Trang chủ</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo _WEB_ROOT; ?>/cam-nang">Cẩm nang</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo handleActiveLink('tim-viec-lam') ? 'active' : false; ?>" href="<?php echo _WEB_ROOT; ?>/tim-viec-lam">Tìm việc làm</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link <?php echo handleActiveLink('lien-he') ? 'active' : false; ?>" href="<?php echo _WEB_ROOT; ?>/lien-he">Liên hệ</a>
                        </li>

                        <?php
                        if (!isLogin()) :
                        ?>
                            <li class="nav-item ms-lg-auto d-none d-sm-none d-md-none d-lg-block">
                                <a class="nav-link p-0 px-3 text-dark fw-semibold fs-6 border-end border-2 border-primary" type="button" href="<?php echo _WEB_ROOT; ?>/dang-nhap"><span class="fs-6 fw-normal text-dark">Người tìm việc</span><br> Đăng ký/Đăng nhập</a>
                            </li>

                            <li class="nav-item d-none d-sm-none d-md-none d-lg-block">
                                <a class="nav-link p-0 px-3 text-dark fw-normal fs-5" type="button" href="<?php echo _WEB_ROOT; ?>/ntd"><i class="text-primary bi bi-suitcase-lg fs-5"></i>
                                    Nhà Tuyển Dụng</a>
                            </li>
                        <?php elseif (isAdmin()) : ?>

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
                                    <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/admin">Trang quản trị</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/dang-xuat">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>

                        <?php elseif (isUser()) : ?>

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
                                    <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/quan-ly-tai-khoan/tai-khoan">Tài khoản</a></li>
                                    <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/ntd">Cổng nhà tuyển dụng</a></li>
                                    <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/doi-mat-khau">Đổi mật
                                            khẩu</a>
                                    </li>
                                    <li><a class="dropdown-item" href="<?php echo _WEB_ROOT; ?>/dang-xuat">Đăng xuất</a>
                                    </li>
                                </ul>
                            </li>

                        <?php endif; ?>
                    </ul>
                </div>
                </div>
    </nav>