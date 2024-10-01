<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị - Chance</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Boostrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/plugins/summernote/summernote-bs4.min.css">

    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/admin/assets/css/main.css?ver=<?php echo rand(); ?>">

    <!-- CkEditor -->
    <script type="text/javascript" src="<?php echo _WEB_ROOT; ?>/public/admin/assets/ckeditor/ckeditor.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed overflow-x-hidden">
    <div class="wrapper">

        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="/public/admin/assets/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-user"> Hi, <?php echo getNameUserLogin(); ?></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="<?php echo _WEB_ROOT; ?>/admin/doi-mat-khau" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Đổi mật khẩu
                        </a>
                        <a href="<?php echo _WEB_ROOT; ?>/dang-xuat" class="dropdown-item">
                            <i class="fas fa-angle-right mr-2"></i>
                            Đăng xuất
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->