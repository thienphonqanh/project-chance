<?php
class Profile extends Controller
{
    private $profileModel;
    private $data = [];

    public function __construct()
    {
        $this->profileModel = $this->model('ProfileModel', 'user');
    }

    public function changePassword()
    {
        $request = new Request();
        $userId = getIdUserLogin();

        if ($request->isPost()) :
            $request->rules([
                'old_password' => 'required',
                'new_password' => 'required|min:8|special',
                'confirm_new_password' => 'required|match:new_password'
            ]);

            $request->message([
                'old_password.required' => 'Mật khẩu cũ không được để trống',
                'new_password.required' => 'Mật khẩu mới không được để trống',
                'new_password.min' => 'Mật khẩu phải lớn hơn 7 ký tự',
                'new_password.special' => 'Mật khẩu phải có ít nhất 1 ký tự hoa và 1 ký tự đặc biệt',
                'confirm_new_password.required' => 'Mật khẩu không được để trống',
                'confirm_new_password.match' => 'Mật khẩu không trùng khớp',
            ]);

            $validate = $request->validate();

            if ($validate && !empty($userId)) :
                $result = $this->profileModel->handleChangePassword($userId);

                if ($result) :
                    Session::flash('msg', 'Thay đổi mật khẩu thành công');
                    Session::flash('msg_type', 'success');
                endif;
            else :
                Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                Session::flash('msg_type', 'danger');
            endif;
        endif;


        $this->data['body'] = 'client/profile/changepassword';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/main.layout', $this->data, 'client');
    }

    public function editPersonalInformation()
    {
        $request = new Request();

        $data = $request->getFields();
        $userId = getIdUserLogin();

        $checkOld = $this->profileModel->handleGetOldCandidate($userId);
        $oldEmail = $checkOld['email'];
        $oldPhone = $checkOld['phone'];
        $oldThumbnail = $checkOld['thumbnail'];

        if ($request->isPost()) :
            $uploadOk = 1;

            if (empty($_FILES['avatar-input']['full_path'])) :
                if (!empty($data['delete-image'])) :
                    $avatarPath = 'public/client/assets/images/4259794-200.png';
                    $uploadOk = 1;
                else :
                    if (!empty($oldThumbnail)) :
                        $avatarPath = $oldThumbnail;
                    else :
                        $avatarPath = 'public/client/assets/images/4259794-200.png';
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

                    $resultUpdate = $this->profileModel->handleUpdateProfileCandidate($userId, $avatarPath);
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
            $result = $this->profileModel->handleGetPersonalInformation($userId);

            if (!empty($result)) :
                $information = $result;

                $this->data['dataView']['information'] = $information;
            endif;
        endif;

        $this->data['body'] = 'client/profile/personalinformation';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/main.layout', $this->data, 'client');
    }

    public function addPersonalProfile()
    {
        $request = new Request();
        $response = new Response();

        $checkProfile = $this->profileModel->handleCheckProfile();

        if ($checkProfile) :
            $response->redirect('quan-ly-ho-so/ho-so');
        else :
            $userId = getIdUserLogin();

            if ($request->isPost()) :
                if (!empty($_FILES['upload-cv']['full_path'])) :
                    $target_dir = "app/uploads/cv/";
                    $target_file = $target_dir . basename($_FILES["upload-cv"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Kiểm tra kích thước file
                    $sizeFile = 5 * 1024 * 1024;
                    if ($_FILES["upload-cv"]["size"] > $sizeFile) :
                        Session::flash('msg', 'Kích thước file quá lớn');
                        Session::flash('msg_type', 'danger');
                        $uploadOk = 0;
                    endif;

                    // Cho phép các định dạng file
                    if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") :
                        Session::flash('msg', 'File không dúng định dạng');
                        Session::flash('msg_type', 'danger');
                        $uploadOk = 0;
                    endif;

                    $request->rules([
                        'job_desired' => 'required',
                        'job_field' => 'required',
                        'current_rank' => 'required',
                        'academic_level' => 'required',
                        'form_work' => 'required',
                        'rank_desired' => 'required',
                        'year_experience' => 'required',
                    ]);

                    $request->message([
                        'job_desired.required' => 'Họ và tên không được để trống',
                        'job_field.required' => 'Họ và tên không được để trống',
                        'current_rank.required' => 'Họ và tên không được để trống',
                        'academic_level.required' => 'Họ và tên không được để trống',
                        'form_work.required' => 'Họ và tên không được để trống',
                        'rank_desired.required' => 'Họ và tên không được để trống',
                        'year_experience.required' => 'Họ và tên không được để trống',
                    ]);

                    $validate = $request->validate();

                    // Kiểm tra nếu $uploadOk = 0
                    if ($uploadOk == 1) :
                        if ($validate) :
                            if (move_uploaded_file($_FILES["upload-cv"]["tmp_name"], $target_file)) :
                                if (!empty($userId)) :
                                    $result = $this->profileModel->handleAddPersonalProfile($userId, $target_file);

                                    if ($result) :
                                        $response->redirect('quan-ly-ho-so/ho-so');
                                    else :
                                        Session::flash('msg', 'Lưu thông tin thất bại');
                                        Session::flash('msg_type', 'danger');
                                    endif;
                                endif;
                            endif;
                        else :
                            Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                            Session::flash('msg_type', 'danger');
                        endif;
                    endif;
                else :
                    $request->rules([
                        'job_desired' => 'required',
                        'job_field' => 'required',
                        'current_rank' => 'required',
                        'academic_level' => 'required',
                        'form_work' => 'required',
                        'rank_desired' => 'required',
                        'year_experience' => 'required',
                    ]);

                    $request->message([
                        'job_desired.required' => 'Họ và tên không được để trống',
                        'job_field.required' => 'Họ và tên không được để trống',
                        'current_rank.required' => 'Họ và tên không được để trống',
                        'academic_level.required' => 'Họ và tên không được để trống',
                        'form_work.required' => 'Họ và tên không được để trống',
                        'rank_desired.required' => 'Họ và tên không được để trống',
                        'year_experience.required' => 'Họ và tên không được để trống',
                    ]);

                    $validate = $request->validate();

                    if ($validate) :
                        if (!empty($userId)) :
                            $result = $this->profileModel->handleAddPersonalProfile($userId, '');

                            if ($result) :
                                $response->redirect('quan-ly-ho-so/ho-so');
                            else :
                                Session::flash('msg', 'Lưu thông tin thất bại');
                                Session::flash('msg_type', 'danger');
                            endif;
                        endif;
                    else :
                        Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                        Session::flash('msg_type', 'danger');
                    endif;
                endif;
            endif;

            if (!empty($userId)) :
                $result = $this->profileModel->handleGetPersonalInformation($userId);

                if (!empty($result)) :
                    $information = $result;
                    $this->data['dataView']['information'] = $information;
                endif;
            endif;

            $jobField = $this->profileModel->handleGetJobField();
            $rank = $this->profileModel->handleGetJobRank();
            $education = $this->profileModel->handleGetEducation();
            $yearExp = $this->profileModel->handleGetYearExp();
            $formWork = $this->profileModel->handleGetFormWork();

            if (
                !empty($jobField) && !empty($rank)
                && !empty($education) && !empty($yearExp) && !empty($formWork)
            ) :

                $this->data['dataView']['jobField'] = $jobField;
                $this->data['dataView']['rank'] = $rank;
                $this->data['dataView']['education'] = $education;
                $this->data['dataView']['yearExp'] = $yearExp;
                $this->data['dataView']['formWork'] = $formWork;
            endif;

            $this->data['body'] = 'client/profile/add_profile';
            $this->data['dataView']['msg'] = Session::flash('msg');
            $this->data['dataView']['msgType'] = Session::flash('msg_type');
            $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
            $this->data['dataView']['old'] = Session::flash('chance_session_old');
            $this->render('layouts/main.layout', $this->data, 'client');
        endif;
    }

    public function viewPersonalProfile()
    {
        $response = new Response();

        $checkProfile = $this->profileModel->handleCheckProfile();

        if ($checkProfile) :
            $userId = getIdUserLogin();

            $profileInformation = $this->profileModel->handleGetPersonalProfile($userId);

            if (!empty($profileInformation)) :
                $this->data['dataView']['profileInformation'] = $profileInformation;

                $sameJobFieldData = $this->profileModel->handleGetSameData($profileInformation['job_category_id']);

                if (!empty($sameJobFieldData)) :
                    $this->data['dataView']['sameJobFieldData'] = $sameJobFieldData;
                endif;
            endif;

            $this->data['body'] = 'client/profile/view_profile';
            $this->data['dataView'][''] = '';
            $this->render('layouts/main.layout', $this->data, 'client');

        else :
            $response->redirect('quan-ly-ho-so/them-ho-so');
        endif;
    }

    public function editPersonalProfile()
    {
        $request = new Request();
        $response = new Response();

        $userId = getIdUserLogin();
        $profileId = $_GET['id'];

        $checkProfile = $this->profileModel->handleCheckProfile();

        if ($checkProfile && !empty($profileId)) :
            if ($request->isPost()) :
                if (!empty($_FILES['upload-cv']['full_path'])) :
                    $target_dir = "app/uploads/cv/";
                    $target_file = $target_dir . basename($_FILES["upload-cv"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Kiểm tra kích thước file
                    $sizeFile = 5 * 1024 * 1024;
                    if ($_FILES["upload-cv"]["size"] > $sizeFile) :
                        Session::flash('msg', 'Kích thước file quá lớn');
                        Session::flash('msg_type', 'danger');
                        $uploadOk = 0;
                    endif;

                    // Cho phép các định dạng file
                    if ($imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx") :
                        Session::flash('msg', 'File không dúng định dạng');
                        Session::flash('msg_type', 'danger');
                        $uploadOk = 0;
                    endif;

                    $request->rules([
                        'job_desired' => 'required',
                        'job_field' => 'required',
                        'current_rank' => 'required',
                        'academic_level' => 'required',
                        'form_work' => 'required',
                        'rank_desired' => 'required',
                        'year_experience' => 'required',
                    ]);

                    $request->message([
                        'job_desired.required' => 'Họ và tên không được để trống',
                        'job_field.required' => 'Họ và tên không được để trống',
                        'current_rank.required' => 'Họ và tên không được để trống',
                        'academic_level.required' => 'Họ và tên không được để trống',
                        'form_work.required' => 'Họ và tên không được để trống',
                        'rank_desired.required' => 'Họ và tên không được để trống',
                        'year_experience.required' => 'Họ và tên không được để trống',
                    ]);

                    $validate = $request->validate();

                    // Kiểm tra nếu $uploadOk = 0
                    if ($uploadOk == 1) :
                        if ($validate) :
                            if (move_uploaded_file($_FILES["upload-cv"]["tmp_name"], $target_file)) :
                                if (!empty($profileId)) :
                                    $result = $this->profileModel->handleEditPersonalProfile($profileId, $target_file);

                                    if ($result) :
                                        $response->redirect('quan-ly-ho-so/ho-so');
                                    else :
                                        Session::flash('msg', 'Lưu thông tin thất bại');
                                        Session::flash('msg_type', 'danger');
                                    endif;
                                endif;
                            endif;
                        else :
                            Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                            Session::flash('msg_type', 'danger');
                        endif;
                    endif;
                else :
                    $request->rules([
                        'job_desired' => 'required',
                        'job_field' => 'required',
                        'current_rank' => 'required',
                        'academic_level' => 'required',
                        'form_work' => 'required',
                        'rank_desired' => 'required',
                        'year_experience' => 'required',
                    ]);

                    $request->message([
                        'job_desired.required' => 'Họ và tên không được để trống',
                        'job_field.required' => 'Họ và tên không được để trống',
                        'current_rank.required' => 'Họ và tên không được để trống',
                        'academic_level.required' => 'Họ và tên không được để trống',
                        'form_work.required' => 'Họ và tên không được để trống',
                        'rank_desired.required' => 'Họ và tên không được để trống',
                        'year_experience.required' => 'Họ và tên không được để trống',
                    ]);

                    $validate = $request->validate();

                    if ($validate) :
                        if (!empty($profileId)) :
                            $result = $this->profileModel->handleEditPersonalProfile($profileId, '');

                            if ($result) :
                                $response->redirect('quan-ly-ho-so/ho-so');
                            else :
                                Session::flash('msg', 'Lưu thông tin thất bại');
                                Session::flash('msg_type', 'danger');
                            endif;
                        endif;
                    else :
                        Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                        Session::flash('msg_type', 'danger');
                    endif;
                endif;
            endif;

            if (!empty($userId)) :
                $result = $this->profileModel->handleGetPersonalInformation($userId);

                if (!empty($result)) :
                    $information = $result;
                    $this->data['dataView']['information'] = $information;
                endif;
            endif;

            $jobField = $this->profileModel->handleGetJobField();
            $rank = $this->profileModel->handleGetJobRank();
            $education = $this->profileModel->handleGetEducation();
            $yearExp = $this->profileModel->handleGetYearExp();
            $formWork = $this->profileModel->handleGetFormWork();

            if (
                !empty($jobField) && !empty($rank)
                && !empty($education) && !empty($yearExp) && !empty($formWork)
            ) :

                $this->data['dataView']['jobField'] = $jobField;
                $this->data['dataView']['rank'] = $rank;
                $this->data['dataView']['education'] = $education;
                $this->data['dataView']['yearExp'] = $yearExp;
                $this->data['dataView']['formWork'] = $formWork;
            endif;

            $profileInformation = $this->profileModel->handleGetPersonalProfile($userId);

            if (!empty($profileInformation)) :
                $this->data['dataView']['profileInformation'] = $profileInformation;
            endif;

            $this->data['body'] = 'client/profile/edit_profile';
            $this->data['dataView']['msg'] = Session::flash('msg');
            $this->data['dataView']['msgType'] = Session::flash('msg_type');
            $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
            $this->data['dataView']['old'] = Session::flash('chance_session_old');
            $this->render('layouts/main.layout', $this->data, 'client');
        else :
            $response->redirect('quan-ly-ho-so/them-ho-so');
        endif;
    }

    public function appliedJob()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];

        if (!empty($data)) :
            extract($data);

            if (isset($status)) :
                switch ($status):
                    case 'active':
                        $filters['job_applications.status'] = $status = 1;
                        break;
                    case 'inactive':
                        $filters['job_applications.status'] = $status = 0;
                        break;
                    case 'unactive':
                        $filters['job_applications.status'] = $status = 2;
                        break;
                endswitch;
            endif;
        endif;

        $countJobApplied = $this->profileModel->handleCountJobApplied();
        $result = $this->profileModel->handleGetListJobApplied($filters);

        if (!empty($result)) :
            $listJobApplied = $result;
            $this->data['dataView']['listJobApplied'] = $listJobApplied;
        endif;

        if (is_numeric($countJobApplied)) :
            $quantityJob = $countJobApplied;
            $this->data['dataView']['quantityJob'] = $quantityJob;
        endif;

        $this->data['body'] = 'client/profile/applied_job';
        $this->data['dataView']['request'] = $request;
        $this->render('layouts/main.layout', $this->data, 'client');
    }

    public function savedJob()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];

        if (!empty($data)) :
            extract($data);

            if (isset($status)) :
                switch ($status):
                    case 'active':
                        $filters['job_applications.status'] = $status = 1;
                        break;
                    case 'inactive':
                        $filters['job_applications.status'] = $status = 0;
                        break;
                    case 'unactive':
                        $filters['job_applications.status'] = $status = 2;
                        break;
                endswitch;
            endif;
        endif;

        $countJobApplied = $this->profileModel->handleCountJobApplied();
        $result = $this->profileModel->handleGetListJobApplied($filters);

        if (!empty($result)) :
            $listJobApplied = $result;
            $this->data['dataView']['listJobApplied'] = $listJobApplied;
        endif;

        if (is_numeric($countJobApplied)) :
            $quantityJob = $countJobApplied;
            $this->data['dataView']['quantityJob'] = $quantityJob;
        endif;

        $this->data['body'] = 'client/profile/saved_job';
        $this->data['dataView']['request'] = $request;
        $this->render('layouts/main.layout', $this->data, 'client');
    }
}
