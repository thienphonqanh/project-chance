<div class="p-2">
    <form method="" class="text-center shadow-lg p-4 rounded-3">
        <h4 class="text-start">Thông tin cá nhân</h4>
        <div class="row">
            <?php if (!empty($dataProfile)) : ?>
            <div class="col-12">
                <div class="avatar">
                    <?php
                        $root = _WEB_ROOT;
                        echo (!empty($dataProfile['thumbnail'])) ?
                            '<img src="' . $root . '/' . $dataProfile['thumbnail'] . '" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">'
                            :
                            '<img src="' . $root . '/public/client/assets/images/default_image.jpg" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                        ?>
                </div>
                <h6 class="fw-bold mb-3 mt-1">Ảnh đại diện</h6>
            </div>
            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" disabled id="floatingInput" name="name"
                        placeholder="name@example.com" value="<?php echo $dataProfile['name']; ?>">
                    <label for="floatingInput">Tên công ty <span class="text-danger fw-bold">*</span></label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" disabled id="floatingInput" name="fullname"
                        placeholder="name@example.com" value="<?php echo $dataProfile['fullname']; ?>">
                    <label for="floatingInput">Người đại diện <span class="text-danger fw-bold">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" disabled id="floatingInput" name="email"
                        placeholder="name@example.com" value="<?php echo $dataProfile['email']; ?>">
                    <label for="floatingInput">Địa chỉ email <span class="text-danger fw-bold">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" disabled id="floatingInput" name="scales"
                        placeholder="name@example.com" value="<?php echo $dataProfile['scales']; ?>">
                    <label for="floatingInput">Quy mô công ty <span class="text-danger fw-bold">*</span></label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" disabled id="floatingInput" name="phone"
                        placeholder="name@example.com" value="<?php echo $dataProfile['phone']; ?>">
                    <label for="floatingInput">Số điện thoại công ty <span class="text-danger fw-bold">*</span></label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" disabled name="address" id="floatingInput"
                        placeholder="name@example.com" value="<?php echo $dataProfile['location']; ?>">
                    <label for="floatingInput">Địa chỉ (Tên đường, quận/huyện,...)</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" disabled id="floatingSelect" aria-label="Floating label select example">
                        <option value="0">Chọn lĩnh vực</option>
                        <?php
                                if (!empty($jobField)) :
                                    foreach ($jobField as $item) :
                                ?>
                        <option value="<?php echo $item['id'] ?>"
                            <?php echo ($item['id'] == $dataProfile['job_category_id']) ? 'selected' : false; ?>>
                            <?php echo $item['name'] ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                    <label for="floatingSelect">Lĩnh vực kinh doanh <span class="text-danger fw-bold">*</span></label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group text-start">
                    <label for="floatingInput">Giói thiệu công ty</label>
                    <textarea class="form-control editor" placeholder="Giới thiệu công ty" disabled name="description"
                        rows="8"><?php echo $dataProfile['description']; ?></textarea>
                </div>
            </div>
            <div class="col-12 text-start">
                <a href="<?php echo _WEB_ROOT; ?>/groups/nha-tuyen-dung" class="btn btn-md btn-danger">Quay lại</a>
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>