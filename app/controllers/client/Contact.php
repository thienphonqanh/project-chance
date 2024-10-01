<?php
class Contact extends Controller
{
    private $data = [];
    private $contactModel;

    public function __construct()
    {
        $this->contactModel = $this->model('ContactModel', 'user');
    }

    public function index()
    {
        $request = new Request();
        $userId = getIdUserLogin();

        if (!empty($userId)) :
            if ($request->isPost()) :
                $request->rules([
                    'fullname' => 'required|min:5',
                    'email' => 'required|email',
                    'message' => 'required'
                ]);

                $request->message([
                    'fullname.required' => 'Họ tên không được để trống',
                    'fullname.min' => 'Họ tên phải lớn hơn 4 ký tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Định dạng email không hợp lệ',
                    'message.required' => 'Lời nhắn không được để trống',
                ]);

                $validate = $request->validate();

                if ($validate) :
                    $result = $this->contactModel->handleContact($userId);

                    if ($result) :
                        Session::flash('msg', 'Gửi thành công. Chúng tôi sẽ liên hệ lại với bạn qua Email vừa cung cấp');
                        Session::flash('msg_type', 'success');
                    else :
                        Session::flash('msg', 'Gửi thât bại');
                        Session::flash('msg_type', 'danger');
                    endif;
                else :
                    Session::flash('msg', 'Vui lòng kiểm tra toàn bộ dữ liệu');
                    Session::flash('msg_type', 'danger');
                endif;
            endif;

            $this->data['dataView']['msg'] = Session::flash('msg');
            $this->data['dataView']['msgType'] = Session::flash('msg_type');
            $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
            $this->data['dataView']['old'] = Session::flash('chance_session_old');
        endif;

        $this->data['body'] = 'client/contact/index';
        $this->data['dataView'][''] = '';
        $this->render('layouts/main.layout', $this->data, 'client');
    }
}
