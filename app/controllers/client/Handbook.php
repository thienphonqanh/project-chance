<?php
class Handbook extends Controller
{
    private $handbookModel;
    private $data = [];

    public function __construct()
    {
        $this->handbookModel = $this->model('HandbookModel', 'admin');
    }

    public function index()
    {
        $randomHandbook = $this->handbookModel->handleGetRandomHandbook();
        $firstPageHandbook = $this->handbookModel->handleGetHandbookFromPageLimit(1);
        $secondPageHandbook = $this->handbookModel->handleGetHandbookFromPageLimit(2);
        $fourthPageHandbook = $this->handbookModel->handleGetHandbookFromPageLimit(4);

        if (!empty($randomHandbook)) :
            $this->data['dataView']['randomHandbook'] = $randomHandbook;
        endif;

        if (!empty($firstPageHandbook)) :
            $this->data['dataView']['firstPageHandbook'] = $firstPageHandbook;
        endif;

        if (!empty($secondPageHandbook)) :
            $this->data['dataView']['secondPageHandbook'] = $secondPageHandbook;
        endif;

        if (!empty($fourthPageHandbook)) :
            $this->data['dataView']['fourthPageHandbook'] = $fourthPageHandbook;
        endif;

        $this->data['body'] = 'client/handbook/index';
        $this->data['page'] = 'handbook-page';
        $this->data['dataView'][''] = '';
        $this->render('layouts/handbook.layout', $this->data, 'client');
    }

    public function detail()
    {
        $response = new Response();

        $handbookId = getIdInURL('chi-tiet-bai-viet');

        if (!empty($handbookId)) :
            $check = $this->handbookModel->handleCheckHandbookId($handbookId);

            if ($check) :
                $this->handbookModel->handleSetViewCount($handbookId);  // Tăng view 

                $result = $this->handbookModel->handleGetDetail($handbookId); // Lấy data detail

                if (!empty($result)) :
                    $dataDetail = $result;
                    $this->data['dataView']['dataDetail'] = $dataDetail;

                    $listNewJob = $this->handbookModel->handleGetListNewJob();
                    $listSameCategory = $this->handbookModel->handleGetListSameCategory($handbookId);

                    if (!empty($listNewJob)) :
                        $this->data['dataView']['listNewJob'] = $listNewJob;
                    endif;

                    if (!empty($listSameCategory)) :
                        $this->data['dataView']['listSameCategory'] = $listSameCategory;
                    endif;
                endif;
            else :
                $response->redirect('errors/404.php');
            endif;
        endif;

        $this->data['body'] = 'client/handbook/detail';
        $this->data['page'] = 'handbook-detai-page';
        $this->data['dataView'][''] = '';
        $this->render('layouts/handbook.layout', $this->data, 'client');
    }

    public function firstPage()
    {
        $firstPageHandbook = $this->handbookModel->handleGetHandbookFromPage(1);

        if (!empty($firstPageHandbook)) :
            $this->data['dataView']['firstPageHandbook'] = $firstPageHandbook;
        endif;

        $this->data['body'] = 'client/handbook/first_page';
        $this->data['page'] = 'la-ban-su-nghiep-page';
        $this->data['dataView'][''] = '';
        $this->render('layouts/handbook.layout', $this->data, 'client');
    }

    public function secondPage()
    {
        $secondPageHandbook = $this->handbookModel->handleGetHandbookFromPage(2);

        if (!empty($secondPageHandbook)) :
            $this->data['dataView']['secondPageHandbook'] = $secondPageHandbook;
        endif;

        $this->data['body'] = 'client/handbook/second_page';
        $this->data['page'] = 'tram-sac-ky-nang-page';
        $this->data['dataView'][''] = '';
        $this->render('layouts/handbook.layout', $this->data, 'client');
    }

    public function thirdPage()
    {
        $thirdPageHandbook = $this->handbookModel->handleGetHandbookFromPage(3);

        if (!empty($thirdPageHandbook)) :
            $this->data['dataView']['thirdPageHandbook'] = $thirdPageHandbook;
        endif;

        $this->data['body'] = 'client/handbook/third_page';
        $this->data['page'] = 'toa-do-nhan-tai-page';
        $this->data['dataView'][''] = '';
        $this->render('layouts/handbook.layout', $this->data, 'client');
    }

    public function fourthPage()
    {
        $fourthPageHandbook = $this->handbookModel->handleGetHandbookFromPage(4);

        if (!empty($fourthPageHandbook)) :
            $this->data['dataView']['fourthPageHandbook'] = $fourthPageHandbook;
        endif;

        $this->data['body'] = 'client/handbook/fourth_page';
        $this->data['page'] = 'ki-ot-vui-ve-page';
        $this->data['dataView'][''] = '';
        $this->render('layouts/handbook.layout', $this->data, 'client');
    }
}
