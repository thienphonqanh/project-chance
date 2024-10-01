<?php
$this->render('block/ntd_header', [], 'client');
$this->render($body, $dataView);
$this->render('block/offcanvas_employer', [], 'client');
$this->render('block/footer', [], 'client');
