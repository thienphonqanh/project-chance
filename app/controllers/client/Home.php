<?php
class Home extends Controller
{
    private $homeModel;
    private $data = [];

    public function __construct()
    {
        $this->homeModel = $this->model('HomeModel', 'admin');
    }

    public function index()
    {
        $jobCategory = $this->homeModel->handleGetJobCategory();
        $outstandingJob = $this->homeModel->handleGetOutstandingJob();
        $someHandbooks = $this->homeModel->handleGetSomeHandbooks();

        if (!empty($jobCategory)) :
            $this->data['dataView']['jobCategory'] = $jobCategory;
        endif;

        if (!empty($outstandingJob)) :
            $this->data['dataView']['outstandingJob'] = $outstandingJob;
        endif;

        if (!empty($someHandbooks)) :
            $this->data['dataView']['someHandbooks'] = $someHandbooks;
        endif;

        $this->data['body'] = 'client/home/index';
        $this->render('layouts/main.layout', $this->data, 'client');
    }
}
