<?php
$this->render('block/header', [], 'admin');
$this->render('block/sidebar', [], 'admin');
$this->render('block/breadcrumb', [], 'admin');
$this->render($body, $dataView);
$this->render('block/footer', [], 'admin');
