<aside class="sidebar-candidates mb-4">
    <div class="d-flex">
        <?php
        $this->render('block/sidebar_employer', [], 'client');
        ?>
        <form method="post" enctype="multipart/form-data" class="m-auto custom-form-profile">
            <div class="w-100 text-start">
                <h5 class="text-primary">Tạo tin tuyển dụng</span></h5>
            </div>
            <div class="text-center shadow-lg p-4 rounded-3">
                <div class="row">
                    <?php
                    if (!empty($msg)) :
                        echo '<div class="alert alert-' . $msgType . '">';
                        echo $msg;
                        echo '</div>';
                    endif;
                    ?>
                    <div class="col-12">
                        <div
                            class="form-group d-flex align-items-center flex-column flex-sm-row flex-md-row flex-lg-row">
                            <div id="avatar-preview" class="avatar px-3 text-start">
                                <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/default_job.jpg"
                                    style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">
                            </div>
                            <div
                                class="text-center text-sm-start text-md-start text-lg-start mt-3 mt-sm-0 mt-md-0 mt-lg-0">
                                <input type="file" name="avatar-input" id="avatar-input" accept="image/*"
                                    onchange="previewImage()" class="d-none">
                                <label for="avatar-input"
                                    class="text-primary border border-1 px-4 py-2 border-primary rounded-2 btn-upload-avatar"><i
                                        class="bi bi-upload"></i> Tải ảnh lên</label>
                                <label onclick="deleteImage('default_job.jpg')" for="delete-image"
                                    class="text-danger px-3 border border-1 rounded-2 px-4 py-2 border-danger btn-delete-avatar">Xoá</label>
                                <input style="display: none;" id="delete-image">
                                <p class="fw-normal fs-6 mt-2">Chỉ chấp nhận ảnh có định dạng .JPG, .JPEG, .PNG</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-floating mb-3 text-start">
                            <input type="text" class="form-control slug" id="floatingInput" name="title"
                                placeholder="name@example.com" value="" />
                            <label for="floatingInput">Tiêu đề <span class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('title', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating mb-3 text-start">
                            <input type="text" class="form-control" id="floatingInput" disabled name="company_name"
                                placeholder="name@example.com" value="<?php echo getNameEmployerLogin(); ?>" />
                            <label for="floatingInput">Công ty</label>
                            <?php echo form_error('company_name', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-3 text-start">
                            <select class="form-select" id="floatingSelect" name="job_field"
                                aria-label="Floating label select example">
                                <option value="0">Chọn</option>
                                <?php
                                if (!empty($jobField)) :
                                    foreach ($jobField as $item) :
                                ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label for="floatingSelect">Lĩnh vực <span class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('job_field', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <input type="text" class="form-control" id="floatingInput" name="salary"
                                placeholder="name@example.com" value="" />
                            <label for="floatingInput">Lương <span class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('salary', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <select class="form-select" id="floatingSelect" name="rank"
                                aria-label="Floating label select example">
                                <option value="0">Chọn</option>
                                <?php
                                if (!empty($rank)) :
                                    foreach ($rank as $item) :
                                ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label for="floatingInput">Cấp bậc <span class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('rank', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <input type="text" class="form-control" id="floatingInput" name="number_recruits"
                                placeholder="name@example.com" value="" />
                            <label for="floatingInput">Số lượng tuyển<span class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('number_recruits', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <select class="form-select" id="floatingSelect" name="exp_required"
                                aria-label="Floating label select example">
                                <option value="0">Chọn</option>
                                <?php
                                if (!empty($yearExp)) :
                                    foreach ($yearExp as $item) :
                                ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label for="floatingInput">Yêu cầu kinh nghiệm<span
                                    class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('exp_required', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-floating mb-3 text-start">
                            <select class="form-select" id="floatingSelect" name="form_work"
                                aria-label="Floating label select example">
                                <option value="0">Chọn</option>
                                <?php
                                if (!empty($formWork)) :
                                    foreach ($formWork as $item) :
                                ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label for="floatingInput">Hình thức làm việc<span
                                    class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('form_work', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com"
                                name="location" value="" />
                            <label for="floatingInput">Địa điểm <span class="text-secondary">(TP/Tỉnh)</span> <span
                                    class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('location', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <input type="date" class="form-control" id="floatingInput" placeholder="name@example.com"
                                name="deadline" value="" />
                            <label for="floatingInput">Hạn nộp <span class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('deadline', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                        <div class="form-floating mb-3 text-start">
                            <select class="form-select" id="floatingSelect" name="education_required"
                                aria-label="Floating label select example">
                                <option value="0">Chọn</option>
                                <?php
                                if (!empty($education)) :
                                    foreach ($education as $item) :
                                ?>
                                <option value="<?php echo $item['id']; ?>"><?php echo $item['name']; ?></option>
                                <?php endforeach;
                                endif; ?>
                            </select>
                            <label for="floatingInput">Yêu cầu bằng cấp<span
                                    class="text-danger fw-bold">*</span></label>
                            <?php echo form_error('education_required', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-start mb-3">
                            <label for="requirement">Yêu cầu công việc <span
                                    class="text-danger fw-bold">*</span></label>
                            <textarea name="requirement" rows="10" class="form-control editor"></textarea>
                            <?php echo form_error('requirement', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-start mb-3">
                            <label for="welfare">Phúc lợi <span class="text-danger fw-bold">*</span></label>
                            <textarea name="welfare" rows="10" class="form-control editor"></textarea>
                            <?php echo form_error('welfare', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-start mb-3">
                            <label for="description">Mô tả công việc <span class="text-danger fw-bold">*</span></label>
                            <textarea name="description" rows="10" class="form-control editor"></textarea>
                            <?php echo form_error('description', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group text-start mb-3">
                            <label for="other_info">Thông tin khác <span class="text-secondary">(địa điểm làm việc, yêu
                                    cầu kỹ năng...)</span></label>
                            <textarea name="other_info" rows="10" class="form-control editor"></textarea>
                        </div>
                    </div>
                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-md px-3">Lưu thay đổi</button>
                        <a href="<?php echo _WEB_ROOT; ?>/jobs/danh-sach" class="btn btn-md px-4 btn-danger">Quay
                            lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</aside>