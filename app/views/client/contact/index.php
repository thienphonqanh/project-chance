<main>

    <header class="site-header">
        <div class="section-overlay"></div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-12 text-center">
                    <h1 class="text-white">Liên hệ</h1>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Liên hệ</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </header>


    <section class="contact-section section-padding">
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-lg-6 col-12 mb-lg-5 mb-3">
                    <iframe class="google-map"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4722.136219194832!2d10.772202738834757!3d59.917660271855105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416fa8eba7e84d%3A0xf4e943975503fa30!2sUrtehagen%20(herb%20garden)!5e1!3m2!1sen!2sth!4v1680951932259!5m2!1sen!2sth"
                        width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="col-lg-5 col-12 mb-3 mx-auto">
                    <div class="contact-info-wrap">
                        <div class="contact-info d-flex align-items-center mb-3">
                            <i class="custom-icon bi-building"></i>

                            <p class="mb-0">
                                <span class="contact-info-small-title">Văn phòng</span>

                                Akershusstranda 20, 0150 Oslo, Norway
                            </p>
                        </div>

                        <div class="contact-info d-flex align-items-center">
                            <i class="custom-icon bi-globe"></i>

                            <p class="mb-0">
                                <span class="contact-info-small-title">Website</span>

                                <a href="#" class="site-footer-link">
                                    www.chancejobs.com
                                </a>
                            </p>
                        </div>

                        <div class="contact-info d-flex align-items-center">
                            <i class="custom-icon bi-telephone"></i>

                            <p class="mb-0">
                                <span class="contact-info-small-title">Phone</span>

                                <a href="tel: 345-000-9999" class="site-footer-link">
                                    345-000-9999
                                </a>
                            </p>
                        </div>

                        <div class="contact-info d-flex align-items-center">
                            <i class="custom-icon bi-envelope"></i>

                            <p class="mb-0">
                                <span class="contact-info-small-title">Email</span>

                                <a href="mailto:info@yourgmail.com" class="site-footer-link">
                                    recruitment@chance.co
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-12 mx-auto">
                    <form class="custom-form contact-form" method="post" role="form">
                        <h2 class="text-center mb-4">Nếu bạn cần hãy liên hệ ngay</h2>
                        <?php
                        if (!empty($msg)) :
                            echo '<div class="alert alert-' . $msgType . '">';
                            echo $msg;
                            echo '</div>';
                        endif;
                    ?>
                        <div class="row">
                            <?php 
                            if (isLogin()):
                        ?>
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="first-name">Họ và tên</label>

                                <input type="text" name="fullname" id="fullname" class="form-control m-0"
                                    placeholder="Họ và tên">
                                <?php echo form_error('fullname', $errors, '<span class="error">', '</span>') ?>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="email">Địa chỉ Email</label>

                                <input type="email" name="email" id="email" class="form-control m-0"
                                    placeholder="name@gmail.com">
                                <?php echo form_error('email', $errors, '<span class="error">', '</span>') ?>
                            </div>

                            <div class="col-lg-12 col-12 mt-3">
                                <label for="message">Gửi tin nhắn</label>

                                <textarea name="message" rows="6" class="form-control m-0" id="message"
                                    placeholder="Chúng tôi có thể giúp bạn điều gì?"></textarea>
                                <?php echo form_error('message', $errors, '<span class="error">', '</span>') ?>
                            </div>

                            <div class="col-lg-4 col-md-4 col-6 mx-auto mt-3">
                                <button type="submit" class="form-control">Gửi</button>
                            </div>

                            <?php else: ?>
                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="first-name">Họ và tên</label>

                                <input type="text" name="fullname" id="fullname" class="form-control"
                                    placeholder="Họ và tên">
                            </div>

                            <div class="col-lg-6 col-md-6 col-12">
                                <label for="email">Địa chỉ Email</label>

                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="name@gmail.com">
                            </div>

                            <div class="col-lg-12 col-12">
                                <label for="message">Gửi tin nhắn</label>

                                <textarea name="message" rows="6" class="form-control" id="message"
                                    placeholder="Chúng tôi có thể giúp bạn điều gì?"></textarea>
                            </div>

                            <div class="col-lg-4 col-md-4 col-6 mx-auto">
                                <a type="button" href="<?php echo _WEB_ROOT; ?>/dang-nhap"
                                    class="btn form-control text-white"
                                    style="background-color: var(--primary-color);">Gửi</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</main>