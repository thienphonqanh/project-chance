<?php
class Contact extends Controller
{
    private $data = [];
    private $contactModel;
    private $config = [];

    public function __construct()
    {
        global $config;
        $this->config = $config['app'];
        $this->contactModel = $this->model('ContactModel', 'admin');
    }

    public function getListContact()
    {
        $request = new Request();
        $data = $request->getFields();

        $filters = [];

        if (!empty($data)) :
            extract($data);

            if (isset($status)) :
                switch ($status):
                    case 'active':
                        $filters['contacts.status'] = $status = 1;
                        break;
                    case 'inactive':
                        $filters['contacts.status'] = $status = 0;
                        break;
                    case 'unactive':
                        $filters['contacts.status'] = $status = 2;
                        break;
                endswitch;
            endif;
        endif;

        $resultPaginate = $this->contactModel->handleGetListContact($filters, $keyword ?? '', $this->config['page_limit']);

        $result = $resultPaginate['data'];

        $links = $resultPaginate['link'];

        if (!empty($result)) :
            $listContact = $result;

            $this->data['dataView']['listContact'] = $listContact;
        endif;


        $this->data['body'] = 'admin/contacts/index';
        $this->data['dataView']['request'] = $request;
        $this->data['dataView']['links'] = $links;
        $this->render('layouts/layout', $this->data, 'admin');
    }

    public function changeStatus()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data['id']) && !empty($data['action'])) :
            $userId = $data['id'];
            $action = $data['action'];

            $result = $this->contactModel->handleChangeStatus($userId, $action); // Gọi xử lý ở Model

            if ($result) :
                $response->redirect('contacts/danh-sach');
            endif;

        endif;
    }

    public function delete()
    {
        $request = new Request();
        $response = new Response();

        $data = $request->getFields();

        if (!empty($data)) :
            $itemsToDelete = isset($data['item']) ? $data['item'] : [];
            $itemsToDelete = implode(',', $itemsToDelete);

            $result = $this->contactModel->handleDelete($itemsToDelete);

            if ($result) :
                $response->redirect('contacts/danh-sach');
            endif;
        endif;
    }

    public function reply()
    {
        $request = new Request();
        $contactId = $_GET['id'];

        if (!empty($contactId)) :
            $result = $this->contactModel->handleGetMessage($contactId);

            if (!empty($result)) :
                $message = $result['message'];
                $this->data['dataView']['message'] = $message;

                if ($request->isPost()) :
                    $request->rules([
                        'reply' => 'required'
                    ]);

                    $request->message([
                        'reply.required' => 'Không được để trống'
                    ]);

                    $validate = $request->validate();

                    if ($validate) :
                        $sendMess = $this->contactModel->hanldeSendMessage($result['fullname'], $result['email'], $result['message']);

                        if ($sendMess) :
                            Session::flash('msg', 'Phản hồi thành công');
                            Session::flash('msg_type', 'success');
                        else :
                            Session::flash('msg', 'Phản hồi thất bại');
                            Session::flash('msg_type', 'danger');
                        endif;
                    endif;
                endif;
            endif;
        endif;

        $this->data['body'] = 'admin/contacts/reply';
        $this->data['dataView']['msg'] = Session::flash('msg');
        $this->data['dataView']['msgType'] = Session::flash('msg_type');
        $this->data['dataView']['errors'] = Session::flash('chance_session_errors');
        $this->data['dataView']['old'] = Session::flash('chance_session_old');
        $this->render('layouts/layout', $this->data, 'admin');
    }
}
