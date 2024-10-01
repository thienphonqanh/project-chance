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
        <a href="<?php echo _WEB_ROOT; ?>/forgot">Quên mật khẩu</a>
    </div>
    <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">Đăng nhập</button>
    <p class="text-center mt-3 text-dark">Bạn chưa có tài khoản? <a href="<?php echo _WEB_ROOT; ?>/dang-ky">Đăng ký
            ngay</a></p>
</form>