<div class="p-1">
    <?php 
        if (!empty($dataHandbook)) :
            foreach ($dataHandbook as $item) :
    ?>
    <form method="post" enctype="multipart/form-data">
        <div class="text-center shadow-lg p-4 rounded-3">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-start fw-bold text-uppercase">Thông tin bài viết</h4>
                </div>
                <div class="col-6 text-end mb-2">
                    <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>"
                        type="button" class="btn btn-primary px-4">Xem trang</a>
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
                        <?php 
                            $root = _WEB_ROOT;
                            echo (!empty($item['thumbnail'])) ? 
                            '<img src="'.$root.'/'.$item['thumbnail'].'" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">' 
                            : 
                            '<img src="'.$root.'/public/client/assets/images/default_post.jpg" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                        ?>
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
                            placeholder="name@example.com" value="<?php echo $item['title'] ?>" />
                        <label for="floatingInput">Tiêu đề <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('title', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control render-slug" id="floatingInput" name="slug"
                            placeholder="name@example.com" value="<?php echo $item['slug'] ?>" />
                        <label for="floatingInput">Đường dẫn <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('slug', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="subCategory" name="sub_category"
                            aria-label="Floating label select example">
                            <?php 
                                if (!empty($allSubCategories)):
                                    foreach ($allSubCategories as $subItem):
                            ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo ($subItem['name'] === $item['sub_category_name']) ? 'selected' : false; ?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        <label for="subCategory">Danh mục phụ <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('sub_category', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="mainCategory" name="main_category"
                            aria-label="Floating label select example" onchange="loadSubCategories()">
                            <option value="0" selected>Chọn danh mục</option>
                            <?php 
                                if (!empty($allCategories)):
                                    foreach ($allCategories as $subItem):
                            ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo ($subItem['name'] === $item['main_category_name']) ? 'selected' : false; ?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        <label for="mainCategory">Danh mục <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('main_category', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group text-start">
                        <label for="descr">Mô tả ngắn</label>
                        <textarea name="descr" rows="5" class="form-control"><?php echo $item['descr'] ?></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group text-start">
                        <label for="content">Nội dung bài viết <span class="text-danger fw-bold">*</span></label>
                        <textarea name="content" rows="10"
                            class="form-control editor"><?php echo $item['content'] ?></textarea>
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
    </form>
    <?php endforeach; endif; ?>
</div>