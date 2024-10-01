 <!-- Nội dung trên cùng -->
 <section class="section-header">
     <div class="container-lg">
         <div class="row">
             <div class="col-lg-8 col-md-8 mt-2">
                 <div>
                     <a href="#" class="rounded fs-6 text-dark fst-italic bg-body-secondary p-1 px-2">#làm sao làm
                         sales</a>
                     <a href="#" class="rounded fs-6 text-dark fst-italic bg-body-secondary p-1 px-2">#thần số học</a>
                     <a href="#" class="rounded fs-6 text-dark fst-italic bg-body-secondary p-1 px-2">#mental health</a>
                     <a href="#" class="rounded fs-6 text-dark fst-italic bg-body-secondary p-1 px-2">#tất tần tật về
                         SEO</a>
                 </div>


                 <a
                     href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $randomHandbook[0]['slug'].'-'.$randomHandbook[0]['id'].'.html'; ?>">
                     <div class="mt-3 w-100">
                         <img src="<?php echo _WEB_ROOT.'/'.$randomHandbook[0]['thumbnail'] ?>"
                             class="img-fluid rounded-4" alt="">
                         <div class="mt-3 p-2">
                             <p class="text-uppercase fw-normal text-dark m-0"><?php echo $randomHandbook[0]['name']; ?>
                             </p>
                             <h3 class="mt-2 fw-bold tilte-handbook text-uppercase">
                                 <?php echo $randomHandbook[0]['title']; ?></h3>
                             <span class="special-content text-dark fw-lighter fs-5">
                                 <?php echo $randomHandbook[0]['descr']; ?>
                             </span>
                         </div>
                     </div>
                 </a>
             </div>

             <div class="col-lg-4 col-md-4">
                 <form action="" class="d-sm-none d-none d-lg-block d-md-block">
                     <div class="form-group d-flex flex-row">
                         <input type="search" name="handbook-search" class="form-control">
                         <button type="submit" class="btn ms-2"><i class="bi bi-search"></i></button>
                     </div>
                 </form>
                 <div>
                     <?php
                    unset($randomHandbook[0]);
                    $randomHandbook = array_values($randomHandbook); 
                    if (!empty($randomHandbook)):
                        foreach ($randomHandbook as $item):
                ?>
                     <div class="row">
                         <div class="col-lg-12 col-md-12 col-sm-6">
                             <a
                                 href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>">
                                 <div class="mt-2">
                                     <img src="<?php echo _WEB_ROOT.'/'.$item['thumbnail']; ?>"
                                         class="img-fluid rounded-4" alt="">
                                     <div class="mt-2">
                                         <p class="text-uppercase fw-normal text-dark m-0"><?php echo $item['name']; ?>
                                         </p>
                                         <h4 class="tilte-handbook"><?php echo $item['title']; ?></h4>
                                     </div>
                                 </div>
                             </a>
                         </div>
                     </div>
                 </div>
                 <?php endforeach; endif; ?>
             </div>
         </div>
     </div>
 </section>

 <!-- Nội dung chính -->
 <section class="section-main pb-3">
     <div class="container-lg">
         <!-- Trạm sạc kỹ năng -->
         <div class="mt-2">
             <div class="d-flex justify-content-between align-items-center">
                 <a href="<?php echo _WEB_ROOT; ?>/cam-nang/tram-sac-ky-nang">
                     <h5 class="post-category fw-normal fs-5 text-uppercase text-white p-2">Trạm sạc kỹ năng</h5>
                 </a>
                 <a href="<?php echo _WEB_ROOT; ?>/cam-nang/tram-sac-ky-nang"
                     class="btn border border-dark m-0 px-3">Xem tất cả</a>
             </div>
             <div>
                 <div class="row">
                     <?php 
                        if (!empty($secondPageHandbook)):
                            foreach ($secondPageHandbook as $item):
                    ?>
                     <div class="col-lg-4 col-md-4 mt-3">
                         <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>"
                             class="handbook-item d-block">
                             <img src="<?php echo _WEB_ROOT.'/'.$item['thumbnail']; ?>" class="img-fluid rounded-3"
                                 alt="">
                             <div class="mt-2 w-100 px-3 py-2 d-flex flex-column">
                                 <p class="text-uppercase fw-normal fs-6 text-dark m-0"><?php echo $item['name'] ?></p>
                                 <h5 class="tilte-handbook"><?php echo $item['title'] ?></h5>
                                 <span class="special-content text-dark fw-lighter fs-5">
                                     <?php echo $item['descr'] ?>
                                 </span>
                             </div>
                         </a>
                     </div>
                     <?php endforeach; endif; ?>
                 </div>
             </div>
         </div>

         <!-- La bàn sự nghiệp -->
         <div class="mt-5">
             <div class="d-flex justify-content-between align-items-center">
                 <a href="<?php echo _WEB_ROOT; ?>/cam-nang/la-ban-su-nghiep">
                     <h5 class="post-category fw-normal fs-5 text-uppercase text-white p-2">La bàn sự nghiệp</h5>
                 </a>
                 <a href="<?php echo _WEB_ROOT; ?>/cam-nang/la-ban-su-nghiep"
                     class="btn border border-dark m-0 px-3">Xem tất cả</a>
             </div>
             <div>
                 <div class="row">
                     <?php 
                    if (!empty($firstPageHandbook)):
                        foreach ($firstPageHandbook as $item):
                ?>
                     <div class="col-lg-4 col-md-4 mt-3">
                         <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>"
                             class="handbook-item d-block">
                             <img src="<?php echo _WEB_ROOT.'/'.$item['thumbnail']; ?>" class="img-fluid rounded-3"
                                 alt="">
                             <div class="mt-2 w-100 px-3 py-2 d-flex flex-column">
                                 <p class="text-uppercase fw-normal fs-6 text-dark m-0"><?php echo $item['name'] ?></p>
                                 <h5 class="tilte-handbook"><?php echo $item['title'] ?></h5>
                                 <span
                                     class="special-content text-dark fw-lighter fs-5"><?php echo $item['descr'] ?></span>

                             </div>
                         </a>
                     </div>
                     <?php endforeach; endif; ?>
                 </div>
             </div>
         </div>

         <!-- La bàn sự nghiệp -->
         <div class="mt-5">
             <div class="d-flex justify-content-between align-items-center">
                 <a href="<?php echo _WEB_ROOT; ?>/cam-nang/ki-ot-vui-ve">
                     <h5 class="post-category fw-normal fs-5 text-uppercase text-white p-2">Ki ốt vui vẻ</h5>
                 </a>
                 <a href="<?php echo _WEB_ROOT; ?>/cam-nang/ki-ot-vui-ve" class="btn border border-dark m-0 px-3">Xem
                     tất cả</a>
             </div>
             <div>
                 <div class="row">
                     <?php 
                    if (!empty($fourthPageHandbook)):
                        foreach ($fourthPageHandbook as $item):
                ?>
                     <div class="col-lg-4 col-md-4 mt-3">
                         <a href="<?php echo _WEB_ROOT; ?>/chi-tiet-bai-viet/<?php echo $item['slug'].'-'.$item['id'].'.html'; ?>"
                             class="handbook-item d-block">
                             <img src="<?php echo _WEB_ROOT.'/'.$item['thumbnail']; ?>" class="img-fluid rounded-3"
                                 alt="">
                             <div class="mt-2 w-100 px-3 py-2 d-flex flex-column">
                                 <p class="text-uppercase fw-normal fs-6 text-dark m-0"><?php echo $item['name'] ?></p>
                                 <h5 class="tilte-handbook"><?php echo $item['title'] ?></h5>
                                 <span
                                     class="special-content text-dark fw-lighter fs-5"><?php echo $item['descr'] ?></span>

                             </div>
                         </a>
                     </div>
                     <?php endforeach; endif; ?>
                 </div>
             </div>
         </div>
     </div>
 </section>