<form action="" method="post" class="mt-3">
    <div class="form-group mt-3">
        <label for="fullname">Họ và tên</label>
        <div class="input-group w-100">
            <span class="input-group-text p-0 border border-end-0"><i class="bi bi-person p-2 px-3 text-primary"></i></span>
            <input type="text" class="form-control border-start-0" name="fullname" placeholder="Họ và tên" value="<?php echo (!empty(old('fullname', $old))) ? old('fullname', $old) : false ?>">
        </div>
        <?php echo form_error('fullname', $errors, '<span class="error">', '</span>') ?>
    </div>
    <div class="form-group mt-3">
        <label for="email">Email</label>
        <div class="input-group w-100">
            <span class="input-group-text p-0 border border-end-0"><i class="bi bi-envelope p-2 px-3 text-primary"></i></span>
            <input type="email" class="form-control border-start-0" name="email" placeholder="Địa chỉ email" value="<?php echo (!empty(old('email', $old))) ? old('email', $old) : false ?>">
        </div>
        <?php echo form_error('email', $errors, '<span class="error">', '</span>') ?>
    </div>
    <div class="form-group mt-3">
        <label for="phone">Số điện thoại</label>
        <div class="input-group w-100">
            <span class="input-group-text p-0 border border-end-0"><i class="bi bi-envelope p-2 px-3 text-primary"></i></span>
            <input type="text" class="form-control border-start-0" name="phone" placeholder="Số điện thoại" value="<?php echo (!empty(old('phone', $old))) ? old('phone', $old) : false ?>">
        </div>
        <?php echo form_error('phone', $errors, '<span class="error">', '</span>') ?>
    </div>
    <div class="form-group mt-3">
        <label for="password">Mật khẩu</label>
        <div class="input-group w-100">
            <span class="input-group-text p-0 border border-end-0"><i class="bi bi-shield-lock p-2 px-3 text-primary"></i></span>
            <input type="password" class="form-control border-start-0" name="password" placeholder="Nhập mật khẩu">
        </div>
        <?php echo form_error('password', $errors, '<span class="error">', '</span>') ?>
    </div>
    <div class="form-group mt-3">
        <label for="re_password">Xác nhận mật khẩu</label>
        <div class="input-group w-100">
            <span class="input-group-text p-0 border border-end-0"><i class="bi bi-shield-lock p-2 px-3 text-primary"></i></span>
            <input type="password" class="form-control border-start-0" name="re_password" placeholder="Nhập lại mật khẩu">
        </div>
        <?php echo form_error('re_password', $errors, '<span class="error">', '</span>') ?>
    </div>
    <button type="submit" class="btn btn-lg btn-primary w-100 mt-4">Đăng ký</button>

    <p class="text-center mt-3 text-dark">Bạn đã có tài khoản? <a href="<?php echo _WEB_ROOT; ?>/dang-nhap">Đăng nhập
            ngay</a></p>
</form>