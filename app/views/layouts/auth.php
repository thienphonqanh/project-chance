<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image" href="<?php echo _WEB_ROOT; ?>/public/client/assets/images/Logo-Chance.png">

    <title><?php echo $title ?></title>

    <!-- CSS FILES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/client/assets/css/base.css?ver=<?php echo rand(); ?>">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/client/assets/css/main.css?ver=<?php echo rand(); ?>">

    <link rel="stylesheet" href="<?php echo _WEB_ROOT; ?>/public/client/assets/css/responsive.css?ver=<?php echo rand(); ?>">

</head>

<body class="login-page" id="top">
    <div class="row">
        <div class="col-lg-6 p-5">
            <h5 class="text-primary">Chào mừng bạn đến với Chance</h5>
            <p class="m-0 fs-5">Cùng tìm kiếm cho mình những cơ hội nghề nghiệp lý tưởng</p>
            <?php
            if (!empty($msg)) :
                echo '<div class="alert alert-' . $msgType . '">';
                echo $msg;
                echo '</div>';
            endif;

            $this->render($body, $dataView);
            ?>
        </div>
        <div class="col-lg-6 d-md-none d-sm-none d-none d-lg-block">
            <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/bg-login.png" width="100%" alt="">
        </div>
    </div>
</body>

</html>