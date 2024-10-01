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
                            '<img src="' . $root . '/' . $dataProfile['thumbnail'] . '" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">'
                            :
                            '<img src="' . $root . '/public/client/assets/images/default_image.jpg" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
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
                    <input type="text" class="form-control" id="floatingInput" name="name"
                        placeholder="name@example.com" value="<?php echo $dataProfile['name']; ?>">
                    <label for="floatingInput">Tên công ty <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('name', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3 text-start">
                    <input type="text" class="form-control" id="floatingInput" name="fullname"
                        placeholder="name@example.com" value="<?php echo $dataProfile['fullname']; ?>">
                    <label for="floatingInput">Người đại diện <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('fullname', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3 text-start">
                    <input type="email" class="form-control" id="floatingInput" name="email"
                        placeholder="name@example.com" value="<?php echo $dataProfile['email']; ?>">
                    <label for="floatingInput">Địa chỉ email <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('email', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3 text-start">
                    <input type="text" class="form-control" id="floatingInput" name="scales"
                        placeholder="name@example.com" value="<?php echo $dataProfile['scales']; ?>">
                    <label for="floatingInput">Quy mô công ty <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('scales', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3 text-start">
                    <input type="text" class="form-control" id="floatingInput" name="phone"
                        placeholder="name@example.com" value="<?php echo $dataProfile['phone']; ?>">
                    <label for="floatingInput">Số điện thoại công ty <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('phone', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3 text-start">
                    <input type="text" class="form-control" name="address" id="floatingInput"
                        placeholder="name@example.com" value="<?php echo $dataProfile['location']; ?>">
                    <label for="floatingInput">Địa chỉ (Tên đường, quận/huyện,...) <span
                            class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('address', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="form-floating mb-3 text-start">
                    <select class="form-select" id="floatingSelect" name="job_field"
                        aria-label="Floating label select example">
                        <option value="0">Chọn lĩnh vực</option>
                        <?php
                            if (!empty($jobField)) :
                                foreach ($jobField as $item) :
                            ?>
                        <option value="<?php echo $item['id'] ?>"
                            <?php echo ($item['id'] == $dataProfile['job_category_id']) ? 'selected' : false; ?>>
                            <?php echo $item['name'] ?></option>
                        <?php endforeach;
                            endif; ?>
                    </select>
                    <label for="floatingSelect">Lĩnh vực kinh doanh <span class="text-danger fw-bold">*</span></label>
                    <?php echo form_error('job_field', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group text-start">
                    <label for="floatingInput">Giói thiệu công ty</label>
                    <textarea class="form-control editor" placeholder="Giới thiệu công ty" name="description"
                        rows="8"><?php echo $dataProfile['description']; ?></textarea>
                </div>
            </div>
            <div class="col-12 text-start">
                <a href="<?php echo _WEB_ROOT; ?>/groups/nha-tuyen-dung" class="btn btn-md btn-danger">Quay lại</a>
                <button type="submit" class="btn btn-primary btn-md">Lưu thay đổi</button>
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>