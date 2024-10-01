<!-- Section main -->
<section class="section-main">
    <?php 
        if (!empty($dataDetail)):
            foreach ($dataDetail as $item):
    ?>
    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 px-4">
                <div class="d-flex mt-2">
                    <a href="">
                        <p class="text-uppercase"><?php echo $item['main_category_name']; ?></p>
                    </a>
                    <p class="text-uppercase ms-4"><?php echo $item['sub_category_name']; ?></p>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="fw-bold"><?php echo $item['title']; ?></h3>
                    </div>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 d-flex">
                                <p class="fs-6">By <span class="fs-6 fw-bold text-dark">
                                        <?php echo $item['author']; ?></span></p>
                                <p class="fs-6 ms-3"><?php echo getDateTimeFormat($item['create_at'], 'd-m-Y'); ?></p>
                            </div>
                            <div class="col-lg-6 text-end">
                                <p class="m-0 p-0 fs-6"><i class="bi bi-eye"></i> Lượt xem
                                    <?php echo $item['view_count']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <img src="<?php echo _WEB_ROOT.'/'.$item['thumbnail']; ?>" width="100%" class="rounded-3" alt="Ảnh">
                    <p class="text-dark mt-3">
                        <?php echo $item['descr']; ?>
                    </p>
                    <p class="text-dark">
                        <?php echo $item['content']; ?>
                    </p>
                </div>
                <div>

                </div>
            </div>

            <div class="col-lg-4">
                <div style="height: 180px;" class="d-lg-block d-md-none d-none d-sm-none"></div>

                <div class="ms-lg-3 mt-3">
                    <p class="fs-4 fw-normal text-dark">Top công việc mới nhất</p>
                    <?php 
                        if (!empty($listNewJob)):
                            foreach ($listNewJob as $item):
                    ?>
                    <div>
                        <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-viec-lam/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>">
                            <div class="d-flex p-2 rounded border border-1 mt-3 text-dark">
                                <div>
                                    <img width="35px" height="32px" class="border rounded"
                                        src="<?php echo _WEB_ROOT.'/'.$item['thumbnail']; ?>" alt="">
                                </div>
                                <div class="special-span ms-2">
                                    <span class="fs-6 fw-semibold special-content-1"><?php echo $item['title']; ?></span>
                                    <span class="fs-6 special-content-1"><?php echo $item['name']; ?></span>
                                    <div class="d-flex mt-1">
                                        <i class="text-primary bi bi-geo-alt"></i>
                                        <p class="fs-6 fw-semibold ms-2 m-0 special-content-1"><?php echo $item['location']; ?>
                                        </p>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <i class="text-primary bi bi-currency-dollar"></i>
                                        <p class="fs-6 fw-semibold ms-2 m-0"><?php echo $item['salary']; ?></p>
                                    </div>
                                    <div class="d-flex mt-1">
                                        <i class="text-primary bi bi-suitcase-lg"></i>
                                        <p class="fs-6 fw-semibold ms-2 m-0"><?php echo $item['exp_required']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; endif; ?>
                </div>
                <div class="ms-lg-3 mt-3">
                    <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/adver/banner.png" alt="Banner"
                        class="w-100 rounded-2">
                </div>
            </div>
        </div>
        <hr class="border border-1 border-dark">
    </div>
    <?php endforeach; endif; ?>
    <div class="same-category p-4">
        <div class="container-lg">
            <?php if (!empty($listSameCategory)): ?>
            <h3>Cùng chuyên mục</h3>
            <?php endif;?>
            <div class="row">
                <?php 
                if (!empty($listSameCategory)):
                    foreach ($listSameCategory as $item):
            ?>
                <div class="col-lg-3 col-md-3">
                    <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>"
                        class="handbook-item d-block">
                        <img src="<?php echo _WEB_ROOT.'/'.$item['thumbnail']; ?>" class="img-fluid rounded-3" alt="">
                        <div class="mt-2 w-100 px-3 py-2 d-flex flex-column">
                            <p class="text-uppercase fw-normal fs-6 text-dark m-0"><?php echo $item['name']; ?></p>
                            <h5 class="tilte-handbook"><?php echo $item['title']; ?></h5>
                        </div>
                    </a>
                </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </div>
</section>