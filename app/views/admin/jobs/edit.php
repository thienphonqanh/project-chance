<div class="p-1">
    <?php
    if (!empty($dataJob)) :
        foreach ($dataJob as $item) :
    ?>
    <form method="post" enctype="multipart/form-data">
        <div class="text-center shadow-lg p-4 rounded-3">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-start fw-bold text-uppercase">Thông tin việc làm</h4>
                </div>
                <div class="col-6 text-end mb-2">
                    <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-viec-lam/<?php echo $item['slug'] . '-' . $item['id'] . '.html'; ?>"
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
                    <div id="avatar-preview" class="avatar mb-3">
                        <?php
                                $root = _WEB_ROOT;
                                echo (!empty($item['thumbnail'])) ?
                                    '<img src="' . $root . '/' . $item['thumbnail'] . '" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">'
                                    :
                                    '<img src="' . $root . '/public/client/assets/images/default_job.jpg" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                                ?>
                    </div>
                    <input type="file" name="avatar-input" id="avatar-input" accept="image/*" onchange="previewImage()"
                        class="d-none">
                    <label for="avatar-input" class="text-info">Tải ảnh lên<i class="bi bi-arrow-up-short"></i></label>
                    <label onclick="deleteImage('default_job.jpg')" for="delete-image"
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
                <div class="col-12">
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control" id="floatingInput" name="company_name"
                            placeholder="name@example.com" value="<?php echo $item['name'] ?>" />
                        <label for="floatingInput">Công ty <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('company_name', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
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
                        <select class="form-select" id="floatingSelect" name="job_field"
                            aria-label="Floating label select example">
                            <option selected>Chọn</option>
                            <?php
                                    if (!empty($jobField)) :
                                        foreach ($jobField as $subItem) :
                                    ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['jobField'] === $subItem['name'] ? 'selected' : false; ?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach;
                                    endif; ?>
                        </select>
                        <label for="floatingSelect">Lĩnh vực <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('job_field', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control" id="floatingInput" name="salary"
                            placeholder="name@example.com" value="<?php echo $item['salary'] ?>" />
                        <label for="floatingInput">Lương <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('salary', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="rank">
                            <option value="0">Chọn</option>
                            <?php
                                    if (!empty($rank)) :
                                        foreach ($rank as $subItem) :
                                    ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['rank'] === $subItem['id'] ? 'selected' : false; ?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach;
                                    endif; ?>
                        </select>
                        <label for="floatingInput">Cấp bậc <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('rank', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control" id="floatingInput" name="number_recruits"
                            placeholder="name@example.com" value="<?php echo $item['number_recruits'] ?>" />
                        <label for="floatingInput">Số lượng tuyển<span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('number_recruits', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>

                </div>
                <div class="col-6">
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="form_work">
                            <option value="0">Chọn</option>
                            <?php
                                    if (!empty($formWork)) :
                                        foreach ($formWork as $subItem) :
                                    ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['form_work'] === $subItem['id'] ? 'selected' : false; ?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach;
                                    endif; ?>
                        </select>
                        <label for="floatingInput">Hình thức làm việc<span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('form_work', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                            name="location" value="<?php echo $item['location'] ?>" />
                        <label for="floatingInput">Địa điểm <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('location', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com"
                            name="deadline" value="<?php echo $item['deadline'] ?>" />
                        <label for="floatingInput">Hạn nộp <span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('deadline', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="education_required">
                            <option value="0">Chọn</option>
                            <?php
                                    if (!empty($education)) :
                                        foreach ($education as $subItem) :
                                    ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['education_required'] === $subItem['id'] ? 'selected' : false; ?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach;
                                    endif; ?>
                        </select>
                        <label for="floatingInput">Yêu cầu bằng cấp<span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('degree_required', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>

                    <div class="form-floating mb-3 text-start">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example"
                            name="exp_required">
                            <option value="0">Chọn</option>
                            <?php
                                    if (!empty($yearExp)) :
                                        foreach ($yearExp as $subItem) :
                                    ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['exp_required'] === $subItem['id'] ? 'selected' : false; ?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach;
                                    endif; ?>
                        </select>
                        <label for="floatingInput">Yêu cầu kinh nghiệm<span class="text-danger fw-bold">*</span></label>
                        <?php echo form_error('exp_required', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3 text-start">
                        <textarea class="form-control editor" placeholder="Leave a comment here" name="requirement"
                            id="floatingTextarea2" style="height: 200px"><?php echo $item['requirement'] ?></textarea>
                        <label for="floatingTextarea2">Yêu cầu công việc</label>
                        <?php echo form_error('requirement', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3 text-start">
                        <textarea class="form-control editor" placeholder="Leave a comment here" name="welfare"
                            id="floatingTextarea2" style="height: 200px"><?php echo $item['welfare'] ?></textarea>
                        <label for="floatingTextarea2">Phúc lợi</label>
                        <?php echo form_error('welfare', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3 text-start">
                        <textarea class="form-control editor" placeholder="Leave a comment here" id="floatingTextarea2"
                            name="description" style="height: 200px"><?php echo $item['description'] ?></textarea>
                        <label for="floatingTextarea2">Mô tả công việc</label>
                        <?php echo form_error('description', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3 text-start">
                        <textarea class="form-control editor" placeholder="Leave a comment here" id="floatingTextarea2"
                            name="other_info" style="height: 200px"><?php echo $item['other_info'] ?></textarea>
                        <label for="floatingTextarea2">Thông tin khác</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center shadow-lg p-4 rounded-3 mt-3">
            <div class="row">
                <div class="col-12">
                    <h4 class="text-start fw-bold text-uppercase">Thông tin công ty</h4>
                    <h5 class="text-info text-start py-2"><?php echo $item['name']; ?></h5>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="company_location"
                            placeholder="name@example.com" value="<?php echo $item['company_location'] ?>" />
                        <label for="floatingInput">Địa điểm</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="scales"
                            placeholder="name@example.com" value="<?php echo $item['scales'] ?>" />
                        <label for="floatingInput">Quy mô</label>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-floating mb-3">
                        <textarea class="form-control editor" placeholder="Leave a comment here"
                            name="company_description" id="floatingTextarea2"
                            style="height: 200px"><?php echo $item['company_description'] ?></textarea>
                        <label for="floatingTextarea2">Giới thiệu công ty</label>
                    </div>
                </div>
                <div class="col-12 text-end mt-2">
                    <button type="submit" class="btn btn-primary btn-md px-3">Lưu thay đổi</button>
                    <a href="<?php echo _WEB_ROOT; ?>/jobs/danh-sach" class="btn btn-md px-4 btn-danger">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
    <?php endforeach;
    endif; ?>
</div>