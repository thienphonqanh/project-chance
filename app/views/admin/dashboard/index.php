<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo !empty($countCandidate) ? $countCandidate : ''; ?></h3>

                        <p>Số lượng ứng viên</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="<?php echo _WEB_ROOT; ?>/groups/ung-vien" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo !empty($countEmployer) ? $countEmployer : ''; ?></h3>

                        <p>Số lượng nhà tuyển dụng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="<?php echo _WEB_ROOT; ?>/groups/nha-tuyen-dung" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo !empty($countJob) ? $countJob : ''; ?></h3>

                        <p>Số lượng việc làm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="<?php echo _WEB_ROOT; ?>/jobs/danh-sach" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo !empty($countHandbook) ? $countHandbook : ''; ?></h3>

                        <p>Số lương bài viết</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="<?php echo _WEB_ROOT; ?>/handbooks/danh-sach" class="small-box-footer">Chi tiết <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->