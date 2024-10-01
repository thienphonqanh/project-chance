<aside class="sidebar-candidates mb-4">
    <div class="d-flex">
        <?php
        $this->render('block/sidebar_employer', [], 'client');
        ?>
        <form method="post" class="m-auto custom-form-profile">
            <div class="w-100 text-start">
                <h5 class="text-primary">Gửi email liên hệ</span></h5>
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
                    <h6 class="border-start border-3 border-primary px-2 text-start mb-3 mx-2">Thông tin ứng viên</h6>
                    <?php if (!empty($information)): ?>
                    <div class="col-lg-6 text-start mb-2">
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" name="fullname" class="form-control" disabled
                                value="<?php echo $information['fullname'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 text-start mb-2">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" disabled
                                value="<?php echo $information['email'] ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 text-start mb-2">
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" disabled
                                value="<?php echo $information['phone'] ?>">
                        </div>
                    </div>
                    <?php endif; ?>
                    <h6 class="border-start border-3 border-primary px-2 text-start mt-3 mx-2">Thông tin email</h6>
                    <div class="col-lg-12 text-start mb-3">
                        <div class="form-group">
                            <label for="subject">Tiêu đề</label>
                            <input type="text" name="subject" class="form-control">
                        </div>
                        <?php echo form_error('subject', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="col-lg-12 text-start mb-3">
                        <div class="form-group">
                            <label for="content">Nội dung email</label>
                            <textarea name="content" class="form-control" rows="8"></textarea>
                        </div>
                        <?php echo form_error('content', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                    </div>
                    <div class="col-12 text-end mt-4">
                        <button type="submit" class="btn btn-primary btn-md px-3">Gửi</button>
                        <a href="<?php echo _WEB_ROOT; ?>/ntd/quan-ly-ung-vien/ho-so-ung-tuyen"
                            class="btn btn-md px-4 btn-danger">Quay
                            lại</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</aside>