<div class="row">
    <div class="col-lg-7 p-5">
        <h5 class="text-primary">Chào mừng bạn đến với Chance</h5>
        <p class="m-0 fs-5">Cùng tìm kiếm cho mình những cơ hội nghề nghiệp lý tưởng</p>
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
                <div class="input-group w-100">
                    <span class="input-group-text p-0 border border-end-0"><i
                            class="bi bi-envelope p-2 px-3 text-primary"></i></span>
                    <input type="email" class="form-control border-start-0" name="email" placeholder="Địa chỉ email"
                        value="<?php echo (!empty(old('email', $old))) ? old('email', $old) : false; ?>">
                </div>
                <?php echo form_error('email', $errors, '<span class="error">', '</span>') ?>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100 mt-4">Xác nhận</button>
            <p class="text-center mt-3 text-dark">Bạn đã có tài khoản? <a href="<?php echo _WEB_ROOT; ?>/dang-nhap">Đăng
                    nhập</a></p>
        </form>
    </div>
    <div class="col-lg-5 d-md-none d-sm-none d-none d-lg-block">
        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/bg-login.png" style="height: 100vh;" alt="">
    </div>
</div>