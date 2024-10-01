<div class="container-lg m-auto shadow-lg p-3 rounded-3">
    <?php
        if (!empty($msg)) :
            echo '<div class="alert alert-' . $msgType . '">';
            echo $msg;
            echo '</div>';
        endif;
    ?>
    <form method="post" enctype="multipart/form-data" accept="<?php echo _WEB_ROOT; ?>/ung-tuyen">
        <span class="text-dark fs-5"> 
            <i class="bi bi-folder-symlink-fill text-primary"></i> Chọn CV để ứng tuyển
        </span>
        <div class="form-group rounded-2 text-center mb-3" style="border: 1px dashed #8e8a8a;">
            <div class="upload-header">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-4 col-3 text-end p-0 p-2">
                        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/upload-cloud.webp" width="42px" alt="">
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-8 col-9 text-start p-0 p-2">
                        <p class="text-dark p-0 m-0 fw-semibold">Chọn và tải lên CV từ máy tính</p>
                    </div>
                    <div class="col-12 p-0 mb-2">
                        <p class="fs-5 p-0 m-0 px-3">Hỗ trợ định dạng .doc, .docx, .pdf có kích thước dưới 5MB</p>
                    </div>
                </div>
            </div>
            <label for="upload-cv" class="btn btn-primary">Chọn CV</label>
            <input type="file" id="upload-cv" name="upload-cv" accept=".pdf, .doc, .docx" onchange="validateFile()" class="d-none">
            <p id="file-name" class="m-0 p-0 mt-2 text-success"></p>
            <button id="delete-button-cv" type="button" onclick="deleteFile()" style="display: none;" class="btn text-danger fs-5"><i class="bi bi-trash p-2 pb-1 rounded-2" style="background-color: rgb(236, 218, 225);"></i></button>
            <p id="error-message" class="text-danger"></p>
            <hr width="95%" class="m-auto">
            <div class="d-flex flex-lg-row flex-md-row flex-sm-column flex-column m-auto my-2 px-4">
                <p class="fs-5 fw-normal text=dark m-0 p-0">Vui lòng nhập đầy đủ thông tin</p>
                <p class="fs-6 text-danger ms-lg-auto m-0 p-0 fw-normal">(*) Thông tin bắt buộc</p>
            </div>
            <div class="form-group text-start px-lg-4 px-md-4 px-sm-4 px-2">
                <label for="fullname" class="fs-5 fw-light">Họ và tên <span class="text-danger">*</span></label>
                <input type="text" name="fullname" class="form-control" placeholder="Họ tên hiển thị với NTD" value="<?php echo (!empty(old('fullname', $old))) ? old('fullname', $old) : false ?>">
                <?php echo form_error('fullname', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
            </div>
            <div class="row px-lg-4 px-md-4 px-sm-4 px-2 my-3">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 form-group text-start">
                    <label for="email" class="fs-5 fw-light">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="Email hiển thị với NTD" value="<?php echo (!empty(old('email', $old))) ? old('email', $old) : false ?>">
                    <?php echo form_error('email', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12 form-group text-start mt-sm-3 mt-3 mt-lg-0 mt-md-0">
                    <label for="phone" class="fs-5 fw-light">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" placeholder="Số điện thoại hiển thị với NTD" value="<?php echo (!empty(old('phone', $old))) ? old('phone', $old) : false ?>">
                    <?php echo form_error('phone', $errors, '<span class="fst-italic fs-6 text-danger px-2">', '</span>') ?>
                </div>
            </div>
        </div>
        <span class="text-dark fs-5"> 
            <i class="bi bi-envelope-arrow-up-fill text-primary"></i> Thư giới thiệu
        </span>
        <div class="form-group">
            <p class="fs-5 fw-light">Một thư giới thiệu ngắn gọn, chỉn chu sẽ giúp bạn trở nên chuyên nghiệp và gây ấn tượng hơn với nhà tuyển dụng.</p>
            <textarea name="letter" rows="5" class="form-control" 
                placeholder="Viết giới thiệu ngắn gọn về bản thân (điểm mạnh, điểm yếu) và nêu rõ mong muốn, lý do bạn muốn ứng tuyển cho vị trí này. Đây là cơ sở để Nhà tuyển dụng dựa vào đó để xem xét nếu việc phỏng vấn hoặc hồ sơ của bạn không tốt."
            ></textarea>
        </div>
        <div class="note border border-1 rounded-2 mt-3 p-3">
            <h5 class="text-danger"><i class="bi bi-exclamation-circle-fill"></i> Lưu ý</h5>
            <p class="text-dark fw-light">
                Chance khuyên tất cả các bạn hãy luôn cẩn trọng trong quá trình tìm việc và chủ động nghiên cứu về thông tin công ty, vị trí việc làm trước khi ứng tuyển.
                Ứng viên cần có trách nhiệm với hành vi ứng tuyển của mình. Nếu bạn gặp phải tin tuyển dụng hoặc nhận được liên lạc đáng ngờ của nhà tuyển dụng, hãy báo cáo ngay cho Chance qua email recruitment@chance.co để được hỗ trợ kịp thời.
            </p>
        </div>
        <div class="row w-100 mt-3">
            <div class="col-lg-2 col-md-2 col-sm-2 px-1">
                <button type="button" onclick="history.back()" class="btn btn-secondary w-100 d-lg-block d-sm-block d-md-block d-none btn-lg">Huỷ</button>
            </div>
            <div class="col-lg-10 col-sm-10 col-md-10 col-12 px-1">
                <button type="submit" class="btn btn-primary w-100 btn-lg">Nộp hồ sơ ứng tuyển</button>
            </div>
        </div>
    </form> 
</div>