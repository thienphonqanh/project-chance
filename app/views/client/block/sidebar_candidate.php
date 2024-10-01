<div style="width: 18%;" class="d-none d-sm-none d-md-none d-lg-block">
    <div class="w-100 p-0 shadow-lg" style="height: 100%;">
        <ul class="p-0 m-0">
            <li>
                <div class="d-inline-flex gap-1 p-0">
                    <a class="btn border border-0 p-0 m-0 px-3 py-2 fw-bold text-dark" data-bs-toggle="collapse" href="#collapseExample-1" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-chevron-down"></i> Quản lý tài khoản
                    </a>
                </div>
                <div class="collapse show" id="collapseExample-1">
                    <ul class="p-0 m-0 px-2 rounded-1">
                        <li class="py-1 <?php echo (handleActiveSidebar('quan-ly-tai-khoan', 'tai-khoan') ? 'active' : false) ?>">
                            <a href="<?php echo _WEB_ROOT; ?>/quan-ly-tai-khoan/tai-khoan" class="text-dark fw-normal fs-6 mx-3">
                                <i class="bi bi-people-fill text-primary"></i> Tài khoản của bạn
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="d-inline-flex gap-1 p-0">
                    <a class="btn border border-0 p-0 m-0 px-3 py-2 fw-bold text-dark" data-bs-toggle="collapse" href="#collapseExample-2" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-chevron-down"></i> Quản lý hồ sơ
                    </a>
                </div>
                <div class="collapse show" id="collapseExample-2">
                    <ul class="p-0 m-0 px-2 rounded-1">
                        <?php if (issetProfile()) : ?>
                            <li class="py-1 <?php echo (handleActiveSidebar('quan-ly-ho-so', 'ho-so') ? 'active' : false) ?>">
                                <a href="<?php echo _WEB_ROOT; ?>/quan-ly-ho-so/ho-so" class="text-dark fw-normal fs-6 mx-3">
                                    <i class="bi bi-file-text text-primary"></i> Hồ sơ của bạn
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="py-1 <?php echo (handleActiveSidebar('quan-ly-ho-so', 'them-ho-so') ? 'active' : false) ?>">
                                <a href="<?php echo _WEB_ROOT; ?>/quan-ly-ho-so/them-ho-so" class="text-dark fw-normal fs-6 mx-3">
                                    <i class="bi bi-file-text text-primary"></i> Hồ sơ của bạn
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </li>
            <li>
                <div class="d-inline-flex gap-1 p-0">
                    <a class="btn border border-0 p-0 m-0 px-3 py-2 fw-bold text-dark" data-bs-toggle="collapse" href="#collapseExample-3" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="bi bi-chevron-down"></i> Quản lý việc làm
                    </a>
                </div>
                <div class="collapse show" id="collapseExample-3">
                    <ul class="p-0 m-0 px-2 rounded-1">
                        <li class="py-1 <?php echo (handleActiveSidebar('quan-ly-viec-lam', 'viec-lam-da-ung-tuyen') ? 'active' : false) ?>">
                            <a href="<?php echo _WEB_ROOT; ?>/quan-ly-viec-lam/viec-lam-da-ung-tuyen" class="text-dark fw-normal fs-6 mx-3">
                                <i class="bi bi-file-text text-primary"></i> Việc làm đã ứng tuyển
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>