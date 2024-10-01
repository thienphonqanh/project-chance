<header class="site-header">
    <div class="section-overlay"></div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 col-12 text-center">
                <h1 class="text-white">Danh sách việc làm</h1>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a href="<?php echo _WEB_ROOT; ?>/trang-chu">Trang chủ</a></li>

                        <li class="breadcrumb-item active" aria-current="page">Danh sách việc làm</li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>
</header>

<section class="section-padding pb-0 d-flex justify-content-center align-items-center">
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-12 col-12">
                <form class="custom-form hero-form" action="" method="post" role="form">
                    <h3 class="text-white mb-3">Tìm kiếm công việc mơ ước</h3>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="bi-person custom-icon"></i></span>

                                <input type="text" name="job_title" id="job-title" class="form-control"
                                    placeholder="Tiêu đề"
                                    value="<?php isset($request->getFields()['job_title']) ?? '' ?>">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="bi-geo-alt custom-icon"></i></span>

                                <input type="text" name="job_location" id="job-location" class="form-control"
                                    placeholder="Vị trí"
                                    value="<?php isset($request->getFields()['job_location']) ?? '' ?>">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="bi-laptop custom-icon"></i></span>

                                <select class="form-select form-control" name="exp_required" id="exp_required"
                                    aria-label="Default select example">
                                    <option value="0" selected>Tất cả hình thức làm việc</option>
                                    <?php
                                    if (!empty($yearExp)) :
                                        foreach ($yearExp as $item) :
                                    ?>
                                    <option value="<?php echo $item['id']; ?>" <?php isset($request->getFields()['exp_required'])
                                        && $request->getFields()['exp_required'] == $item['id'] ? 'selected' : '' ?>>
                                        <?php echo $item['name']; ?>
                                    </option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="bi-laptop custom-icon"></i></span>

                                <select class="form-select form-control" name="form_work" id="form_work"
                                    aria-label="Default select example">
                                    <option value="0" selected>Tất cả hình thức làm việc</option>
                                    <?php
                                    if (!empty($formWork)) :
                                        foreach ($formWork as $item) :
                                    ?>
                                    <option value="<?php echo $item['id']; ?>" <?php isset($request->getFields()['form_work'])
                                        && $request->getFields()['form_work'] == $item['id'] ? 'selected' : '' ?>>
                                        <?php echo $item['name']; ?>
                                    </option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="bi-laptop custom-icon"></i></span>

                                <select class="form-select form-control" name="job_field" id="job-field"
                                    aria-label="Default select example">
                                    <option value="0" selected>Tất cả lĩnh vực</option>
                                    <?php
                                    if (!empty($jobField)) :
                                        foreach ($jobField as $item) :
                                    ?>
                                    <option value="<?php echo $item['id']; ?>" <?php isset($request->getFields()['job_field'])
                                        && $request->getFields()['job_field'] == $item['id'] ? 'selected' : '' ?>>
                                        <?php echo $item['name']; ?>
                                    </option>
                                    <?php endforeach;
                                    endif; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-12 col-12">
                            <button type="submit" class="form-control">
                                Tìm việc
                            </button>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap align-items-center mt-4 mt-lg-0">
                                <span class="text-white mb-lg-0 mb-md-0 me-2">Từ khoá phổ biến:</span>

                                <div>
                                    <a href="job-listings.html" class="badge">Web design</a>

                                    <a href="job-listings.html" class="badge">Marketing</a>

                                    <a href="job-listings.html" class="badge">Customer support</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="job-section section-padding bg-white">
    <div class="container-lg">
        <div class="row align-items-center">

            <div class="col-lg-6 col-12 mb-lg-4">
                <h4>Kết quả của
                    <?php echo (!empty($quantityJob)) ? '(' . $quantityJob . ' tin đăng)' : '(0 tin đăng)'; ?>
                </h4>
            </div>

            <div class="col-lg-4 col-12 d-flex align-items-center ms-auto mb-5 mb-lg-4">
                <p class="mb-0 ms-lg-auto">Sắp xếp:</p>

                <div class="dropdown dropdown-sorting ms-3 me-4">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSortingButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Mới nhất
                    </button>

                    <ul class="dropdown-menu" aria-labelledby="dropdownSortingButton">
                        <li><a class="dropdown-item" href="#">Cũ nhất</a></li>
                    </ul>
                </div>

                <div class="d-flex">
                    <a href="#" class="sorting-icon active bi-list me-2"></a>

                    <a href="#" class="sorting-icon bi-grid"></a>
                </div>
            </div>


            <div class="col-lg-12 col-12 bg-body-tertiary p-3 rounded d-flex">
                <div class="row">
                    <div class="col-lg-9">
                        <ul class="list-job">
                            <?php
                            if (!empty($listJob)) :
                                foreach ($listJob as $item) :
                            ?>
                            <li class="job-thumb">
                                <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-viec-lam/<?php echo $item['slug'] . '-' . $item['id'].'.html'; ?>"
                                    class="d-flex w-100">
                                    <div class="job-image-wrap bg-white shadow-lg">
                                        <img src="<?php echo $item['thumbnail'] ?>" class="job-image img-fluid" alt="">
                                    </div>
                                    <div class="job-body d-flex flex-wrap align-items-center ms-4 w-100">
                                        <div class="mb-3">
                                            <h5 class="text-dark mb-lg-0 pb-2">
                                                <?php echo $item['title'] ?>
                                            </h5>

                                            <div class="row align-items-center">
                                                <div class="col-lg-6 col-md-6 col-sm-12">
                                                    <p class="job-location mb-0">
                                                        <i class="fa-solid fa-location-dot text-primary-emphasis"></i>
                                                        <?php echo $item['name'] ?><br>
                                                        <strong
                                                            class="text-info mx-1"><?php echo $item['location'] ?></strong>
                                                    </p>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <p class="job-date mb-0">
                                                        <i class="fa-regular fa-clock text-primary-emphasis"></i>
                                                        <?php echo getTimeAgo($item['create_at']) ?>
                                                    </p>
                                                </div>

                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <p class="job-price mb-0">
                                                        <i class="fa-regular fa-money-bill-1 text-primary-emphasis"></i>
                                                        <?php echo $item['salary'] ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <?php endforeach; ?>
                            <div class="paging">
                                <ul class="list-page"></ul>
                            </div>
                            <?php else : ?>
                            <div class="text-center mt-5">
                                <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/empty.webp" alt="Ảnh"
                                    class="mb-3">
                                <h5>Không tìm thấy kết quả nào</h5>
                                <p class="fw-normal">Chưa tìm được việc làm phù hợp với tiêu chí của bạn</p>
                            </div>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-lg-3">
                        <div class="side-bar mt-md-3 mt-sm-3 mt-lg-0">
                            <div class="tag-keyword-block border border-dark ms-3 rounded">
                                <h6 class="p-2 border-bottom rounded text-center fs-3">Có thể bạn quan tâm</h6>
                                <div class="tag-keyword-item d-flex flex-wrap">
                                    <a href="#" class="p-2 m-2 rounded">Quản Lý Kho</a>
                                    <a href="#" class="p-2 m-2 rounded">Đại Diện Kinh Doanh</a>
                                    <a href="#" class="p-2 m-2 rounded">Quản Lý Kho Vật Tư Giao Nhận</a>
                                    <a href="#" class="p-2 m-2 rounded">Kỹ Sư Xây Dựng</a>
                                    <a href="#" class="p-2 m-2 rounded">Kế Toán Trưởng</a>
                                    <a href="#" class="p-2 m-2 rounded">Graphic Designer</a>
                                    <a href="#" class="p-2 m-2 rounded">Nhân Viên Thực Tập</a>
                                    <a href="#" class="p-2 m-2 rounded">HR</a>
                                    <a href="#" class="p-2 m-2 rounded">Kỹ Thuật Viên</a>
                                    <a href="#" class="p-2 m-2 rounded">Giám Đốc Kinh Doanh</a>
                                    <a href="#" class="p-2 m-2 rounded">Accountant</a>
                                </div>
                            </div>
                            <div class="adver">
                                <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/adver/Picture2.png"
                                    class="w-100 p-2 ms-2" alt="">
                                <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/adver/Picture3.png"
                                    class="w-100 p-2 ms-2" alt="">
                                <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/adver/Picture1.png"
                                    class="w-100 p-2 ms-2" alt="">
                            </div>
                        </div>
                    </div>
                </div>



            </div>



        </div>
    </div>
</section>

<!-- Gợi ý các ngành nghề -->
<section class="career-suggestions">
    <div class="container-lg">
        <h2 class="fw-bold text-center">Việc làm theo nghề nghiệp</h2>
        <div class="d-flex flex-wrap justify-content-between">
            <div class="d-flex flex-column mt-4">
                <a href="#" class="fw-semibold">Hành chính-Thư ký</a>
                <a href="#" class="fw-semibold">An ninh-Bảo vệ</a>
                <a href="#" class="fw-semibold">Thiết kế-Sáng tạo nghệ thuật</a>
                <a href="#" class="fw-semibold">Kiến trúc-Thiêt kế nội ngoại thất</a>
                <a href="#" class="fw-semibold">Khách sạn-Nhà hàng-Du lịch</a>
                <a href="#" class="fw-semibold">Bán sỉ-Bán lẻ-Quản lý cửa hàng</a>
                <a href="#" class="fw-semibold">IT Phần cứng-mạng</a>
                <a href="#" class="fw-semibold">IT Phần mềm</a>
            </div>
            <div class="d-flex flex-column mt-4">
                <a href="#" class="fw-semibold">Sản xuất-Lắp ráp-Chế biến</a>
                <a href="#" class="fw-semibold">Vận hành-Bảo trì-Bảo dưỡng</a>
                <a href="#" class="fw-semibold">Nông-Lâm-Ngư nghiệp</a>
                <a href="#" class="fw-semibold">Marketing</a>
                <a href="#" class="fw-semibold">Bán hàng-Kinh doanh</a>
                <a href="#" class="fw-semibold">Thu mua-Kho vận-Chuỗi cung ứng</a>
                <a href="#" class="fw-semibold">Xuất nhập khẩu</a>
                <a href="#" class="fw-semibold">Vận tải-Lái xe-Giao nhận</a>
            </div>
            <div class="d-flex flex-column mt-4">
                <a href="#" class="fw-semibold">Kế toán</a>
                <a href="#" class="fw-semibold">Tài chính-Đầu tư-Chứng khoán</a>
                <a href="#" class="fw-semibold">Bảo hiểm</a>
                <a href="#" class="fw-semibold">Ngân hàng</a>
                <a href="#" class="fw-semibold">Khai thác năng lượng-Khoáng sản-Địa chất</a>
                <a href="#" class="fw-semibold">Y tế-Chăm sóc sức khoẻ</a>
                <a href="#" class="fw-semibold">Nhân sự</a>
                <a href="#" class="fw-semibold">Thông tin-Truyền thông-Quảng cáo</a>
            </div>
        </div>
        <a href="#" type="button" class="d-block text-center m-auto mt-4 text-primary">Xem tất cả nghề nghiệp <i
                class="fa-solid fa-arrow-right"></i></a>
    </div>
</section>