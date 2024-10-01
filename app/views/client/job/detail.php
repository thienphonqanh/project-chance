<div class="main pb-3">
    <?php 
        if (!empty($dataDetail)):
            foreach ($dataDetail as $item):
    ?>
    <div class="header p-2 w-100">
        <div class="container-lg">
            <a href="<?php echo _WEB_ROOT; ?>/trang-chu" class="text-dark">Trang chủ <a
                    href="<?php echo _WEB_ROOT; ?>/tim-viec-lam" class="text-dark">/ Việc làm </a>
                <a href="" class="text-dark"> / <?php echo $item['jobField'] ?></a>
                <a href="" class="text-secondary"> / <?php echo $item['title'] ?></a></a>
        </div>
    </div>

    <div class="container-lg d-flex border rounded p-4 w-100">
        <div class="row w-100">
            <div class="col-2">
                <div class="ms-2">
                    <?php 
                        $root = _WEB_ROOT;
                        echo (!empty($item['thumbnail'])) ? 
                        '<img src="'.$root.'/'.$item['thumbnail'].'" width="90%" alt="Avatar">' 
                        : 
                        '<img src="'.$root.'/public/client/assets/images/default_job.jpg" width="90%" alt="Avatar">';
                    ?>
                </div>
            </div>
            <div class="col-10">
                <div class="d-flex w-100 align-items-center w-75">
                    <p class="w-100 m-0 fw-normal"><?php echo $item['name']; ?></p>
                </div>
                <div class="w-100 mt-2">
                    <h4><?php echo $item['title'] ?></h4>
                    <div class="row align-items-center w-100 mt-3">
                        <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                            <div class="d-flex align-items-center">
                                <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/icon-coin.png"
                                    width="30px" height="30px" alt="">
                                <p class="fs-6 fw-normal m-0 ms-2">Mức lương <strong
                                        class="text-info"><?php echo $item['salary']; ?></strong></p>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <div class="d-flex align-items-center ms-lg-3 mt-md-3 mt-sm-3 mt-2 mt-lg-0">
                                <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/icon-schedual.png"
                                    width="30px" height="30px" alt="">
                                <p class="fs-6 fw-normal m-0 ms-2">Hạn nộp hồ sơ <strong
                                        class="text-dark"><?php echo getDateTimeFormat($item['deadline'], 'd-m-Y'); ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center w-100 mt-3">
                        <div class="d-flex align-items-center">
                            <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/icon-map.png" width="30px"
                                height="30px" alt="">
                            <p class="fs-6 fw-normal m-0 ms-2">Khu vực tuyển <strong
                                    class="text-dark"><?php echo $item['location']; ?></strong></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-lg-center align-items-sm-center align-items-md-center 
                            w-100 mt-3 flex-lg-row flex-md-row flex-sm-row flex-column">
                        <div class="d-flex align-items-center">
                            <?php 
                                if (isLogin()):
                            ?>
                            <a type="button" href="<?php echo _WEB_ROOT; ?>/ung-tuyen?id=<?php echo $item['id']; ?>"
                                class="btn btn-primary px-4"><i class="bi bi-send"></i> Nộp hồ sơ</a>
                            <?php else: ?>
                            <a type="button" href="<?php echo _WEB_ROOT; ?>/dang-nhap" class="btn btn-primary px-4"><i
                                    class="bi bi-send"></i> Nộp hồ sơ</a>
                            <?php endif; ?>
                            <button class="btn btn-lg border-0 mt-2 fs-5"><i class="bi bi-heart"></i></button>
                        </div>
                        <p class="text-dark fs-6 fw-normal m-0 ms-lg-auto ms-md-auto ms-sm-auto "><i
                                class="bi bi-eye"></i> Lượt xem
                            <?php echo $item['view_count']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section-main">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 p-0">
                    <ul class="nav nav-tabs mt-4">
                        <li class="nav-item border-primary border-top border-2 job-tab">
                            <a class="nav-link active text-primary text-center rounded-0 fw-semibold" href="#">Chi tiết
                                tin</a>
                        </li>
                        <li class="nav-item bg-light job-tab">
                            <a class="nav-link text-dark text-center fw-normal" href="#section-company">Công ty</a>
                        </li>
                    </ul>
                    <div class="shadow-lg px-lg-5 px-md-5 px-sm-3 px-2 py-4 rounded">
                        <h4>Thông tin chung</h4>
                        <div class="general-information p-4 rounded">
                            <div class="d-flex flex-column flex-lg-row flex-sm-row flex-lg-row align-items-center">
                                <div class="d-flex align-items-center criteria">
                                    <i class="bi bi-calendar-check text-primary"></i>
                                    <div class="ms-3">
                                        <p class="fs-6 fw-normal m-0">Ngày đăng</p>
                                        <p class="fs-6 fw-bold m-0">
                                            <?php echo getDateTimeFormat($item['create_at'], 'd-m-Y'); ?></p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ms-lg-5 ms-md-5 ms-sm-5 second-criteria">
                                    <i class="fa-solid fa-medal text-primary"></i>
                                    <div class="ms-3">
                                        <p class="fs-6 fw-normal m-0">Cấp bậc</p>
                                        <p class="fs-6 fw-bold m-0"><?php echo $item['rank']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="d-lg-block d-sm-block d-md-block d-none">
                            <div class="d-flex flex-column flex-lg-row flex-sm-row flex-lg-row align-items-center">
                                <div class="d-flex align-items-center criteria">
                                    <i class="bi bi-people text-primary"></i>
                                    <div class="ms-3">
                                        <p class="fs-6 fw-normal m-0">Số lượng tuyển</p>
                                        <p class="fs-6 fw-bold m-0"><?php echo $item['number_recruits']; ?></p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ms-lg-5 ms-md-5 ms-sm-5 second-criteria">
                                    <i class="bi bi-brightness-high-fill text-primary"></i>
                                    <div class="ms-3">
                                        <p class="fs-6 fw-normal m-0">Hình thức làm việc</p>
                                        <p class="fs-6 fw-bold m-0"><?php echo $item['form_work']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="d-lg-block d-sm-block d-md-block d-none">
                            <div class="d-flex flex-column flex-lg-row flex-sm-row flex-lg-row align-items-center">
                                <div class="d-flex align-items-center criteria">
                                    <i class="bi bi-mortarboard text-primary"></i>
                                    <div class="ms-3">
                                        <p class="fs-6 fw-normal m-0">Yêu cầu bằng cấp</p>
                                        <p class="fs-6 fw-bold m-0"><?php echo $item['education_required']; ?></p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ms-lg-5 ms-md-5 ms-sm-5 second-criteria">
                                    <i class="fa-solid fa-wand-sparkles text-primary"></i>
                                    <div class="ms-3">
                                        <p class="fs-6 fw-normal m-0">Yêu cầu kinh nghiệm</p>
                                        <p class="fs-6 fw-bold m-0"><?php echo $item['exp_required']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="d-lg-block d-sm-block d-md-block d-none">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-suitcase-lg text-primary"></i>
                                    <div class="ms-3">
                                        <p class="fs-6 fw-normal m-0">Ngành nghề</p>
                                        <p class="fs-6 fw-bold m-0 text-primary"><?php echo $item['jobField']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--  -->
                        <h4 class="mt-4 fw-bold">Mô tả công việc</h4>
                        <p class="text-dark fs-6 fw-bold">
                            <?php echo $item['job_description']; ?>
                        </p>

                        <!--  -->
                        <h4 class="mt-4 fw-bold">Yêu cầu công việc</h4>
                        <p class="text-dark fs-6 fw-bold">
                            <?php echo $item['requirement']; ?>
                        </p>

                        <!--  -->
                        <h4 class="mt-4 fw-bold">Quyền lợi</h4>
                        <p class="text-dark fs-6 fw-bold">
                            <?php echo $item['welfare']; ?>
                        </p>

                        <!--  -->
                        <h4 class="mt-4 fw-bold">Thông tin khác</h4>
                        <p class="text-dark fs-6 fw-bold">
                            <?php echo $item['other_info']; ?>
                        </p>
                    </div>
                    <div id="section-company"
                        class="shadow-lg d-flex flex-column border rounded px-lg-5 px-md-5 px-sm-3 px-2 py-4 mt-3">
                        <h4 class="mt-2"><?php echo $item['name']; ?></h4>
                        <div class="text-dark fw-normal">
                            <i class="text-primary bi bi-geo-alt pe-4"></i> <?php echo $item['company_location']; ?>
                            <br>
                            <i class="text-primary bi bi-people pe-4"></i> <?php echo $item['scales']; ?>
                            <br>
                            <p class="mt-3">
                                <?php echo $item['description']; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 p-3">
                    <h6 class="mt-4 fs-4">Việc làm tương tự cho bạn</h6>
                    <hr width="40%" class="border border-primary border-3">
                    <?php 
                        if (!empty($randomData)):
                            foreach ($randomData as $subItem):
                    ?>
                    <div class="d-flex flex-column">
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
    </div>
    <?php endforeach; endif; ?>
</div>
<?php 
    if (!empty($result)):
        echo $result;
    endif;
?>