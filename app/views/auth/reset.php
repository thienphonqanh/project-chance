<form action="" method="post" class="mt-3">
    <div class="form-group">
        <label for="password">Mật khẩu mới</label>
        <div class="input-group mb-2 w-100">
            <span class="input-group-text p-0 border border-end-0"><i
                    class="bi bi-shield-lock p-2 px-3 text-primary"></i></span>
            <input type="password" class="form-control border-start-0" name="password" placeholder="Nhập mật khẩu">
        </div>
        <?php echo form_error('password', $errors, '<span class="error">', '</span>') ?>
    </div>
    <div class="form-group">
        <label for="re_password">Nhập lại mật khẩu</label>
        <div class="input-group mb-2 w-100">
            <span class="input-group-text p-0 border border-end-0"><i
                    class="bi bi-shield-lock p-2 px-3 text-primary"></i></span>
            <input type="password" class="form-control border-start-0" name="re_password" placeholder="Nhập mật khẩu">
        </div>
        <?php echo form_error('re_password', $errors, '<span class="error">', '</span>') ?>
    </div>
    <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Xác nhận</button>
</form>