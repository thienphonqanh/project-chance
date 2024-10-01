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
                <label for="password">Mật khẩu mới</label>
                <div class="input-group mb-2 w-100">
                    <span class="input-group-text p-0 border border-end-0"><i
                            class="bi bi-shield-lock p-2 px-3 text-primary"></i></span>
                    <input type="password" class="form-control border-start-0" name="password"
                        placeholder="Nhập mật khẩu">
                </div>
                <?php echo form_error('password', $errors, '<span class="error">', '</span>') ?>
            </div>
            <div class="form-group">
                <label for="re_password">Nhập lại mật khẩu</label>
                <div class="input-group mb-2 w-100">
                    <span class="input-group-text p-0 border border-end-0"><i
                            class="bi bi-shield-lock p-2 px-3 text-primary"></i></span>
                    <input type="password" class="form-control border-start-0" name="re_password"
                        placeholder="Nhập mật khẩu">
                </div>
                <?php echo form_error('re_password', $errors, '<span class="error">', '</span>') ?>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Xác nhận</button>
        </form>
    </div>
    <div class="col-lg-5 d-md-none d-sm-none d-none d-lg-block">
        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/bg-login.png" style="height: 100vh;" alt="">
    </div>
</div>