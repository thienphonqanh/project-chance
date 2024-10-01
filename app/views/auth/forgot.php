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