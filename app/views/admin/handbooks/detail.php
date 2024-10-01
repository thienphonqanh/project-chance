<div class="p-1">
    <?php 
        if (!empty($dataHandbook)):
            foreach ($dataHandbook as $item):
    ?>
    <form method="">
        <div class="text-center shadow-lg p-4 rounded-3">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-start fw-bold text-uppercase">Thông tin bài viết</h4>
                </div>
                <div class="col-6 text-end">
                    <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>"
                        type="button" class="btn btn-primary px-4">Xem bài viết</a>
                </div>
                <div class="col-12">
                    <?php 
                    $root = _WEB_ROOT;
                    echo (!empty($item['thumbnail'])) ? 
                    '<img src="'.$root.'/'.$item['thumbnail'].'" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">' 
                    :
                    '<img src="'.$root.'/public/client/assets/images/default_post.jpg" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                ?>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control slug" id="floatingInput" disabled name="title"
                            placeholder="name@example.com" value="<?php echo $item['title']; ?>" />
                        <label for="floatingInput">Tiêu đề <span class="text-danger fw-bold">*</span></label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control render-slug" id="floatingInput" disabled name="slug"
                            placeholder="name@example.com" value="<?php echo $item['slug'] ?>" />
                        <label for="floatingInput">Đường dẫn <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" aria-label="Floating label select example" disabled>
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
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" aria-label="Floating label select example" disabled>
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
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group text-start">
                        <label for="descr">Mô tả ngắn</label>
                        <textarea name="descr" rows="5" class="form-control"
                            disabled><?php echo $item['descr'] ?></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group text-start">
                        <label for="content">Nội dung bài viết <span class="text-danger fw-bold">*</span></label>
                        <textarea name="content" rows="10" class="form-control editor"
                            disabled><?php echo $item['content'] ?></textarea>
                    </div>
                </div>
                <div class="col-12 text-start mt-2">
                    <a href="<?php echo _WEB_ROOT; ?>/handbooks/danh-sach" class="btn btn-md px-4 btn-danger">Quay
                        lại</a>
                </div>
            </div>
        </div>
    </form>
    <?php endforeach; endif; ?>
</div>