<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="" method="post">
            <div class="row">
                <div class="col-4">
                    <select class="form-select" name="status">
                        <option value="all">--- Tất cả trạng thái ---</option>
                        <option value="inactive"
                            <?php isset($request->getFields()['status']) && $request->getFields()['status'] == 'inactive' ? 'selected' : '' ?>>
                            Chờ duyệt</option>
                        <option value="active"
                            <?php isset($request->getFields()['status']) && $request->getFields()['status'] == 'active' ? 'selected' : '' ?>>
                            Đã duyệt</option>
                        <option value="unactive"
                            <?php isset($request->getFields()['status']) && $request->getFields()['status'] == 'unactive' ? 'selected' : '' ?>>
                            Bị loại</option>
                    </select>
                </div>
                <div class="col-5">
                    <input type="search" name="keyword" class="form-control"
                        placeholder="Nhập từ khoá (Tiêu đề, công ty, địa điểm)..."
                        value="<?php isset($request->getFields()['keyword']) ?? '' ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="groups">
        </form>
        <hr>
        <form action="<?php echo _WEB_ROOT; ?>/jobs/danh-sach/xoa" method="post" class="form-delete">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">
                            <input type="checkbox" class="checkbox-select-all">
                        </th>
                        <th class="text-center">Tiêu đề</th>
                        <th class="text-center" width="20%">Công ty</th>
                        <th class="text-center" width="11%">Địa điểm</th>
                        <th class="text-center" width="9%">Trạng thái</th>
                        <th class="text-center" width="8%">Thời hạn</th>
                        <th class="text-center" width="8%">Xem</th>
                        <th class="text-center" width="8%">Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($listJob)) :
                        foreach ($listJob as $item) :
                    ?>
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" class="checkbox-item" name="item[]"
                                value="<?php echo $item['id'] ?>">
                        </td>
                        <td class="text-center"><?php echo $item['title'] ?></td>
                        <td class="text-center"><?php echo $item['name'] ?></td>
                        <td class="text-center"><?php echo $item['location'] ?></td>
                        <td class="text-center">
                            <?php
                                    switch ($item['status']):
                                        case 0:
                                            echo '<div class="dropdown">
                                            <button class="btn btn-warning btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Chờ duyệt
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="' . _WEB_ROOT . '/jobs/danh-sach/trang-thai?action=active&id=' . $item['id'] . '">Duyệt</a></li>
                                                <li><a class="dropdown-item" href="' . _WEB_ROOT . '/jobs/danh-sach/trang-thai?action=unactive&id=' . $item['id'] . '">Từ chối</a></li>
                                            </ul>
                                            </div>';
                                            break;
                                        case 1:
                                            echo '<div class="dropdown">
                                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Đã duyệt
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="' . _WEB_ROOT . '/jobs/danh-sach/trang-thai?action=inactive&id=' . $item['id'] . '">Chờ duyệt</a></li>
                                                <li><a class="dropdown-item" href="' . _WEB_ROOT . '/jobs/danh-sach/trang-thai?action=unactive&id=' . $item['id'] . '">Từ chối</a></li>
                                            </ul>
                                            </div>';
                                            break;
                                        case 2:
                                            echo '<div class="dropdown">
                                            <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Bị loại 
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="' . _WEB_ROOT . '/jobs/danh-sach/trang-thai?action=active&id=' . $item['id'] . '">Duyệt</a></li>
                                                <li><a class="dropdown-item" href="' . _WEB_ROOT . '/jobs/danh-sach/trang-thai?action=inactive&id=' . $item['id'] . '">Chờ duyệt</a></li>
                                            </ul>
                                            </div>';
                                            break;
                                    endswitch;
                                    ?>
                        </td>
                        <td class="text-center"><?php echo getDateTimeFormat($item['deadline'], 'd-m-Y') ?></td>
                        <td class="text-center"><a
                                href="<?php echo _WEB_ROOT; ?>/jobs/danh-sach/thong-tin?id=<?php echo $item['id'] ?>"
                                class="btn btn-primary btn-sm"><i class="bi bi-eye"></i>
                                Xem</a></td>
                        <td class="text-center"><a
                                href="<?php echo _WEB_ROOT; ?>/jobs/danh-sach/chinh-sua?id=<?php echo $item['id'] ?>"
                                class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>
                                Sửa</a></td>
                    </tr>
                    <?php endforeach;
                    else : ?>
                    <tr>
                        <td colspan="8" class="text-center bg-danger"><?php echo $emptyValue; ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col-6">
                    <button type="submit" class="btn btn-danger delete-button" disabled>Xoá đã chọn (0)</button>
                </div>
                <div class="col-6">
                    <nav class="d-flex justify-content-end"><?php echo $links; ?></nav>
                </div>
            </div>
        </form>

    </div><!-- /.container-fluid -->
</section>