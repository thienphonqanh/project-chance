        <!-- Mở đầu -->
        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">

                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <div class="hero-section-text mt-5">
                            <h6 class="text-white">Bạn đang tìm kiếm công việc mơ ước?</h6>

                            <h1 class="hero-title text-white mt-4 mb-4">Việc làm trực tuyến. <br> <span class="text-info">WEBSITE</span> tuyển dụng hàng đầu</h1>

                            <a href="#categories-section" class="custom-btn custom-border-btn btn">Duyệt danh mục</a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <form class="custom-form hero-form" action="<?php echo _WEB_ROOT; ?>/tim-viec-lam" method="post" role="form">
                            <h3 class="text-white mb-3">Tìm kiếm công việc mơ ước</h3>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="bi-person custom-icon"></i></span>

                                        <input type="text" name="job_title" id="job-title" class="form-control" placeholder="Tiêu đề">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><i class="bi-geo-alt custom-icon"></i></span>

                                        <input type="text" name="job_location" id="job-location" class="form-control" placeholder="Vị trí">
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
                                            <a href="<?php echo _WEB_ROOT; ?>/tim-viec-lam" class="badge">Web design</a>

                                            <a href="<?php echo _WEB_ROOT; ?>/tim-viec-lam" class="badge">Marketing</a>

                                            <a href="<?php echo _WEB_ROOT; ?>/tim-viec-lam" class="badge">Customer
                                                support</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

        <!-- Giới thiệu công cụ -->
        <section class="section-introducing" id="section-introducing">
            <h3 class="text-center">Công cụ tốt nhất cho hành trang ứng tuyển của bạn</h3>
            <p class="text-center">Khẳng định bản thân qua hồ sơ "chất" với công cụ và kiến thức bổ ích từ Chance.</p>
            <div class="d-lg-flex mt-5">
                <div class="d-flex flex-column align-items-center rounded p-lg-4 py-lg-5 p-md-4 py-md-5 p-sm-4 py-sm-5 py-5">
                    <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/site-header/job_search.png" width="100px" alt="">
                    <div>
                        <h4 class="text-center">Tìm kiếm việc làm</h4>
                        <p class="text-center fw-normal text-dark">Danh sách việc làm "chất" liên tục cập nhật các lựa
                            chọn mới nhất theo thị trường và xu hướng tìm kiếm.</p>
                        <a href="<?php echo _WEB_ROOT; ?>/tim-viec-lam" type="button" class="discover-1 border border-primary text-primary d-block w-50 p-2 text-center m-auto  rounded fw-bold fs-5">Khám
                            phá</a>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center shadow-lg rounded p-lg-4 py-lg-5 p-md-4 py-md-5 p-sm-4 py-sm-5 py-5">
                    <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/site-header/user_profile.png" width="100px" alt="">
                    <div>
                        <h4 class="text-center">Hồ sơ cá nhân</h4>
                        <p class="text-center fw-normal text-dark">Kiến tạo hồ sơ với bố cục chuẩn mực, chuyên nghiệp
                            cho các ngành nghề, được nhiều nhà tuyển dụng đề xuất.</p>
                        <?php if (isUser()) : ?>
                            <a href="<?php echo _WEB_ROOT; ?>/quan-ly-tai-khoan/tai-khoan" type="button" class="discover-2 border border-primary btn btn-primary text-white d-block w-50 p-2 text-center m-auto rounded fw-bold fs-5">Khám
                                phá</a>
                        <?php else : ?>
                            <a href="#" type="button" class="discover-2 border border-primary btn btn-primary text-white d-block w-50 p-2 text-center m-auto rounded fw-bold fs-5">Khám
                                phá</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="d-flex flex-column align-items-center rounded p-lg-4 py-lg-5 p-md-4 py-md-5 p-sm-4 py-sm-5 py-5">
                    <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/site-header/blog.png" width="100px" alt="">
                    <div>
                        <h4 class="text-center">Blog về việc làm</h4>
                        <p class="text-center fw-normal text-dark">Đừng bỏ lỡ cơ hội cập nhật thông tin lương thưởng,
                            chế độ làm việc, nghề nghiệp và kiến thức các ngành nghề.</p>
                        <a href="<?php echo _WEB_ROOT; ?>/cam-nang" type="button" class="discover-3 border border-primary text-primary d-block w-50 p-2 text-center m-auto rounded fw-bold fs-5">Khám
                            phá</a>
                    </div>
                </div>
            </div>

        </section>

        <!-- Ngành nghề trọng điểm -->
        <section class="section-key-industries" id="section-key-industries">
            <h2 class="text-center">Ngành Nghề Trọng Điểm</h2>
            <div class="industries-block">
                <div class="industries">
                    <?php
                    if (!empty($jobCategory)) :
                        foreach ($jobCategory as $item) :
                    ?>
                            <a href="#" class="item">
                                <img src="<?php echo _WEB_ROOT . '/' . $item['icon']; ?>" alt="">
                                <p class="text-uppercase"><?php echo $item['name']; ?></p>
                            </a>
                    <?php endforeach;
                    endif; ?>
                </div>
            </div>

            <div class="direction">
                <button id="prev"><i class="fa-solid fa-angle-left"></i></button>
                <button id="next"><i class="fa-solid fa-angle-right"></i></button>
            </div>
        </section>

        <!-- Việc làm nổi bật -->
        <section class="job-section job-featured-section section-padding" id="section-job">
            <div class="container-lg">
                <div class="row">
                    <div class="col-lg-6 col-12 text-center mx-auto mb-4">
                        <h2>Việc làm nổi bật</h2>

                        <p><strong>Hơn 10k công việc đang chờ đón bạn</strong> Cơ hội việc làm đang rộng mở, còn chần
                            chừ gì nữa mà không ứng tuyển ngay bây giờ.</p>
                    </div>

                    <div class="col-lg-12 col-12">
                        <ul class="list-job">
                            <?php
                            if (!empty($outstandingJob)) :
                                foreach ($outstandingJob as $item) :
                            ?>
                                    <li class="job-thumb">
                                        <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-viec-lam/<?php echo $item['slug'] . '-' . $item['id'] . '.html'; ?>">
                                            <div class="job-image-wrap bg-white shadow-lg">
                                                <img src="<?php echo _WEB_ROOT . '/' . $item['thumbnail']; ?>" class="job-image img-fluid" alt="">
                                            </div>

                                            <div class="job-body d-flex flex-wrap flex-auto align-items-center ms-4">
                                                <div class="mb-3">
                                                    <h5 class="job-title mb-lg-0 pb-2">
                                                        <?php echo $item['title']; ?>
                                                    </h5>

                                                    <div class="d-flex flex-wrap align-items-center">
                                                        <p class="job-location mb-0">
                                                            <i class="fa-solid fa-location-dot text-primary-emphasis"></i>
                                                            <?php echo $item['name']; ?><br>
                                                            <strong class="text-info mx-1"><?php echo $item['location']; ?></strong>
                                                        </p>

                                                        <p class="job-date mb-0">
                                                            <i class="fa-regular fa-clock text-primary-emphasis"></i>
                                                            <?php echo getTimeAgo($item['create_at']); ?>
                                                        </p>

                                                        <p class="job-price mb-0">
                                                            <i class="fa-regular fa-money-bill-1 text-primary-emphasis"></i>
                                                            <?php echo $item['salary']; ?>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="job-section-btn-wrap">
                                                    <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-viec-lam/<?php echo $item['slug'] . '-' . $item['id'] . '.html'; ?>" class="btn-details">Ứng tuyển</a>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                            <?php endforeach;
                            endif; ?>
                        </ul>

                        <div class="paging">
                            <ul class="list-page">
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Cẩm nang nghề nghiệp -->
        <section class="section-handbook">
            <h3 class="text-center">Cẩm Nang Nghề Nghiệp</h3>
            <p class="text-center">Những kinh nghiệm bạn có thể cần trong quá trình tìm kiếm và làm việc</p>
            <div class="handbook-block">
                <?php
                if (!empty($someHandbooks)) :
                    foreach ($someHandbooks as $item) :
                ?>
                        <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'] . '-' . $item['id'] . '.html'; ?>" class="handbook">
                            <img src="<?php echo _WEB_ROOT . '/' . $item['thumbnail']; ?>" class="img-fluid" alt="">
                            <p class="text-dark"><?php echo $item['title'] ?></p>
                            <span class="special-content text-dark fw-lighter fs-5"><?php echo $item['descr']; ?></span>
                        </a>
                <?php endforeach;
                endif; ?>
            </div>
            <!-- <button type="button" class="btn-loadHandBook">Xem thêm cẩm nang nghề nghiệp</button> -->
            <a href="<?php echo _WEB_ROOT; ?>/cam-nang" class="more-handbook d-block p-2 m-auto mt-3 text-center rounded">Xem thêm cẩm nang nghề nghiệp</a>
        </section>