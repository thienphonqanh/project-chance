<!-- Nội dung header -->
<section class="section-header">
    <div class="container-lg">
        <img src="<?php echo _WEB_ROOT; ?>/public/client/assets/images/handbook/toa-do-nhan-tai/Toado-Sannhantai-Banner.png"
            class="img-fluid mt-lg-2" alt="">
        <?php if (!empty($thirdPageHandbook)): ?>
        <div>
            <a
                href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $thirdPageHandbook[0]['slug'].'-'.$thirdPageHandbook[0]['id'].'.html'; ?>">
                <div class="row mt-4 w-full">
                    <div class="col-lg-6 ">
                        <img src="<?php echo _WEB_ROOT.'/'.$thirdPageHandbook[0]['thumbnail']; ?>"
                            class="mt-lg-2 img-fluid rounded-2" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="mt-2 w-100 px-3 py-2 d-flex flex-column">
                            <p class="text-uppercase fw-normal fs-5 text-dark m-0">
                                <?php echo $thirdPageHandbook[0]['name']; ?></p>
                            <h3 class="tilte-handbook"><?php echo $thirdPageHandbook[0]['title']; ?></h3>
                            <span
                                class="special-content text-dark fw-lighter fs-5"><?php echo $thirdPageHandbook[0]['descr']; ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Nội dung chính -->
<section class="section-main pb-3">
    <div class="container-lg">
        <div class="row mt-lg-4">
            <?php
            unset($thirdPageHandbook[0]);
            $thirdPageHandbook = array_values($thirdPageHandbook); 
            if (!empty($thirdPageHandbook)):
                foreach ($thirdPageHandbook as $item):
        ?>
            <div class="col-lg-4 col-md-4 mt-3">
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
</section>