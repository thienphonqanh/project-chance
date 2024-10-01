<?php
class Job extends Controller
{
    private $jobModel;
    private $data = [];

    public function __construct()
    {
        $this->jobModel = $this->model('JobModel', 'admin');
    }

    public function index()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];
        $keyword = [];

        if (!empty($data)) :
            extract($data);

            if (!empty($job_title) || !empty($job_location)) :
                $keyword = [
                    'job_title' => $job_title,
                    'job_location' => $job_location
                ];
            endif;

            if (isset($form_work) && $form_work != 0) :
                $filters['form_work'] = $form_work;
            endif;

            if (isset($exp_required) && $exp_required != 0) :
                $filters['exp_required'] = $exp_required;
            endif;

            if (isset($job_field) && $job_field != 0) :
                $filters['job_category_id'] = $job_field;
            endif;
        endif;

        $result = $this->jobModel->handleGetListJob($filters, $keyword ?? '');

        if (!empty($result)) :
            $listJob = $result;
            $quantityJob = count($listJob);
            $this->data['dataView']['listJob'] = $listJob;
            $this->data['dataView']['quantityJob'] = $quantityJob;
        endif;

        $jobField = $this->jobModel->handleGetJobField();
        $yearExp = $this->jobModel->handleGetYearExp();
        $formWork = $this->jobModel->handleGetFormWork();

        if (!empty($jobField) && !empty($yearExp) && !empty($formWork)) :
            $this->data['dataView']['jobField'] = $jobField;
            $this->data['dataView']['yearExp'] = $yearExp;
            $this->data['dataView']['formWork'] = $formWork;
        endif;

        $this->data['body'] = 'client/job/index';
        $this->data['dataView']['request'] = $request;
        $this->render('layouts/main.layout', $this->data, 'client');
    }

    public function detail()
    {
        $jobId = getIdInURL('chi-tiet-viec-lam');

        if (!empty($jobId)) :
            $this->jobModel->handleSetViewCount($jobId);  // Tăng view 

            $result = $this->jobModel->handleGetDetail($jobId); // Lấy data detail

            if (!empty($result)) :
                $dataDetail = $result;
                $jobField = $dataDetail[0]['jobField'];

                $randomData = $this->jobModel->handleRandomData($jobField);

                $this->data['dataView']['dataDetail'] = $dataDetail;

                if (!empty($randomData)) :
                    $this->data['dataView']['randomData'] = $randomData;
                endif;
            endif;


        endif;

        $this->data['body'] = 'client/job/detail';
        $this->render('layouts/main.layout', $this->data, 'client');
    }

    public function recruitment()
    {
        $request = new Request();
        $response = new Response();

        if (isUser()) :
            $userId = getIdUserLogin();
            $jobId = $_GET['id'];

            if (!empty($jobId)) :
                if ($this->jobModel->isJobId($jobId)) :
                    if ($request->isPost()) :
                        if (empty($_FILES['upload-cv']['full_path'])) :
                            Session::flash('msg', 'Vui lòng upload file CV');
                            Session::flash('msg_type', 'danger');
                        else :
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
                                'fullname' => 'required|min:6',
                                'email' => 'required|email',
                                'phone' => 'required|phone',
                            ]);

                            $request->message([
                                'fullname.required' => 'Họ và tên không được để trống',
                                'fullname.min' => 'Họ và tên phải có ít nhất 6 ký tự',
                                'email.required' => 'Email không được để trống',
                                'email.email' => 'Định dạng email không hợp lệ',
                                'phone.required' => 'Số điện thoại không được để trống',
                                'phone.phone' => 'Định dạng số điện thoại không hợp lệ',
                            ]);

                            $validate = $request->validate();

                            // Kiểm tra nếu $uploadOk = 0
                            if ($uploadOk == 1) :
                                if ($validate) :
                                    if (move_uploaded_file($_FILES["upload-cv"]["tmp_name"], $target_file)) :
                                        if (!empty($userId) && !empty($jobId)) :
                                            $result = $this->jobModel->handleRecruitment($userId, $jobId, $target_file);

                                            if ($result) :
                                                Session::flash('msg', 'Đã nộp thành công. Hãy chờ Nhà tuyển dụng thông báo đến bạn');
                                                Session::flash('msg_type', 'success');
                                            else :
                                                Session::flash('msg', 'Nộp thất bại');
                                                Session::flash('msg_type', 'danger');
                                            endif;
                                        endif;
                                    endif;
                                else :
                                    Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                                    Session::flash('msg_type', 'danger');
                                endif;
                            endif;
                        endif;
                    endif;
                else :
                    $response->redirect('tim-viec-lam');
                endif;
            else :
                $response->redirect('tim-viec-lam');
            endif;

            $this->data['body'] = 'client/job/recruitment';
            $this->data['dataView']['msg'] = Session::flash('msg');
            $this->data['dataView']['msgType'] = Session::flash('msg_type');
            $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
            $this->data['dataView']['old'] = Session::flash('chance_session_old');
        else :
            $this->data['body'] = 'client/job/blockpermission';
            $this->data['dataView'][''] = '';
        endif;


        $this->render('layouts/main.layout', $this->data, 'client');
    }
}
