<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo _WEB_ROOT; ?>/admin" class="brand-link">
        <span class="brand-text font-weight-light">Trang quản trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo _WEB_ROOT . '/' . getAvatarUserLogin(); ?>" style="width: 32px; height: 32px;"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo getNameUserLogin(); ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?php echo _WEB_ROOT; ?>/admin"
                        class="nav-link <?php echo handleActiveSidebar('admin') ? 'active' : false; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang chủ
                        </p>
                    </a>
                </li>
                <li class="nav-item <?php echo handleActiveSidebar('groups') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link  <?php echo handleActiveSidebar('groups') ? 'active' : false; ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Nhóm người dùng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_ROOT; ?>/groups/nha-tuyen-dung"
                                class="nav-link <?php echo handleActiveSidebar('groups', 'nha-tuyen-dung') ? 'active' : false; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách nhà tuyển dụng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo _WEB_ROOT; ?>/groups/ung-vien"
                                class="nav-link <?php echo handleActiveSidebar('groups', 'ung-vien') ? 'active' : false; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách ứng viên</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo handleActiveSidebar('jobs') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link  <?php echo handleActiveSidebar('jobs') ? 'active' : false; ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Quản lý việc làm
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_ROOT; ?>/jobs/danh-sach"
                                class="nav-link <?php echo handleActiveSidebar('jobs', 'danh-sach') ? 'active' : false; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách việc làm</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo _WEB_ROOT; ?>/jobs/ho-so-ung-vien"
                                class="nav-link <?php echo handleActiveSidebar('jobs', 'ho-so-ung-vien') ? 'active' : false; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Hồ sơ ứng viên</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo handleActiveSidebar('handbooks') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link  <?php echo handleActiveSidebar('handbooks') ? 'active' : false; ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Quản lý tin tức ngành nghề
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_ROOT; ?>/handbooks/danh-sach"
                                class="nav-link <?php echo handleActiveSidebar('handbooks', 'danh-sach') ? 'active' : false; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách tin tức</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo handleActiveSidebar('contacts') ? 'menu-open' : false; ?>">
                    <a href="#" class="nav-link  <?php echo handleActiveSidebar('contacts') ? 'active' : false; ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Quản lý liên hệ
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo _WEB_ROOT; ?>/contacts/danh-sach"
                                class="nav-link <?php echo handleActiveSidebar('contacts', 'danh-sach') ? 'active' : false; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách liên hệ</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<div class="content-wrapper">