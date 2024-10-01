<?php
class Group extends Controller
{
    private $groupModel;
    private $data = [];
    private $config = [];

    public function __construct()
    {
        global $config;
        $this->config = $config['app'];
        $this->groupModel = $this->model('GroupModel', 'admin');
    }

    public function getEmployer()
    {
        $request = new Request();
        $query = $request->getFields();

        $filters = [];

        if (!empty($query)) :
            extract($query);

            if (isset($status)) :
                switch ($status):
                    case 'active':
                        $filters['status'] = $status = 1;
                        break;
                    case 'inactive':
                        $filters['status'] = $status = 0;
                        break;
                    case 'unactive':
                        $filters['status'] = $status = 2;
                        break;
                endswitch;
            endif;
        endif;

        $resultPaginate = $this->groupModel->handleGetEmployer($filters, $keyword ?? '', $this->config['page_limit']);

        $result = $resultPaginate['data'];

        $links = $resultPaginate['link'];

        if (!empty($result)) :
            $listEmployer = $result;
            $this->data['dataView']['listEmployer'] = $listEmployer;
        else :
            $emtyValue = 'Không có dữ liệu';
            $this->data['dataView']['emptyValue'] = $emtyValue;
        endif;

        $this->data['body'] = 'admin/groups/employer';
        $this->data['dataView']['request'] = $request;
        $this->data['dataView']['links'] = $links;
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function getCandidate()
    {
        $request = new Request();
        $query = $request->getFields();

        $filters = [];

        if (!empty($query)) :
            extract($query);

            if (isset($status)) :
                switch ($status):
                    case 'active':
                        $filters['status'] = $status = 1;
                        break;
                    case 'inactive':
                        $filters['status'] = $status = 0;
                        break;
                    case 'unactive':
                        $filters['status'] = $status = 2;
                        break;
                endswitch;
            endif;
        endif;

        $resultPaginate = $this->groupModel->handleGetCandidate($filters, $keyword ?? '', $this->config['page_limit']);

        $result = $resultPaginate['data'];

        $links = $resultPaginate['link'];

        if (!empty($result)) :
            $listCandidate = $result;
            $this->data['dataView']['listCandidate'] = $listCandidate;
        else :
            $emtyValue = 'Không có dữ liệu';
            $this->data['dataView']['emptyValue'] = $emtyValue;
        endif;

        $this->data['body'] = 'admin/groups/candidate';
        $this->data['dataView']['request'] = $request;
        $this->data['dataView']['links'] = $links;
        $this->render('layouts/layout', $this->data, 'admin');
    }

    // Xem thông tin cá nhân của ứng viên
    public function viewProfileEmployer()
    {
        $request = new Request();

        $data = $request->getFields();

        if (!empty($data['id'])) :
            $userId = $data['id'];

            $result = $this->groupModel->handleViewProfileEmployer($userId);
            $jobField = $this->groupModel->handleGetJobField();

            if (!empty($result) && !empty($jobField)) :
                $dataProfile = $result;

                $this->data['dataView']['dataProfile'] = $dataProfile;
                $this->data['dataView']['jobField'] = $jobField;
            else :
                $emtyValue = 'Không có dữ liệu';
                $this->data['dataView']['emptyValue'] = $emtyValue;
            endif;
        endif;


        $this->data['body'] = 'admin/profile/employer';
        $this->render('layouts/layout', $this->data, 'admin');
    }


    // Xem thông tin cá nhân của ứng viên
    public function viewProfileCandidate()
    {
        $request = new Request();

        $data = $request->getFields();

        if (!empty($data['id'])) :
            $userId = $data['id'];

            $result = $this->groupModel->handleViewProfileCandidate($userId);

            if (!empty($result)) :
                $dataProfile = $result;
                $this->data['dataView']['dataProfile'] = $dataProfile;
            else :
                $emtyValue = 'Không có dữ liệu';
                $this->data['dataView']['emptyValue'] = $emtyValue;
            endif;
        endif;


        $this->data['body'] = 'admin/profile/candidate';
        $this->render('layouts/layout', $this->data, 'admin');
    }

    // Sửa thông tin cá nhân của user
    public function updateProfileEmployer()
    {
        $request = new Request();

        $data = $request->getFields();
        $userId = $_GET['id'];

        $checkOld = $this->groupModel->handleGetOldEmployer($userId);
        $oldEmail = $checkOld['email'];
        $oldPhone = $checkOld['phone'];
        $oldThumbnail = $checkOld['thumbnail'];

        if ($request->isPost()) :

            $uploadOk = 1;

            if (empty($_FILES['avatar-input']['full_path'])) :
                if (!empty($data['delete-image'])) :
                    $avatarPath = 'public/client/assets/images/default_image.jpg';
                    $uploadOk = 1;
                else :
                    if (!empty($oldThumbnail)) :
                        $avatarPath = $oldThumbnail;
                    else :
                        $avatarPath = 'public/client/assets/images/default_image.jpg';
                    endif;
                    $uploadOk = 1;
                endif;
            else :
                // Xử lý tệp được tải lên
                $targetDir = "app/uploads/avatar/"; // Thư mục để lưu trữ ảnh đại diện
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
                    && $imageFileType != "jpeg" && $imageFileType != "gif"
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


            if (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail == $data['email'] && $oldPhone == $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11',
                    'phone' => 'required|phone',
                    'name' => 'required|min:5',
                    'address' => 'required',
                    'scales' => 'required',
                    'job_field' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'name.required' => 'Tên công ty không được để trống',
                    'name.min' => 'Tên công ty phải lớn hơn 4 ký tự',
                    'address.required' => 'Địa chỉ công ty không được để trống',
                    'scales.required' => 'Quy mô công ty không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                ]);

            elseif (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail != $data['email'] && $oldPhone == $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11|unique:candidates:email',
                    'phone' => 'required|phone',
                    'name' => 'required|min:5',
                    'address' => 'required',
                    'scales' => 'required',
                    'job_field' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'email.unique' => 'Email đã tồn tại',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'name.required' => 'Tên công ty không được để trống',
                    'name.min' => 'Tên công ty phải lớn hơn 4 ký tự',
                    'address.required' => 'Địa chỉ công ty không được để trống',
                    'scales.required' => 'Quy mô công ty không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                ]);

            elseif (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail == $data['email'] && $oldPhone != $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11',
                    'phone' => 'required|phone|unique:candidates:phone',
                    'name' => 'required|min:5',
                    'address' => 'required',
                    'scales' => 'required',
                    'job_field' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'phone.unique' => 'Số điện thoại đã tồn tại',
                    'name.required' => 'Tên công ty không được để trống',
                    'name.min' => 'Tên công ty phải lớn hơn 4 ký tự',
                    'address.required' => 'Địa chỉ công ty không được để trống',
                    'scales.required' => 'Quy mô công ty không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                ]);

            else :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11|unique:candidates:email',
                    'phone' => 'required|phone|unique:candidates:phone',
                    'name' => 'required|min:5',
                    'address' => 'required',
                    'scales' => 'required',
                    'job_field' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'email.unique' => 'Email đã tồn tại',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'phone.unique' => 'Số điện thoại đã tồn tại',
                    'name.required' => 'Tên công ty không được để trống',
                    'name.min' => 'Tên công ty phải lớn hơn 4 ký tự',
                    'address.required' => 'Địa chỉ công ty không được để trống',
                    'scales.required' => 'Quy mô công ty không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                ]);
            endif;

            $validate = $request->validate();

            if ($validate && $uploadOk == 1) :
                if (!empty($userId)) :
                    if (!empty($targetFile)) :
                        if (move_uploaded_file($_FILES["avatar-input"]["tmp_name"], $targetFile)) :
                            // Cập nhật đường dẫn ảnh đại diện vào database
                            $avatarPath = $targetFile;
                        endif;
                    endif;

                    $resultUpdate = $this->groupModel->handleUpdateProfileEmployer($userId, $avatarPath);
                endif;

                if ($resultUpdate) :
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

        if (!empty($userId)) :
            $result = $this->groupModel->handleViewProfileEmployer($userId);
            $jobField = $this->groupModel->handleGetJobField();

            if (!empty($result) && !empty($jobField)) :
                $dataProfile = $result;

                $this->data['dataView']['dataProfile'] = $dataProfile;
                $this->data['dataView']['jobField'] = $jobField;
            else :
                $emtyValue = 'Không có dữ liệu';
                $this->data['dataView']['emptyValue'] = $emtyValue;
            endif;
        endif;

        $this->data['body'] = 'admin/profile/employer_edit';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }


    // Sửa thông tin cá nhân của user
    public function updateProfileCandidate()
    {
        $request = new Request();

        $data = $request->getFields();
        $userId = $_GET['id'];

        $checkOld = $this->groupModel->handleGetOldCandidate($userId);
        $oldEmail = $checkOld['email'];
        $oldPhone = $checkOld['phone'];
        $oldThumbnail = $checkOld['thumbnail'];

        if ($request->isPost()) :
            $uploadOk = 1;

            if (empty($_FILES['avatar-input']['full_path'])) :
                if (!empty($data['delete-image'])) :
                    $avatarPath = 'public/client/assets/images/default_image.jpg';
                    $uploadOk = 1;
                else :
                    if (!empty($oldThumbnail)) :
                        $avatarPath = $oldThumbnail;
                    else :
                        $avatarPath = 'public/client/assets/images/default_image.jpg';
                    endif;
                    $uploadOk = 1;
                endif;
            else :
                // Xử lý tệp được tải lên
                $targetDir = "app/uploads/avatar/"; // Thư mục để lưu trữ ảnh đại diện
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
                    && $imageFileType != "jpeg" && $imageFileType != "gif"
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


            if (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail == $data['email'] && $oldPhone == $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11',
                    'phone' => 'required|phone',
                    'dob' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'dob.required' => 'Ngày sinh không được để trống',
                ]);

            elseif (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail != $data['email'] && $oldPhone == $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11|unique:candidates:email',
                    'phone' => 'required|phone',
                    'dob' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'email.unique' => 'Email đã tồn tại',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'dob.required' => 'Ngày sinh không được để trống',
                ]);

            elseif (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail == $data['email'] && $oldPhone != $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11',
                    'phone' => 'required|phone|unique:candidates:phone',
                    'dob' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'phone.unique' => 'Số điện thoại đã tồn tại',
                    'dob.required' => 'Ngày sinh không được để trống',
                ]);

            else :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11|unique:candidates:email',
                    'phone' => 'required|phone|unique:candidates:phone',
                    'dob' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'email.unique' => 'Email đã tồn tại',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Số điện thoại không hợp lệ',
                    'phone.unique' => 'Số điện thoại đã tồn tại',
                    'dob.required' => 'Ngày sinh không được để trống',
                ]);
            endif;

            $validate = $request->validate();

            if ($validate && $uploadOk == 1) :
                if (!empty($userId)) :
                    if (!empty($targetFile)) :
                        if (move_uploaded_file($_FILES["avatar-input"]["tmp_name"], $targetFile)) :
                            // Cập nhật đường dẫn ảnh đại diện vào database
                            $avatarPath = $targetFile;
                        endif;
                    endif;

                    $resultUpdate = $this->groupModel->handleUpdateProfileCandidate($userId, $avatarPath);
                endif;

                if ($resultUpdate) :
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

        if (!empty($userId)) :
            $result = $this->groupModel->handleViewProfileCandidate($userId);

            if (!empty($result)) :
                $dataProfile = $result;
                $this->data['dataView']['dataProfile'] = $dataProfile;
            else :
                $emtyValue = 'Không có dữ liệu';
                $this->data['dataView']['emptyValue'] = $emtyValue;
            endif;
        endif;

        $this->data['body'] = 'admin/profile/candidate_edit';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }

    // Xử lý trạng thái account
    public function changeStatusAccountCandidate()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data['id']) && !empty($data['action'])) :
            $userId = $data['id'];
            $action = $data['action'];

            $result = $this->groupModel->handleChangeStatusAccountCandidate($userId, $action); // Gọi xử lý ở Model

            if ($result) :
                $response->redirect('groups/ung-vien');
            endif;

        endif;
    }

    // Xử lý trạng thái account
    public function changeStatusAccountEmployer()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data['id']) && !empty($data['action'])) :
            $userId = $data['id'];
            $action = $data['action'];

            $result = $this->groupModel->handleChangeStatusAccountEmployer($userId, $action); // Gọi xử lý ở Model

            if ($result) :
                $response->redirect('groups/nha-tuyen-dung');
            endif;

        endif;
    }

    // Xoá nhân sự
    public function deleteEmployer()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data)) :
            $itemsToDelete = isset($data['item']) ? $data['item'] : [];
            $itemsToDelete = implode(',', $itemsToDelete);

            $result = $this->groupModel->handleDeleteEmployer($itemsToDelete);

            if ($result) :
                $response->redirect('groups/nha-tuyen-dung');
            endif;

        endif;
    }

    // Xoá ứng viên
    public function deleteCandidate()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data)) :
            $itemsToDelete = isset($data['item']) ? $data['item'] : [];
            $itemsToDelete = implode(',', $itemsToDelete);

            $checkProfile = $this->groupModel->handleCheckProfile($itemsToDelete);

            if ($checkProfile) :
                $deleteProfile = $this->groupModel->handleDeleteProfile($itemsToDelete);

                if ($deleteProfile) :
                    $result = $this->groupModel->handleDeleteCandidate($itemsToDelete);
    
                    if ($result) :
                        $response->redirect('groups/ung-vien');
                    endif;
                endif;
            else:
                $result = $this->groupModel->handleDeleteCandidate($itemsToDelete);
    
                if ($result) :
                    $response->redirect('groups/ung-vien');
                endif;
            endif;
        endif;
    }
}
