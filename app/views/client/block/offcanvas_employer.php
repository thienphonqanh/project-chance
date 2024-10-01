<aside>
    <div class="offcanvas offcanvas-end w-75 p-md-2 p-sm-2 p-1" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions2" aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header sidebar-candidates-header w-100 rounded-2 mb-3">
            <h5 class="offcanvas-title fw-normal" id="offcanvasWithBothOptionsLabel"><i class="text-primary bi bi-person-circle fs-4 me-1"></i> <?php echo getNameEmployerLogin(); ?></h5>
        </div>
        <div class="offcanvas-body w-100 p-0">
            <ul class="p-0 m-0">
                <li>
                    <div class="d-inline-flex gap-1 p-0">
                        <a class="btn border border-0 p-0 m-0 px-3 py-2 fw-bold text-dark" data-bs-toggle="collapse" href="#collapseExample-1" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-chevron-down"></i> Quản lý tài khoản
                        </a>
                    </div>
                    <div class="collapse show" id="collapseExample-1">
                        <ul class="p-0 m-0 px-2 rounded-1">
                            <li class="py-1 <?php echo (handleActiveSidebarEmployer('quan-ly-tai-khoan', 'tai-khoan') ? 'active' : false) ?>">
                                <a href="<?php echo _WEB_ROOT; ?>/ntd/quan-ly-tai-khoan/tai-khoan" class="text-dark fw-normal fs-6 mx-3">
                                    <i class="bi bi-people-fill text-primary"></i> Tài khoản nhà tuyển dụng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="d-inline-flex gap-1 p-0">
                        <a class="btn border border-0 p-0 m-0 px-3 py-2 fw-bold text-dark" data-bs-toggle="collapse" href="#collapseExample-2" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-chevron-down"></i> Quản lý đăng tuyển
                        </a>
                    </div>
                    <div class="collapse show" id="collapseExample-2">
                        <ul class="p-0 m-0 px-2 rounded-1">
                            <li class="py-1 <?php echo (handleActiveSidebarEmployer('quan-ly-dang-tuyen', 'tao-tin') ? 'active' : false) ?>">
                                <a href="<?php echo _WEB_ROOT; ?>/ntd/quan-ly-dang-tuyen/tao-tin" class="text-dark fw-normal fs-6 mx-3">
                                    <i class="bi bi-plus-square-fill text-primary"></i> Tạo tin tuyển dụng
                                </a>
                            </li>
                            <li class="py-1 <?php echo (handleActiveSidebarEmployer('quan-ly-dang-tuyen', 'danh-sach') ? 'active' : false) ?>">
                                <a href="<?php echo _WEB_ROOT; ?>/ntd/quan-ly-dang-tuyen/danh-sach" class="text-dark fw-normal fs-6 mx-3">
                                    <i class="bi bi-file-text text-primary"></i> Danh sách tin đăng
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="d-inline-flex gap-1 p-0">
                        <a class="btn border border-0 p-0 m-0 px-3 py-2 fw-bold text-dark" data-bs-toggle="collapse" href="#collapseExample-3" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <i class="bi bi-chevron-down"></i> Quản lý ứng viên
                        </a>
                    </div>
                    <div class="collapse show" id="collapseExample-3">
                        <ul class="p-0 m-0 px-2 rounded-1">
                            <li class="py-1 <?php echo (handleActiveSidebarEmployer('quan-ly-ung-vien', 'ho-so-ung-tuyen') ? 'active' : false) ?>">
                                <a href="<?php echo _WEB_ROOT; ?>/ntd/quan-ly-ung-vien/ho-so-ung-tuyen" class="text-dark fw-normal fs-6 mx-3">
                                    <i class="bi bi-people-fill text-primary"></i> Hồ sơ ứng tuyển
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <hr>
                    <div class="d-inline-flex gap-1 p-0">
                        <a class="btn border border-0 p-0 m-0 px-3 fw-bold text-dark" href="<?php echo _WEB_ROOT; ?>/ntd/dang-xuat">
                            <i class="bi bi-box-arrow-right"></i> Đăng xuất
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>