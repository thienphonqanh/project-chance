<?php
class Handbook extends Controller
{
    private $handbookModel;
    private $data = [];
    private $config = [];

    public function __construct()
    {
        global $config;
        $this->config = $config['app'];
        $this->handbookModel = $this->model('HandbookModel', 'admin');
    }

    public function getListHandbook()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];

        if (!empty($data)) :
            extract($data);

            if (isset($category) && $category != 0) :
                $filters['handbook_category_id'] = $category;
            endif;
        endif;

        $resultPaginate = $this->handbookModel->handleGetListHandbook($filters, $keyword ?? '', $this->config['page_limit']);

        $allCategories = $this->handbookModel->handleGetAllCategory();

        $result = $resultPaginate['data'];

        $links = $resultPaginate['link'];

        if (!empty($result)) :
            $listHandbook = $result;
            $this->data['dataView']['listHandbook'] = $listHandbook;
        endif;

        if (!empty($allCategories)) :
            $this->data['dataView']['allCategories'] = $allCategories;
        endif;

        $this->data['body'] = 'admin/handbooks/index';
        $this->data['dataView']['request'] = $request;
        $this->data['dataView']['links'] = $links;
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function addHandbook()
    {
        $request = new Request();

        if ($request->isPost()) :
            $data = $request->getFields();
            $uploadOk = 1;

            if (empty($_FILES['avatar-input']['full_path'])) :
                $avatarPath = 'public/client/assets/images/default_post.jpg';
            else :
                // Xử lý tệp được tải lên
                $targetDir = "app/uploads/post/"; // Thư mục để lưu trữ ảnh đại diện
                $targetFile = $targetDir . basename($_FILES["avatar-input"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Kiểm tra xem tệp có phải là ảnh hợp lệ hay không
                $check = getimagesize($_FILES["avatar-input"]["tmp_name"]);
                if ($check !== false) :
                    $uploadOk = 1;
                else :
                    Session::flash('msg', 'File không phải là ảnh');
                    Session::flash('msg_type', 'danger');
                    $uploadOk = 0;
                endif;

                // Kiểm tra kích thước tệp
                $sizeFile = 5 * 1024 * 1024; // 5MB
                if ($_FILES["avatar-input"]["size"] > $sizeFile) {
                    Session::flash('msg', 'Kích thước file quá lớn (yêu cầu tối đa 5MB)');
                    Session::flash('msg_type', 'danger');
                    $uploadOk = 0;
                }

                // Kiểm tra định dạng ảnh
                if (
                    $imageFileType != "jpg" && $imageFileType != "png"
                    && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != 'webp'
                ) {
                    Session::flash('msg', 'File không đúng định dạng ảnh (.jpg, .png, .jpeg, .gif)');
                    Session::flash('msg_type', 'danger');
                    $uploadOk = 0;
                }

                // Kiểm tra nếu có lỗi xảy ra
                if ($uploadOk == 0) :
                    Session::flash('msg', 'Hiện tại không thể upload file');
                    Session::flash('msg_type', 'danger');
                endif;
            endif;

            $request->rules([
                'title' => 'required',
                'slug' => 'required',
                'main_category' => 'required',
                'content' => 'required',
            ]);

            $request->message([
                'title.required' => 'Tiêu đề không được để trống',
                'slug.required' => 'Đường dẫn không được để trống',
                'main_category.required' => 'Danh mục không được để trống',
                'content.required' => 'Nội dung bài viết không được để trống',
            ]);

            $validate = $request->validate();

            if ($validate && $uploadOk == 1) :
                if (!empty($targetFile)) :
                    if (move_uploaded_file($_FILES["avatar-input"]["tmp_name"], $targetFile)) :
                        // Cập nhật đường dẫn ảnh đại diện vào database
                        $avatarPath = $targetFile;
                    endif;
                endif;

                $result = $this->handbookModel->handleAddHandbook($data, $avatarPath);

                if ($result) :
                    Session::flash('msg', 'Thêm mới thành công');
                    Session::flash('msg_type', 'success');
                else :
                    Session::flash('msg', 'Thêm mới thất bại');
                    Session::flash('msg_type', 'danger');
                endif;
            else :
                Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                Session::flash('msg_type', 'danger');
            endif;
        endif;

        $this->data['body'] = 'admin/handbooks/add';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function getCategory()
    {

        $categories = $this->handbookModel->handleGetCategory();

        if (!empty($categories)) :
            echo json_encode($categories);
        endif;
    }

    public function getSubCategory()
    {

        if (!empty($_GET['category'])) :
            $categoryId = $_GET['category'];

            $subCategories = $this->handbookModel->handleGetSubCategory($categoryId);

            if (!empty($subCategories)) :
                echo json_encode($subCategories);
            endif;
        endif;
    }

    public function viewHandbook()
    {
        $request = new Request();

        $data = $request->getFields();

        if (!empty($data['id'])) :
            $handbookId = $data['id'];

            $result = $this->handbookModel->handleViewHandbook($handbookId);
            $allCategories = $this->handbookModel->handleGetAllCategory();
            $allSubCategories = $this->handbookModel->handleGetAllSubCategory();

            if (!empty($result)) :
                $dataHandbook = $result;
                $this->data['dataView']['dataHandbook'] = $dataHandbook;
            endif;

            if (!empty($allCategories)) :
                $this->data['dataView']['allCategories'] = $allCategories;
            endif;

            if (!empty($allSubCategories)) :
                $this->data['dataView']['allSubCategories'] = $allSubCategories;
            endif;

        endif;

        $this->data['body'] = 'admin/handbooks/detail';
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function updateHandbook()
    {
        $request = new Request();

        $handbookId = $_GET['id'];
        $checkOld = $this->handbookModel->handleGetOld($handbookId);
        $oldThumbnail = $checkOld['thumbnail'];

        if ($request->isPost()) :
            $data = $request->getFields();
            $uploadOk = 1;

            if (empty($_FILES['avatar-input']['full_path'])) :
                if (!empty($data['delete-image'])) :
                    $avatarPath = 'public/client/assets/images/default_post.jpg';
                    $uploadOk = 1;
                else :
                    if (!empty($oldThumbnail)) :
                        $avatarPath = $oldThumbnail;
                    else :
                        $avatarPath = 'public/client/assets/images/default_post.jpg';
                    endif;
                    $uploadOk = 1;
                endif;
            else :
                // Xử lý tệp được tải lên
                $targetDir = "app/uploads/post/"; // Thư mục để lưu trữ ảnh đại diện
                $targetFile = $targetDir . basename($_FILES["avatar-input"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Kiểm tra xem tệp có phải là ảnh hợp lệ hay không
                $check = getimagesize($_FILES["avatar-input"]["tmp_name"]);
                if ($check !== false) :
                    $uploadOk = 1;
                else :
                    Session::flash('msg', 'File không phải là ảnh');
                    Session::flash('msg_type', 'danger');
                    $uploadOk = 0;
                endif;

                // Kiểm tra kích thước tệp
                $sizeFile = 5 * 1024 * 1024; // 5MB
                if ($_FILES["avatar-input"]["size"] > $sizeFile) {
                    Session::flash('msg', 'Kích thước file quá lớn (yêu cầu tối đa 5MB)');
                    Session::flash('msg_type', 'danger');
                    $uploadOk = 0;
                }

                // Kiểm tra định dạng ảnh
                if (
                    $imageFileType != "jpg" && $imageFileType != "png"
                    && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != 'webp'
                ) {
                    Session::flash('msg', 'File không đúng định dạng ảnh (.jpg, .png, .jpeg, .gif, .webp)');
                    Session::flash('msg_type', 'danger');
                    $uploadOk = 0;
                }

                // Kiểm tra nếu có lỗi xảy ra
                if ($uploadOk == 0) :
                    Session::flash('msg', 'Hiện tại không thể upload file');
                    Session::flash('msg_type', 'danger');
                endif;
            endif;

            $request->rules([
                'title' => 'required',
                'slug' => 'required',
                'main_category' => 'required',
                'content' => 'required',
            ]);

            $request->message([
                'title.required' => 'Tiêu đề không được để trống',
                'slug.required' => 'Đường dẫn không được để trống',
                'main_category.required' => 'Danh mục không được để trống',
                'content.required' => 'Nội dung bài viết không được để trống',
            ]);

            $validate = $request->validate();

            if ($validate && $uploadOk == 1) :
                if (!empty($targetFile)) :
                    if (move_uploaded_file($_FILES["avatar-input"]["tmp_name"], $targetFile)) :
                        // Cập nhật đường dẫn ảnh đại diện vào database
                        $avatarPath = $targetFile;
                    endif;
                endif;

                $result = $this->handbookModel->handleUpdateHandbook($data, $handbookId, $avatarPath);

                if ($result) :
                    Session::flash('msg', 'Thay đổi thành công');
                    Session::flash('msg_type', 'success');
                else :
                    Session::flash('msg', 'Thay đổi thất bại');
                    Session::flash('msg_type', 'danger');
                endif;
            else :
                Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                Session::flash('msg_type', 'danger');
            endif;
        endif;

        if (!empty($handbookId)) :
            $result = $this->handbookModel->handleViewHandbook($handbookId);

            if (!empty($result)) :
                $dataHandbook = $result;
                $this->data['dataView']['dataHandbook'] = $dataHandbook;
            endif;
        endif;

        $allCategories = $this->handbookModel->handleGetAllCategory();
        $allSubCategories = $this->handbookModel->handleGetAllSubCategory();

        if (!empty($allCategories)) :
            $this->data['dataView']['allCategories'] = $allCategories;
        endif;

        if (!empty($allSubCategories)) :
            $this->data['dataView']['allSubCategories'] = $allSubCategories;
        endif;

        $this->data['body'] = 'admin/handbooks/edit';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function delete()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data)) :
            $itemsToDelete = isset($data['item']) ? $data['item'] : [];
            $itemsToDelete = implode(',', $itemsToDelete);

            $result = $this->handbookModel->handleDelete($itemsToDelete);

            if ($result) :
                $response->redirect('handbooks/danh-sach');
            endif;
        endif;
    }
}
