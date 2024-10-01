<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="" method="post">
            <div class="row">
                <div class="col-4">

                    <select class="form-select" name="category">
                        <option value="0">--- Tất cả danh mục ---</option>
                        <?php 
                        if (!empty($allCategories)):
                            foreach ($allCategories as $item):
                    ?>
                        <option value="<?php echo $item['id']; ?>"
                            <?php isset($request->getFields()['category']) && $request->getFields()['category'] === $item['id'] ? 'selected' : '' ?>>
                            <?php echo $item['name']; ?></option>
                        <?php endforeach; endif; ?>
                    </select>
                </div>
                <div class="col-5">
                    <input type="search" name="keyword" class="form-control"
                        placeholder="Nhập từ khoá (Tiêu đề, người đăng)..."
                        value="<?php isset($request->getFields()['keyword']) ?? '' ?>">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary btn-block">Tìm kiếm</button>
                </div>
            </div>
            <input type="hidden" name="module" value="groups">
        </form>
        <hr>
        <a type="button" href="<?php echo _WEB_ROOT; ?>/handbooks/them-moi" class="btn btn-primary px-3"><i
                class="bi bi-plus-circle-dotted px-1"></i> Thêm bài viết</a>
        <form action="<?php echo _WEB_ROOT; ?>/handbooks/danh-sach/xoa" method="post" class="form-delete">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th class="text-center" width="5%">
                            <input type="checkbox" class="checkbox-select-all">
                        </th>
                        <th class="text-center">Tiêu đề</th>
                        <th class="text-center" width="15%">Danh mục</th>
                        <th class="text-center" width="12%">Người đăng</th>
                        <th class="text-center" width="8%">Lượt xem</th>
                        <th class="text-center" width="10%">Ngày đăng</th>
                        <th class="text-center" width="8%">Xem</th>
                        <th class="text-center" width="8%">Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        if (!empty($listHandbook)):
                            foreach ($listHandbook as $item):
                    ?>
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" class="checkbox-item" name="item[]"
                                value="<?php echo $item['id']; ?>">
                        </td>
                        <td class="text-center"><?php echo $item['title']; ?></td>
                        <td class="text-center"><?php echo $item['main_category_name']; ?></td>
                        <td class="text-center"><?php echo $item['author']; ?></td>
                        <td class="text-center"><?php echo $item['view_count']; ?></td>
                        <td class="text-center"><?php echo getDateTimeFormat($item['create_at'], 'd-m-Y'); ?></td>
                        <td class="text-center"><a
                                href="<?php echo _WEB_ROOT; ?>/handbooks/danh-sach/thong-tin?id=<?php echo $item['id']; ?>"
                                class="btn btn-primary btn-sm"><i class="bi bi-eye"></i>
                                Xem</a></td>
                        <td class="text-center"><a
                                href="<?php echo _WEB_ROOT; ?>/handbooks/danh-sach/chinh-sua?id=<?php echo $item['id']; ?>"
                                class="btn btn-warning btn-sm"><i class="fa fa-edit"></i>
                                Sửa</a></td>
                    </tr>
                    <?php endforeach; else: ?>
                    <tr>
                        <td colspan="8" class="bg-danger text-white text-center">Không có dữ liệu</td>
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