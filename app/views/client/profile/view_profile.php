<aside class="sidebar-candidates mb-4">
    <div class="d-flex">
        <?php  
        $this->render('block/sidebar_candidate', [], 'client');
    ?>
        <?php if (!empty($profileInformation)): ?>
        <div class="mx-lg-4 mx-md-3 mx-sm-3 mx-3 custom-form-profile">
            <div class="mt-2 w-100 text-start">
                <h4>Hồ sơ của bạn</h4>
                <div>
                    <p class="text-secondary fs-6 fw-semibold">Hồ sơ đính kèm</p>
                    <div class="shadow rounded-2 p-2">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="d-flex align-items-center justify-content-around">
                                    <?php 
                                $fileType = checkFileType($profileInformation['cv_file']);
                                if (!empty($fileType)):
                                    if ($fileType == 'pdf'):
                            ?>
                                    <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/pdf-file-type.svg"
                                        style="width: 60px; height: 60px;" alt="">
                                    <?php elseif ($fileType == 'doc'): ?>
                                    <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/doc-icon.png"
                                        style="width: 60px; height: 60px;" alt="">
                                    <?php elseif ($fileType == 'docx'): ?>
                                    <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/docx-icon.png"
                                        style="width: 60px; height: 60px;" alt="">
                                    <?php endif; endif; ?>
                                    <h6 class="m-0 p-0 special-content-1 w-50">
                                        <?php echo $profileInformation['job_desired'] ?></h6>
                                    <?php 
                                    if ($profileInformation['status'] === 0) :
                                ?>
                                    <button type="button" class="btn btn-warning p-0 px-lg-3 px-md-2 px-sm-1 px-1">Chờ
                                        duyệt</button>
                                    <?php elseif ($profileInformation['status'] === 1) :?>
                                    <button type="button" class="btn btn-success p-0 px-lg-3 px-md-2 px-sm-1 px-1">Đã
                                        duyệt</button>
                                    <?php else: ?>
                                    <button type="button" class="btn btn-danger p-0 px-lg-3 px-md-2 px-sm-1 px-1">Bị
                                        loại</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6 ms-lg-auto mt-md-2 mt-sm-2 mt-lg-0 mt-2">
                                <div class="d-flex align-items-center flex-wrap justify-content-around">
                                    <p
                                        class="text-secondary px-3 m-0 fw-normal fs-6 border-end border-lg-start border-2">
                                        Lượt xem: <span
                                            class="text-dark"><?php echo $profileInformation['view_count'] ?></span></p>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked" checked>
                                        <label class="form-check-label text-secondary border-2 border-end pe-4"
                                            for="flexSwitchCheckChecked">Cho phép tìm kiếm</label>
                                    </div>
                                    <a type="button"
                                        href="<?php echo _WEB_ROOT; ?>/quan-ly-ho-so/sua-ho-so?id=<?php echo $profileInformation['id']; ?>"
                                        class="btn border-primary text-primary px-4 py-2 custom-btn-profile mt-sm-2 mt-md-2 mt-2 mt-lg-0"><i
                                            class="bi bi-pencil"></i>
                                        Cập nhật hồ sơ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow rounded-2 mt-4 p-3">
                <h3><i class="bi bi-lightbulb text-primary"></i> Việc làm gợi ý</h3>
                <div class="row">
                    <?php 
                        if (!empty($sameJobFieldData)):
                            foreach ($sameJobFieldData as $subItem):
                    ?>
                    <div class="col-lg-6 d-flex flex-column">
                        <a
                            href="<?php echo _WEB_ROOT; ?>/chi-tiet-viec-lam/<?php echo $subItem['slug'].'-'.$subItem['id'].'.html'; ?>">
                            <div class="d-flex shadow p-2 rounded border mt-3 text-dark">
                                <div>
                                    <img width="35px" height="32px" class="border rounded"
                                        src="<?php echo _WEB_ROOT.'/'.$subItem['thumbnail'] ?>" alt="">
                                </div>
                                <div class="special-span ms-2">
                                    <span
                                        class="fs-6 fw-semibold special-content-1"><?php echo $subItem['title'] ?></span>
                                    <span class="fs-6 special-content-1"><?php echo $subItem['name'] ?></span>
                                    <div class="d-flex mt-1">
                                        <i class="text-primary bi bi-geo-alt"></i>
                                        <p class="fs-6 fw-semibold ms-2 m-0 special-content-1">
                                            <?php echo $subItem['location'] ?></p>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <i class="text-primary bi bi-currency-dollar"></i>
                                        <p class="fs-6 fw-semibold ms-2 m-0"><?php echo $subItem['salary'] ?></p>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <i class="text-primary bi bi-suitcase-lg"></i>
                                        <p class="fs-6 fw-semibold ms-2 m-0"><?php echo $subItem['exp_required'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</aside>