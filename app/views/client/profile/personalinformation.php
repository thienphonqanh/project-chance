<aside class="sidebar-candidates mb-4">
    <div class="d-flex">
        <?php
        $this->render('block/sidebar_candidate', [], 'client');
        ?>
        <?php if (!empty($information)) : ?>
            <form method="post" class="m-auto custom-form-profile" enctype="multipart/form-data">
                <div class="w-100 text-start">
                    <h5 class="text-secondary">Xin chào, <span class="text-dark"><?php echo $information['fullname']; ?></span></h5>
                </div>
                <?php
                if (!empty($msg)) :
                    echo '<div class="alert alert-' . $msgType . '">';
                    echo $msg;
                    echo '</div>';
                endif;
                ?>
                <div class="shadow p-2 rounded-2">
                    <h5 class="p-0 m-0 py-1 px-2 py-md-2 px-md-4 py-sm-2 px-sm-4 py-lg-2 px-lg-4">Thông tin đăng ký</h5>
                    <hr class="p-0 m-0">
                    <div class="form-group row align-items-center py-lg-4 py-md-3 py-sm-2 py-2 px-2 px-sm-4 px-md-4 px-lg-0">
                        <div class="col-lg-2 col-md-12 col-sm-12 col-12 text-lg-center text-sm-start text-md-start text-start">
                            <label for="email" class="w-25 fw-semibold">Email</label>
                        </div>
                        <div class="col-lg-7">
                            <div class="input-group custom-input-profile mt-lg-0 mt-sm-1 mt-md-1 mt-1">
                                <input type="email" name="email" class="form-control border-0 old-email" value="<?php echo $information['email']; ?>" disabled>
                                <span class="input-group-text p-0 m-0 px-2" style="background-color: #e9ecef;"><i class="text-primary bi bi-check-circle"></i></span>
                            </div>

                            <div class="form-group custom-input-profile">
                                <input type="email" name="email" class="form-control input-edit-email border-1 border-primary mt-3" style="display: none;" value="<?php echo $information['email']; ?>">
                                <?php
                                if (!empty(form_error('email', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>'))) :
                                ?>
                                    <input type="email" name="email" class="form-control border-1 border-primary mt-3" value="<?php echo $information['email']; ?>">
                                <?php endif; ?>
                                <?php echo form_error('email', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                            </div>
                        </div>
                        <div class="col-lg-3 mt-lg-0 mt-sm-3 mt-md-3 mt-3">
                            <button class="btn border border-primary text-primary custom-btn-profile" type="button" onclick="editEmail()"><i class="bi bi-pencil"></i> Sửa email</button>
                            <br>
                            <button class="btn border border-danger text-danger mt-3 btn-cancer-edit custom-btn-profile" type="button" style="display: none;" onclick="cancerEditEmail()"><i class="bi bi-trash"></i>
                                Huỷ</button>
                        </div>
                    </div>
                </div>
                <div class="shadow p-2 rounded-2 mt-3">
                    <h5 class="p-0 m-0 py-1 px-2 py-md-2 px-md-4 py-sm-2 px-sm-4 py-lg-2 px-lg-4">Thông tin cá nhân</h5>
                    <hr class="p-0 m-0">
                    <p class="fw-semibold text-dark fs-6 p-0 px-lg-4 px-md-4 px-sm-4 px-2 mt-3">Ảnh đại diện</p>
                    <div class="form-group d-flex align-items-center flex-column flex-sm-row flex-md-row flex-lg-row">
                        <div id="avatar-preview" class="avatar px-3 text-start">
                            <?php
                            $root = _WEB_ROOT;
                            echo (!empty($information['thumbnail'])) ?
                                '<img src="' . $root . '/' . $information['thumbnail'] . '" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">'
                                :
                                '<img src="' . $root . '/public/client/assets/images/4259794-200.png" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                            ?>
                        </div>
                        <div class="text-center text-sm-start text-md-start text-lg-start mt-3 mt-sm-0 mt-md-0 mt-lg-0">
                            <input type="file" name="avatar-input" id="avatar-input" accept="image/*" onchange="previewImage()" class="d-none">
                            <label for="avatar-input" class="text-primary border border-1 px-4 py-2 border-primary rounded-2 btn-upload-avatar"><i class="bi bi-upload"></i> Tải ảnh lên</label>
                            <label onclick="deleteImage('4259794-200.png')" for="delete-image" class="text-danger px-3 border border-1 rounded-2 px-4 py-2 border-danger btn-delete-avatar">Xoá</label>
                            <input style="display: none;" id="delete-image">
                            <p class="fw-normal fs-6 mt-2">Chỉ chấp nhận ảnh có định dạng .JPG, .JPEG, .PNG</p>
                        </div>
                    </div>
                    <hr width="95%" class="m-auto mt-4">
                    <div class="row p-lg-4 p-md-3 p-sm-2 p-1 mt-lg-0 mt-md-2 mt-sm-2 mt-2">
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="fullname" class="fw-semibold mb-2">Họ và tên</label>
                                <input type="text" class="form-control" name="fullname" value="<?php echo $information['fullname']; ?>">
                                <?php echo form_error('fullname', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="location" class="fw-semibold mb-2">Tỉnh/Thành phố</label>
                                <input type="text" class="form-control" name="location" value="<?php echo $information['location']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="gender" class="fw-semibold mb-2">Giới tính</label>
                                <select name="gender" class="form-control">
                                    <option value="1" <?php echo ($information['gender'] == '1') ? 'selected' : ''; ?>>
                                        Nam</option>
                                    <option value="2" <?php echo ($information['gender'] == '2') ? 'selected' : ''; ?>>
                                        Nữ</option>
                                    <option value="3" <?php echo ($information['gender'] == '3') ? 'selected' : ''; ?>>
                                        Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="dob" class="fw-semibold mb-2">Ngày sinh</label>
                                <input type="date" class="form-control" name="dob" value="<?php echo $information['dob']; ?>">
                                <?php echo form_error('dob', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="address" class="fw-semibold mb-2">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $information['address']; ?>">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="fw-semibold mb-2">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone" value="<?php echo $information['phone']; ?>">
                                <?php echo form_error('phone', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="contact_facebook" class="fw-semibold mb-2">Link Facebook</label>
                                <input type="text" class="form-control" name="contact_facebook" value="<?php echo $information['contact_facebook']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="contact_twitter" class="fw-semibold mb-2">Link Twitter</label>
                                <input type="text" class="form-control" name="contact_twitter" value="<?php echo $information['contact_twitter']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="contact_linkedin" class="fw-semibold mb-2">Link LinkedIn</label>
                                <input type="text" class="form-control" name="contact_linkedin" value="<?php echo $information['contact_linkedin']; ?>">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label for="about_content" class="fw-semibold mb-2">Giới thiệu bản thân</label>
                                <textarea name="about_content" rows="6" class="form-control"><?php echo $information['about_content']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 text-end mt-3">
                            <button type="submit" class="btn border border-1 border-primary py-2 px-5 text-primary btn-save-info custom-btn-profile">Lưu
                                thông tin</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</aside>