<div class="d-flex">
    <div class="mt-5 ntd-form-login" style="padding: 120px; width: 70%; overflow: hidden">
        <h5 class="text-primary">Chào mừng bạn đã trở lại</h5>
        <p class="m-0 fs-5">Cùng tạo dựng lợi thế cho doanh nghiệp bằng trải nghiệm công nghệ tuyển dụng ứng dụng sâu AI
            & Hiring Funnel</p>
        <?php
        if (!empty($msg)) :
            echo '<div class="alert alert-' . $msgType . '">';
            echo $msg;
            echo '</div>';
        endif;
        ?>
        <form action="" method="post" class="mt-3">
            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group mb-4 w-100">
                    <span class="input-group-text p-0 border border-end-0"><i class="bi bi-envelope p-2 px-3 text-primary"></i></span>
                    <input type="email" class="form-control border-start-0" name="email" placeholder="Địa chỉ email">
                </div>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <div class="input-group mb-2 w-100">
                    <span class="input-group-text p-0 border border-end-0"><i class="bi bi-shield-lock p-2 px-3 text-primary"></i></span>
                    <input type="password" class="form-control border-start-0" name="password" placeholder="Nhập mật khẩu">
                </div>
            </div>
            <div class="form-group text-end">
                <a href="<?php echo _WEB_ROOT; ?>/ntd/forgot">Quên mật khẩu</a>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">Đăng nhập</button>
            <p class="text-center mt-3 text-dark">Bạn chưa có tài khoản? <a href="<?php echo _WEB_ROOT; ?>/ntd/dang-ky">Đăng ký ngay</a></p>
        </form>
    </div>
    <div class="p-0 d-lg-block d-sm-none d-md-none d-none" style="width: 30%;">
        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/logos/ntd.banner.png" class="img-fluid" style="overflow: hidden; height: 100vh;" alt="">
    </div>
</div>