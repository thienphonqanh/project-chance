<div class="p-2">
    <form method="post" class="text-center shadow-lg p-4 rounded-3" enctype="multipart/form-data">
        <h4 class="text-start">Thông tin cá nhân</h4>
        <?php
        if (!empty($msg)) :
            echo '<div class="alert alert-' . $msgType . '">';
            echo $msg;
            echo '</div>';
        endif;
        ?>
        <div class="row">
            <?php if (!empty($dataProfile)) : ?>
            <div class="col-12">
                <div id="avatar-preview" class="avatar mb-3">
                    <?php 
                            $root = _WEB_ROOT;
                            echo (!empty($dataProfile['thumbnail'])) ? 
                            '<img src="'.$root.'/'.$dataProfile['thumbnail'].'" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">' 
                            : 
                            '<img src="'.$root.'/public/client/assets/images/default_image.jpg" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                        ?>
                </div>
                <input type="file" name="avatar-input" id="avatar-input" accept="image/*" onchange="previewImage()"
                    class="d-none">
                <label for="avatar-input" class="text-info">Tải ảnh lên<i class="bi bi-arrow-up-short"></i></label>
                <label onclick="deleteImage('default_image.jpg')" for="delete-image"
                    class="text-danger px-3">Xoá</label>
                <input style="display: none;" id="delete-image">
            </div>
            <div class="col-12">
                <div class="form-floating mb-3 text-start">
                    <input type="text" class="form-control" id="floatingInput" name="fullname"
                        placeholder="name@example.com" value="<?php echo $dataProfile['fullname']; ?>">
                    <label for="floatingInput">Họ và tên <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('fullname', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3 text-start">
                    <input type="email" class="form-control" id="floatingInput" name="email"
                        placeholder="name@example.com" value="<?php echo $dataProfile['email']; ?>">
                    <label for="floatingInput">Địa chỉ email <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('email', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3 text-start">
                    <input type="date" class="form-control" id="floatingInput" name="dob" placeholder="name@example.com"
                        value="<?php echo $dataProfile['dob']; ?>">
                    <label for="floatingInput">Ngày sinh <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('dob', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3 text-start">
                    <input type="text" class="form-control" id="floatingInput" name="location"
                        placeholder="name@example.com" value="<?php echo $dataProfile['location']; ?>">
                    <label for="floatingInput">Tỉnh/Thành phố hiện tại</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3 text-start">
                    <input type="text" class="form-control" id="floatingInput" name="phone"
                        placeholder="name@example.com" value="<?php echo $dataProfile['phone']; ?>">
                    <label for="floatingInput">Số điện thoại <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('phone', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" name="gender" id="floatingSelect">
                        <option selected>Chọn giới tính</option>
                        <option value="1" <?php echo $dataProfile['gender'] === 1 ? 'selected' : false; ?>>Nam</option>
                        <option value="2" <?php echo $dataProfile['gender'] === 2 ? 'selected' : false; ?>>Nữ</option>
                        <option value="3" <?php echo $dataProfile['gender'] === 3 ? 'selected' : false; ?>>Khác</option>
                    </select>
                    <label for="floatingSelect">Giới tính</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="address" id="floatingInput"
                        placeholder="name@example.com" value="<?php echo $dataProfile['address']; ?>">
                    <label for="floatingInput">Địa chỉ (Tên đường, quận/huyện,...)</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="contact_facebook" id="floatingInput"
                        placeholder="name@example.com" value="<?php echo $dataProfile['contact_facebook']; ?>">
                    <label for="floatingInput">Link Facebook</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="contact_twitter" id="floatingInput"
                        placeholder="name@example.com" value="<?php echo $dataProfile['contact_twitter']; ?>">
                    <label for="floatingInput">Link Twitter</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="contact_linkedin" id="floatingInput"
                        placeholder="name@example.com" value="<?php echo $dataProfile['contact_linkedin']; ?>">
                    <label for="floatingInput">Link LinkedIn</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Giới thiệu bản thân" name="about_content"
                        rows="8"><?php echo $dataProfile['about_content']; ?></textarea>
                </div>
            </div>
            <div class="col-12 text-start">
                <a href="<?php echo _WEB_ROOT; ?>/groups/ung-vien" class="btn btn-md btn-danger">Quay lại</a>
                <button type="submit" class="btn btn-primary btn-md">Lưu thay đổi</button>
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>