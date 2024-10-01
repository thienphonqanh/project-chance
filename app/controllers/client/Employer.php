<?php
class Employer extends Controller
{
    private $data = [];
    private $employerModel;

    public function __construct()
    {
        $this->employerModel = $this->model('EmployerModel', 'user');
    }

    public function index()
    {

        $this->data['body'] = 'client/ntd.home/index';
        $this->data['dataView'][''] = '';
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    public function editEmployerInformation()
    {
        $request = new Request();

        $data = $request->getFields();
        $userId = getIdEmployerLogin();

        $checkOld = $this->employerModel->handleGetOldEmployer($userId);
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
                    'company_name' => 'required',
                    'job_field' => 'required',
                    'scales' => 'required',
                    'address' => 'required',
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Định dạng số điện thoại không hợp lệ',
                    'company_name.required' => 'Tên công ty không được để trống',
                    'scales.required' => 'Quy mô không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                    'address.required' => 'Địa chỉ không được để trống',
                ]);

            elseif (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail != $data['email'] && $oldPhone == $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11|unique:companies:email',
                    'phone' => 'required|phone',
                    'company_name' => 'required',
                    'job_field' => 'required',
                    'scales' => 'required',
                    'address' => 'required',
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'email.unique' => 'Email đã tồn tại',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Định dạng số điện thoại không hợp lệ',
                    'company_name.required' => 'Tên công ty không được để trống',
                    'scales.required' => 'Quy mô không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                    'address.required' => 'Địa chỉ không được để trống',
                ]);

            elseif (
                !empty($oldEmail) && (!empty($oldPhone))
                && $oldEmail == $data['email'] && $oldPhone != $data['phone']
            ) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11',
                    'phone' => 'required|phone|unique:companies:phone',
                    'company_name' => 'required',
                    'job_field' => 'required',
                    'scales' => 'required',
                    'address' => 'required',
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Định dạng số điện thoại không hợp lệ',
                    'phone.unique' => 'Số điện thoại đã tồn tại',
                    'company_name.required' => 'Tên công ty không được để trống',
                    'scales.required' => 'Quy mô không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                    'address.required' => 'Địa chỉ không được để trống',
                ]);

            else :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email|min:11|unique:companies:email',
                    'phone' => 'required|phone|unique:companies:phone',
                    'company_name' => 'required',
                    'job_field' => 'required',
                    'scales' => 'required',
                    'address' => 'required',
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'email.min' => 'Email phải lớn hơn 11 ký tự',
                    'email.unique' => 'Email đã tồn tại',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.phone' => 'Định dạng số điện thoại không hợp lệ',
                    'phone.unique' => 'Số điện thoại đã tồn tại',
                    'company_name.required' => 'Tên công ty không được để trống',
                    'scales.required' => 'Quy mô không được để trống',
                    'job_field.required' => 'Lĩnh vực không được để trống',
                    'address.required' => 'Địa chỉ không được để trống',
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

                    $resultUpdate = $this->employerModel->handleUpdateProfileEmployer($userId, $avatarPath);
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
            $result = $this->employerModel->handleGetEmployerInformation($userId);
            $jobField = $this->employerModel->handleGetJobField();

            if (!empty($result) && !empty($jobField)) :
                $information = $result;

                $this->data['dataView']['information'] = $information;
                $this->data['dataView']['jobField'] = $jobField;
            endif;
        endif;

        $this->data['body'] = 'client/ntd.profile/employer_information';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    // Xem thông tin của việc làm
    public function addJob()
    {
        $request = new Request();

        $data = $request->getFields();

        if ($request->isPost()) :
            $uploadOk = 1;

            if (empty($_FILES['avatar-input']['full_path'])) :
                $avatarPath = 'public/client/assets/images/default_job.jpg';
            else :
                // Xử lý tệp được tải lên
                $targetDir = "app/uploads/job/"; // Thư mục để lưu trữ ảnh đại diện
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

            $request->rules([
                'title' => 'required',
                'form_work' => 'required',
                'job_field' => 'required',
                'location' => 'required',
                'salary' => 'required',
                'deadline' => 'required',
                'rank' => 'required',
                'education_required' => 'required',
                'exp_required' => 'required',
                'number_recruits' => 'required',
                'requirement' => 'required',
                'description' => 'required',
                'welfare' => 'required',
            ]);

            $request->message([
                'title.required' => 'Tiêu đề không được để trống',
                'form_work.required' => 'Hình thức làm việc không được để trống',
                'job_field.required' => 'Lĩnh vực không được để trống',
                'location.required' => 'Địa điểm không được để trống',
                'salary.required' => 'Lương không được để trống',
                'deadline.required' => 'Thời hạn nộp không được để trống',
                'rank.required' => 'Cấp bậc không được để trống',
                'education_required.required' => 'Yêu cầu bằng cấp không được để trống',
                'exp_required.required' => 'Yêu cầu kinh nghiệm không được để trống',
                'number_recruits.required' => 'Số lượng tuyển không được để trống',
                'requirement.required' => 'Yêu cầu công việc không được để trống',
                'description.required' => 'Mô tả công việc không được để trống',
                'welfare.required' => 'Phúc lợi không được để trống',
            ]);

            $validate = $request->validate();

            if ($validate && $uploadOk == 1) :
                if (!empty($targetFile)) :
                    if (move_uploaded_file($_FILES["avatar-input"]["tmp_name"], $targetFile)) :
                        // Cập nhật đường dẫn ảnh đại diện vào database
                        $avatarPath = $targetFile;
                    endif;
                endif;

                $result = $this->employerModel->handleAddJob($avatarPath);

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

        $jobField = $this->employerModel->handleGetJobField();
        $rank = $this->employerModel->handleGetJobRank();
        $education = $this->employerModel->handleGetEducation();
        $yearExp = $this->employerModel->handleGetYearExp();
        $formWork = $this->employerModel->handleGetFormWork();

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

        $this->data['body'] = 'client/ntd.profile/add_job';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    // Xem thông tin của việc làm
    public function listJob()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];

        if (!empty($data)) :
            extract($data);

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

        $countJob = $this->employerModel->handleCountJob();
        $result = $this->employerModel->handleGetListJob($filters, $keyword ?? '');

        if (!empty($result)) :
            $listJob = $result;
            $this->data['dataView']['listJob'] = $listJob;
        endif;

        if (is_numeric($countJob)) :
            $quantityJob = $countJob;
            $this->data['dataView']['quantityJob'] = $quantityJob;
        endif;

        $this->data['body'] = 'client/ntd.profile/list_job';
        $this->data['dataView']['request'] = $request;
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    // Xem thông tin của việc làm
    public function updateJob()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();
        $jobId = $_GET['id'];
        $checkOld = $this->employerModel->handleGetOldThumbnail($jobId);
        $oldThumbnail = $checkOld['thumbnail'];

        if ($request->isPost()) :
            $uploadOk = 1;

            if (empty($_FILES['avatar-input']['full_path'])) :
                if (!empty($data['delete-image'])) :
                    $avatarPath = 'public/client/assets/images/default_job.jpg';
                    $uploadOk = 1;
                else :
                    if (!empty($oldThumbnail)) :
                        $avatarPath = $oldThumbnail;
                    else :
                        $avatarPath = 'public/client/assets/images/default_job.jpg';
                    endif;
                    $uploadOk = 1;
                endif;
            else :
                // Xử lý tệp được tải lên
                $targetDir = "app/uploads/job/"; // Thư mục để lưu trữ ảnh đại diện
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

            $request->rules([
                'title' => 'required',
                'form_work' => 'required',
                'job_field' => 'required',
                'location' => 'required',
                'salary' => 'required',
                'deadline' => 'required',
                'rank' => 'required',
                'education_required' => 'required',
                'exp_required' => 'required',
                'number_recruits' => 'required',
                'requirement' => 'required',
                'description' => 'required',
                'welfare' => 'required',
            ]);

            $request->message([
                'title.required' => 'Tiêu đề không được để trống',
                'form_work.required' => 'Hình thức làm việc không được để trống',
                'job_field.required' => 'Lĩnh vực không được để trống',
                'location.required' => 'Địa điểm không được để trống',
                'salary.required' => 'Lương không được để trống',
                'deadline.required' => 'Thời hạn nộp không được để trống',
                'rank.required' => 'Cấp bậc không được để trống',
                'education_required.required' => 'Yêu cầu bằng cấp không được để trống',
                'exp_required.required' => 'Yêu cầu kinh nghiệm không được để trống',
                'number_recruits.required' => 'Số lượng tuyển không được để trống',
                'requirement.required' => 'Yêu cầu công việc không được để trống',
                'description.required' => 'Mô tả công việc không được để trống',
                'welfare.required' => 'Phúc lợi không được để trống',
            ]);

            $validate = $request->validate();

            if ($validate && $uploadOk == 1) :
                if (!empty($jobId)) :
                    if (!empty($targetFile)) :
                        if (move_uploaded_file($_FILES["avatar-input"]["tmp_name"], $targetFile)) :
                            // Cập nhật đường dẫn ảnh đại diện vào database
                            $avatarPath = $targetFile;
                        endif;
                    endif;

                    $resultUpdate = $this->employerModel->handleUpdateJob($jobId, $avatarPath);
                endif;

                if ($resultUpdate) :
                    $response->redirect('ntd/quan-ly-dang-tuyen/danh-sach');
                else :
                    Session::flash('msg', 'Thay đổi thất bại');
                    Session::flash('msg_type', 'danger');
                endif;
            else :
                Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                Session::flash('msg_type', 'danger');
            endif;
        endif;

        if (!empty($jobId)) :
            $result = $this->employerModel->handleViewJob($jobId);

            if (!empty($result)) :
                $dataJob = $result;
                $this->data['dataView']['dataJob'] = $dataJob;
            else :
                $emtyValue = 'Không có dữ liệu';
                $this->data['dataView']['emptyValue'] = $emtyValue;
            endif;
        endif;

        $jobField = $this->employerModel->handleGetJobField();
        $rank = $this->employerModel->handleGetJobRank();
        $education = $this->employerModel->handleGetEducation();
        $yearExp = $this->employerModel->handleGetYearExp();
        $formWork = $this->employerModel->handleGetFormWork();

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

        $this->data['body'] = 'client/ntd.profile/edit_job';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    public function deleteJob()
    {
        $response = new Response();
        $jobId = $_GET['id'];

        $result = $this->employerModel->handleDeleteJob($jobId);

        if ($result) :
            $response->redirect('ntd/quan-ly-dang-tuyen/danh-sach');
        endif;
    }

    // Xem thông tin của việc làm
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

        $countJobApplied = $this->employerModel->handleCountJobApplied();
        $result = $this->employerModel->handleGetListJobApplied($filters, $keyword ?? '');

        if (!empty($result)) :
            $listJobApplied = $result;
            $this->data['dataView']['listJobApplied'] = $listJobApplied;
        endif;

        if (is_numeric($countJobApplied)) :
            $quantityJob = $countJobApplied;
            $this->data['dataView']['quantityJob'] = $quantityJob;
        endif;

        $this->data['body'] = 'client/ntd.profile/applied_profile';
        $this->data['dataView']['request'] = $request;
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    // Xử lý trạng thái account
    public function changeStatusAppliedProfile()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data['id']) && !empty($data['action'])) :
            $jobId = $data['id'];
            $action = $data['action'];

            $result = $this->employerModel->handleChangeStatusAppliedProfile($jobId, $action); // Gọi xử lý ở Model

            if ($result) :
                $response->redirect('ntd/quan-ly-ung-vien/ho-so-ung-tuyen');
            endif;

        endif;
    }

    // Xử lý trạng thái account
    public function sendMailApplied()
    {
        $request = new Request();
        $jobId = $_GET['id'];

        if (!empty($jobId)) :
            $informationSendMail = $this->employerModel->handleGetInfoSendMail($jobId);

            if (!empty($informationSendMail)) :
                $this->data['dataView']['information'] = $informationSendMail;
            endif;

            if ($request->isPost()) :
                $request->rules([
                    'subject' => 'required',
                    'content' => 'required'
                ]);

                $request->message([
                    'subject.required' => 'Tiêu đề không được để trống',
                    'content.required' => 'Nội dung không được để trống',
                ]);

                $validate = $request->validate();

                if ($validate) :
                    $result = $this->employerModel->handleSendMailApplied($jobId); // Gọi xử lý ở Model

                    if ($result) :
                        Session::flash('msg', 'Đã gửi thành công');
                        Session::flash('msg_type', 'success');
                    else :
                        Session::flash('msg', 'Hệ thống đang gặp sự cố');
                        Session::flash('msg_type', 'danger');
                    endif;
                else :
                    Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                    Session::flash('msg_type', 'danger');
                endif;

            endif;
        endif;

        $this->data['body'] = 'client/ntd.profile/send_mail';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    public function changePassword()
    {
        $request = new Request();
        $userId = getIdEmployerLogin();

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
                $result = $this->employerModel->handleChangePassword($userId);

                if ($result) :
                    Session::flash('msg', 'Thay đổi mật khẩu thành công');
                    Session::flash('msg_type', 'success');
                endif;
            else :
                Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                Session::flash('msg_type', 'danger');
            endif;
        endif;


        $this->data['body'] = 'client/ntd.profile/changepassword';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }

    public function viewProfile()
    {
        $candidateId = $_GET['id'];

        if (!empty($candidateId)) :
            $profileId = $this->employerModel->handleGetProfileId($candidateId);
            $profileId = $profileId['id'];

            if (!empty($profileId)) :
                $result = $this->employerModel->handleGetPersonalInformation($profileId);

                if (!empty($result)) :
                    $information = $result;
                    $this->data['dataView']['information'] = $information;
                endif;

                $jobField = $this->employerModel->handleGetJobField();
                $rank = $this->employerModel->handleGetJobRank();
                $education = $this->employerModel->handleGetEducation();
                $yearExp = $this->employerModel->handleGetYearExp();
                $formWork = $this->employerModel->handleGetFormWork();

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

                $profileInformation = $this->employerModel->handleGetPersonalProfile($profileId);

                if (!empty($profileInformation)) :
                    $this->data['dataView']['profileInformation'] = $profileInformation;
                endif;
            endif;
        endif;

        $this->data['body'] = 'client/ntd.profile/view_candidate_profile';
        $this->data['dataView'][''] = '';
        $this->render('layouts/ntd.layout', $this->data, 'client');
    }
}
