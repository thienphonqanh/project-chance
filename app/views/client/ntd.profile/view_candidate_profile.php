<aside class="sidebar-candidates mb-4">
    <div class="d-flex">
        <?php
        $this->render('block/sidebar_employer', [], 'client');
        ?>
        <?php if (!empty($information)) :
            foreach ($information as $item) :
        ?>
                <form method="post" class="m-auto custom-form-profile" enctype="multipart/form-data">
                    <?php
                    if (!empty($msg)) :
                        echo '<div class="alert alert-' . $msgType . '">';
                        echo $msg;
                        echo '</div>';
                    endif;
                    ?>
                    <div class="shadow p-2 rounded-2">
                        <h5 class="p-0 m-0 py-1 px-2 py-md-2 px-md-4 py-sm-2 px-sm-4 py-lg-2 px-lg-4">Tải CV đính kèm</h5>
                        <hr class="p-0 m-0">
                        <div class="form-group mx-lg-4 mx-md-3 mx-sm-2 mx-1">
                            <div class="d-flex align-items-center mt-2">
                                <p id="file-name" class="m-0 p-0 text-success rounded-2 py-lg-1 px-lg-2 px-md-2 py-md-1 px-sm-2 py-sm-1 px-2 py-1 special-content-1">
                                    <?php echo !empty($profileInformation) ? $profileInformation['file_name'] : ''; ?></p>
                                <button id="delete-button-cv" type="button" onclick="deleteFile()" style="display: none;" class="btn text-danger fs-5"><i class="bi bi-trash p-2 pb-1 rounded-2" style="background-color: rgb(236, 218, 225);"></i></button>
                            </div>
                            <a type="button" href="<?php echo _WEB_ROOT; ?>/jobs/ho-so-ung-vien/xem-cv?id=<?php echo !empty($profileInformation) ? $profileInformation['id'] : ''; ?>" class="text-primary border border-1 px-4 py-2 border-primary rounded-2 text-center"><i class="bi bi-eye"></i> Xem file</a>
                        </div>
                    </div>

                    <div class="shadow p-2 rounded-2 mt-3">
                        <h5 class="p-0 m-0 py-1 px-2 py-md-2 px-md-4 py-sm-2 px-sm-4 py-lg-2 px-lg-4">Thông tin cá nhân</h5>
                        <hr class="p-0 m-0">
                        <div class="form-group text-center mt-3">
                            <div id="avatar-preview" class="avatar px-3">
                                <?php
                                $root = _WEB_ROOT;
                                echo (!empty($item['thumbnail'])) ?
                                    '<img src="' . $root . '/' . $item['thumbnail'] . '" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">'
                                    :
                                    '<img src="' . $root . '/public/client/assets/images/4259794-200.png" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                                ?>
                            </div>
                        </div>
                        <p class="fw-semibold text-dark fs-6 p-0 mt-2 text-center">Ảnh đại diện</p>

                        <hr width="95%" class="m-auto mt-3">
                        <div class="row p-lg-4 p-md-3 p-sm-2 p-1 mt-2 mt-md-2 mt-sm-2 mt-lg-0">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="fullname" class="fw-semibold mb-2">Họ và tên</label>
                                    <input type="text" class="form-control" name="fullname" value="<?php echo $item['fullname']; ?>" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="location" class="fw-semibold mb-2">Tỉnh/Thành phố</label>
                                    <input type="text" class="form-control" name="location" value="<?php echo $item['location']; ?>" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gender" class="fw-semibold mb-2">Giới tính</label>
                                    <select name="gender" class="form-control" disabled>
                                        <option value="1" <?php echo ($item['gender'] == '1') ? 'selected' : ''; ?>>
                                            Nam</option>
                                        <option value="2" <?php echo ($item['gender'] == '2') ? 'selected' : ''; ?>>
                                            Nữ</option>
                                        <option value="3" <?php echo ($item['gender'] == '3') ? 'selected' : ''; ?>>
                                            Khác</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="dob" class="fw-semibold mb-2">Ngày sinh</label>
                                    <input type="date" class="form-control" name="dob" value="<?php echo $item['dob']; ?>" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address" class="fw-semibold mb-2">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" value="<?php echo $item['address']; ?>" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="phone" class="fw-semibold mb-2">Số điện thoại</label>
                                    <input type="text" class="form-control" name="phone" value="<?php echo $item['phone']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="contact_facebook" class="fw-semibold mb-2">Link Facebook</label>
                                    <input type="text" class="form-control" name="contact_facebook" disabled value="<?php echo $item['contact_facebook']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="contact_twitter" class="fw-semibold mb-2">Link Twitter</label>
                                    <input type="text" class="form-control" name="contact_twitter" disabled value="<?php echo $item['contact_twitter']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="contact_linkedin" class="fw-semibold mb-2">Link LinkedIn</label>
                                    <input type="text" class="form-control" name="contact_linkedin" disabled value="<?php echo $item['contact_linkedin']; ?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label for="about_content" class="fw-semibold mb-2">Giới thiệu bản thân</label>
                                    <textarea name="about_content" rows="6" class="form-control" disabled><?php echo $item['about_content']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="shadow p-2 rounded-2 mt-3">
                        <h5 class="p-0 m-0 py-1 px-2 py-md-2 px-md-4 py-sm-2 px-sm-4 py-lg-2 px-lg-4">Thông tin chung</h5>
                        <hr class="p-0 m-0">
                        <div class="row p-lg-4 p-md-3 p-sm-2 p-1 mt-2 mt-sm-2 mt-md-2 mt-lg-0">
                            <?php if (!empty($profileInformation)) : ?>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="job_desired" class="fw-semibold mb-2">Vị trí mong muốn</label>
                                        <input type="text" class="form-control" disabled name="job_desired" placeholder="E.g. Nhân viên kinh doanh" value="<?php echo $profileInformation['job_desired'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="job_field" class="fw-semibold mb-2">Nghề nghiệp</label>
                                        <select class="form-select" name="job_field" disabled>
                                            <option value="0">Chọn</option>
                                            <?php
                                            if (!empty($jobField)) :
                                                foreach ($jobField as $item) :
                                            ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($profileInformation['job_category_id'] === $item['id']) ? 'selected' : false; ?>>
                                                        <?php echo $item['name']; ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="current_rank" class="fw-semibold mb-2">Cấp bậc hiện tại</label>
                                        <select class="form-select" name="current_rank" disabled>
                                            <option value="0">Chọn</option>
                                            <?php
                                            if (!empty($rank)) :
                                                foreach ($rank as $item) :
                                            ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($profileInformation['current_rank'] === $item['id']) ? 'selected' : false; ?>>
                                                        <?php echo $item['name']; ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="academic_level" class="fw-semibold mb-2">Trình độ học vấn</label>
                                        <select class="form-select" name="academic_level" disabled>
                                            <option value="0">Chọn</option>
                                            <?php
                                            if (!empty($education)) :
                                                foreach ($education as $item) :
                                            ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($profileInformation['academic_level'] === $item['id']) ? 'selected' : false; ?>>
                                                        <?php echo $item['name']; ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group mb-3">
                                        <label for="form_work" class="fw-semibold mb-2">Hình thức làm việc</label>
                                        <select class="form-select" name="form_work" disabled>
                                            <option value="0">Chọn</option>
                                            <?php
                                            if (!empty($formWork)) :
                                                foreach ($formWork as $item) :
                                            ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($profileInformation['form_work'] === $item['id']) ? 'selected' : false; ?>>
                                                        <?php echo $item['name']; ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="rank_desired" class="fw-semibold mb-2">Cấp bậc mong muốn</label>
                                        <select class="form-select" name="rank_desired" disabled>
                                            <option value="0">Chọn</option>
                                            <?php
                                            if (!empty($rank)) :
                                                foreach ($rank as $item) :
                                            ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($profileInformation['rank_desired'] === $item['id']) ? 'selected' : false; ?>>
                                                        <?php echo $item['name']; ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="year_experience" class="fw-semibold mb-2">Số năm kinh nghiệm</label>
                                        <select class="form-select" name="year_experience" disabled>
                                            <option value="0">Chọn</option>
                                            <?php
                                            if (!empty($yearExp)) :
                                                foreach ($yearExp as $item) :
                                            ?>
                                                    <option value="<?php echo $item['id']; ?>" <?php echo ($profileInformation['year_experience'] === $item['id']) ? 'selected' : false; ?>>
                                                        <?php echo $item['name']; ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mb-3">
                                        <label for="skills" class="fw-semibold mb-2">Kỹ năng cứng & mềm <span class="text-secondary">(không bắt buộc)</span></label>
                                        <input type="text" class="form-control" disabled name="skills" placeholder="Nhập tên kỹ năng mềm hoặc cứng, (phân cách bởi dấu phẩy)" value="<?php echo $profileInformation['skills'] ?>">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-end mt-2">
                                    <a class="btn btn-danger px-5 rounded-3 py-2" href="<?php echo _WEB_ROOT; ?>/ntd/quan-ly-ung-vien/ho-so-ung-tuyen">Quay lại</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
        <?php endforeach;
        endif; ?>
    </div>
</aside>