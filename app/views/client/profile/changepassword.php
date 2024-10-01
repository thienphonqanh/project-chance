<section class="section-main p-lg-3">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-7 col-md-12 col-sm-12 col-12 mx-lg-5">
                <p class="fw-bold">Thay đổi mật khẩu đăng nhập</p>
                <div class="shadow-lg rounded-3 p-4">
                    <?php
                    if (!empty($msg)) :
                        echo '<div class="alert alert-' . $msgType . '">';
                        echo $msg;
                        echo '</div>';
                    endif;
                    ?>
                    <form action="" method="post" class="text-end">
                        <div class="form-group py-2">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-lg-end text-md-end text-sm-end text-start">
                                    <label for="email">Email đăng nhập</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input type="email" name="email" class="form-control" value="<?php echo getEmailUserLogin(); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-lg-end text-md-end text-sm-end text-start">
                                    <label for="old_password">Mật khẩu hiện tại</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input type="password" name="old_password" class="form-control">
                                    <?php echo form_error('old_password', $errors, '<span class="error">', '</span>') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-lg-end text-md-end text-sm-end text-start">
                                    <label for="new_password">Mật khẩu mới</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input type="password" name="new_password" class="form-control">
                                    <?php echo form_error('new_password', $errors, '<span class="error">', '</span>') ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group py-2">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-lg-end text-md-end text-sm-end text-start">
                                    <label for="confirm_new_password">Nhập lại mật khẩu mới</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-12">
                                    <input type="password" name="confirm_new_password" class="form-control">
                                    <?php echo form_error('confirm_new_password', $errors, '<span class="error">', '</span>') ?>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-5 mt-2">Lưu</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 d-lg-block d-md-none d-sm-none d-none">
                <div class="shadow-lg text-center rounded-3">
                    <div class="avatar-profile-edit text-center p-3">
                        <img src="<?php echo _WEB_ROOT . '/' . getAvatarUserLogin(); ?>" height="100px" width="100px" class="avatar" alt="">
                    </div>
                    <p class="bg-secondary w-50 m-auto text-white rounded-5">Tài khoản đã xác thực</p>
                    <h6 class="py-3"><?php echo getNameUserLogin(); ?></h6>
                </div>
            </div>
        </div>
    </div>
</section>