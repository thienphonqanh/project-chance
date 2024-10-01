<div class="p-1">
    <?php
    if (!empty($dataJob)) :
        foreach ($dataJob as $item) :
    ?>
    <form method="">
        <div class="text-center shadow-lg p-4 rounded-3">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-start fw-bold text-uppercase">Thông tin việc làm</h4>
                </div>
                <div class="col-6 text-end">
                    <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-viec-lam/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>"
                        type="button" class="btn btn-primary px-4">Xem trang</a>
                </div>
                <div class="col-12">
                    <div class="avatar">
                        <?php 
                            $root = _WEB_ROOT;
                            echo (!empty($item['thumbnail'])) ? 
                            '<img src="'.$root.'/'.$item['thumbnail'].'" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">' 
                            :
                            '<img src="'.$root.'/public/client/assets/images/default_job.jpg" style="width: 130px; height: 130px;" id="avatar-default" alt="Avatar">';
                        ?>
                    </div>
                    <h6 class="fw-bold mb-3 mt-1">Ảnh việc làm</h6>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-floating mb-3">
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['title'] ?>" />
                        <label for="floatingInput">Tiêu đề <span class="text-danger fw-bold">*</span></label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating mb-3">
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['name'] ?>" />
                        <label for="floatingInput">Công ty <span class="text-danger fw-bold">*</span></label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['slug'] ?>" />
                        <label for="floatingInput">Đường dẫn <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" disabled id="floatingSelect"
                            aria-label="Floating label select example">
                            <option value="0">Chọn</option>
                            <?php 
                                if (!empty($jobField)): 
                                    foreach ($jobField as $subItem):
                            ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['jobField'] === $subItem['name'] ? 'selected' : false;?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        <label for="floatingSelect">Lĩnh vực <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['salary'] ?>" />
                        <label for="floatingInput">Lương <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" disabled id="floatingSelect"
                            aria-label="Floating label select example">
                            <option value="0">Chọn</option>
                            <?php 
                                if (!empty($rank)): 
                                    foreach ($rank as $subItem):
                            ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['rank'] === $subItem['id'] ? 'selected' : false;?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        <label for="floatingInput">Cấp bậc <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['number_recruits'] ?>" />
                        <label for="floatingInput">Số lượng tuyển
                            <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control editor" disabled placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 200px"><?php echo $item['requirement'] ?></textarea>
                        <label for="floatingTextarea2">Yêu cầu công việc</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control editor" disabled placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 200px"><?php echo $item['welfare'] ?></textarea>
                        <label for="floatingTextarea2">Phúc lợi</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <select class="form-select" disabled id="floatingSelect"
                            aria-label="Floating label select example">
                            <option value="0">Chọn</option>
                            <?php 
                                if (!empty($formWork)): 
                                    foreach ($formWork as $subItem):
                            ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['form_work'] === $subItem['id'] ? 'selected' : false;?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        <label for="floatingInput">Hình thức làm việc
                            <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['location'] ?>" />
                        <label for="floatingInput">Địa điểm <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="date" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['deadline'] ?>" />
                        <label for="floatingInput">Hạn nộp <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" disabled id="floatingSelect"
                            aria-label="Floating label select example">
                            <option value="0">Chọn</option>
                            <?php 
                                if (!empty($education)): 
                                    foreach ($education as $subItem):
                            ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['education_required'] === $subItem['id'] ? 'selected' : false;?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        <label for="floatingInput">Yêu cầu bằng cấp
                            <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" disabled id="floatingSelect"
                            aria-label="Floating label select example">
                            <option value="0">Chọn</option>
                            <?php 
                                if (!empty($yearExp)): 
                                    foreach ($yearExp as $subItem):
                            ?>
                            <option value="<?php echo $subItem['id']; ?>"
                                <?php echo $item['exp_required'] === $subItem['id'] ? 'selected' : false;?>>
                                <?php echo $subItem['name']; ?>
                            </option>
                            <?php endforeach; endif; ?>
                        </select>
                        <label for="floatingInput">Yêu cầu kinh nghiệm
                            <span class="text-danger fw-bold">*</span></label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control editor" disabled placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 200px"><?php echo $item['description'] ?></textarea>
                        <label for="floatingTextarea2">Mô tả công việc</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control editor" disabled placeholder="Leave a comment here"
                            id="floatingTextarea2" style="height: 200px"><?php echo $item['other_info'] ?></textarea>
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
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['company_location'] ?>" />
                        <label for="floatingInput">Địa điểm</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating mb-3">
                        <input type="text" disabled class="form-control" id="floatingInput"
                            placeholder="name@example.com" value="<?php echo $item['scales'] ?>" />
                        <label for="floatingInput">Quy mô</label>
                    </div>
                </div>
                <div class="col-12 mt-3">
                    <div class="form-floating mb-3">
                        <textarea class="form-control editor" disabled placeholder="Leave a comment here"
                            id="floatingTextarea2"
                            style="height: 200px"><?php echo $item['company_description'] ?></textarea>
                        <label for="floatingTextarea2">Giới thiệu công ty</label>
                    </div>
                </div>
                <div class="col-12 text-start">
                    <a href="<?php echo _WEB_ROOT; ?>/jobs/danh-sach" class="btn btn-md px-4 btn-danger">Quay lại</a>
                </div>
            </div>
        </div>
    </form>
    <?php endforeach;
    endif; ?>
</div>