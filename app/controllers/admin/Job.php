<?php
class Job extends Controller
{
    private $jobModel;
    private $data = [];
    private $config = [];

    public function __construct()
    {
        global $config;
        $this->config = $config['app'];
        $this->jobModel = $this->model('JobModel', 'admin');
    }

    public function getListJob()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];

        if (!empty($data)) :
            extract($data);

            if (isset($status)) :
                switch ($status):
                    case 'active':
                        $filters['jobs.status'] = $status = 1;
                        break;
                    case 'inactive':
                        $filters['jobs.status'] = $status = 0;
                        break;
                    case 'unactive':
                        $filters['jobs.status'] = $status = 2;
                        break;
                endswitch;
            endif;
        endif;

        $resultPaginate = $this->jobModel->handleGetListJobDashboard($filters, $keyword ?? '', $this->config['page_limit']);

        $result = $resultPaginate['data'];

        $links = $resultPaginate['link'];

        if (!empty($result)) :
            $listJob = $result;
            $this->data['dataView']['listJob'] = $listJob;
        else :
            $emtyValue = 'Không có dữ liệu';
            $this->data['dataView']['emptyValue'] = $emtyValue;
        endif;

        $this->data['body'] = 'admin/jobs/index';
        $this->data['dataView']['request'] = $request;
        $this->data['dataView']['links'] = $links;
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function getCandidateProfile()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];

        if (!empty($data)) :
            extract($data);

            if (isset($status)) :
                switch ($status):
                    case 'active':
                        $filters['jobs.status'] = $status = 1;
                        break;
                    case 'inactive':
                        $filters['jobs.status'] = $status = 0;
                        break;
                    case 'unactive':
                        $filters['jobs.status'] = $status = 2;
                        break;
                endswitch;
            endif;
        endif;

        $resultPaginate = $this->jobModel->handleGetCandidateProfile($filters, $keyword ?? '', $this->config['page_limit']);

        $result = $resultPaginate['data'];

        $links = $resultPaginate['link'];

        if (!empty($result)) :
            $profile = $result;
            $this->data['dataView']['profile'] = $profile;
        else :
            $emtyValue = 'Không có dữ liệu';
            $this->data['dataView']['emptyValue'] = $emtyValue;
        endif;

        $this->data['body'] = 'admin/jobs/candidate_profile';
        $this->data['dataView']['request'] = $request;
        $this->data['dataView']['links'] = $links;
        $this->render('layouts/layout', $this->data, 'admin');
    }

    // Thay đổi trạng thái việc làm
    public function changeStatus()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data['id']) && !empty($data['action'])) :
            $userId = $data['id'];
            $action = $data['action'];

            $result = $this->jobModel->handleChangeStatus($userId, $action); // Gọi xử lý ở Model

            if ($result) :
                $response->redirect('jobs/danh-sach');
            endif;

        endif;
    }

    // Thay đổi trạng thái việc làm
    public function changeStatusCandidateProfile()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data['id']) && !empty($data['action'])) :
            $profileId = $data['id'];
            $action = $data['action'];

            $result = $this->jobModel->handleChangeStatusCandidateProfile($profileId, $action); // Gọi xử lý ở Model

            if ($result) :
                $response->redirect('jobs/ho-so-ung-vien');
            endif;

        endif;
    }

    // Xoá việc làm
    public function delete()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data)) :
            $itemsToDelete = isset($data['item']) ? $data['item'] : [];
            $itemsToDelete = implode(',', $itemsToDelete);

            $result = $this->jobModel->handleDelete($itemsToDelete);

            if ($result) :
                $response->redirect('jobs/danh-sach');
            endif;
        endif;
    }

    // Xoá việc làm
    public function deleteCandidateProfile()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data)) :
            $itemsToDelete = isset($data['item']) ? $data['item'] : [];
            $itemsToDelete = implode(',', $itemsToDelete);

            $result = $this->jobModel->handleDeleteCandidateProfile($itemsToDelete);

            if ($result) :
                $response->redirect('jobs/ho-so-ung-vien');
            endif;
        endif;
    }

    // Xem thông tin của việc làm
    public function viewJob()
    {
        $request = new Request();

        $data = $request->getFields();

        if (!empty($data['id'])) :
            $jobId = $data['id'];

            $result = $this->jobModel->handleViewJob($jobId);

            if (!empty($result)) :
                $dataJob = $result;
                $this->data['dataView']['dataJob'] = $dataJob;
            else :
                $emtyValue = 'Không có dữ liệu';
                $this->data['dataView']['emptyValue'] = $emtyValue;
            endif;
        endif;

        $jobField = $this->jobModel->handleGetJobField();
        $rank = $this->jobModel->handleGetJobRank();
        $education = $this->jobModel->handleGetEducation();
        $yearExp = $this->jobModel->handleGetYearExp();
        $formWork = $this->jobModel->handleGetFormWork();

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

        $this->data['body'] = 'admin/jobs/detail';
        $this->render('layouts/layout', $this->data, 'admin');
    }

    // Xem thông tin của việc làm
    public function updateJob()
    {
        $request = new Request();

        $data = $request->getFields();
        $jobId = $_GET['id'];
        $checkOld = $this->jobModel->handleGetOld($jobId);
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
                'company_name' => 'required',
                'slug' => 'required',
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
                'company_name.required' => 'Tên công ty không được để trống',
                'slug.required' => 'Đường dẫn không được để trống',
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

                    $resultUpdate = $this->jobModel->handleUpdateJob($jobId, $avatarPath);
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

        if (!empty($jobId)) :
            $result = $this->jobModel->handleViewJob($jobId);

            if (!empty($result)) :
                $dataJob = $result;
                $this->data['dataView']['dataJob'] = $dataJob;
            else :
                $emtyValue = 'Không có dữ liệu';
                $this->data['dataView']['emptyValue'] = $emtyValue;
            endif;
        endif;

        $jobField = $this->jobModel->handleGetJobField();
        $rank = $this->jobModel->handleGetJobRank();
        $education = $this->jobModel->handleGetEducation();
        $yearExp = $this->jobModel->handleGetYearExp();
        $formWork = $this->jobModel->handleGetFormWork();

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

        $this->data['body'] = 'admin/jobs/edit';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function editCandidateProfile()
    {
        $request = new Request();

        $profileId = $_GET['id'];

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
                                $result = $this->jobModel->handleEditPersonalProfile($profileId, $target_file);

                                if ($result) :
                                    Session::flash('msg', 'Lưu thông tin thành công');
                                    Session::flash('msg_type', 'success');
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
                        $result = $this->jobModel->handleEditPersonalProfile($profileId, '');

                        if ($result) :
                            Session::flash('msg', 'Lưu thông tin thành công');
                            Session::flash('msg_type', 'success');
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

        $result = $this->jobModel->handleGetPersonalInformation($profileId);

        if (!empty($result)) :
            $information = $result;
            $this->data['dataView']['information'] = $information;
        endif;

        $jobField = $this->jobModel->handleGetJobField();
        $rank = $this->jobModel->handleGetJobRank();
        $education = $this->jobModel->handleGetEducation();
        $yearExp = $this->jobModel->handleGetYearExp();
        $formWork = $this->jobModel->handleGetFormWork();

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

        $profileInformation = $this->jobModel->handleGetPersonalProfile($profileId);

        if (!empty($profileInformation)) :
            $this->data['dataView']['profileInformation'] = $profileInformation;
        endif;

        $this->data['body'] = 'admin/jobs/edit_profile';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function viewCandidateProfile()
    {
        $profileId = $_GET['id'];

        $result = $this->jobModel->handleGetPersonalInformation($profileId);

        if (!empty($result)) :
            $information = $result;
            $this->data['dataView']['information'] = $information;
        endif;

        $jobField = $this->jobModel->handleGetJobField();
        $rank = $this->jobModel->handleGetJobRank();
        $education = $this->jobModel->handleGetEducation();
        $yearExp = $this->jobModel->handleGetYearExp();
        $formWork = $this->jobModel->handleGetFormWork();

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

        $profileInformation = $this->jobModel->handleGetPersonalProfile($profileId);

        if (!empty($profileInformation)) :
            $this->data['dataView']['profileInformation'] = $profileInformation;
        endif;

        $this->data['body'] = 'admin/jobs/view_profile';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function viewCV() {
        $cvId = isset($_GET['id']) ? $_GET['id'] : null;

        if (isset($cvId)):
            $cvFile = $this->jobModel->handleGetFileCV($cvId);

            if (!empty($cvFile) && file_exists($cvFile['cv_file'])) :
                $fileExtension = pathinfo($cvFile['cv_file'], PATHINFO_EXTENSION);
                // Hiển thị file PDF trực tiếp
                if (pathinfo($fileExtension, PATHINFO_EXTENSION) === 'pdf') :
                    header('Content-type: application/pdf');
                    readfile($cvFile['cv_file']);
                else :
                    // Hiển thị link tải về cho các định dạng khác
                    header('Content-type: application/octet-stream');
                    header('Content-Disposition: attachment; filename="' . $cvFile['cv_file'] . '"');
                    readfile($cvFile['cv_file']);
                endif;
            endif;
        endif;

        
    }
}