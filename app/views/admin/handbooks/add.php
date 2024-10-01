<div class="p-1">
    <form method="post" enctype="multipart/form-data">
        <div class="text-center shadow-lg p-4 rounded-3">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-start fw-bold text-uppercase">Thông tin bài viết</h4>
                </div>
                <?php
                if (!empty($msg)) :
                    echo '<div class="alert alert-' . $msgType . '">';
                    echo $msg;
                    echo '</div>';
                endif;
                ?>
                <div class="col-12">
                    <div id="avatar-preview" class="mb-3">
                        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/default_post.jpg"
                            class="border border-2" style="width: 120px; height: 120px;" id="avatar-default"
                            alt="Avatar">
                    </div>
                    <input type="file" name="avatar-input" id="avatar-input" accept="image/*" onchange="previewImage()"
                        class="d-none">
                    <label for="avatar-input" class="text-info">Tải ảnh lên<i class="bi bi-arrow-up-short"></i></label>
                    <label onclick="deleteImage('default_post.jpg')" for="delete-image"
                        class="text-danger px-3">Xoá</label>
                    <input style="display: none;" id="delete-image">
                </div>
                <div class="col-12 mt-3">
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control slug" id="floatingInput" name="title"
                            placeholder="name@example.com" value="" />
                        <label for="floatingInput">Tiêu đề <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('title', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control render-slug" id="floatingInput" name="slug"
                            placeholder="name@example.com" value="" />
                        <label for="floatingInput">Đường dẫn <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('slug', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="subCategory" name="sub_category"
                            aria-label="Floating label select example">
                            <option value="0" selected>Chọn danh mục</option>
                        </select>
                        <label for="subCategory">Danh mục phụ<span class="text-danger fw-bold">*</span></label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="mainCategory" name="main_category"
                            aria-label="Floating label select example" onchange="loadSubCategories()">
                            <option value="0" selected>Chọn danh mục</option>
                        </select>
                        <label for="mainCategory">Danh mục <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('main_category', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group text-start">
                        <label for="descr">Mô tả ngắn</label>
                        <textarea name="descr" rows="5" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group text-start">
                        <label for="content">Nội dung bài viết <span class="text-danger fw-bold">*</span></label>
                        <textarea name="content" rows="10" class="form-control editor"></textarea>
                        <?php echo form_error('content', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-12 text-end mt-2">
                    <button type="submit" class="btn btn-primary btn-md px-3">Lưu thay đổi</button>
                    <a href="<?php echo _WEB_ROOT; ?>/handbooks/danh-sach" class="btn btn-md px-4 btn-danger">Quay
                        lại</a>
                </div>
            </div>
        </div>
</div>
</form>
</div>